<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: my_bookings.php");
    exit();
}

// Validate and sanitize input
$booking_id = intval($_POST['booking_id']);
$time_slot_id = intval($_POST['time_slot_id']);
$reason = mysqli_real_escape_string($connect, $_POST['reason'] ?? '');

// Get user ID from session
$user_id = $_SESSION['userid'];

// Start transaction
mysqli_begin_transaction($connect);

try {
    // Verify booking exists and belongs to user
    $check_sql = "SELECT b.*, t.id as trainer_id, ts.start_time, ts.end_time, ta.date 
                  FROM bookings b
                  INNER JOIN time_slots ts ON b.time_slot_id = ts.id
                  INNER JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
                  INNER JOIN trainers t ON ta.trainer_id = t.id
                  WHERE b.id = $booking_id AND b.user_id = $user_id AND b.status = 'confirmed'";
    
    $check_result = mysqli_query($connect, $check_sql);
    $booking = mysqli_fetch_assoc($check_result);
    
    if (!$booking) {
        throw new Exception('Booking not found or unauthorized');
    }

    // Get new time slot details
    $slot_sql = "SELECT ts.*, ta.date, ta.trainer_id 
                 FROM time_slots ts
                 JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
                 WHERE ts.id = $time_slot_id AND ts.status = 'available'";
    
    $slot_result = mysqli_query($connect, $slot_sql);
    $new_time_slot = mysqli_fetch_assoc($slot_result);

    if (!$new_time_slot) {
        throw new Exception("Selected time slot is no longer available");
    }

    // Verify the new time slot belongs to the same trainer
    if ($new_time_slot['trainer_id'] != $booking['trainer_id']) {
        throw new Exception("Invalid time slot selected");
    }

    // Create reschedule request
    $request_sql = "INSERT INTO reschedule_requests (
                        booking_id,
                        user_id,
                        trainer_id,
                        original_time_slot_id,
                        requested_date,
                        requested_start_time,
                        requested_end_time,
                        reason,
                        requested_by
                    ) VALUES (
                        $booking_id,
                        $user_id,
                        {$booking['trainer_id']},
                        {$booking['time_slot_id']},
                        '{$new_time_slot['date']}',
                        '{$new_time_slot['start_time']}',
                        '{$new_time_slot['end_time']}',
                        '$reason',
                        'user'
                    )";
    
    if (!mysqli_query($connect, $request_sql)) {
        throw new Exception("Failed to create reschedule request");
    }

    // Update booking status to pending_reschedule
    $update_sql = "UPDATE bookings SET status = 'pending_reschedule' WHERE id = $booking_id";
    if (!mysqli_query($connect, $update_sql)) {
        throw new Exception("Failed to update booking status");
    }

    // Update time slot status to pending_reschedule
    $update_slot_sql = "UPDATE time_slots SET status = 'pending_reschedule' WHERE id = $time_slot_id";
    if (!mysqli_query($connect, $update_slot_sql)) {
        throw new Exception("Failed to update time slot status");
    }

    // Commit transaction
    mysqli_commit($connect);

    // Redirect to success page
    header("Location: reschedule_success.php?booking_id=" . $booking_id);
    exit();

} catch (Exception $e) {
    // Rollback transaction
    mysqli_rollback($connect);
    
    // Redirect with error
    header("Location: reschedule.php?booking_id=" . $booking_id . "&error=" . urlencode($e->getMessage()));
    exit();
} 