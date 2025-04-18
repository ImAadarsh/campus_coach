<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Check if database connection exists
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get trainers with their time slots and pricing information
$sql = "SELECT t.*, 
        MIN(ts.price) as min_price,
        MAX(ts.price) as max_price,
        COUNT(DISTINCT ts.id) as available_sessions
        FROM trainers t
        LEFT JOIN trainer_availabilities ta ON t.id = ta.trainer_id
        LEFT JOIN time_slots ts ON ta.id = ts.trainer_availability_id AND ts.status = 'available'
        GROUP BY t.id";

$result = mysqli_query($connect, $sql);

// Check if query was successful
if (!$result) {
    die("Error in query: " . mysqli_error($connect));
}

$trainers = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Check if $uri is defined in connect.php
if (!isset($uri)) {
    die("Error: Base URL (\$uri) is not defined in connect.php");
}

// Check if any trainers were found
if (empty($trainers)) {
    echo "<div class='alert alert-info'>No trainers found in the database.</div>";
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

				<h2 class="main-title d-block d-lg-none">Trainers</h2>

				<div class="row gx-xxl-5">
                    <?php foreach($trainers as $index => $trainer): ?>
                    <div class="col-lg-4 col-md-6 d-flex mb-50 wow fadeInUp" data-wow-delay="<?php echo $index * 0.1; ?>s">
                        <div class="listing-card-one border-25 h-100 w-100 position-relative">
                            <!-- Trainer Image with Overlay -->
                            <div class="img-gallery position-relative">
                                <div class="position-relative border-25 overflow-hidden">
                                    <div class="tag position-absolute top-0 end-0 m-3 bg-primary text-white border-25 px-3 py-1">TRAINER</div>
                                    <?php 
                                    $imagePath = !empty($trainer['profile_img']) ? $uri . $trainer['profile_img'] : $uri . 'images/default-trainer.jpg';
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" class="w-100" alt="<?php echo htmlspecialchars($trainer['first_name'] . ' ' . $trainer['last_name']); ?>">
                                    <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
                                </div>
                            </div>

                            <!-- Trainer Info -->
                            <div class="property-info p-4">
                                <!-- Name and Designation -->
                                <div class="trainer-header mb-3">
                                    <h3 class="title mb-1"><?php echo htmlspecialchars($trainer['first_name'] . ' ' . $trainer['last_name']); ?></h3>
                                    <div class="designation text-muted">
                                        <i class="bi bi-award me-2"></i>
                                        <?php echo htmlspecialchars($trainer['designation'] ?? 'No designation'); ?>
                                    </div>
                                </div>

                                <!-- Price Range -->
                                <div class="price-range mb-1">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-currency-rupee text-primary me-1"></i>
                                        <span class="fw-bold">
                                            <?php 
                                            if ($trainer['min_price'] == $trainer['max_price']) {
                                                echo number_format($trainer['min_price'], 2);
                                            } else {
                                                echo number_format($trainer['min_price'], 2) . ' - ' . number_format($trainer['max_price'], 2);
                                            }
                                            ?>
                                            <span class="text-muted small ms-1">/session</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Available Sessions -->
                                <div class="available-sessions mb-1">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar-check text-success me-1"></i>
                                        <span class="fw-bold">
                                            <?php echo ' '.$trainer['available_sessions']; ?>
                                            <span class="text-muted small ms-1">Avaliable slots</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Contact Info -->
                                <div class="contact-info mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-envelope me-2 text-primary"></i>
                                        <span class="text-muted"><?php echo htmlspecialchars($trainer['email'] ?? 'No email'); ?></span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-telephone me-2 text-primary"></i>
                                        <span class="text-muted"><?php echo htmlspecialchars($trainer['mobile'] ?? 'No phone'); ?></span>
                                    </div>
                                </div>

                                <!-- Short About -->
                                <div class="short-about mb-3">
                                    <p class="text-muted mb-0">
                                        <?php echo htmlspecialchars($trainer['short_about'] ?? 'No description available'); ?>
                                    </p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="action-buttons d-flex gap-2">
                                    <a href="book_session.php?trainer_id=<?php echo $trainer['id']; ?>" 
                                       class="btn btn-primary flex-grow-1 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-calendar-plus me-2"></i>
                                        <span>Book Now</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
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
.listing-card-one {
    background: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.listing-card-one:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.img-gallery {
    height: 250px;
    overflow: hidden;
}

.img-gallery img {
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.listing-card-one:hover .img-gallery img {
    transform: scale(1.05);
}

.trainer-header .title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
}

.trainer-stats {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 10px;
}

.trainer-stats .value {
    font-size: 1.1rem;
    color: #333;
}

.contact-info {
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    padding: 1rem 0;
}

.action-buttons .btn {
    padding: 0.75rem 1rem;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.action-buttons .btn-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
    border: none;
}

.action-buttons .btn-outline-primary {
    border: 2px solid #4e73df;
    color: #4e73df;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.short-about {
    font-size: 0.95rem;
    line-height: 1.5;
}

.price-range, .available-sessions {
    padding: 0.25rem;
    background: #f8f9fa;
    border-radius: 4px;
}

.price-range i, .available-sessions i {
    font-size: 1rem;
}

.price-range .value, .available-sessions .value {
    font-size: 0.95rem;
}
</style>