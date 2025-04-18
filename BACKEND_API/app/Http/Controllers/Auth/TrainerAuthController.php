<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TrainerAuthController extends Controller
{
    /**
     * Trainer login
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false, 
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $trainer = Trainer::where('email', $request->email)->first();

        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Trainer not found'
            ], 404);
        }

        if (!Hash::check($request->password, $trainer->passcode)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Generate a new remember token
        $trainer->remember_token = Str::random(60);
        $trainer->save();

        // Create personal access token
        $token = $trainer->createToken('trainer_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'trainer' => [
                    'id' => $trainer->id,
                    'first_name' => $trainer->first_name,
                    'last_name' => $trainer->last_name,
                    'email' => $trainer->email,
                    'mobile' => $trainer->mobile,
                    'designation' => $trainer->designation,
                    'profile_img' => $trainer->profile_img,
                    'hero_img' => $trainer->hero_img,
                    'about' => $trainer->about,
                    'short_about' => $trainer->short_about,
                    'user_type' => 'trainer'
                ],
                'token' => $trainer->remember_token,
                'access_token' => $token
            ]
        ], 200);
    }

    /**
     * Trainer logout
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false, 
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $trainer = Trainer::where('remember_token', $request->token)->first();

        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token'
            ], 401);
        }

        // Revoke all tokens
        if (method_exists($trainer, 'tokens')) {
            $trainer->tokens()->delete();
        }

        // Clear remember token
        $trainer->remember_token = null;
        $trainer->save();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ], 200);
    }

    /**
     * Get trainer profile
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false, 
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $trainer = Trainer::where('remember_token', $request->token)->first();

        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token'
            ], 401);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'trainer' => [
                    'id' => $trainer->id,
                    'first_name' => $trainer->first_name,
                    'last_name' => $trainer->last_name,
                    'email' => $trainer->email,
                    'mobile' => $trainer->mobile,
                    'designation' => $trainer->designation,
                    'short_about' => $trainer->short_about,
                    'about' => $trainer->about,
                    'profile_img' => $trainer->profile_img,
                    'hero_img' => $trainer->hero_img,
                    'user_type' => 'trainer'
                ]
            ]
        ], 200);
    }
}
