<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: trainers.php");
    exit();
}

// Validate and sanitize input
$trainer_id = mysqli_real_escape_string($connect, $_POST['trainer_id']);
$time_slot_id = mysqli_real_escape_string($connect, $_POST['time_slot_id']);
$notes = mysqli_real_escape_string($connect, $_POST['notes'] ?? '');

// Get user ID from session
$user_id = $_SESSION['userid'] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit();
}

// Start transaction
mysqli_begin_transaction($connect);

try {
    // Get time slot details
    $slot_sql = "SELECT ts.*, ta.date, ta.trainer_id 
                 FROM time_slots ts
                 JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
                 WHERE ts.id = '$time_slot_id' AND ts.status = 'available'";
    
    $slot_result = mysqli_query($connect, $slot_sql);
    $time_slot = mysqli_fetch_assoc($slot_result);

    if (!$time_slot) {
        throw new Exception("Selected time slot is no longer available");
    }

    // Create booking
    $booking_sql = "INSERT INTO bookings (user_id, time_slot_id, status, booking_notes) 
                    VALUES ('$user_id', '$time_slot_id', 'pending', '$notes')";
    
    if (!mysqli_query($connect, $booking_sql)) {
        throw new Exception("Failed to create booking");
    }

    $booking_id = mysqli_insert_id($connect);

    // Update time slot status
    $update_slot_sql = "UPDATE time_slots SET status = 'booked' WHERE id = '$time_slot_id'";
    if (!mysqli_query($connect, $update_slot_sql)) {
        throw new Exception("Failed to update time slot status");
    }

    // Create payment record
    $payment_sql = "INSERT INTO payments (booking_id, amount, payment_method, status) 
                    VALUES ('$booking_id', '{$time_slot['price']}', 'pending', 'pending')";
    
    if (!mysqli_query($connect, $payment_sql)) {
        throw new Exception("Failed to create payment record");
    }

    // Commit transaction
    mysqli_commit($connect);

    // Redirect to payment page
    header("Location: payment.php?booking_id=" . $booking_id);
    exit();

} catch (Exception $e) {
    // Rollback transaction
    mysqli_rollback($connect);
    
    // Log error
    error_log("Booking Error: " . $e->getMessage());
    
    // Redirect with error
    header("Location: book_session.php?trainer_id=" . $trainer_id . "&error=" . urlencode($e->getMessage()));
    exit();
}
?> 