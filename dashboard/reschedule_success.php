<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Get booking ID from URL
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;

if (!$booking_id) {
    header("Location: my_bookings.php");
    exit();
}

// Get booking details
$sql = "SELECT b.*, t.first_name as trainer_first_name, t.last_name as trainer_last_name, 
               ts.start_time, ts.end_time, ta.date 
        FROM bookings b
        INNER JOIN time_slots ts ON b.time_slot_id = ts.id
        INNER JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
        INNER JOIN trainers t ON ta.trainer_id = t.id
        WHERE b.id = $booking_id AND b.user_id = {$_SESSION['userid']}";

$result = mysqli_query($connect, $sql);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    header("Location: my_bookings.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/meta.php" ?>
<body>
    <div class="main-page-wrapper">
        <!-- Dashboard Aside Menu -->
        <?php include "include/aside.php" ?>

        <!-- Dashboard Body -->
        <div class="dashboard-body">
            <div class="position-relative">
                <!-- Header -->
                <?php include "include/header.php" ?>

                <div class="container py-5">
                    <div class="success-message">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h5>Reschedule Request Submitted</h5>
                        <p>Your request to reschedule your session has been submitted successfully.</p>
                        <div class="booking-details">
                            <h6>Booking Details</h6>
                            <p><strong>Trainer:</strong> <?php echo htmlspecialchars($booking['trainer_first_name'] . ' ' . $booking['trainer_last_name']); ?></p>
                            <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($booking['date'])); ?></p>
                            <p><strong>Time:</strong> <?php echo date('h:i A', strtotime($booking['start_time'])) . ' - ' . date('h:i A', strtotime($booking['end_time'])); ?></p>
                        </div>
                        <div class="next-steps">
                            <h6>What happens next?</h6>
                            <ul>
                                <li>The trainer will review your reschedule request</li>
                                <li>You will be notified once the trainer responds</li>
                                <li>You can check the status of your request in your bookings</li>
                            </ul>
                        </div>
                        <div class="action-buttons">
                            <a href="my_bookings.php" class="btn btn-primary">View My Bookings</a>
                            <a href="index.php" class="btn btn-secondary">Return to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="../vendor/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/theme.js"></script>
    <?php include "include/footer.php" ?>

    <style>
        .success-message {
            text-align: center;
            padding: 2rem;
            max-width: 600px;
            margin: 2rem auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }
        .booking-details {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 6px;
            margin: 2rem 0;
            text-align: left;
        }
        .next-steps {
            text-align: left;
            margin: 2rem 0;
        }
        .next-steps ul {
            list-style-type: none;
            padding-left: 0;
        }
        .next-steps li {
            margin: 0.5rem 0;
            padding-left: 1.5rem;
            position: relative;
        }
        .next-steps li:before {
            content: "✓";
            color: #28a745;
            position: absolute;
            left: 0;
        }
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: #007bff;
            color: white;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
    </style>
</body>
</html> 