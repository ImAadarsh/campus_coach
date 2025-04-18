<?php

namespace App\Http\Controllers;

use App\Models\TrainerReview;
use App\Models\Booking;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainerReviewController extends Controller
{
    /**
     * Display a listing of trainer reviews with optional filters
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = TrainerReview::query()->with(['user', 'trainer', 'booking']);
        
        // Apply filters
        if ($request->has('rating')) {
            $query->where('rating', $request->rating);
        }
        
        if ($request->has('trainer_id')) {
            $query->where('trainer_id', $request->trainer_id);
        }
        
        $reviews = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return response()->json([
            'status' => true,
            'data' => $reviews
        ]);
    }
    
    /**
     * Store a newly created review
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'token' => 'required|max:255',
            'booking_id' => 'required|exists:bookings,id',
            'user_id' => 'required|exists:users,id',
            'trainer_id' => 'required|exists:trainers,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Validate booking ownership and status
        $booking = Booking::with('timeSlot.trainerAvailability')->where('id', $request->booking_id)->first();
        
        if (!$this->validateBookingOwnership($booking, $request)) {
            return response()->json([
                'status' => false,
                'message' => 'Booking validation failed. Please check user and trainer information.'
            ], 400);
        }
        
        // Check if review already exists
        $existingReview = TrainerReview::where('booking_id', $request->booking_id)->first();
        
        if ($existingReview) {
            return response()->json([
                'status' => false,
                'message' => 'Review already exists for this booking.'
            ], 400);
        }

        try {
            $review = new TrainerReview();
            $review->booking_id = $request->booking_id;
            $review->user_id = $request->user_id;
            $review->trainer_id = $request->trainer_id;
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Review submitted successfully.',
                'data' => $review
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to submit review.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Display the specified review
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $review = TrainerReview::with(['user', 'trainer', 'booking'])->find($id);
        
        if (!$review) {
            return response()->json([
                'status' => false,
                'message' => 'Review not found.'
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'data' => $review
        ]);
    }
    
    /**
     * Update the specified review
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $review = TrainerReview::find($id);
        
        if (!$review) {
            return response()->json([
                'status' => false,
                'message' => 'Review not found.'
            ], 404);
        }
        
        $rules = [
            'token' => 'required|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        // Verify user owns the review
        $user = User::where('remember_token', $request->token)->first();
        if (!$user || $user->id !== $review->user_id) {
            return response()->json([
                'status' => false,
                'message' => 'You are not authorized to update this review.'
            ], 403);
        }

        try {
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Review updated successfully.',
                'data' => $review
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update review.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Remove the specified review
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $rules = [
            'token' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        
        $review = TrainerReview::find($id);
        
        if (!$review) {
            return response()->json([
                'status' => false,
                'message' => 'Review not found.'
            ], 404);
        }
        
        // Verify user owns the review or is admin
        $user = User::where('remember_token', $request->token)->first();
        if (!$user || ($user->id !== $review->user_id && $user->user_type !== 'admin')) {
            return response()->json([
                'status' => false,
                'message' => 'You are not authorized to delete this review.'
            ], 403);
        }
        
        try {
            $review->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Review deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete review.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get all reviews for a specific trainer with rating statistics
     *
     * @param int $trainerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTrainerReviews($trainerId)
    {
        $trainer = Trainer::find($trainerId);
        
        if (!$trainer) {
            return response()->json([
                'status' => false,
                'message' => 'Trainer not found.'
            ], 404);
        }
        
        $reviews = TrainerReview::with('user')
            ->where('trainer_id', $trainerId)
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Calculate rating statistics
        $averageRating = $reviews->avg('rating');
        $reviewCount = $reviews->count();
        
        // Get rating distribution
        $ratingDistribution = [
            '5' => $reviews->where('rating', 5)->count(),
            '4' => $reviews->where('rating', 4)->count(),
            '3' => $reviews->where('rating', 3)->count(),
            '2' => $reviews->where('rating', 2)->count(),
            '1' => $reviews->where('rating', 1)->count(),
        ];
            
        return response()->json([
            'status' => true,
            'data' => [
                'reviews' => $reviews,
                'average_rating' => $averageRating,
                'review_count' => $reviewCount,
                'rating_distribution' => $ratingDistribution
            ]
        ]);
    }
    
    /**
     * Validate booking ownership and status
     *
     * @param Booking|null $booking
     * @param Request $request
     * @return bool
     */
    private function validateBookingOwnership($booking, Request $request)
    {
        if (!$booking || $booking->user_id != $request->user_id) {
            return false;
        }
        
        if (!$booking->timeSlot || !$booking->timeSlot->trainerAvailability || 
            $booking->timeSlot->trainerAvailability->trainer_id != $request->trainer_id) {
            return false;
        }
        
        // Check if booking is completed
        // if ($booking->status !== 'completed') {
        //     return false;
        // }
        
        return true;
    }
}
