<?php
include ("../include/private_page.php");
include ("../include/connect.php");


$user_id = $_SESSION['userid'];
// Get booking ID from POST request
$booking_id = isset($_POST['booking_id']) ? intval($_POST['booking_id']) : 0;

if ($booking_id <= 0) {
    die(json_encode(['error' => 'Invalid booking ID']));
}

// Start transaction
mysqli_begin_transaction($connect);

try {
    // Verify booking exists and belongs to user
    $check_sql = "SELECT b.*, ta.date, ts.start_time, p.status as payment_status 
                  FROM bookings b
                  INNER JOIN time_slots ts ON b.time_slot_id = ts.id
                  INNER JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
                  LEFT JOIN payments p ON b.id = p.booking_id
                  WHERE b.id = $booking_id AND b.user_id = '$user_id'";
    
    $check_result = mysqli_query($connect, $check_sql);
    
    if (!$check_result || mysqli_num_rows($check_result) == 0) {
        throw new Exception('Booking not found or unauthorized');
    }
    
    $booking = mysqli_fetch_assoc($check_result);
    
    // Check if booking can be cancelled
    $current_time = time();
    $session_time = strtotime($booking['date'] . ' ' . $booking['start_time']);
    
    if ($booking['status'] != 'pending' || 
        $booking['payment_status'] != 'pending' || 
        $current_time >= $session_time) {
        throw new Exception('This booking cannot be cancelled');
    }
    
    // Update booking status to cancelled
    $update_sql = "UPDATE bookings SET status = 'cancelled' WHERE id = $booking_id";
    if (!mysqli_query($connect, $update_sql)) {
        throw new Exception('Failed to update booking status');
    }
    
    // Commit transaction
    mysqli_commit($connect);
    
    // Return success response
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Booking cancelled successfully']);
    
} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_rollback($connect);
    
    // Return error response
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
} 