<?php
include ("../include/private_page.php");
include ("../include/connect.php");

header('Content-Type: application/json');

$userId = $_SESSION['userid'];
$searchTerm = isset($_GET['q']) ? trim($_GET['q']) : '';

if (strlen($searchTerm) < 2) {
    echo json_encode(['error' => 'Search term must be at least 2 characters']);
    exit;
}

$results = [];

// Search in bookings
$sqlBookings = "SELECT b.*, t.first_name, t.last_name, t.designation, 
                ts.start_time, ts.end_time, ta.date, p.status as payment_status
                FROM bookings b
                JOIN time_slots ts ON b.time_slot_id = ts.id
                JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
                JOIN trainers t ON ta.trainer_id = t.id
                LEFT JOIN payments p ON b.id = p.booking_id
                WHERE b.user_id = $userId 
                AND (
                    t.first_name LIKE '%$searchTerm%' 
                    OR t.last_name LIKE '%$searchTerm%'
                    OR t.designation LIKE '%$searchTerm%'
                    OR b.status LIKE '%$searchTerm%'
                    OR p.status LIKE '%$searchTerm%'
                )
                ORDER BY ta.date DESC
                LIMIT 5";

$resultBookings = mysqli_query($connect, $sqlBookings);
while ($row = mysqli_fetch_assoc($resultBookings)) {
    $results[] = [
        'type' => 'booking',
        'id' => $row['id'],
        'title' => $row['first_name'] . ' ' . $row['last_name'],
        'subtitle' => $row['designation'],
        'date' => date('d M Y', strtotime($row['date'])),
        'time' => date('h:i A', strtotime($row['start_time'])) . ' - ' . date('h:i A', strtotime($row['end_time'])),
        'status' => $row['status'],
        'payment_status' => $row['payment_status'],
        'url' => 'booking_details.php?id=' . $row['id']
    ];
}

// Search in upcoming sessions
$sqlSessions = "SELECT b.*, t.first_name, t.last_name, t.designation, 
                ts.start_time, ts.end_time, ta.date
                FROM bookings b
                JOIN time_slots ts ON b.time_slot_id = ts.id
                JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
                JOIN trainers t ON ta.trainer_id = t.id
                WHERE b.user_id = $userId 
                AND b.status = 'confirmed'
                AND ta.date >= CURDATE()
                AND (
                    t.first_name LIKE '%$searchTerm%' 
                    OR t.last_name LIKE '%$searchTerm%'
                    OR t.designation LIKE '%$searchTerm%'
                )
                ORDER BY ta.date ASC
                LIMIT 5";

$resultSessions = mysqli_query($connect, $sqlSessions);
while ($row = mysqli_fetch_assoc($resultSessions)) {
    $results[] = [
        'type' => 'session',
        'id' => $row['id'],
        'title' => $row['first_name'] . ' ' . $row['last_name'],
        'subtitle' => $row['designation'],
        'date' => date('d M Y', strtotime($row['date'])),
        'time' => date('h:i A', strtotime($row['start_time'])) . ' - ' . date('h:i A', strtotime($row['end_time'])),
        'url' => 'booking_details.php?id=' . $row['id']
    ];
}

echo json_encode($results);
?> 