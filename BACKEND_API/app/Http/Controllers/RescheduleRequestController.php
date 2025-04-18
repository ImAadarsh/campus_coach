<?php

namespace App\Http\Controllers;

use App\Models\RescheduleRequest;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RescheduleRequestController extends Controller
{
    /**
     * Display a listing of reschedule requests
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = RescheduleRequest::query()->with(['booking', 'booking.user', 'booking.timeSlot']);
        
        // Apply filters
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('user_id')) {
            $query->whereHas('booking', function($q) use ($request) {
                $q->where('user_id', $request->user_id);
            });
        }
        
        if ($request->has('trainer_id')) {
            $query->whereHas('booking.timeSlot.trainerAvailability', function($q) use ($request) {
                $q->where('trainer_id', $request->trainer_id);
            });
        }
        
        $requests = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return response()->json([
            'status' => true,
            'data' => $requests
        ]);
    }
    
    /**
     * Store a newly created reschedule request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'token' => 'required|string|max:255',
            'booking_id' => 'required|exists:bookings,id',
            'preferred_date' => 'required|date|after_or_equal:today',
            'preferred_time' => 'required|string',
            'reason' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Verify the booking exists and can be rescheduled
        $booking = Booking::find($request->booking_id);
        if (!$booking) {
            return response()->json([
                'status' => false,
                'message' => 'Booking not found'
            ], 404);
        }
        
        if (!in_array($booking->status, ['confirmed', 'pending'])) {
            return response()->json([
                'status' => false,
                'message' => 'Cannot reschedule a booking with status: ' . $booking->status
            ], 400);
        }
        
        // Check if there's already a pending reschedule request
        $existingRequest = RescheduleRequest::where('booking_id', $request->booking_id)
            ->where('status', 'pending')
            ->first();
            
        if ($existingRequest) {
            return response()->json([
                'status' => false,
                'message' => 'A pending reschedule request already exists for this booking'
            ], 400);
        }

        try {
            $rescheduleRequest = new RescheduleRequest();
            $rescheduleRequest->booking_id = $request->booking_id;
            $rescheduleRequest->preferred_date = $request->preferred_date;
            $rescheduleRequest->preferred_time = $request->preferred_time;
            $rescheduleRequest->reason = $request->reason;
            $rescheduleRequest->status = 'pending';
            $rescheduleRequest->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Reschedule request created successfully',
                'data' => $rescheduleRequest
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create reschedule request',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Display the specified reschedule request
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $rescheduleRequest = RescheduleRequest::with(['booking', 'booking.user', 'booking.timeSlot'])->find($id);
        
        if (!$rescheduleRequest) {
            return response()->json([
                'status' => false,
                'message' => 'Reschedule request not found'
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'data' => $rescheduleRequest
        ]);
    }
    
    /**
     * Update the specified reschedule request status
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        $rescheduleRequest = RescheduleRequest::find($id);
        
        if (!$rescheduleRequest) {
            return response()->json([
                'status' => false,
                'message' => 'Reschedule request not found'
            ], 404);
        }
        
        $rules = [
            'token' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Cannot update if already approved or rejected
        if ($rescheduleRequest->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Cannot update a reschedule request that is not pending'
            ], 400);
        }

        try {
            $rescheduleRequest->status = $request->status;
            $rescheduleRequest->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Reschedule request status updated successfully',
                'data' => $rescheduleRequest
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update reschedule request status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
