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
        p.payment_date
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

				<h2 class="main-title d-block d-lg-none">Payment Successful</h2>

				<div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card border-25 mb-4">
                            <div class="card-body p-4 text-center">
                                <!-- Success Icon -->
                                <div class="success-icon mb-4">
                                    <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                                </div>

                                <h4 class="mb-3">Payment Successful!</h4>
                                <p class="text-muted mb-4">
                                    Your payment has been processed successfully. A confirmation email has been sent to your registered email address.
                                </p>

                                <!-- Booking Details -->
                                <div class="booking-details mb-4">
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

                                <!-- Payment Details -->
                                <div class="payment-details mb-4">
                                    <h6 class="mb-3">Payment Details</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Transaction ID</label>
                                                <div class="fw-bold">
                                                    <?php echo str_pad($booking_id, 8, '0', STR_PAD_LEFT); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Payment Date</label>
                                                <div class="fw-bold">
                                                    <?php echo date('M d, Y h:i A', strtotime($booking['payment_date'])); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Amount Paid</span>
                                        <span class="fw-bold fs-5">₹<?php echo number_format($booking['price'] * 1.18, 2); ?></span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-3 justify-content-center">
                                    <a href="my_bookings.php" class="btn btn-primary">
                                        <i class="bi bi-calendar-check me-2"></i>View My Bookings
                                    </a>
                                    <a href="trainers.php" class="btn btn-outline-primary">
                                        <i class="bi bi-plus-circle me-2"></i>Book Another Session
                                    </a>
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
        <?php include "include/footer.php" ?>
	</div> <!-- /.main-page-wrapper -->
</body>

</html>

<style>
.success-icon {
    animation: scaleIn 0.5s ease-out;
}

@keyframes scaleIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.booking-details, .payment-details {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
}

.btn {
    padding: 0.75rem 1.5rem;
    font-weight: 500;
}
</style> 