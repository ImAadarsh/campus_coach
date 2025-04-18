<?php

namespace App\Http\Controllers;

use App\Models\RescheduleApproval;
use App\Models\RescheduleRequest;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RescheduleApprovalController extends Controller
{
    /**
     * Display a listing of reschedule approvals
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = RescheduleApproval::query()->with(['rescheduleRequest', 'newTimeSlot']);
        
        // Apply filters
        if ($request->has('approved_by_type')) {
            $query->where('approved_by_type', $request->approved_by_type);
        }
        
        if ($request->has('approved_by_id')) {
            $query->where('approved_by_id', $request->approved_by_id);
        }
        
        $approvals = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return response()->json([
            'status' => true,
            'data' => $approvals
        ]);
    }
    
    /**
     * Store a newly created reschedule approval
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'token' => 'required|string|max:255',
            'reschedule_request_id' => 'required|exists:reschedule_requests,id',
            'approved_by_id' => 'required|integer',
            'approved_by_type' => 'required|in:user,trainer,admin',
            'new_time_slot_id' => 'nullable|exists:time_slots,id',
            'notes' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Verify the reschedule request exists and is pending
        $rescheduleRequest = RescheduleRequest::find($request->reschedule_request_id);
        if (!$rescheduleRequest) {
            return response()->json([
                'status' => false,
                'message' => 'Reschedule request not found'
            ], 404);
        }
        
        if ($rescheduleRequest->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Cannot approve a reschedule request that is not pending'
            ], 400);
        }
        
        // Verify the new time slot is available if provided
        if ($request->new_time_slot_id) {
            $timeSlot = TimeSlot::find($request->new_time_slot_id);
            if (!$timeSlot || $timeSlot->status !== 'available') {
                return response()->json([
                    'status' => false,
                    'message' => 'The selected time slot is not available'
                ], 400);
            }   
        }

        try {
            // Start a transaction
            DB::beginTransaction();
            
            // Create the approval
            $approval = new RescheduleApproval();
            $approval->reschedule_request_id = $request->reschedule_request_id;
            $approval->approved_by_id = $request->approved_by_id;
            $approval->approved_by_type = $request->approved_by_type;
            $approval->new_time_slot_id = $request->new_time_slot_id;
            $approval->notes = $request->notes;
            $approval->save();
            
            // Update the reschedule request status
            $rescheduleRequest->status = 'approved';
            $rescheduleRequest->save();
            
            // Update the time slot status if a new one is provided
            if ($request->new_time_slot_id) {
                $timeSlot->status = 'booked';
                $timeSlot->save();
                
                // Update the booking with the new time slot
                $booking = $rescheduleRequest->booking;
                if ($booking) {
                    // Release the old time slot
                    $oldTimeSlot = $booking->timeSlot;
                    if ($oldTimeSlot) {
                        $oldTimeSlot->status = 'available';
                        $oldTimeSlot->save();
                    }
                    
                    // Assign the new time slot
                    $booking->time_slot_id = $request->new_time_slot_id;
                    $booking->save();
                }
            }
            
            DB::commit();
            
            return response()->json([
                'status' => true,
                'message' => 'Reschedule request approved successfully',
                'data' => $approval
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => false,
                'message' => 'Failed to approve reschedule request',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Display the specified reschedule approval
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $approval = RescheduleApproval::with(['rescheduleRequest', 'newTimeSlot'])->find($id);
        
        if (!$approval) {
            return response()->json([
                'status' => false,
                'message' => 'Reschedule approval not found'
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'data' => $approval
        ]);
    }
    
    /**
     * Update the specified reschedule approval
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $approval = RescheduleApproval::find($id);
        
        if (!$approval) {
            return response()->json([
                'status' => false,
                'message' => 'Reschedule approval not found'
            ], 404);
        }
        
        $rules = [
            'token' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }

        try {
            // Only allow updating notes
            if ($request->has('notes')) {
                $approval->notes = $request->notes;
                $approval->save();
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Reschedule approval updated successfully',
                'data' => $approval
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update reschedule approval',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
