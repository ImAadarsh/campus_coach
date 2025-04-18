<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use App\Models\TrainerAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimeSlotController extends Controller
{
    public function index(Request $request)
    {
        $query = TimeSlot::query()->with('trainerAvailability');
        
        // Apply filters
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('date')) {
            $query->whereHas('trainerAvailability', function($q) use ($request) {
                $q->where('date', $request->date);
            });
        }
        
        if ($request->has('trainer_id')) {
            $query->whereHas('trainerAvailability', function($q) use ($request) {
                $q->where('trainer_id', $request->trainer_id);
            });
        }
        
        $timeSlots = $query->paginate(15);
        
        return response()->json([
            'status' => true,
            'data' => $timeSlots
        ]);
    }
    
    public function store(Request $request)
    {
        $rules = [
            'trainer_availability_id' => 'required|exists:trainer_availabilities,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration_minutes' => 'required|integer|min:15',
            'price' => 'required|numeric|min:0',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Check for overlapping time slots
        $availability = TrainerAvailability::find($request->trainer_availability_id);
        $overlappingSlots = TimeSlot::where('trainer_availability_id', $request->trainer_availability_id)
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function($query) use ($request) {
                        $query->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                    });
            })
            ->exists();
            
        if ($overlappingSlots) {
            return response()->json([
                'status' => false,
                'message' => 'Time slot overlaps with existing slots.'
            ], 400);
        }

        try {
            $timeSlot = new TimeSlot();
            $timeSlot->trainer_availability_id = $request->trainer_availability_id;
            $timeSlot->start_time = $request->start_time;
            $timeSlot->end_time = $request->end_time;
            $timeSlot->duration_minutes = $request->duration_minutes;
            $timeSlot->price = $request->price;
            $timeSlot->status = 'available';
            $timeSlot->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Time slot created successfully.',
                'data' => $timeSlot
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create time slot.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function show($id)
    {
        $timeSlot = TimeSlot::with(['trainerAvailability', 'trainerAvailability.trainer'])->find($id);
        
        if (!$timeSlot) {
            return response()->json([
                'status' => false,
                'message' => 'Time slot not found.'
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'data' => $timeSlot
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $timeSlot = TimeSlot::find($id);
        
        if (!$timeSlot) {
            return response()->json([
                'status' => false,
                'message' => 'Time slot not found.'
            ], 404);
        }
        
        // Check if the time slot is already booked
        if ($timeSlot->status === 'booked') {
            return response()->json([
                'status' => false,
                'message' => 'Cannot update a booked time slot.'
            ], 400);
        }
        
        $rules = [
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration_minutes' => 'required|integer|min:15',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,cancelled,booked',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Check for overlapping time slots
        $overlappingSlots = TimeSlot::where('trainer_availability_id', $timeSlot->trainer_availability_id)
            ->where('id', '!=', $id)
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function($query) use ($request) {
                        $query->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                    });
            })
            ->exists();
            
        if ($overlappingSlots) {
            return response()->json([
                'status' => false,
                'message' => 'Time slot overlaps with existing slots.'
            ], 400);
        }

        try {
            $timeSlot->start_time = $request->start_time;
            $timeSlot->end_time = $request->end_time;
            $timeSlot->duration_minutes = $request->duration_minutes;
            $timeSlot->price = $request->price;
            $timeSlot->status = $request->status;
            $timeSlot->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Time slot updated successfully.',
                'data' => $timeSlot
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update time slot.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function destroy(Request $request, $id)
    {
        $rules = [
            'token' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        $timeSlot = TimeSlot::find($id);
        
        if (!$timeSlot) {
            return response()->json([
                'status' => false,
                'message' => 'Time slot not found.'
            ], 404);
        }
        
        // Check if the time slot is already booked
        if ($timeSlot->status === 'booked') {
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete a booked time slot.'
            ], 400);
        }
        
        try {
            $timeSlot->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Time slot deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete time slot.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function getAvailabilityTimeSlots($availabilityId)
    {
        $availability = TrainerAvailability::find($availabilityId);
        
        if (!$availability) {
            return response()->json([
                'status' => false,
                'message' => 'Availability not found.'
            ], 404);
        }
        
        $timeSlots = TimeSlot::where('trainer_availability_id', $availabilityId)
            ->orderBy('start_time')
            ->get();
            
        return response()->json([
            'status' => true,
            'data' => $timeSlots
        ]);
    }
}

