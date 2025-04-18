<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Get user statistics
$userId = $_SESSION['userid'];

// Total Bookings
$sqlBookings = "SELECT COUNT(*) as total_bookings FROM bookings WHERE user_id = $userId";
$resultBookings = mysqli_query($connect, $sqlBookings);
$totalBookings = mysqli_fetch_assoc($resultBookings)['total_bookings'];

// Completed Sessions
$sqlCompleted = "SELECT COUNT(*) as completed_sessions FROM bookings b 
                 JOIN payments p ON b.id = p.booking_id 
                 WHERE b.user_id = $userId AND p.status = 'completed'";
$resultCompleted = mysqli_query($connect, $sqlCompleted);
$completedSessions = mysqli_fetch_assoc($resultCompleted)['completed_sessions'];

// Upcoming Sessions
$sqlUpcoming = "SELECT COUNT(*) as upcoming_sessions FROM bookings b 
                JOIN time_slots ts ON b.time_slot_id = ts.id 
                JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id 
                WHERE b.user_id = $userId AND b.status = 'confirmed' 
                AND ta.date >= CURDATE()";
$resultUpcoming = mysqli_query($connect, $sqlUpcoming);
$upcomingSessions = mysqli_fetch_assoc($resultUpcoming)['upcoming_sessions'];

// Total Spent
$sqlSpent = "SELECT COALESCE(SUM(amount), 0) as total_spent FROM payments p 
             JOIN bookings b ON p.booking_id = b.id 
             WHERE b.user_id = $userId AND p.status = 'completed'";
$resultSpent = mysqli_query($connect, $sqlSpent);
$totalSpent = mysqli_fetch_assoc($resultSpent)['total_spent'];

// Recent Bookings
$sqlRecentBookings = "SELECT b.*, t.first_name, t.last_name, t.designation, 
                      ts.start_time, ts.end_time, ta.date, p.status as payment_status, t.profile_img
                      FROM bookings b
                      JOIN time_slots ts ON b.time_slot_id = ts.id
                      JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
                      JOIN trainers t ON ta.trainer_id = t.id
                      LEFT JOIN payments p ON b.id = p.booking_id
                      WHERE b.user_id = $userId
                      ORDER BY ta.date DESC, ts.start_time DESC
                      LIMIT 3";
$resultRecentBookings = mysqli_query($connect, $sqlRecentBookings);
$recentBookings = mysqli_fetch_all($resultRecentBookings, MYSQLI_ASSOC);

// Monthly Statistics for Chart
$sqlMonthlyStats = "SELECT MONTH(ta.date) as month, COUNT(*) as count
                    FROM bookings b
                    JOIN time_slots ts ON b.time_slot_id = ts.id
                    JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
                    WHERE b.user_id = $userId AND ta.date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                    GROUP BY MONTH(ta.date)
                    ORDER BY month";
$resultMonthlyStats = mysqli_query($connect, $sqlMonthlyStats);
$monthlyStats = mysqli_fetch_all($resultMonthlyStats, MYSQLI_ASSOC);

// Prepare data for chart
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$chartData = array_fill(0, 12, 0);
foreach ($monthlyStats as $stat) {
    $chartData[$stat['month'] - 1] = $stat['count'];
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
			Dashboard Aside Menuhttps://campus-coach.endeavourdigital.in/index.php
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

				<h2 class="main-title d-block d-lg-none">Dashboard</h2>
				<div class="border-20">
					<div class="row gx-3">
						<div class="col-lg-3 col-6 ">
							<div class="dash-card-one border-25 p-3 position-relative overflow-hidden rounded-3">
								<div class="d-flex align-items-center justify-content-between">
									<div>
										<h6 style="font-size: 1rem;" class="mb-1 text-muted">Total Bookings</h6>
										<h6 class="mb-0"><?php echo $totalBookings; ?></h6>
									</div>
									<div class="icon rounded-circle bg-primary bg-opacity-10 p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
										<i class="bi bi-calendar-check text-primary" style="font-size: 1.5rem;"></i>
									</div>
								</div>
								<div class="position-absolute bottom-0 end-0">
									<img src="../images/shape/shape_01.svg" alt="" class="lazy-img">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="dash-card-one border-25 p-3 position-relative overflow-hidden rounded-3">
								<div class="d-flex align-items-center justify-content-between">
									<div>
										<h6 style="font-size: 1rem;"  class="mb-1 text-muted">Completed Sessions</h6>
										<h6 class="mb-0"><?php echo $completedSessions; ?></h6>
									</div>
									<div class="icon rounded-circle bg-success bg-opacity-10 p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
										<i class="bi bi-check-circle text-success" style="font-size: 1.5rem;"></i>
									</div>
								</div>
								<div class="position-absolute bottom-0 end-0">
									<img src="../images/shape/shape_02.svg" alt="" class="lazy-img">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="dash-card-one border-25 p-3 position-relative overflow-hidden rounded-3">
								<div class="d-flex align-items-center justify-content-between">
									<div>
										<h6 style="font-size: 1rem;"  class="mb-1 text-muted">Upcoming Sessions</h6>
										<h6 class="mb-0"><?php echo $upcomingSessions; ?></h6>
									</div>
									<div class="icon rounded-circle bg-warning bg-opacity-10 p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
										<i class="bi bi-clock text-warning" style="font-size: 1.5rem;"></i>
									</div>
								</div>
								<div class="position-absolute bottom-0 end-0">
									<img src="../images/shape/shape_03.svg" alt="" class="lazy-img">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="dash-card-one border-25 p-3 position-relative overflow-hidden rounded-3">
								<div class="d-flex align-items-center justify-content-between">
									<div>
										<h6 style="font-size: 1rem;"  class="mb-1 text-muted">Total Spent</h6>
										<h6 class="mb-0">₹<?php echo number_format($totalSpent, 0); ?></h6>
									</div>
									<div class="icon rounded-circle bg-info bg-opacity-10 p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
										<i class="bi bi-currency-rupee text-info" style="font-size: 1.5rem;"></i>
									</div>
								</div>
								<div class="position-absolute bottom-0 end-0">
									<img src="../images/shape/shape_04.svg" alt="" class="lazy-img">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row gx-3 mt-3">
					<div class="col-xl-7 col-lg-6">
						<div class="user-activity-chart bg-white border-20 p-3 h-100">
							<div class="d-flex align-items-center justify-content-between mb-3">
								<h5 class="dash-title-two mb-0">Monthly Bookings</h5>

							</div>
							<div class="chart-wrapper">
								<canvas id="bookingsChart"></canvas>
							</div>
						</div>
					</div>
					<div class="col-xl-5 col-lg-6">
						<div class="recent-job-tab bg-white border-20 p-3 h-100">
							<h5 class="dash-title-two mb-3">Upcoming Sessions</h5>
							<div class="message-wrapper">
								<div class="message-sidebar border-0">
									<div class="email-read-panel">
										<?php
										$sqlUpcomingSessions = "SELECT b.*, t.first_name, t.last_name, t.designation, 
										                      ts.start_time, ts.end_time, ta.date
										                      FROM bookings b
										                      JOIN time_slots ts ON b.time_slot_id = ts.id
										                      JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
										                      JOIN trainers t ON ta.trainer_id = t.id
										                      WHERE b.user_id = $userId AND b.status = 'confirmed' 
										                      AND ta.date >= CURDATE()
										                      ORDER BY ta.date ASC, ts.start_time ASC
										                      LIMIT 3";
										$resultUpcomingSessions = mysqli_query($connect, $sqlUpcomingSessions);
										$upcomingSessions = mysqli_fetch_all($resultUpcomingSessions, MYSQLI_ASSOC);

										if (empty($upcomingSessions)) {
											echo '<div class="alert alert-info">No upcoming sessions</div>';
										} else {
											foreach ($upcomingSessions as $session) {
												$date = new DateTime($session['date']);
												$startTime = new DateTime($session['start_time']);
												$endTime = new DateTime($session['end_time']);
												?>
												<div class="email-list-item read border-0 pt-0">
													<div class="email-short-preview position-relative">
														<div class="d-flex align-items-center justify-content-between">
															<div class="sender-name"><?php echo $session['first_name'] . ' ' . $session['last_name']; ?></div>
															<div class="date"><?php echo $date->format('d M'); ?></div>
														</div>
														<div class="mail-sub"><?php echo $session['designation']; ?></div>
														<div class="mail-text">
															<?php echo $startTime->format('h:i A') . ' - ' . $endTime->format('h:i A'); ?>
														</div>
													</div>
												</div>
												<?php
											}
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="bg-white border-20 mt-3">
					<div class="d-flex align-items-center justify-content-between p-3">
						<h5 class="dash-title-two mb-0">Recent Bookings</h5>
						<a href="my_bookings.php" class="btn btn-primary">View All</a>
					</div>
					<div class="table-responsive p-3">
						<div class="d-none d-md-block">
							<table class="table">
								<thead>
									<tr>
										<th>Trainer</th>
										<th>Date & Time</th>
										<th>Status</th>
										<th>Payment</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($recentBookings as $booking): ?>
										<tr>
											<td>
												<div class="d-flex align-items-center">
													<div class="flex-shrink-0">
														<img src="<?php echo $uri . $booking['profile_img']; ?>" 
															 alt="<?php echo $booking['first_name']; ?>" 
															 class="rounded-circle" width="60" height="60">
													</div>
													<div class="flex-grow-1 ms-3">
														<h6 class="mb-0"><?php echo $booking['first_name'] . ' ' . $booking['last_name']; ?></h6>
														<small class="text-muted"><?php echo $booking['designation']; ?></small>
													</div>
												</div>
											</td>
											<td>
												<?php 
												$date = new DateTime($booking['date']);
												$startTime = new DateTime($booking['start_time']);
												$endTime = new DateTime($booking['end_time']);
												echo $date->format('d M Y') . '<br>';
												echo $startTime->format('h:i A') . ' - ' . $endTime->format('h:i A');
												?>
											</td>
											<td>
												<span class="badge bg-<?php 
													echo $booking['status'] == 'confirmed' ? 'success' : 
														($booking['status'] == 'pending' ? 'warning' : 
														($booking['status'] == 'cancelled' ? 'danger' : 'info')); 
												?>">
													<?php echo ucfirst($booking['status']); ?>
												</span>
											</td>
											<td>
												<span class="badge bg-<?php 
													echo $booking['payment_status'] == 'completed' ? 'success' : 
														($booking['payment_status'] == 'pending' ? 'warning' : 
														($booking['payment_status'] == 'failed' ? 'danger' : 'info')); 
												?>">
													<?php echo ucfirst($booking['payment_status']); ?>
												</span>
											</td>
											<td>
												<a href="booking_details.php?id=<?php echo $booking['id']; ?>" 
												   class="btn btn-sm btn-primary">
													<i class="bi bi-eye"></i>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<div class="d-md-none">
							<?php foreach ($recentBookings as $booking): ?>
								<div class="card mb-3">
									<div class="card-body">
										<div class="d-flex align-items-center mb-3">
											<img src="<?php echo $uri . $booking['profile_img']; ?>" 
												 alt="<?php echo $booking['first_name']; ?>" 
												 class="rounded-circle me-3" width="50" height="50">
											<div>
												<h6 class="mb-0"><?php echo $booking['first_name'] . ' ' . $booking['last_name']; ?></h6>
												<small class="text-muted"><?php echo $booking['designation']; ?></small>
											</div>
										</div>
										<div class="row g-2">
											<div class="col-6">
												<small class="text-muted d-block">Date & Time</small>
												<?php 
												$date = new DateTime($booking['date']);
												$startTime = new DateTime($booking['start_time']);
												$endTime = new DateTime($booking['end_time']);
												echo $date->format('d M Y') . '<br>';
												echo $startTime->format('h:i A') . ' - ' . $endTime->format('h:i A');
												?>
											</div>
											<div class="col-6">
												<small class="text-muted d-block">Status</small>
												<span class="badge bg-<?php 
													echo $booking['status'] == 'confirmed' ? 'success' : 
														($booking['status'] == 'pending' ? 'warning' : 
														($booking['status'] == 'cancelled' ? 'danger' : 'info')); 
												?>">
													<?php echo ucfirst($booking['status']); ?>
												</span>
											</div>
											<div class="col-6">
												<small class="text-muted d-block">Payment</small>
												<span class="badge bg-<?php 
													echo $booking['payment_status'] == 'completed' ? 'success' : 
														($booking['payment_status'] == 'pending' ? 'warning' : 
														($booking['payment_status'] == 'failed' ? 'danger' : 'info')); 
												?>">
													<?php echo ucfirst($booking['payment_status']); ?>
												</span>
											</div>
											<div class="col-6">
												<small class="text-muted d-block">Action</small>
												<a href="booking_details.php?id=<?php echo $booking['id']; ?>" 
												   class="btn btn-sm btn-primary">
													<i class="bi bi-eye"></i> View
												</a>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<!-- Welcome Message Modal -->
				<div class="modal fade" id="welcomeModal" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content border-20">
							<div class="modal-body text-center p-4">
								<div class="mb-4">
									<img src="../assets/img/logo/logo.svg" alt="Campus Coach" class="lazy-img" width="200">
								</div>
								<h3 class="mb-2">Welcome Back, <?php echo $_SESSION['name']; ?>!</h3>
								<p class="text-muted mb-4">We're glad to see you again. Here's what's happening today.</p>
								<div class="d-flex justify-content-center gap-2">
									<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
										<i class="bi bi-arrow-right me-2"></i>Get Started
									</button>
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
		<!-- Chart js -->
		<script src="../vendor/chart.js"></script>

		<!-- Theme js -->
		<script src="../js/theme.js"></script>

		<script>
			$(document).ready(function() {
				// Check if welcome modal has been shown in this session
				if (!sessionStorage.getItem('welcomeModalShown')) {
					$('#welcomeModal').modal('show');
					sessionStorage.setItem('welcomeModalShown', 'true');
				}

				// Remove loader after page loads
				setTimeout(function() {
					$('#preloader').fadeOut(500, function() {
						$(this).remove();
					});
				}, 500);

				// Initialize Chart
				const ctx = document.getElementById('bookingsChart').getContext('2d');
				new Chart(ctx, {
					type: 'line',
					data: {
						labels: <?php echo json_encode($months); ?>,
						datasets: [{
							label: 'Bookings',
							data: <?php echo json_encode($chartData); ?>,
							borderColor: '#4e73df',
							backgroundColor: 'rgba(78, 115, 223, 0.05)',
							tension: 0.4,
							fill: true
						}]
					},
					options: {
						responsive: true,
						maintainAspectRatio: false,
						plugins: {
							legend: {
								display: false
							}
						},
						scales: {
							y: {
								beginAtZero: true,
								ticks: {
									stepSize: 1
								}
							}
						}
					}
				});
			});
		</script>
		<?php include "include/footer.php" ?>
	</div> <!-- /.main-page-wrapper -->

<style>
.dash-card-one {
    background: #fff;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.dash-card-one:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.dash-card-one .icon {
    transition: all 0.3s ease;
}

.dash-card-one:hover .icon {
    transform: scale(1.1);
}

.dash-card-one img {
    opacity: 0.1;
    transition: all 0.3s ease;
}

.dash-card-one:hover img {
    opacity: 0.2;
}

#welcomeModal .modal-content {
    background: #fff;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

#welcomeModal .btn-primary {
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease;
}

#welcomeModal .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

@media (max-width: 767.98px) {
    .card {
        border: 1px solid rgba(0,0,0,.125);
        border-radius: 0.25rem;
        box-shadow: 0 2px 4px rgba(0,0,0,.05);
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .card-body .row {
        margin-top: 0.5rem;
    }
    
    .card-body small.text-muted {
        font-size: 0.75rem;
    }
    
    .card-body .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    .card-body img {
        width: 40px;
        height: 40px;
    }
}
</style>
</body>

</html>