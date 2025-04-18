<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Check if database connection exists
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}


$user_id = $_SESSION['userid'];
// Get user's bookings with trainer and time slot details
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
        WHERE b.user_id = $user_id
        ORDER BY ta.date DESC, ts.start_time DESC";



$result = mysqli_query($connect, $sql);

// Check if query was successful
if (!$result) {
    die("Error in query: " . mysqli_error($connect));
}

$bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Check if $uri is defined in connect.php
if (!isset($uri)) {
    die("Error: Base URL (\$uri) is not defined in connect.php");
}

// Update the trainer query as well
$trainer_sql = "SELECT DISTINCT t.id, CONCAT(t.first_name, ' ', t.last_name) as name 
                FROM trainers t 
                JOIN trainer_availabilities ta ON t.id = ta.trainer_id
                JOIN time_slots ts ON ta.id = ts.trainer_availability_id
                JOIN bookings b ON ts.id = b.time_slot_id
                WHERE b.user_id = " . $_SESSION['userid'];

$trainer_result = mysqli_query($connect, $trainer_sql);

if ($trainer_result) {
    while($trainer = mysqli_fetch_assoc($trainer_result)) {
        echo "<option value='" . $trainer['id'] . "'>" . $trainer['name'] . "</option>";
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

				<h2 class="main-title d-block d-lg-none">My Bookings</h2>
				<div class="dash-accordion-one">
					<div class="accordion" id="accordionOne">
						<!-- Filter Section -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingOne">
								<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="bi bi-funnel"></i> Filter Bookings
								</button>
							</div>
							<div id="collapseOne" class="accordion-collapse collapse  " aria-labelledby="headingOne" data-bs-parent="#accordionOne">
								<div class="accordion-body">
									<div class="row">
										<div class="col-lg-3">
											<div class="dash-input-wrapper mb-25">
												<label for="status">Status</label>
												<select class="form-select" id="status">
													<option value="">All Status</option>
													<option value="pending">Pending</option>
													<option value="confirmed">Confirmed</option>
													<option value="completed">Completed</option>
													<option value="cancelled">Cancelled</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="dash-input-wrapper mb-25">
												<label for="date">Date</label>
												<input type="date" class="form-control" id="date">
											</div>
										</div>
										<div class="col-lg-3">
											<div class="dash-input-wrapper mb-25">
												<label for="trainer">Trainer</label>
												<select class="form-select" id="trainer">
													<option value="">All Trainers</option>
													<?php
													$trainer_sql = "SELECT DISTINCT t.id, CONCAT(t.first_name, ' ', t.last_name) as name 
																 FROM trainers t 
																 JOIN trainer_availabilities ta ON t.id = ta.trainer_id
																 JOIN time_slots ts ON ta.id = ts.trainer_availability_id
																 JOIN bookings b ON ts.id = b.time_slot_id
																 WHERE b.user_id = " . $_SESSION['userid'];
													$trainer_result = mysqli_query($connect, $trainer_sql);
													if ($trainer_result) {
														while($trainer = mysqli_fetch_assoc($trainer_result)) {
															echo "<option value='" . $trainer['id'] . "'>" . $trainer['name'] . "</option>";
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="dash-input-wrapper mb-25">
												<label for="payment">Payment Status</label>
												<select class="form-select" id="payment">
													<option value="">All Payments</option>
													<option value="pending">Pending</option>
													<option value="completed">Completed</option>
													<option value="failed">Failed</option>
													<option value="refunded">Refunded</option>
												</select>
											</div>
										</div>
									</div>
									<div class="button-group d-flex justify-content-end">
										<button class="dash-btn-two tran3s me-3" onclick="resetFilters()">Reset</button>
										<button class="dash-btn-one" onclick="applyFilters()">Apply Filter</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Bookings List -->
				<div class="row gx-xxl-5">
					<?php if(empty($bookings)): ?>
						<div class="col-12">
							<div class="alert alert-info">
								<i class="bi bi-info-circle me-2"></i> You don't have any bookings yet.
								<a href="trainers.php" class="alert-link">Browse trainers</a> to book a session.
							</div>
						</div>
					<?php else: ?>
						<?php foreach($bookings as $booking): ?>
							<div class="col-lg-6 col-md-12 d-flex mb-30 mt-4">
								<div class="listing-card-one border-25 h-100 w-100 position-relative" data-booking-id="<?php echo $booking['id']; ?>">
									<div class="img-gallery position-relative">
										<div class="position-relative border-25 overflow-hidden">
											<?php 
											$imagePath = !empty($booking['trainer_image']) ? $uri . $booking['trainer_image'] : $uri . 'images/default-trainer.jpg';
											?>
											<img src="<?php echo $imagePath; ?>" class="w-100" alt="Trainer Image">
											<div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
											<div class="tag position-absolute top-0 end-0 m-3">
												<span class="badge bg-<?php 
													switch($booking['status']) {
														case 'pending': echo 'warning'; break;
														case 'confirmed': echo 'success'; break;
														case 'completed': echo 'info'; break;
														case 'cancelled': echo 'danger'; break;
														default: echo 'secondary';
													}
												?>">
													<?php echo ucfirst($booking['status']); ?>
												</span>
											</div>
										</div>
									</div>

									<div class="property-info p-4">
										<div class="trainer-header mb-3">
											<h3 class="title mb-1">
												<?php echo htmlspecialchars($booking['trainer_first_name'] . ' ' . $booking['trainer_last_name']); ?>
											</h3>
											<div class="designation text-muted">
												<i class="bi bi-award me-2"></i>
												<?php echo htmlspecialchars($booking['trainer_designation']); ?>
											</div>
										</div>

										<div class="booking-details mb-3">
											<div class="d-flex align-items-center mb-2">
												<i class="bi bi-calendar-event me-2 text-primary"></i>
												<span class="session-date"><?php echo date('F j, Y', strtotime($booking['date'])); ?></span>
											</div>
											<div class="d-flex align-items-center mb-2">
												<i class="bi bi-clock me-2 text-primary"></i>
												<span class="session-time"><?php echo date('h:i A', strtotime($booking['start_time'])) . ' - ' . date('h:i A', strtotime($booking['end_time'])); ?></span>
											</div>
											<div class="d-flex align-items-center mb-2">
												<i class="bi bi-currency-rupee me-2 text-primary"></i>
												<span><?php echo number_format($booking['price'], 2); ?></span>
											</div>
											<?php if($booking['payment_status']): ?>
												<div class="d-flex align-items-center">
													<i class="bi bi-credit-card me-2 text-primary"></i>
													<span class="text-<?php echo $booking['payment_status'] == 'completed' ? 'success' : 'warning'; ?>">
														<?php echo ucfirst($booking['payment_status']); ?>
													</span>
												</div>
											<?php endif; ?>
										</div>

										<?php if($booking['booking_notes']): ?>
											<div class="booking-notes mb-3">
												<p class="text-muted mb-0">
													<i class="bi bi-pencil me-2"></i>
													<?php echo htmlspecialchars($booking['booking_notes']); ?>
												</p>
											</div>
										<?php endif; ?>

										<div class="action-buttons d-flex gap-2">
											<?php 
											$current_date = date('Y-m-d');
											$current_time = date('H:i:s');
											$session_date = $booking['date'];
											$session_start_time = $booking['start_time'];
											$session_passed = ($session_date < $current_date) || 
															($session_date == $current_date && $session_start_time < $current_time);
											$session_completed = $booking['status'] == 'completed';
											$payment_pending = $booking['payment_status'] == 'pending' || !$booking['payment_status'];
											$can_cancel = $booking['status'] == 'pending' && $payment_pending && !$session_passed;
											$can_reschedule = $booking['status'] == 'confirmed' && !$session_passed && !$session_completed;
											?>

											<?php if($can_cancel): ?>
												<button class="btn btn-outline-danger flex-grow-1 d-flex align-items-center justify-content-center"
														onclick="cancelBooking(<?php echo $booking['id']; ?>)">
													<i class="bi bi-x-circle me-2"></i>
													<span>Cancel</span>
												</button>
											<?php endif; ?>

											<?php if($can_reschedule): ?>
												<button class="btn btn-outline-primary flex-grow-1 d-flex align-items-center justify-content-center"
														onclick="requestReschedule(<?php echo $booking['id']; ?>)">
													<i class="bi bi-calendar-check me-2"></i>
													<span>Reschedule</span>
												</button>
											<?php endif; ?>

											<?php if($booking['status'] == 'pending' && $payment_pending): ?>
												<a href="payment.php?booking_id=<?php echo $booking['id']; ?>" 
												   class="btn btn-primary flex-grow-1 d-flex align-items-center justify-content-center">
													<i class="bi bi-credit-card me-2"></i>
													<span>Pay Now</span>
												</a>
											<?php endif; ?>
										</div>

										<?php if($booking['status'] == 'completed'): ?>
											<div class="review-section mt-3">
												<?php
												// Check if review exists
												$review_sql = "SELECT * FROM trainer_reviews WHERE booking_id = " . $booking['id'];
												$review_result = mysqli_query($connect, $review_sql);
												$review = mysqli_fetch_assoc($review_result);
												
												if($review): ?>
													<div class="existing-review p-3 bg-light rounded">
														<h6 class="mb-2">Your Review</h6>
														<div class="rating mb-2">
															<?php for($i = 1; $i <= 5; $i++): ?>
																<i class="bi bi-star<?php echo $i <= $review['rating'] ? '-fill text-warning' : ''; ?>"></i>
															<?php endfor; ?>
														</div>
														<p class="mb-0"><?php echo htmlspecialchars($review['review']); ?></p>
													</div>
												<?php else: ?>
													<div class="review-form">
														<h6 class="mb-2">Write a Review</h6>
														<form class="review-form" data-booking-id="<?php echo $booking['id']; ?>">
															<div class="rating mb-2">
																<input type="hidden" name="rating" id="rating_<?php echo $booking['id']; ?>" value="5">
																<div class="stars">
																	<?php for($i = 5; $i >= 1; $i--): ?>
																		<i class="bi bi-star-fill star" data-rating="<?php echo $i; ?>"></i>
																	<?php endfor; ?>
																</div>
															</div>
															<div class="mb-2">
																<textarea class="form-control" name="review" rows="3" placeholder="Write your review here..."></textarea>
															</div>
															<button type="submit" class="btn btn-primary btn-sm">Submit Review</button>
														</form>
													</div>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
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

		<script>
			// Filter functionality
			function applyFilters() {
				const status = document.getElementById('status').value;
				const date = document.getElementById('date').value;
				const trainer = document.getElementById('trainer').value;
				const payment = document.getElementById('payment').value;
				
				$.ajax({
					url: 'filter_bookings.php',
					method: 'POST',
					data: {
						status: status,
						date: date,
						trainer: trainer,
						payment: payment
					},
					success: function(response) {
						try {
							const bookings = JSON.parse(response);
							updateBookingsList(bookings);
						} catch(e) {
							console.error('Error parsing response:', e);
							alert('Error processing filter results');
						}
					},
					error: function() {
						alert('Error applying filters. Please try again.');
					}
				});
			}

			function updateBookingsList(bookings) {
				const container = document.querySelector('.row.gx-xxl-5');
				container.innerHTML = '';

				if (bookings.length === 0) {
					container.innerHTML = `
						<div class="col-12">
							<div class="alert alert-info">
								<i class="bi bi-info-circle me-2"></i> No bookings found matching your criteria.
							</div>
						</div>
					`;
					return;
				}

				bookings.forEach(booking => {
					const bookingCard = createBookingCard(booking);
					container.appendChild(bookingCard);
				});
			}

			function createBookingCard(booking) {
				const div = document.createElement('div');
				div.className = 'col-lg-6 col-md-12 d-flex mb-30';
				div.setAttribute('data-booking-id', booking.id);
				div.innerHTML = `
					<div class="listing-card-one border-25 h-100 w-100 position-relative" data-booking-id="${booking.id}">
						<div class="img-gallery position-relative">
							<div class="position-relative border-25 overflow-hidden">
								<img src="${booking.trainer_image}" class="w-100" alt="Trainer Image">
								<div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
								<div class="tag position-absolute top-0 end-0 m-3">
									<span class="badge bg-${getStatusColor(booking.status)}">
										${booking.status}
									</span>
								</div>
							</div>
						</div>
						<div class="property-info p-4">
							<div class="trainer-header mb-3">
								<h3 class="title mb-1">${booking.trainer_first_name} ${booking.trainer_last_name}</h3>
								<div class="designation text-muted">
									<i class="bi bi-award me-2"></i>
									${booking.trainer_designation}
								</div>
							</div>
							<div class="booking-details mb-3">
								<div class="d-flex align-items-center mb-2">
									<i class="bi bi-calendar-event me-2 text-primary"></i>
									<span class="session-date">${formatDate(booking.date)}</span>
								</div>
								<div class="d-flex align-items-center mb-2">
									<i class="bi bi-clock me-2 text-primary"></i>
									<span class="session-time">${formatTime(booking.start_time)} - ${formatTime(booking.end_time)}</span>
								</div>
								<div class="d-flex align-items-center mb-2">
									<i class="bi bi-currency-rupee me-2 text-primary"></i>
									<span>${booking.price}</span>
								</div>
								${booking.payment_status ? `
									<div class="d-flex align-items-center">
										<i class="bi bi-credit-card me-2 text-primary"></i>
										<span class="text-${booking.payment_status === 'completed' ? 'success' : 'warning'}">
											${booking.payment_status}
										</span>
									</div>
								` : ''}
							</div>
							${booking.booking_notes ? `
								<div class="booking-notes mb-3">
									<p class="text-muted mb-0">
										<i class="bi bi-pencil me-2"></i>
										${booking.booking_notes}
									</p>
								</div>
							` : ''}
							<div class="action-buttons d-flex gap-2">
								${getActionButtons(booking)}
							</div>
						</div>
					</div>
				`;
				return div;
			}

			function getStatusColor(status) {
				switch(status) {
					case 'pending': return 'warning';
					case 'confirmed': return 'success';
					case 'completed': return 'info';
					case 'cancelled': return 'danger';
					default: return 'secondary';
				}
			}

			function formatDate(date) {
				return new Date(date).toLocaleDateString('en-US', {
					year: 'numeric',
					month: 'long',
					day: 'numeric'
				});
			}

			function formatTime(time) {
				return new Date('2000-01-01T' + time).toLocaleTimeString('en-US', {
					hour: 'numeric',
					minute: '2-digit',
					hour12: true
				});
			}

			function getActionButtons(booking) {
				const currentDate = new Date();
				const sessionDate = new Date(booking.date);
				const sessionTime = booking.start_time;
				const sessionPassed = sessionDate < currentDate || 
									(sessionDate.getTime() === currentDate.getTime() && 
									sessionTime < currentDate.getHours() + ':' + currentDate.getMinutes());
				const sessionCompleted = booking.status === 'completed';
				const paymentPending = booking.payment_status === 'pending' || !booking.payment_status;
				const canCancel = booking.status === 'pending' && paymentPending && !sessionPassed;
				const canReschedule = booking.status === 'confirmed' && !sessionPassed && !sessionCompleted;

				let buttons = '';

				if (canCancel) {
					buttons += `
						<button class="btn btn-outline-danger flex-grow-1 d-flex align-items-center justify-content-center"
								onclick="cancelBooking(${booking.id})">
							<i class="bi bi-x-circle me-2"></i>
							<span>Cancel</span>
						</button>
					`;
				}

				if (canReschedule) {
					buttons += `
						<button class="btn btn-outline-primary flex-grow-1 d-flex align-items-center justify-content-center"
								onclick="requestReschedule(${booking.id})">
							<i class="bi bi-calendar-check me-2"></i>
							<span>Reschedule</span>
						</button>
					`;
				}

				if (booking.status === 'pending' && paymentPending) {
					buttons += `
						<a href="payment.php?booking_id=${booking.id}" 
						   class="btn btn-primary flex-grow-1 d-flex align-items-center justify-content-center">
							<i class="bi bi-credit-card me-2"></i>
							<span>Pay Now</span>
						</a>
					`;
				}

				return buttons;
			}

			function resetFilters() {
				document.getElementById('status').value = '';
				document.getElementById('date').value = '';
				document.getElementById('trainer').value = '';
				document.getElementById('payment').value = '';
				applyFilters();
			}

			// Booking actions
			function cancelBooking(bookingId) {
				if(confirm('Are you sure you want to cancel this booking? This action cannot be undone.')) {
					$.ajax({
						url: 'cancel_booking.php',
						method: 'POST',
						data: { 
							booking_id: bookingId,
							action: 'cancel'
						},
						success: function(response) {
							try {
								const result = JSON.parse(response);
								if(result.success) {
									alert('Booking cancelled successfully');
									location.reload();
								} else {
									alert('Failed to cancel booking: ' + result.message);
								}
							} catch(e) {
								alert('Error processing response. Please try again.');
							}
						},
						error: function() {
							alert('Error connecting to server. Please try again.');
						}
					});
				}
			}

			function requestReschedule(bookingId) {
				// Get the current date and time
				const now = new Date();
				
				// Find the booking card
				const bookingCard = document.querySelector(`[data-booking-id="${bookingId}"]`);
				if (!bookingCard) {
					alert('Booking not found');
					return;
				}

				// Get session date and time from the booking card
				const sessionDate = bookingCard.querySelector('.session-date').textContent;
				const sessionTime = bookingCard.querySelector('.session-time').textContent;
				
				// Parse the session date and time
				const [startTime, endTime] = sessionTime.split(' - ');
				const sessionDateTime = new Date(sessionDate + ' ' + startTime);
				
				// Check if session has passed
				if (sessionDateTime < now) {
					alert('Cannot reschedule a session that has already passed.');
					return;
				}

				// Redirect to reschedule page
				window.location.href = 'reschedule.php?booking_id=' + bookingId;
			}

			// Review functionality
			document.querySelectorAll('.review-form').forEach(form => {
				form.addEventListener('submit', function(e) {
					e.preventDefault();
					const bookingId = this.dataset.bookingId;
					const rating = document.getElementById(`rating_${bookingId}`).value;
					const review = this.querySelector('textarea[name="review"]').value;

					$.ajax({
						url: 'submit_review.php',
						method: 'POST',
						data: {
							booking_id: bookingId,
							rating: rating,
							review: review
						},
						success: function(response) {
							if(response.success) {
								alert('Review submitted successfully');
								location.reload();
							} else {
								alert('Failed to submit review: ' + response.message);
							}
						},
						error: function() {
							alert('Error connecting to server. Please try again.');
						}
					});
				});
			});

			// Star rating functionality
			document.querySelectorAll('.stars .star').forEach(star => {
				star.addEventListener('click', function() {
					const rating = this.dataset.rating;
					const form = this.closest('.review-form');
					const hiddenInput = form.querySelector('input[name="rating"]');
					const stars = form.querySelectorAll('.star');
					
					hiddenInput.value = rating;
					
					stars.forEach(s => {
						if(s.dataset.rating <= rating) {
							s.classList.add('text-warning');
						} else {
							s.classList.remove('text-warning');
						}
					});
				});
			});
		</script>
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

.booking-details {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 10px;
}

.booking-details i {
    font-size: 1.1rem;
}

.action-buttons .btn {
    padding: 0.75rem 1rem;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.booking-notes {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 10px;
    font-size: 0.95rem;
}

.tag .badge {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

.review-section {
    border-top: 1px solid #eee;
    padding-top: 1rem;
}

.stars {
    display: flex;
    gap: 0.25rem;
}

.stars .star {
    cursor: pointer;
    font-size: 1.25rem;
    color: #ddd;
    transition: color 0.2s;
}

.stars .star.text-warning {
    color: #ffc107;
}

.existing-review {
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    padding: 1rem;
}

.existing-review .rating {
    color: #ffc107;
}
</style> 