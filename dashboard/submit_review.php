<?php
include ("../include/private_page.php");
include ("../include/connect.php");

header('Content-Type: application/json');

// Check if required fields are present
if (!isset($_POST['booking_id']) || !isset($_POST['rating']) || !isset($_POST['review'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

$booking_id = $_POST['booking_id'];
$rating = intval($_POST['rating']);
$review = trim($_POST['review']);

// Validate rating
if ($rating < 1 || $rating > 5) {
    echo json_encode(['success' => false, 'message' => 'Invalid rating']);
    exit;
}

// Validate review
if (empty($review)) {
    echo json_encode(['success' => false, 'message' => 'Review cannot be empty']);
    exit;
}

// Get booking details to verify user and trainer
$booking_sql = "SELECT b.*, t.id as trainer_id 
                FROM bookings b 
                JOIN time_slots ts ON b.time_slot_id = ts.id 
                JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id 
                JOIN trainers t ON ta.trainer_id = t.id 
                WHERE b.id = $booking_id AND b.user_id = " . $_SESSION['userid'];

$booking_result = mysqli_query($connect, $booking_sql);
$booking = mysqli_fetch_assoc($booking_result);

if (!$booking) {
    echo json_encode(['success' => false, 'message' => 'Invalid booking']);
    exit;
}

// Check if review already exists
$check_sql = "SELECT id FROM trainer_reviews WHERE booking_id = $booking_id";
$check_result = mysqli_query($connect, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    echo json_encode(['success' => false, 'message' => 'Review already exists for this booking']);
    exit;
}

// Insert review
$insert_sql = "INSERT INTO trainer_reviews (booking_id, user_id, trainer_id, rating, review) 
               VALUES ($booking_id, " . $_SESSION['userid'] . ", " . $booking['trainer_id'] . ", $rating, '" . 
               mysqli_real_escape_string($connect, $review) . "')";

if (mysqli_query($connect, $insert_sql)) {
    echo json_encode(['success' => true, 'message' => 'Review submitted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to submit review']);
}
?> 