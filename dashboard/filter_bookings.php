<?php
include ("../include/private_page.php");
include ("../include/connect.php");


$user_id = $_SESSION['userid'];
// Get filter parameters
$status = isset($_POST['status']) ? $_POST['status'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$trainer = isset($_POST['trainer']) ? $_POST['trainer'] : '';
$payment = isset($_POST['payment']) ? $_POST['payment'] : '';

// Build the base query
$sql = "SELECT 
            b.*, 
            t.first_name as trainer_first_name, 
            t.last_name as trainer_last_name,
            t.designation as trainer_designation,
            t.hero_img as trainer_image,
            ts.start_time,
            ts.end_time,
            ts.price,
            ta.date,
            p.status as payment_status,
            p.amount as payment_amount,
            p.transaction_id
        FROM bookings b
        INNER JOIN time_slots ts ON b.time_slot_id = ts.id
        INNER JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
        INNER JOIN trainers t ON ta.trainer_id = t.id
        LEFT JOIN payments p ON b.id = p.booking_id
        WHERE b.user_id = '$user_id'";

// Add filters
if (!empty($status)) {
    $sql .= " AND b.status = '" . mysqli_real_escape_string($connect, $status) . "'";
}

if (!empty($date)) {
    $sql .= " AND ta.date = '" . mysqli_real_escape_string($connect, $date) . "'";
}

if (!empty($trainer)) {
    $sql .= " AND t.id = " . intval($trainer);
}

if (!empty($payment)) {
    $sql .= " AND p.status = '" . mysqli_real_escape_string($connect, $payment) . "'";
}

$sql .= " ORDER BY ta.date DESC, ts.start_time DESC";

$result = mysqli_query($connect, $sql);

if (!$result) {
    die(json_encode(['error' => 'Database error: ' . mysqli_error($connect)]));
}

$bookings = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Format the data for JSON
    $row['trainer_image'] = $uri . $row['trainer_image'];
    $bookings[] = $row;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($bookings); 