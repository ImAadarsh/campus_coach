<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class TrainerController extends Controller
{
    public function index(Request $request)
    {
        $query = Trainer::query();
        
        // Apply filters if provided
        if ($request->has('specialization')) {
            $query->whereHas('specializations', function($q) use ($request) {
                $q->where('specialization', 'like', '%' . $request->specialization . '%');
            });
        }
        
        $trainers = $query->with('specializations')->paginate(10);
        
        return response()->json([
            'status' => true,
            'data' => $trainers
        ]);
    }
    
    public function store(Request $request)
    {
        $rules = [
            'token' => 'required|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'hero_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
            'short_about' => 'nullable|string|max:500',
            'about' => 'nullable|string',
            'designation' => 'required|string|max:255',
            'email' => 'required|email|unique:trainers,email',
            'passcode' => 'required|string|min:6',
            'mobile' => 'required|string|max:15|unique:trainers,mobile'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }

        $admin = User::where('remember_token', $request->token)->where('user_type', 'admin')->first();
        if (!$admin) {
            return response()->json(['status' => false, 'message' => 'Session expired. Please log in again.'], 401);
        }

        try {
            $trainer = new Trainer();
            $trainer->first_name = $request->first_name;
            $trainer->last_name = $request->last_name;
            $trainer->short_about = $request->short_about;
            $trainer->about = $request->about;
            $trainer->designation = $request->designation;
            $trainer->email = $request->email;
            $trainer->passcode = bcrypt($request->passcode);
            $trainer->mobile = $request->mobile;

            if ($request->hasFile('hero_img')) {
                $heroImgPath = $request->file('hero_img')->store('public/trainer/hero');
                $trainer->hero_img = $heroImgPath;
            }

            if ($request->hasFile('profile_img')) {
                $profileImgPath = $request->file('profile_img')->store('public/trainer/profile');
                $trainer->profile_img = $profileImgPath;
            }

            $trainer->save();

            return response()->json([
                'status' => true,
                'message' => 'Trainer created successfully.',
                'data' => $trainer
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create trainer.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function show($id)
    {
        $trainer = Trainer::with(['specializations', 'reviews'])->find($id);
        
        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Trainer not found.'
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'data' => $trainer
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $trainer = Trainer::find($id);
        
        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Trainer not found.'
            ], 404);
        }
        
        $rules = [
            'token' => 'required|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'hero_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
            'short_about' => 'nullable|string|max:500',
            'about' => 'nullable|string',
            'designation' => 'required|string|max:255',
            'email' => 'required|email|unique:trainers,email,' . $id,
            'passcode' => 'nullable|string|min:6',
            'mobile' => 'required|string|max:15|unique:trainers,mobile,' . $id
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }

        $admin = User::where('remember_token', $request->token)->where('user_type', 'admin')->first();
        if (!$admin) {
            return response()->json(['status' => false, 'message' => 'Session expired. Please log in again.'], 401);
        }

        try {
            $trainer->first_name = $request->first_name;
            $trainer->last_name = $request->last_name;
            $trainer->short_about = $request->short_about;
            $trainer->about = $request->about;
            $trainer->designation = $request->designation;
            $trainer->email = $request->email;
            $trainer->mobile = $request->mobile;
            
            if ($request->passcode) {
                $trainer->passcode = bcrypt($request->passcode);
            }

            if ($request->hasFile('hero_img')) {
                // Delete old image if exists
                if ($trainer->hero_img) {
                    Storage::delete($trainer->hero_img);
                }
                $heroImgPath = $request->file('hero_img')->store('public/trainer/hero');
                $trainer->hero_img = $heroImgPath;
            }

            if ($request->hasFile('profile_img')) {
                // Delete old image if exists
                if ($trainer->profile_img) {
                    Storage::delete($trainer->profile_img);
                }
                $profileImgPath = $request->file('profile_img')->store('public/trainer/profile');
                $trainer->profile_img = $profileImgPath;
            }

            $trainer->save();

            return response()->json([
                'status' => true,
                'message' => 'Trainer updated successfully.',
                'data' => $trainer
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update trainer.',
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

        $admin = User::where('remember_token', $request->token)->where('user_type', 'admin')->first();
        if (!$admin) {
            return response()->json(['status' => false, 'message' => 'Session expired. Please log in again.'], 401);
        }
        
        $trainer = Trainer::find($id);
        
        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Trainer not found.'
            ], 404);
        }
        
        try {
            // Delete associated images
            if ($trainer->hero_img) {
                Storage::delete($trainer->hero_img);
            }
            
            if ($trainer->profile_img) {
                Storage::delete($trainer->profile_img);
            }
            
            $trainer->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Trainer deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete trainer.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
