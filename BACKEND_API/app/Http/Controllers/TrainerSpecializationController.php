<?php

namespace App\Http\Controllers;

use App\Models\TrainerSpecialization;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainerSpecializationController extends Controller
{
    /**
     * Add a new specialization for a trainer
     *
     * @param Request $request
     * @param int $trainerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $trainerId)
    {
        $trainer = Trainer::find($trainerId);
        
        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Trainer not found.'
            ], 404);
        }
        
        $rules = [
            'token' => 'required|max:255',
            'specialization' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Check for duplicate specialization
        $existingSpecialization = TrainerSpecialization::where('trainer_id', $trainerId)
            ->where('specialization', $request->specialization)
            ->first();
            
        if ($existingSpecialization) {
            return response()->json([
                'status' => false,
                'message' => 'This specialization already exists for this trainer.'
            ], 400);
        }

        try {
            $specialization = new TrainerSpecialization();
            $specialization->trainer_id = $trainerId;
            $specialization->specialization = $request->specialization;
            $specialization->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Trainer specialization added successfully.',
                'data' => $specialization
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to add trainer specialization.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Remove a specialization from a trainer
     *
     * @param Request $request
     * @param int $trainerId
     * @param int $specializationId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $trainerId, $specializationId)
    {
        $rules = [
            'token' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        $specialization = TrainerSpecialization::where('id', $specializationId)
            ->where('trainer_id', $trainerId)
            ->first();
        
        if (!$specialization) {
            return response()->json([
                'status' => false,
                'message' => 'Specialization not found for this trainer.'
            ], 404);
        }
        
        try {
            $specialization->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Trainer specialization deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete trainer specialization.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
