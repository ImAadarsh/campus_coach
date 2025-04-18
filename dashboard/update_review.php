<?php
include ("../include/private_page.php");
include ("../include/connect.php");

header('Content-Type: application/json');

// Check if required fields are present
if (!isset($_POST['review_id']) || !isset($_POST['rating']) || !isset($_POST['review'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

$review_id = $_POST['review_id'];
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

// Check if review exists and belongs to the current user
$check_sql = "SELECT id FROM trainer_reviews WHERE id = $review_id AND user_id = " . $_SESSION['userid'];
$check_result = mysqli_query($connect, $check_sql);

if (mysqli_num_rows($check_result) == 0) {
    echo json_encode(['success' => false, 'message' => 'Review not found or unauthorized']);
    exit;
}

// Update review
$update_sql = "UPDATE trainer_reviews 
               SET rating = $rating, 
                   review = '" . mysqli_real_escape_string($connect, $review) . "',
                   updated_at = CURRENT_TIMESTAMP
               WHERE id = $review_id";

if (mysqli_query($connect, $update_sql)) {
    echo json_encode(['success' => true, 'message' => 'Review updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update review']);
}
?> 