<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Get user's transactions with related booking and trainer information
$sql = "SELECT p.*, 
        b.id as booking_id,
        t.first_name as trainer_first_name,
        t.last_name as trainer_last_name,
        ts.start_time,
        ts.end_time,
        ta.date
        FROM payments p
        JOIN bookings b ON p.booking_id = b.id
        JOIN time_slots ts ON b.time_slot_id = ts.id
        JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
        JOIN trainers t ON ta.trainer_id = t.id
        WHERE b.user_id = " . $_SESSION['userid'] . "
        ORDER BY p.payment_date DESC";

$result = mysqli_query($connect, $sql);
$transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<?php include "include/meta.php" ?>
<style>
    
</style>
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

                <h2 class="main-title d-block d-lg-none">Transactions</h2>

                <!-- Transaction Filters -->
                <div class="filter-section mb-30">
                    <div class="row gx-3">
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                <input type="date" class="form-control" id="dateFilter" placeholder="Filter by date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="failed">Failed</option>
                                <option value="refunded">Refunded</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="amountFilter">
                                <option value="">Amount Range</option>
                                <option value="0-1000">₹0 - ₹1,000</option>
                                <option value="1000-5000">₹1,000 - ₹5,000</option>
                                <option value="5000+">₹5,000+</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary w-100" id="resetFilters">Reset Filters</button>
                        </div>
                    </div>
                </div>

                <!-- Transactions List -->
                <div class="transactions-list">
                    <?php if (empty($transactions)): ?>
                        <div class="alert alert-info">
                            No transactions found.
                        </div>
                    <?php else: ?>
                        <?php foreach ($transactions as $transaction): ?>
                            <div class="listing-card-one border-25 mb-30">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <div class="transaction-info">
                                            <h6 style="font-size: 1rem;" class="title mb-1">Transaction #<?php echo $transaction['transaction_id']; ?></h6>
                                            <p class="text-muted mb-0">
                                                <i class="bi bi-calendar me-2"></i>
                                                <?php echo date('d M Y, h:i A', strtotime($transaction['payment_date'])); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="trainer-info">
                                            <h6  style="font-size: 1rem;"  class="title mb-1">
                                                <?php echo htmlspecialchars($transaction['trainer_first_name'] . ' ' . $transaction['trainer_last_name']); ?>
                                            </h6>
                                            <p class="text-muted mb-0">
                                                <?php echo date('d M Y', strtotime($transaction['date'])); ?> 
                                                <?php echo date('h:i A', strtotime($transaction['start_time'])); ?> - 
                                                <?php echo date('h:i A', strtotime($transaction['end_time'])); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="amount">
                                            <h6 class="title mb-1">₹<?php echo number_format($transaction['amount'], 2); ?></h6>
                                            <p class="text-muted mb-0"><?php echo ucfirst($transaction['payment_method']); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="status">
                                            <span class="badge bg-<?php 
                                                echo $transaction['status'] == 'completed' ? 'success' : 
                                                    ($transaction['status'] == 'pending' ? 'warning' : 
                                                    ($transaction['status'] == 'failed' ? 'danger' : 'info')); 
                                            ?>">
                                                <?php echo ucfirst($transaction['status']); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-1">
                                        <div  class="actions">
                                            <a href="payment_success.php?booking_id=<?php echo $transaction['booking_id']; ?>" 
                                               class="btn btn-primary">
                                                <i class="bi bi-eye me-2"></i>Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
        <script src="../js/theme.js"></script>

        <script>
            $(document).ready(function() {
                // Remove loader after page loads
                setTimeout(function() {
                    $('#preloader').fadeOut(500, function() {
                        $(this).remove();
                    });
                }, 500);

                // Filter functionality
                $('#dateFilter, #statusFilter, #amountFilter').on('change', function() {
                    filterTransactions();
                });

                $('#resetFilters').on('click', function() {
                    $('#dateFilter').val('');
                    $('#statusFilter').val('');
                    $('#amountFilter').val('');
                    filterTransactions();
                });

                function filterTransactions() {
                    const date = $('#dateFilter').val();
                    const status = $('#statusFilter').val();
                    const amount = $('#amountFilter').val();

                    $('.listing-card-one').each(function() {
                        const card = $(this);
                        const cardDateText = card.find('.text-muted').first().text().split(',')[0].trim();
                        const cardStatus = card.find('.badge').text().trim().toLowerCase();
                        const cardAmount = parseFloat(card.find('.title').eq(2).text().replace('₹', '').replace(',', ''));

                        let show = true;

                        // Date filter
                        if (date) {
                            const filterDate = new Date(date);
                            const cardDate = new Date(cardDateText);
                            if (filterDate.toDateString() !== cardDate.toDateString()) {
                                show = false;
                            }
                        }

                        // Status filter
                        if (status && cardStatus !== status) {
                            show = false;
                        }

                        // Amount filter
                        if (amount) {
                            if (amount === '0-1000' && (cardAmount < 0 || cardAmount > 1000)) {
                                show = false;
                            } else if (amount === '1000-5000' && (cardAmount < 1000 || cardAmount > 5000)) {
                                show = false;
                            } else if (amount === '5000+' && cardAmount < 5000) {
                                show = false;
                            }
                        }

                        if (show) {
                            card.show();
                        } else {
                            card.hide();
                        }
                    });

                    // Show no results message if all cards are hidden
                    const visibleCards = $('.listing-card-one:visible').length;
                    if (visibleCards === 0) {
                        if ($('.no-results-message').length === 0) {
                            $('.transactions-list').append(
                                '<div class="alert alert-info no-results-message">No transactions found matching your criteria.</div>'
                            );
                        }
                    } else {
                        $('.no-results-message').remove();
                    }
                }

                // Initialize filters
                filterTransactions();
            });
        </script>
        	<?php include "include/footer.php" ?>
    </div>
</body>

</html>

<style>
.listing-card-one {
    background: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    padding: 20px;
}

.listing-card-one:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.title {
    color: #333;
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 5px;
}

.text-muted {
    color: #666;
    font-size: 0.9rem;
}

.status .badge {
    padding: 8px 12px;
    font-weight: 500;
    font-size: 0.9rem;
}

.filter-section {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
}

.input-group-text {
    background: #f8f9fa;
    border-right: none;
}

.form-control, .form-select {
    border-left: none;
}

.form-control:focus, .form-select:focus {
    box-shadow: none;
    border-color: #ced4da;
}

.btn-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
    border: none;
    padding: 8px 16px;
    font-weight: 500;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

#preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #fff;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

#ctn-preloader {
    text-align: center;
}
</style> 