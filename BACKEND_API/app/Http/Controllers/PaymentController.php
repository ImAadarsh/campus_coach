<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::query()->with(['booking', 'booking.user', 'booking.timeSlot']);
        
        // Apply filters
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }
        
        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('payment_date', [$request->date_from, $request->date_to]);
        }
        
        $payments = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return response()->json([
            'status' => true,
            'data' => $payments
        ]);
    }
    
    public function store(Request $request)
    {
        $rules = [
            'token' => 'required|max:255',
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
            'status' => 'required|in:pending,completed,failed,refunded',
            'payment_date' => 'nullable|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Check if booking exists and is not already paid
        $booking = Booking::find($request->booking_id);
        $existingPayment = Payment::where('booking_id', $request->booking_id)
            ->where('status', 'completed')
            ->exists();
            
        if ($existingPayment) {
            return response()->json([
                'status' => false,
                'message' => 'Payment already exists for this booking.'
            ], 400);
        }

        try {
            // Start a transaction
            DB::beginTransaction();
            
            $payment = new Payment();
            $payment->booking_id = $request->booking_id;
            $payment->amount = $request->amount;
            $payment->payment_method = $request->payment_method;
            $payment->transaction_id = $request->transaction_id;
            $payment->status = $request->status;
            $payment->payment_date = $request->payment_date ?? now();
            $payment->save();
            
            // If payment is completed, update booking status
            if ($request->status === 'completed' && $booking->status === 'pending') {
                $booking->status = 'confirmed';
                $booking->save();
            }
            
            DB::commit();
            
            return response()->json([
                'status' => true,
                'message' => 'Payment created successfully.',
                'data' => $payment
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => false,
                'message' => 'Failed to create payment.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function show($id)
    {
        $payment = Payment::with(['booking', 'booking.user', 'booking.timeSlot'])->find($id);
        
        if (!$payment) {
            return response()->json([
                'status' => false,
                'message' => 'Payment not found.'
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'data' => $payment
        ]);
    }
    
    public function updateStatus(Request $request, $id)
    {
        $payment = Payment::find($id);
        
        if (!$payment) {
            return response()->json([
                'status' => false,
                'message' => 'Payment not found.'
            ], 404);
        }
        
        $rules = [
            'token' => 'required|max:255',
            'status' => 'required|in:pending,completed,failed,refunded',
            'transaction_id' => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        try {
            // Start a transaction
            DB::beginTransaction();
            
            $oldStatus = $payment->status;
            $payment->status = $request->status;
            
            if ($request->has('transaction_id')) {
                $payment->transaction_id = $request->transaction_id;
            }
            
        if ($request->status === 'completed' && $oldStatus !== 'completed') {
            $payment->payment_date = now();
            
            // Update booking status if it's pending
            $booking = Booking::find($payment->booking_id);
            if ($booking->status === 'pending') {
                $booking->status = 'confirmed';
                $booking->save();
            }
        } else if ($request->status === 'refunded' && $oldStatus !== 'refunded') {
            // Update time slot status
            $booking = Booking::find($payment->booking_id);
            $timeSlot = TimeSlot::find($booking->time_slot_id);
            $timeSlot->status = 'available';
            $timeSlot->save();
        }
        
        $payment->save();
        
        DB::commit();
        
        return response()->json([
            'status' => true,
            'message' => 'Payment status updated successfully.',
            'data' => $payment
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        
        return response()->json([
            'status' => false,
            'message' => 'Failed to update payment status.',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
