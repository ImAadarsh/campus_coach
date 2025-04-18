

<?php
include "include/connect.php";

// Fetch all workshops
$sql = "SELECT w.*, c.name as category_name FROM workshops w 
        LEFT JOIN categories c ON w.category_id = c.id 
        ORDER BY w.start_date DESC";
$result = mysqli_query($connect, $sql);
$workshops = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch all categories for filter
$cat_sql = "SELECT * FROM categories";
$cat_result = mysqli_query($connect, $cat_sql);
$categories = mysqli_fetch_all($cat_result, MYSQLI_ASSOC);
$months = array_unique(array_map(function($workshop) {
    return date('F Y', strtotime($workshop['start_date']));
}, $workshops));
sort($months);

// Get unique modes, states, and languages
$modes = array_unique(array_column($workshops, 'mode'));
$states = array_unique(array_column($workshops, 'state'));
$languages = array_unique(array_column($workshops, 'language'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "include/meta.php" ?>
    <title>Workshops | Campus Coach</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .filter-section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 30px;
        }
        .filter-section h3 {
            color: #8B4513;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .filter-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .filter-select-wrapper {
            position: relative;
        }
        .filter-select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            font-size: 16px;
            color: #8B4513;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }
       
        .filter-select::-ms-expand {
            display: none;
        }
        .filter-select-wrapper::before {
            content: '\25BC';
            position: absolute;
            top: 50%;
            right: 30px;
            transform: translateY(-50%);
            color: #8B4513;
            pointer-events: none;
            font-size: 12px;
        }
        .filter-select-wrapper::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            width: 10px;
            height: 10px;
            border-right: 2px solid #8B4513;
            border-bottom: 2px solid #8B4513;
            transform: translateY(-75%) rotate(45deg);
            pointer-events: none;
        }
        .filter-select:focus {
            outline: none;
            border-color: #8B4513;
        }
        .filter-select option{
            color: white !important;
        }
    </style>
</head>
<body>
    <?php include "include/loader.php" ?>
    <?php include "include/canvas.php" ?>
    <?php include "include/header_sub.php" ?>

    <!--<< Breadcrumb Section Start >>-->
    <div class="breadcrumb-wrapper bg-cover" style="background-image: url('assets/img/breadcrumb.png');">
            <div class="line-shape">
                <img src="assets/img/breadcrumb-shape/line.png" alt="shape-img">
            </div>
            <div class="plane-shape float-bob-y">
                <img src="assets/img/breadcrumb-shape/plane.png" alt="shape-img">
            </div>
            <div class="doll-shape float-bob-x">
                <img src="assets/img/breadcrumb-shape/doll.png" alt="shape-img">
            </div>
            <div class="parasuit-shape float-bob-y">
                <img src="assets/img/breadcrumb-shape/parasuit.png" alt="shape-img">
            </div>
            <div class="frame-shape">
                <img src="assets/img/breadcrumb-shape/frame.png" alt="shape-img">
            </div>
            <div class="bee-shape float-bob-x">
                <img src="assets/img/breadcrumb-shape/bee.png" alt="shape-img">
            </div>
            <div class="container">
                <div class="page-heading">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Workshop & Sessions</h1>
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                        <li>
                            <a href="index.php">
                                Home
                            </a>
                        </li>
                        <li>
                            <i class="fas fa-chevron-right"></i>
                        </li>
                        <li>
                            Workshops
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    <!-- Workshop Section Start -->
    <section class="event-section fix section-padding">
        <div class="container">
            <!-- Filter Section -->
            <div class="filter-section wow fadeInUp" data-wow-delay=".3s">
    <h3>Filter Workshops</h3>
    <div class="filter-container">
        <div class="filter-select-wrapper">
            <select id="monthFilter" class="filter-select">
                <option value="">All Months</option>
                <?php foreach ($months as $month): ?>
                    <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filter-select-wrapper">
            <select id="categoryFilter" class="filter-select">
                <option value="">All Categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filter-select-wrapper">
            <select id="modeFilter" class="filter-select">
                <option value="">All Modes</option>
                <?php foreach ($modes as $mode): ?>
                    <option value="<?php echo $mode; ?>"><?php echo $mode; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filter-select-wrapper">
            <select id="stateFilter" class="filter-select">
                <option value="">All States</option>
                <?php foreach ($states as $state): ?>
                    <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

            <!-- Workshop Grid -->
            <div class="row g-4" id="workshopGrid">
                <?php foreach ($workshops as $workshop): ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp workshop-item" 
                         data-category="<?php echo $workshop['category_id']; ?>"
                         data-mode="<?php echo $workshop['mode']; ?>"
                         data-state="<?php echo $workshop['state']; ?>"
                         data-date="<?php echo $workshop['start_date']; ?>"
                         data-wow-delay=".3s">
                        <div class="event-box-items mt-0 box-shadow">
                            <div class="event-image">
                                <img src="<?php echo $uri . $workshop['banner_image']; ?>" alt="workshop-img">
                                <div class="event-shape">
                                    <img src="assets/img/event/shape.png" alt="shape-img">
                                </div>
                                <ul class="post-date">
                                    <li>
                                        <img src="assets/img/event/calender.svg" alt="img" class="me-2">
                                        <?php echo date('M d, Y', strtotime($workshop['start_date'])); ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="event-content">
                                <ul>
                                    <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M12.7847 1.98206C11.5066 0.703906 9.80717 0 7.99961 0C6.19205 0 4.49261 0.703906 3.21448 1.98206C1.93633 3.26025 1.23242 4.95962 1.23242 6.76716C1.23242 10.4238 4.68986 13.4652 6.54733 15.0991C6.80545 15.3262 7.02836 15.5223 7.20595 15.6882C7.42845 15.896 7.71405 15.9999 7.99958 15.9999C8.28517 15.9999 8.5707 15.896 8.79324 15.6882C8.97083 15.5223 9.19374 15.3262 9.45186 15.0991C11.3093 13.4652 14.7668 10.4238 14.7668 6.76716C14.7667 4.95962 14.0629 3.26025 12.7847 1.98206ZM8.8328 14.3954C8.56902 14.6275 8.34124 14.8279 8.15342 15.0033C8.06714 15.0838 7.93202 15.0838 7.8457 15.0033C7.65792 14.8278 7.43011 14.6274 7.16633 14.3954C5.42008 12.8593 2.16961 9.99997 2.16961 6.76719C2.16961 3.55256 4.78489 0.937281 7.99955 0.937281C11.2142 0.937281 13.8295 3.55256 13.8295 6.76719C13.8295 9.99997 10.579 12.8593 8.8328 14.3954Z" fill="#F39F5F"/>
                                            <path d="M7.9998 3.5293C6.35539 3.5293 5.01758 4.86708 5.01758 6.51148C5.01758 8.15589 6.35539 9.49367 7.9998 9.49367C9.6442 9.49367 10.982 8.15589 10.982 6.51148C10.982 4.86708 9.6442 3.5293 7.9998 3.5293ZM7.9998 8.55639C6.8722 8.55639 5.95483 7.63902 5.95483 6.51145C5.95483 5.38389 6.8722 4.46652 7.9998 4.46652C9.12739 4.46652 10.0447 5.38389 10.0447 6.51145C10.0447 7.63902 9.12739 8.55639 7.9998 8.55639Z" fill="#F39F5F"/>
                                        </svg>
                                        <span><?php echo $workshop['location'] . ', ' . $workshop['state']; ?></span>
                                    </li>
                                </ul>
                                <h3>
                                    <a href="event-details.php?id=<?php echo $workshop['id']; ?>"><?php echo $workshop['title']; ?></a>
                                </h3>
                                <div class="event-author">
                                    <a href="event-details.php?id=<?php echo $workshop['id']; ?>" class="theme-btn">Learn More <i class="fa-solid fa-arrow-right-long"></i></a>
                                    <div class="author-ratting">
                                        <span><?php echo $workshop['mode']; ?></span>
                                        <div class="star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star color-1"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php include "include/footer.php" ?>
    <?php include "include/script.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
$(document).ready(function() {
    $('#monthFilter, #categoryFilter, #modeFilter, #stateFilter').change(function() {
        filterWorkshops();
    });

    function filterWorkshops() {
        var selectedMonth = $('#monthFilter').val();
        var selectedCategory = $('#categoryFilter').val();
        var selectedMode = $('#modeFilter').val();
        var selectedState = $('#stateFilter').val();

        $('.workshop-item').each(function() {
            var workshopDate = $(this).data('date');
            var workshopMonth = new Date(workshopDate).toLocaleString('default', { month: 'long', year: 'numeric' });
            var workshopCategory = $(this).data('category');
            var workshopMode = $(this).data('mode');
            var workshopState = $(this).data('state');

            var monthMatch = !selectedMonth || workshopMonth === selectedMonth;
            var categoryMatch = !selectedCategory || workshopCategory == selectedCategory;
            var modeMatch = !selectedMode || workshopMode === selectedMode;
            var stateMatch = !selectedState || workshopState === selectedState;

            if (monthMatch && categoryMatch && modeMatch && stateMatch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
});
</script>
</body>
</html>