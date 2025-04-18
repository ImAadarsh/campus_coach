<?php

use App\Http\Controllers\Auth\TrainerAuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RescheduleApprovalController;
use App\Http\Controllers\RescheduleRequestController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\TrainerAvailabilityController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TrainerReviewController;
use App\Http\Controllers\TrainerSettingsController;
use App\Http\Controllers\TrainerSpecializationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/register",'App\Http\Controllers\Authentication@register');
Route::post("/login",'App\Http\Controllers\Authentication@login');
Route::post("/profilecreation",'App\Http\Controllers\Authentication@profilecreation');
Route::post("/getstarted",'App\Http\Controllers\Authentication@getstarted');
Route::post("/emailverification",'App\Http\Controllers\Authentication@emailverification');

//user
Route::post('/userupdate', 'App\Http\Controllers\User@userupdate');
Route::post('/insertReview', 'App\Http\Controllers\User@insertReview');

Route::post('/insertContact', 'App\Http\Controllers\User@insertContact');
Route::post('/insertWishlist', 'App\Http\Controllers\User@insertWishlist');
Route::post('/addItemCart', 'App\Http\Controllers\User@addItemCart');
Route::post('/addItemCartCoupon', 'App\Http\Controllers\User@addItemCartCoupon');


Route::post('/removeItemCart', 'App\Http\Controllers\User@removeItemCart');
Route::post('/insertSubscriber', 'App\Http\Controllers\User@insertSubscriber');
Route::post('/cartPaymentFree', 'App\Http\Controllers\User@cartPaymentFree');

Route::post('/cartPaymentInitiate', 'App\Http\Controllers\User@cartPaymentInitiate');
Route::post('/cartPaymentSucess', 'App\Http\Controllers\User@cartPaymentSucess');

Route::post('/cartPaymentSucessWebhook', 'App\Http\Controllers\User@cartPaymentSucessWebhook');
Route::post('/cartPaymentSucess', 'App\Http\Controllers\User@cartPaymentSucess');
Route::post('/cartPaymentSucess', 'App\Http\Controllers\User@cartPaymentSucess');
Route::post('/cartPaymentSucess', 'App\Http\Controllers\User@cartPaymentSucess');
Route::post('/cartPaymentSucess', 'App\Http\Controllers\User@cartPaymentSucess');
Route::post('/cartPaymentSucess', 'App\Http\Controllers\User@cartPaymentSucess');
Route::post('/cartPaymentSucess', 'App\Http\Controllers\User@cartPaymentSucess');

//Admin

Route::post('/insertCategory', 'App\Http\Controllers\Admin@insertCategory');
Route::post('/insertTrainer', 'App\Http\Controllers\Admin@insertTrainer');
Route::post('/insertWorkshop', 'App\Http\Controllers\Admin@insertWorkshop');
Route::post('/insertTestimonial', 'App\Http\Controllers\Admin@insertTestimonial');
Route::post('/insertItem', 'App\Http\Controllers\Admin@insertItem');
Route::post('/insertEvent', 'App\Http\Controllers\Admin@insertEvent');

Route::post('/insertCoupon', 'App\Http\Controllers\Admin@insertCoupon');
Route::post('/insertBlogCategory', 'App\Http\Controllers\Admin@insertBlogCategory');
Route::post('/insertBlog', 'App\Http\Controllers\Admin@insertBlog');
// Route::post('/userupdate', 'App\Http\Controllers\Admin@userupdate');
// Route::post('/userupdate', 'App\Http\Controllers\Admin@userupdate');
// Route::post('/userupdate', 'App\Http\Controllers\Admin@userupdate');
// Route::post('/userupdate', 'App\Http\Controllers\Admin@userupdate');


// routes/api.php
Route::prefix('v1')->group(function () {
    // Trainer routes
    Route::apiResource('trainers', TrainerController::class);
    Route::post('trainers/{trainer}/specializations', [TrainerSpecializationController::class, 'store']);
    Route::delete('trainers/{trainer}/specializations/{specialization}', [TrainerSpecializationController::class, 'destroy']);
    
    // Availability routes
    Route::apiResource('availabilities', TrainerAvailabilityController::class);
    Route::get('trainers/{trainer}/availabilities', [TrainerAvailabilityController::class, 'getTrainerAvailabilities']);
    
    // Time slot routes
    Route::apiResource('time-slots', TimeSlotController::class);
    Route::get('availabilities/{availability}/time-slots', [TimeSlotController::class, 'getAvailabilityTimeSlots']);
    
    // Booking routes
    Route::apiResource('bookings', BookingController::class);
    Route::patch('bookings/{booking}/status', [BookingController::class, 'updateStatus']);
    Route::get('users/{user}/bookings', [BookingController::class, 'getUserBookings']);
    
    // Payment routes
    Route::apiResource('payments', PaymentController::class);
    Route::patch('payments/{payment}/status', [PaymentController::class, 'updateStatus']);
    
    // Review routes
    Route::apiResource('reviews', TrainerReviewController::class);
    Route::get('trainers/{trainer}/reviews', [TrainerReviewController::class, 'getTrainerReviews']);

    // Reschedule Request routes
    Route::apiResource('reschedule-requests', RescheduleRequestController::class);
    Route::patch('reschedule-requests/{id}/status', [RescheduleRequestController::class, 'updateStatus']);

    // Reschedule Approval routes
    Route::apiResource('reschedule-approvals', RescheduleApprovalController::class);


});

// Trainer Authentication Routes
Route::prefix('v1/trainer')->group(function () {
    Route::post('/login', [TrainerAuthController::class, 'login']);
    Route::post('/logout', [TrainerAuthController::class, 'logout']);
    Route::post('/profile', [TrainerAuthController::class, 'profile']);

    Route::post('/settings/update', [TrainerSettingsController::class, 'updateSettings']);
    Route::post('/profile-image/upload', [TrainerSettingsController::class, 'uploadProfileImage']);
    Route::post('/hero-image/upload', [TrainerSettingsController::class, 'uploadHeroImage']);
});


