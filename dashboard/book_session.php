<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Check if trainer_id is provided
if (!isset($_GET['trainer_id'])) {
    header("Location: trainers.php");
    exit();
}

$trainer_id = mysqli_real_escape_string($connect, $_GET['trainer_id']);

// Get trainer details
$sql = "SELECT t.*, 
        MIN(ts.price) as min_price,
        MAX(ts.price) as max_price,
        COUNT(DISTINCT ts.id) as available_sessions
        FROM trainers t
        LEFT JOIN trainer_availabilities ta ON t.id = ta.trainer_id
        LEFT JOIN time_slots ts ON ta.id = ts.trainer_availability_id AND ts.status = 'available'
        WHERE t.id = '$trainer_id'
        GROUP BY t.id";

$result = mysqli_query($connect, $sql);
$trainer = mysqli_fetch_assoc($result);

if (!$trainer) {
    header("Location: trainers.php");
    exit();
}

// Get available time slots
$slots_sql = "SELECT ts.*, ta.date 
              FROM time_slots ts
              JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
              WHERE ta.trainer_id = '$trainer_id' 
              AND ts.status = 'available'
              AND ta.date >= CURDATE()
              ORDER BY ta.date, ts.start_time";

$slots_result = mysqli_query($connect, $slots_sql);
$time_slots = mysqli_fetch_all($slots_result, MYSQLI_ASSOC);
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

				<h2 class="main-title d-block d-lg-none">Book Session</h2>

				<div class="row">
                    <div class="col-lg-8">
                        <div class="card border-25 mb-4">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">Book a Session with <?php echo htmlspecialchars($trainer['first_name'] . ' ' . $trainer['last_name']); ?></h5>
                                
                                <!-- Trainer Info -->
                                <div class="trainer-info mb-4">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $uri . $trainer['hero_img']; ?>" alt="Trainer" class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h6 class="mb-1"><?php echo htmlspecialchars($trainer['designation']); ?></h6>
                                            <p class="text-muted mb-0">Session Fee: ₹<?php echo number_format($trainer['min_price'], 2); ?> - ₹<?php echo number_format($trainer['max_price'], 2); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Booking Form -->
                                <form id="bookingForm" action="process_booking.php" method="POST">
                                    <input type="hidden" name="trainer_id" value="<?php echo $trainer_id; ?>">
                                    
                                    <!-- Date Selection -->
                                    <div class="mb-4">
                                        <label class="form-label">Select Date</label>
                                        <select class="form-select" name="date" id="dateSelect" required>
                                            <option value="">Choose a date</option>
                                            <?php
                                            $dates = array_unique(array_column($time_slots, 'date'));
                                            foreach ($dates as $date) {
                                                echo '<option value="' . $date . '">' . date('D, M d, Y', strtotime($date)) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Time Slot Selection -->
                                    <div class="mb-4">
                                        <label class="form-label">Available Time Slots</label>
                                        <div id="timeSlots" class="row g-2">
                                            <!-- Time slots will be populated via JavaScript -->
                                        </div>
                                    </div>

                                    <!-- Session Details -->
                                    <div class="mb-4">
                                        <label class="form-label">Session Duration</label>
                                        <div class="form-text">Each session is <?php echo $time_slots[0]['duration_minutes'] ?? 60; ?> minutes</div>
                                    </div>

                                    <!-- Additional Notes -->
                                    <div class="mb-4">
                                        <label class="form-label">Additional Notes (Optional)</label>
                                        <textarea class="form-control" name="notes" rows="3" placeholder="Any specific requirements or questions for the trainer"></textarea>
                                    </div>

                                    <!-- Payment Section -->
                                    <div class="payment-section mb-4">
                                        <h5 class="mb-3">Payment Details</h5>
                                        <div class="alert alert-info">
                                            <i class="bi bi-info-circle me-2"></i>
                                            Payment will be processed after booking confirmation
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span>Session Fee:</span>
                                            <span class="fw-bold" id="sessionFee">₹0.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>Total Amount:</span>
                                            <span class="fw-bold fs-5" id="totalAmount">₹0.00</span>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-calendar-check me-2"></i>Confirm Booking
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Sidebar -->
                    <div class="col-lg-4">
                        <div class="card border-25 mb-4">
                            <div class="card-body p-4">
                                <h6 class="card-title mb-4">Booking Summary</h6>
                                
                                <div class="booking-details">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Trainer:</span>
                                        <span><?php echo htmlspecialchars($trainer['first_name'] . ' ' . $trainer['last_name']); ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Date:</span>
                                        <span id="summaryDate">Not selected</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Time:</span>
                                        <span id="summaryTime">Not selected</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Duration:</span>
                                        <span><?php echo $time_slots[0]['duration_minutes'] ?? 60; ?> minutes</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Total:</span>
                                        <span class="fw-bold" id="summaryTotal">₹0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cancellation Policy -->
                        <div class="card border-25">
                            <div class="card-body p-4">
                                <h6 class="card-title mb-3">Cancellation Policy</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Free cancellation up to 24 hours before the session</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>50% refund if cancelled within 24 hours</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>No refund for no-shows</li>
                                </ul>
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

        <script>
        $(document).ready(function() {
            // Handle date selection
            $('#dateSelect').change(function() {
                const selectedDate = $(this).val();
                const timeSlots = <?php echo json_encode($time_slots); ?>;
                
                // Filter time slots for selected date
                const filteredSlots = timeSlots.filter(slot => slot.date === selectedDate);
                
                // Update time slots display
                let html = '';
                filteredSlots.forEach(slot => {
                    const startTime = new Date('1970-01-01T' + slot.start_time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    const endTime = new Date('1970-01-01T' + slot.end_time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    
                    html += `
                        <div class="col-md-6">
                            <div class="time-slot-card">
                                <input type="radio" name="time_slot_id" value="${slot.id}" id="slot_${slot.id}" class="time-slot-radio">
                                <label for="slot_${slot.id}" class="time-slot-label">
                                    <span class="time">${startTime} - ${endTime}</span>
                                    <span class="price">₹${parseFloat(slot.price).toFixed(2)}</span>
                                </label>
                            </div>
                        </div>
                    `;
                });
                
                $('#timeSlots').html(html);
                updateSummary();
            });

            // Handle time slot selection
            $(document).on('change', '.time-slot-radio', function() {
                updateSummary();
            });

            // Update booking summary
            function updateSummary() {
                const selectedDate = $('#dateSelect').val();
                const selectedSlot = $('.time-slot-radio:checked');
                
                if (selectedDate) {
                    $('#summaryDate').text(new Date(selectedDate).toLocaleDateString('en-US', { 
                        weekday: 'short', 
                        month: 'short', 
                        day: 'numeric',
                        year: 'numeric'
                    }));
                }
                
                if (selectedSlot.length) {
                    const timeLabel = selectedSlot.siblings('label').find('.time').text();
                    const price = selectedSlot.siblings('label').find('.price').text();
                    
                    $('#summaryTime').text(timeLabel);
                    $('#summaryTotal').text(price);
                    $('#sessionFee').text(price);
                    $('#totalAmount').text(price);
                }
            }
        });
        </script>
        	<?php include "include/footer.php" ?>


        <style>
        .time-slot-card {
            position: relative;
            margin-bottom: 10px;
        }

        .time-slot-radio {
            position: absolute;
            opacity: 0;
        }

        .time-slot-label {
            display: block;
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .time-slot-radio:checked + .time-slot-label {
            border-color: #4e73df;
            background-color: rgba(78, 115, 223, 0.05);
        }

        .time-slot-label:hover {
            border-color: #4e73df;
        }

        .time-slot-label .time {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .time-slot-label .price {
            color: #4e73df;
            font-weight: 600;
        }

        .payment-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }
        </style>
	</div> <!-- /.main-page-wrapper -->
</body>

</html> 