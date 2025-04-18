<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Get booking ID from URL
$booking_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Get booking details with trainer and payment information
$sql = "SELECT 
            b.*, 
            t.first_name as trainer_first_name, 
            t.last_name as trainer_last_name,
            t.designation as trainer_designation,
            t.hero_img as trainer_image,
            t.email as trainer_email,
            t.mobile as trainer_mobile,
            t.about as trainer_about,
            ts.start_time,
            ts.end_time,
            ts.price,
            ta.date,
            p.status as payment_status,
            p.amount as payment_amount,
            p.transaction_id,
            p.payment_method,
            p.payment_date
        FROM bookings b
        INNER JOIN time_slots ts ON b.time_slot_id = ts.id
        INNER JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
        INNER JOIN trainers t ON ta.trainer_id = t.id
        LEFT JOIN payments p ON b.id = p.booking_id
        WHERE b.id = $booking_id AND b.user_id = " . $_SESSION['userid'];

$result = mysqli_query($connect, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: my_bookings.php");
    exit();
}

$booking = mysqli_fetch_assoc($result);

// Format date and time
$session_date = date('F j, Y', strtotime($booking['date']));
$start_time = date('h:i A', strtotime($booking['start_time']));
$end_time = date('h:i A', strtotime($booking['end_time']));
$payment_date = $booking['payment_date'] ? date('F j, Y h:i A', strtotime($booking['payment_date'])) : 'N/A';
?>

<!DOCTYPE html>
<html lang="en">

<?php include "include/meta.php" ?>

<body>
    <div class="main-page-wrapper">
        <!-- Loading Transition -->
        <div id="preloader">
            <div id="ctn-preloader" class="ctn-preloader">
                <div class="icon"><img src="../images/loader.gif" alt="" class="m-auto d-block" width="250"></div>
            </div>
        </div>

        <!-- Dashboard Aside Menu -->
        <?php include "include/aside.php" ?>

        <!-- Dashboard Body -->
        <div class="dashboard-body">
            <div class="position-relative">
                <!-- Header -->
                <?php include "include/header.php" ?>

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="main-title">Booking Details</h2>
                                <a href="my_bookings.php" class="btn btn-outline-primary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Bookings
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row gx-4">
                        <!-- Trainer Information -->
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body p-4">
                                    <h4 class="card-title mb-4">Trainer Information</h4>
                                    <div class="text-center mb-4">
                                        <img src="<?php echo $uri . $booking['trainer_image']; ?>" 
                                             alt="Trainer Image" 
                                             class="rounded-circle mb-3"
                                             style="width: 120px; height: 120px; object-fit: cover;">
                                        <h5 class="mb-1"><?php echo $booking['trainer_first_name'] . ' ' . $booking['trainer_last_name']; ?></h5>
                                        <p class="text-muted mb-2"><?php echo $booking['trainer_designation']; ?></p>
                                    </div>
                                    <div class="trainer-info">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bi bi-envelope me-2 text-primary"></i>
                                            <span><?php echo $booking['trainer_email']; ?></span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bi bi-telephone me-2 text-primary"></i>
                                            <span><?php echo $booking['trainer_mobile']; ?></span>
                                        </div>
                                        <div class="trainer-about">
                                            <p class="text-muted mb-0"><?php echo $booking['trainer_about']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="col-lg-8">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body p-4">
                                    <h4 class="card-title mb-4">Session Details</h4>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-calendar-event me-2 text-primary"></i>
                                                <div>
                                                    <small class="text-muted d-block">Date</small>
                                                    <span class="fw-bold"><?php echo $session_date; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-clock me-2 text-primary"></i>
                                                <div>
                                                    <small class="text-muted d-block">Time</small>
                                                    <span class="fw-bold"><?php echo $start_time . ' - ' . $end_time; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-currency-rupee me-2 text-primary"></i>
                                                <div>
                                                    <small class="text-muted d-block">Price</small>
                                                    <span class="fw-bold">₹<?php echo number_format($booking['price'], 2); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-credit-card me-2 text-primary"></i>
                                                <div>
                                                    <small class="text-muted d-block">Payment Status</small>
                                                    <span class="badge bg-<?php 
                                                        switch($booking['payment_status']) {
                                                            case 'completed': echo 'success'; break;
                                                            case 'pending': echo 'warning'; break;
                                                            case 'failed': echo 'danger'; break;
                                                            case 'refunded': echo 'info'; break;
                                                            default: echo 'secondary';
                                                        }
                                                    ?>">
                                                        <?php echo ucfirst($booking['payment_status'] ?? 'Pending'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if($booking['booking_notes']): ?>
                                    <div class="booking-notes mt-4">
                                        <h5 class="mb-3">Booking Notes</h5>
                                        <p class="text-muted mb-0"><?php echo $booking['booking_notes']; ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Payment Information -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <h4 class="card-title mb-4">Payment Information</h4>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-credit-card-2-front me-2 text-primary"></i>
                                                <div>
                                                    <small class="text-muted d-block">Payment Method</small>
                                                    <span class="fw-bold"><?php echo ucfirst($booking['payment_method'] ?? 'N/A'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-calendar-check me-2 text-primary"></i>
                                                <div>
                                                    <small class="text-muted d-block">Payment Date</small>
                                                    <span class="fw-bold"><?php echo $payment_date; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-receipt me-2 text-primary"></i>
                                                <div>
                                                    <small class="text-muted d-block">Transaction ID</small>
                                                    <span class="fw-bold"><?php echo $booking['transaction_id'] ?? 'N/A'; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-cash me-2 text-primary"></i>
                                                <div>
                                                    <small class="text-muted d-block">Amount Paid</small>
                                                    <span class="fw-bold">₹<?php echo number_format($booking['payment_amount'] ?? $booking['price'], 2); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="scroll-top">
            <i class="bi bi-arrow-up-short"></i>
        </button>

        <!-- Optional JavaScript -->
        <script src="../vendor/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../vendor/wow/wow.min.js"></script>
        <script src="../vendor/slick/slick.min.js"></script>
        <script src="../vendor/fancybox/fancybox.umd.js"></script>
        <script src="../vendor/jquery.lazy.min.js"></script>
        <script src="../vendor/jquery.counterup.min.js"></script>
        <script src="../vendor/jquery.waypoints.min.js"></script>
        <script src="../vendor/nice-select/jquery.nice-select.min.js"></script>
        <script src="../vendor/validator.js"></script>
        <script src="../js/theme.js"></script>
    </div>
</body>

</html>

<style>
.card {
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
}

.trainer-info i {
    font-size: 1.2rem;
    width: 24px;
}

.trainer-about {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 10px;
    margin-top: 1rem;
}

.booking-notes {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 10px;
}

.badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
}

.btn-outline-primary {
    border: 2px solid #4e73df;
    color: #4e73df;
    font-weight: 500;
}

.btn-outline-primary:hover {
    background: #4e73df;
    color: #fff;
}
</style> 