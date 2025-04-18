<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Check if booking_id is provided
if (!isset($_GET['booking_id'])) {
    header("Location: my_bookings.php");
    exit();
}

$booking_id = intval($_GET['booking_id']);
$user_id = $_SESSION['userid'];

// Get current booking details
$sql = "SELECT 
            b.*, 
            t.id as trainer_id,
            t.first_name as trainer_first_name,
            t.last_name as trainer_last_name,
            ts.start_time,
            ts.end_time,
            ts.price,
            ta.date
        FROM bookings b
        INNER JOIN time_slots ts ON b.time_slot_id = ts.id
        INNER JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
        INNER JOIN trainers t ON ta.trainer_id = t.id
        WHERE b.id = $booking_id AND b.user_id = $user_id AND b.status = 'confirmed'";

$result = mysqli_query($connect, $sql);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    header("Location: my_bookings.php");
    exit();
}

// Get available time slots for the trainer
$slots_sql = "SELECT ts.*, ta.date 
              FROM time_slots ts
              JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
              WHERE ta.trainer_id = {$booking['trainer_id']} 
              AND ts.status = 'available'
              AND ta.date >= CURDATE()
              AND (ta.date > '{$booking['date']}' OR (ta.date = '{$booking['date']}' AND ts.start_time > '{$booking['start_time']}'))
              ORDER BY ta.date, ts.start_time";

$slots_result = mysqli_query($connect, $slots_sql);
$time_slots = mysqli_fetch_all($slots_result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<?php include "include/meta.php" ?>

<body>
    <div class="main-page-wrapper">
        <!-- Loading Transition -->
        <!-- <div id="preloader">
            <div id="ctn-preloader" class="ctn-preloader">
                <div class="icon"><img src="../images/loader.gif" alt="" class="m-auto d-block" width="250"></div>
            </div>
        </div> -->

        <!-- Dashboard Aside Menu -->
        <?php include "include/aside.php" ?>

        <!-- Dashboard Body -->
        <div class="dashboard-body">
            <div class="position-relative">
                <!-- Header -->
                <?php include "include/header.php" ?>

                <h2 class="main-title">Reschedule Booking</h2>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h4 class="card-title mb-4">Current Booking Details</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person me-2 text-primary"></i>
                                            <div>
                                                <small class="text-muted d-block">Trainer</small>
                                                <span class="fw-bold"><?php echo htmlspecialchars($booking['trainer_first_name'] . ' ' . $booking['trainer_last_name']); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-event me-2 text-primary"></i>
                                            <div>
                                                <small class="text-muted d-block">Current Date</small>
                                                <span class="fw-bold"><?php echo date('F j, Y', strtotime($booking['date'])); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock me-2 text-primary"></i>
                                            <div>
                                                <small class="text-muted d-block">Current Time</small>
                                                <span class="fw-bold"><?php echo date('h:i A', strtotime($booking['start_time'])) . ' - ' . date('h:i A', strtotime($booking['end_time'])); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-currency-rupee me-2 text-primary"></i>
                                            <div>
                                                <small class="text-muted d-block">Session Fee</small>
                                                <span class="fw-bold">₹<?php echo number_format($booking['price'], 2); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h4 class="card-title mb-4">Select New Time Slot</h4>
                                <form id="rescheduleForm" action="process_reschedule.php" method="POST">
                                    <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                                    
                                    <!-- Date Selection -->
                                    <div class="mb-4">
                                        <label class="form-label">Select New Date</label>
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

                                    <!-- Reason for Rescheduling -->
                                    <div class="mb-4">
                                        <label class="form-label">Reason for Rescheduling (Optional)</label>
                                        <textarea class="form-control" name="reason" rows="3" placeholder="Please provide a reason for rescheduling"></textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-calendar-check me-2"></i>Request Reschedule
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Sidebar -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h6 class="card-title mb-4">Rescheduling Summary</h6>
                                
                                <div class="booking-details">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Trainer:</span>
                                        <span><?php echo htmlspecialchars($booking['trainer_first_name'] . ' ' . $booking['trainer_last_name']); ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">New Date:</span>
                                        <span id="summaryDate">Not selected</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">New Time:</span>
                                        <span id="summaryTime">Not selected</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Session Fee:</span>
                                        <span>₹<?php echo number_format($booking['price'], 2); ?></span>
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
        <!-- jQuery first, then Bootstrap JS -->
        <script src="../vendor/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
                        $('#summaryTime').text(timeLabel);
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
        </style>
    </div>
</body>
</html> 