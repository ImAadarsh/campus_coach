<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query()->with(['user', 'timeSlot', 'timeSlot.trainerAvailability', 'timeSlot.trainerAvailability.trainer']);
        
        // Apply filters
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereHas('timeSlot.trainerAvailability', function($q) use ($request) {
                $q->whereBetween('date', [$request->date_from, $request->date_to]);
            });
        }
        
        if ($request->has('trainer_id')) {
            $query->whereHas('timeSlot.trainerAvailability', function($q) use ($request) {
                $q->where('trainer_id', $request->trainer_id);
            });
        }
        
        $bookings = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return response()->json([
            'status' => true,
            'data' => $bookings
        ]);
    }
    
    public function store(Request $request)
    {
        $rules = [
            'token' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'booking_notes' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Check if time slot is available
        $timeSlot = TimeSlot::find($request->time_slot_id);
        if (!$timeSlot || $timeSlot->status !== 'available') {
            return response()->json([
                'status' => false,
                'message' => 'Time slot is not available for booking.'
            ], 400);
        }

        try {
            // Start a transaction
            DB::beginTransaction();
            
            // Create booking
            $booking = new Booking();
            $booking->user_id = $request->user_id;
            $booking->time_slot_id = $request->time_slot_id;
            $booking->status = 'pending';
            $booking->booking_notes = $request->booking_notes;
            $booking->save();
            
            // Update time slot status
            $timeSlot->status = 'booked';
            $timeSlot->save();
            
            DB::commit();
            
            return response()->json([
                'status' => true,
                'message' => 'Booking created successfully.',
                'data' => $booking
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => false,
                'message' => 'Failed to create booking.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function show($id)
    {
        $booking = Booking::with([
            'user', 
            'timeSlot', 
            'timeSlot.trainerAvailability', 
            'timeSlot.trainerAvailability.trainer',
            'payments'
        ])->find($id);
        
        if (!$booking) {
            return response()->json([
                'status' => false,
                'message' => 'Booking not found.'
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'data' => $booking
        ]);
    }
    
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::find($id);
        
        if (!$booking) {
            return response()->json([
                'status' => false,
                'message' => 'Booking not found.'
            ], 404);
        }
        
        $rules = [
            'token' => 'required|max:255',
            'status' => 'required|in:pending,confirmed,completed,cancelled,refunded',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        try {
            // Start a transaction
            DB::beginTransaction();
            
            $oldStatus = $booking->status;
            $booking->status = $request->status;
            $booking->save();
            
            // If booking is cancelled or refunded, update time slot status
            if (in_array($request->status, ['cancelled', 'refunded']) && $oldStatus !== 'cancelled' && $oldStatus !== 'refunded') {
                $timeSlot = TimeSlot::find($booking->time_slot_id);
                $timeSlot->status = 'available';
                $timeSlot->save();
            }
            
            DB::commit();
            
            return response()->json([
                'status' => true,
                'message' => 'Booking status updated successfully.',
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => false,
                'message' => 'Failed to update booking status.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function getUserBookings($userId)
    {
        $user = User::find($userId);
        
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }
        
        $bookings = Booking::with([
            'timeSlot', 
            'timeSlot.trainerAvailability', 
            'timeSlot.trainerAvailability.trainer',
            'payments'
        ])
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();
            
        return response()->json([
            'status' => true,
            'data' => $bookings
        ]);
    }
}
