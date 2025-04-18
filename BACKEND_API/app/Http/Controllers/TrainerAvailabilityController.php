<?php

namespace App\Http\Controllers;

use App\Models\TrainerAvailability;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainerAvailabilityController extends Controller
{
    public function index()
    {
        $availabilities = TrainerAvailability::with(['trainer', 'timeSlots'])->paginate(15);
        
        return response()->json([
            'status' => true,
            'data' => $availabilities
        ]);
    }
    
    public function store(Request $request)
    {
        $rules = [
            'token' => 'required|max:255',
            'trainer_id' => 'required|exists:trainers,id',
            'date' => 'required|date|after_or_equal:today',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Check for duplicate availability
        $existingAvailability = TrainerAvailability::where('trainer_id', $request->trainer_id)
            ->where('date', $request->date)
            ->first();
            
        if ($existingAvailability) {
            return response()->json([
                'status' => false,
                'message' => 'Trainer already has availability for this date.'
            ], 400);
        }

        try {
            $availability = new TrainerAvailability();
            $availability->trainer_id = $request->trainer_id;
            $availability->date = $request->date;
            $availability->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Trainer availability created successfully.',
                'data' => $availability
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create trainer availability.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function show($id)
    {
        $availability = TrainerAvailability::with(['trainer', 'timeSlots'])->find($id);
        
        if (!$availability) {
            return response()->json([
                'status' => false,
                'message' => 'Availability not found.'
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'data' => $availability
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $availability = TrainerAvailability::find($id);
        
        if (!$availability) {
            return response()->json([
                'status' => false,
                'message' => 'Availability not found.'
            ], 404);
        }
        
        $rules = [
            'token' => 'required|max:255',
            'date' => 'required|date|after_or_equal:today',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Check for duplicate availability
        $existingAvailability = TrainerAvailability::where('trainer_id', $availability->trainer_id)
            ->where('date', $request->date)
            ->where('id', '!=', $id)
            ->first();
            
        if ($existingAvailability) {
            return response()->json([
                'status' => false,
                'message' => 'Trainer already has availability for this date.'
            ], 400);
        }

        try {
            $availability->date = $request->date;
            $availability->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Trainer availability updated successfully.',
                'data' => $availability
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update trainer availability.',
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
        
        $availability = TrainerAvailability::find($id);
        
        if (!$availability) {
            return response()->json([
                'status' => false,
                'message' => 'Availability not found.'
            ], 404);
        }
        
        try {
            $availability->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Trainer availability deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete trainer availability.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function getTrainerAvailabilities($trainerId)
    {
        $trainer = Trainer::find($trainerId);
        
        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Trainer not found.'
            ], 404);
        }
        
        $availabilities = TrainerAvailability::with('timeSlots')
            ->where('trainer_id', $trainerId)
            ->orderBy('date')
            ->get();
            
        return response()->json([
            'status' => true,
            'data' => $availabilities
        ]);
    }
}
