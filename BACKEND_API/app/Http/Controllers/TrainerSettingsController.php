<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class TrainerSettingsController extends Controller
{
    /**
     * Update trainer settings
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'short_about' => 'sometimes|nullable|string|max:500',
            'about' => 'sometimes|nullable|string',
            'designation' => 'sometimes|string|max:255',
            'mobile' => 'sometimes|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $trainer = Trainer::where('remember_token', $request->token)->first();
        
        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token or trainer not found'
            ], 401);
        }

        try {
            // Update only the fields that were provided
            if ($request->has('first_name')) $trainer->first_name = $request->first_name;
            if ($request->has('last_name')) $trainer->last_name = $request->last_name;
            if ($request->has('short_about')) $trainer->short_about = $request->short_about;
            if ($request->has('about')) $trainer->about = $request->about;
            if ($request->has('designation')) $trainer->designation = $request->designation;
            if ($request->has('mobile')) $trainer->mobile = $request->mobile;
            
            $trainer->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Settings updated successfully',
                'data' => $trainer
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update settings',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Upload trainer profile image
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:9048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $trainer = Trainer::where('remember_token', $request->token)->first();
        
        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token or trainer not found'
            ], 401);
        }

        try {
            // Delete old image if exists
            if ($trainer->profile_img) {
                Storage::delete($trainer->profile_img);
            }
            
            // Upload new image
            $profileImgPath = $request->file('profile_img')->store('public/trainer/profile');
            $trainer->profile_img = $profileImgPath;
            $trainer->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Profile image uploaded successfully',
                'data' => [
                    'profile_img' => $profileImgPath,
                    'profile_img_url' => Storage::url($profileImgPath)
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to upload profile image',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Upload trainer hero image
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadHeroImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'hero_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:9048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $trainer = Trainer::where('remember_token', $request->token)->first();
        
        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token or trainer not found'
            ], 401);
        }

        try {
            // Delete old image if exists
            if ($trainer->hero_img) {
                Storage::delete($trainer->hero_img);
            }
            
            // Upload new image
            $heroImgPath = $request->file('hero_img')->store('public/trainer/hero');
            $trainer->hero_img = $heroImgPath;
            $trainer->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Hero image uploaded successfully',
                'data' => [
                    'hero_img' => $heroImgPath,
                    'hero_img_url' => Storage::url($heroImgPath)
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to upload hero image',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
