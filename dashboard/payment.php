<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Check if booking_id is provided
if (!isset($_GET['booking_id'])) {
    header("Location: my_bookings.php");
    exit();
}

$booking_id = mysqli_real_escape_string($connect, $_GET['booking_id']);

// Get booking details with payment information
$sql = "SELECT b.*, 
        t.first_name as trainer_first_name, 
        t.last_name as trainer_last_name,
        t.designation as trainer_designation,
        ts.start_time, 
        ts.end_time,
        ts.price,
        ta.date,
        p.status as payment_status,
        p.amount as payment_amount,
        p.id as payment_id
        FROM bookings b
        JOIN time_slots ts ON b.time_slot_id = ts.id
        JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
        JOIN trainers t ON ta.trainer_id = t.id
        LEFT JOIN payments p ON b.id = p.booking_id
        WHERE b.id = '$booking_id' AND b.user_id = '{$_SESSION['userid']}'";

$result = mysqli_query($connect, $sql);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    header("Location: my_bookings.php");
    exit();
}

// Check if payment is already completed
if ($booking['payment_status'] === 'completed') {
    header("Location: my_bookings.php");
    exit();
}

// Handle payment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Start transaction
    mysqli_begin_transaction($connect);

    try {
        // Update payment status
        $payment_sql = "UPDATE payments 
                       SET status = 'completed', 
                           payment_date = NOW(),
                           payment_method = 'online'
                       WHERE booking_id = '$booking_id'";
        
        if (!mysqli_query($connect, $payment_sql)) {
            throw new Exception("Failed to update payment status");
        }

        // Update booking status
        $booking_sql = "UPDATE bookings 
                       SET status = 'confirmed'
                       WHERE id = '$booking_id'";
        
        if (!mysqli_query($connect, $booking_sql)) {
            throw new Exception("Failed to update booking status");
        }

        // Commit transaction
        mysqli_commit($connect);

        // Redirect to success page
        header("Location: payment_success.php?booking_id=" . $booking_id);
        exit();

    } catch (Exception $e) {
        // Rollback transaction
        mysqli_rollback($connect);
        
        // Log error
        error_log("Payment Error: " . $e->getMessage());
        
        // Redirect with error
        header("Location: payment.php?booking_id=" . $booking_id . "&error=" . urlencode($e->getMessage()));
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "include/meta.php" ?>

<body>
	<div class="main-page-wrapper">
		<!-- ===================================================
			Loading Transition
		==================================================== -->
		<div id="preloader">
			<div id="ctn-preloader" class="ctn-preloader">
				<div class="icon"><img src="../images/loader.gif" alt="" class="m-auto d-block" width="250"></div>
			</div>
		</div>

		<!-- 
		=============================================
			Dashboard Aside Menu
		============================================== 
		-->
        <?php include "include/aside.php" ?>
		<!-- /.dash-aside-navbar -->

		<!-- 
		=============================================
			Dashboard Body
		============================================== 
		-->
		<div class="dashboard-body">
			<div class="position-relative">
				<!-- ************************ Header **************************** -->
                <?php include "include/header.php" ?>
				<!-- End Header -->

				<h2 class="main-title d-block d-lg-none">Payment</h2>

				<div class="row">
                    <div class="col-lg-8">
                        <div class="card border-25 mb-4">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">Complete Payment</h5>
                                
                                <?php if (isset($_GET['error'])): ?>
                                    <div class="alert alert-danger">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        <?php echo htmlspecialchars($_GET['error']); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Booking Summary -->
                                <div class="booking-summary mb-4">
                                    <h6 class="mb-3">Booking Details</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Trainer</label>
                                                <div class="fw-bold">
                                                    <?php echo htmlspecialchars($booking['trainer_first_name'] . ' ' . $booking['trainer_last_name']); ?>
                                                </div>
                                                <div class="small text-muted">
                                                    <?php echo htmlspecialchars($booking['trainer_designation']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Date & Time</label>
                                                <div class="fw-bold">
                                                    <?php echo date('D, M d, Y', strtotime($booking['date'])); ?>
                                                </div>
                                                <div class="small text-muted">
                                                    <?php echo date('h:i A', strtotime($booking['start_time'])) . ' - ' . date('h:i A', strtotime($booking['end_time'])); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Form -->
                                <form action="payment.php?booking_id=<?php echo $booking_id; ?>" method="POST">
                                    <div class="payment-methods mb-4">
                                        <h6 class="mb-3">Payment Method</h6>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="creditCard" value="credit_card" checked>
                                            <label class="form-check-label" for="creditCard">
                                                <i class="bi bi-credit-card me-2"></i>Credit Card
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="debitCard" value="debit_card">
                                            <label class="form-check-label" for="debitCard">
                                                <i class="bi bi-credit-card-2-front me-2"></i>Debit Card
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="upi" value="upi">
                                            <label class="form-check-label" for="upi">
                                                <i class="bi bi-phone me-2"></i>UPI
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Payment Amount -->
                                    <div class="payment-amount mb-4">
                                        <h6 class="mb-3">Payment Summary</h6>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Session Fee</span>
                                            <span class="fw-bold">₹<?php echo number_format($booking['price'], 2); ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Tax (18%)</span>
                                            <span class="fw-bold">₹<?php echo number_format($booking['price'] * 0.18, 2); ?></span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Total Amount</span>
                                            <span class="fw-bold fs-5">₹<?php echo number_format($booking['price'] * 1.18, 2); ?></span>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-credit-card me-2"></i>Pay Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Security Info -->
                    <div class="col-lg-4">
                        <div class="card border-25">
                            <div class="card-body p-4">
                                <h6 class="card-title mb-3">Secure Payment</h6>
                                <div class="security-info">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-shield-check text-success me-2"></i>
                                        <span>Your payment is secure and encrypted</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-lock text-primary me-2"></i>
                                        <span>We never store your card details</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-credit-card-2-back text-info me-2"></i>
                                        <span>All major cards accepted</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<!-- /.dashboard-body -->

		<button class="scroll-top">
			<i class="bi bi-arrow-up-short"></i>
		</button>

		<!-- Optional JavaScript _____________________________  -->
		<!-- jQuery first, then Bootstrap JS -->
		<!-- jQuery -->
		<script src="../vendor/jquery.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- WOW js -->
		<script src="../vendor/wow/wow.min.js"></script>
		<!-- Slick Slider -->
		<script src="../vendor/slick/slick.min.js"></script>
		<!-- Fancybox -->
		<script src="../vendor/fancybox/fancybox.umd.js"></script>
		<!-- Lazy -->
		<script src="../vendor/jquery.lazy.min.js"></script>
		<!-- js Counter -->
		<script src="../vendor/jquery.counterup.min.js"></script>
		<script src="../vendor/jquery.waypoints.min.js"></script>
		<!-- Nice Select -->
		<script src="../vendor/nice-select/jquery.nice-select.min.js"></script>
		<!-- validator js -->
		<script src="../vendor/validator.js"></script>

		<!-- Theme js -->
		<script src="../js/theme.js"></script>
	</div> <!-- /.main-page-wrapper -->
</body>

</html>

<style>
.booking-summary {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
}

.payment-methods .form-check {
    padding: 0.75rem;
    border: 1px solid #eee;
    border-radius: 8px;
    margin-bottom: 0.5rem;
}

.payment-methods .form-check:hover {
    background: #f8f9fa;
}

.payment-amount {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
}

.security-info i {
    font-size: 1.25rem;
}

.security-info span {
    font-size: 0.9rem;
}
</style> 