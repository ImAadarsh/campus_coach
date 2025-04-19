<?php include "include/connect.php"; 


// Get filter parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$price = isset($_GET['price']) ? $_GET['price'] : '';

// Build the SQL query
$sql = "SELECT t.*, 
        GROUP_CONCAT(DISTINCT ts.specialization) as specializations,
        AVG(tr.rating) as avg_rating,
        COUNT(tr.id) as review_count
        FROM trainers t
        LEFT JOIN trainer_specializations ts ON t.id = ts.trainer_id
        LEFT JOIN trainer_reviews tr ON t.id = tr.trainer_id
        WHERE 1=1";

// Add search filter
if (!empty($search)) {
    $sql .= " AND (t.first_name LIKE '%$search%' OR t.last_name LIKE '%$search%' OR t.designation LIKE '%$search%')";
}

// Add category filter
if (!empty($category)) {
    $sql .= " AND ts.specialization = '$category'";
}

// Add price filter
if (!empty($price)) {
    if ($price === 'asc') {
        $sql .= " ORDER BY t.price ASC";
    } elseif ($price === 'desc') {
        $sql .= " ORDER BY t.price DESC";
    }
}

// Group by trainer ID
$sql .= " GROUP BY t.id";

// Execute the query
$result = $connect->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Coach | Guiding Future | Counsellor</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets_cc/images/fav.png">
    <!-- fontawesome 6.4.2 -->
    <link rel="stylesheet" href="assets_cc/css/plugins/fontawesome-6.css">
    <!-- swiper Css 10.2.0 -->
    <link rel="stylesheet" href="assets_cc/css/plugins/swiper.min.css">
    <!-- magnific popup css -->
    <link rel="stylesheet" href="assets_cc/css/vendor/magnific-popup.css">
    <!-- Bootstrap 5.0.2 -->
    <link rel="stylesheet" href="assets_cc/css/vendor/bootstrap.min.css">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="assets_cc/css/vendor/jquery-ui.css">
    <!-- metismenu scss -->
    <link rel="stylesheet" href="assets_cc/css/vendor/metismenu.css">
    <!-- custom style css -->
    <link rel="stylesheet" href="assets_cc/css/style.css">
</head>

<body>


    <!-- header style one -->
    <!-- header style one -->
<?php include "include_cc/header.php"; ?>
    <!-- header style end -->
    <!-- header style end -->


    <!-- bread crumb area -->
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">Our Counsellor</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="index.php">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="counsellor.php">All Counsellor</a>
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bread crumb area end -->



    <!-- course area start -->
    <div class="rts-course-default-area rts-section-gap">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3">
                    <!-- course-filter-area start -->
                    <div class="rts-course-filter-area">
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Search</h6>
                            <div class="search-filter filter-body">
                                <div class="input-wrapper">
                                    <input type="text" id="searchInput" placeholder="Search Counsellor..." value="<?php echo htmlspecialchars($search); ?>">
                                    <i class="fa-light fa-magnifying-glass"></i>
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Specialization</h6>
                            <div class="checkbox-filter filter-body">
                                <div class="checkbox-wrapper">
                                    <?php
                                    $specializations = $connect->query("SELECT DISTINCT specialization FROM trainer_specializations");
                                    while ($spec = $specializations->fetch_assoc()) {
                                        $checked = ($category == $spec['specialization']) ? 'checked' : '';
                                        echo '<div class="single-checkbox-filter">
                                        <div class="check-box">
                                                    <input type="checkbox" id="category-' . $spec['specialization'] . '" 
                                                           name="category" value="' . $spec['specialization'] . '" ' . $checked . '>
                                                    <label for="category-' . $spec['specialization'] . '">' . $spec['specialization'] . '</label>
                                        </div>
                                            </div>';
                                    }
                                    ?>
                                    </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->

                        <!-- single filter wized end -->
                        <a href="#" class="rts-btn btn-border"><i class="fa-regular fa-x"></i> Clear All Filters</a>
                    </div>
                    <!-- course-filter-area end -->
                </div>
                <div class="col-lg-9">
                    <!-- filter top-area  -->
                    <div class="filter-small-top-full">
                        <div class="left-filter">
                            <span>Short By</span>
                            <select class="nice-select" name="price">
                                <option>All Category</option>
                                <option value="asc">Design</option>
                                <option value="desc">Development</option>
                                <option value="pop">Popularity</option>
                                <option value="low">Price</option>
                                <option value="high">Stars</option>
                            </select>
                        </div>
                        <div class="right-filter">
                            <span>Showing All Counsellor</span>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                        <i class="fa-light fa-grid-2"></i>
                                        <span>Grid</span>
                                    </button>
                                </li>
                               
                            </ul>

                        </div>
                    </div>
                    <!-- filter top-area end -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row g-5 mt--10">
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($trainer = $result->fetch_assoc()) {
                                        $rating = round($trainer['avg_rating'], 1);
                                        $stars = str_repeat('<i class="fa-sharp fa-solid fa-star"></i>', floor($rating));
                                        if ($rating - floor($rating) >= 0.5) {
                                            $stars .= '<i class="fa-sharp fa-regular fa-star-half-stroke"></i>';
                                        }
                                        $stars .= str_repeat('<i class="fa-sharp fa-regular fa-star"></i>', 5 - ceil($rating));
                                        
                                        echo '<div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="rts-single-course">
                                                    <a href="trainer-profile.php?id=' . $trainer['id'] . '" class="thumbnail">
                                                        <img src="' . $uri . $trainer['profile_img'] . '" alt="' . $trainer['first_name'] . ' ' . $trainer['last_name'] . '">
                                        </a>
                                        <div class="tags-area-wrapper">
                                            <div class="single-tag">
                                                            <span>' . $trainer['specializations'] . '</span>
                                            </div>
                                        </div>
                                        <div class="lesson-studente">
                                            <div class="lesson">
                                                <i class="fa-light fa-user-group"></i>
                                                            <span>' . $trainer['review_count'] . ' Reviews</span>
                                            </div>
                                        </div>
                                                    <a href="trainer-profile.php?id=' . $trainer['id'] . '">
                                                        <h5 class="title">' . $trainer['first_name'] . ' ' . $trainer['last_name'] . '</h5>
                                        </a>
                                                    <p class="teacher">' . $trainer['designation'] . '</p>
                                        <div class="rating-and-price">
                                            <div class="rating-area">
                                                            <span>' . $rating . '</span>
                                                <div class="stars">
                                                                <ul>' . $stars . '</ul>
                                                </div>
                                            </div>
                                            <div class="price-area">
                                                            <a href="booking.php?trainer_id=' . $trainer['id'] . '" class="rts-btn btn-primary">Book Now</a>
                                                </div>
                                                </div>
                                            </div>
                                            </div>';
                                    }
                                } else {
                                    echo '<div class="col-12"><p>No trainers found matching your criteria.</p></div>';
                                }
                                ?>
                            </div>
                            <div class="row mt--30">
                                <div class="col-lg-12">
                                    <!-- rts-pagination-area -->
                                    
                                    <!-- rts-pagination-area end -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                                </div>
                                            </div>
        </div>
    </div>
    <!-- course area end -->


    <!-- Modal -->
    <div class="modal login-pupup-modal fade" id="exampleModal-login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hi, Welcome back!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" class="login-form">
                        <input type="text" placeholder="Username of Email Address" required>
                        <input type="password" placeholder="Password" required>
                        <div class="d-flex mb--20 align-items-center">
                            <input type="checkbox" id="examplecheck-modal">
                            <label for="examplecheck-modal">I agree to the terms of use and privacy policy.</label>
                        </div>
                        <button type="submit" class="rts-btn btn-primary">Sign In</button>

                        <p class="dont-acc mt--20">Dont Have an Account? <a href="registration.php">Sign-up</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- cart area start -->

    <!-- footer call to action area start -->
<?php include "include_cc/footer.php"; ?> 
    <!-- footer call to action area end -->
    <!-- cart area edn -->


    <!-- cart area start -->

    <!-- cart area start -->
<?php include "include_cc/cart.php"; ?>
    <!-- cart area edn -->
    <!-- cart area edn -->


    <!-- header style two -->
    <div id="side-bar" class="side-bar header-two">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>
        <!-- inner menu area desktop start -->
        <div class="inner-main-wrapper-desk">
            <div class="thumbnail">
                <img src="assets_cc/images/banner/04.jpg" alt="elevate">
            </div>
            <div class="inner-content">
                <h4 class="title">We Build Building and Great Constructive Homes.</h4>
                <p class="disc">
                    We successfully cope with tasks of varying complexity, provide long-term guarantees and regularly master new technologies.
                </p>
                <div class="footer">
                    <h4 class="title">Got a project in mind?</h4>
                    <a href="contact.php" class="rts-btn btn-primary">Let's talk</a>
                </div>
            </div>
        </div>
        <!-- mobile menu area start -->
        <div class="mobile-menu-main">
            <nav class="nav-main mainmenu-nav mt--30">
                <ul class="mainmenu metismenu" id="mobile-menu-active">
                    <li class="has-droupdown">
                        <a href="#" class="main">Home</a>
                        <ul class="submenu mm-collapse">
                            <li><a class="mobile-menu-link" href="index.php">Main Home</a></li>
                            <li><a class="mobile-menu-link" href="index-two.php">Online Course</a></li>
                            <li><a class="mobile-menu-link" href="index-three.php">Course Hub</a></li>
                            <li><a class="mobile-menu-link" href="index-four.php">Distance Learning</a></li>
                            <li><a class="mobile-menu-link" href="index-five.php">Single Instructor</a></li>
                            <li><a class="mobile-menu-link" href="index-six.php">Language Academy</a></li>
                            <li><a class="mobile-menu-link" href="index-seven.php">Gym Instructor</a></li>
                            <li><a class="mobile-menu-link" href="index-eight.php">Kitchen Coach</a></li>
                            <li><a class="mobile-menu-link" href="index-nine.php">Course Portal</a></li>
                            <li><a class="mobile-menu-link" href="index-ten.php">Business Coach</a></li>
                        </ul>
                    </li>
                    <li class="has-droupdown">
                        <a href="#" class="main">Pages</a>
                        <ul class="submenu mm-collapse">
                            <li><a class="mobile-menu-link" href="about.php">About Us</a></li>
                            <li><a class="mobile-menu-link" href="about-two.php">About Us Two</a></li>
                            <li><a class="mobile-menu-link" href="instructor-profile.php">Profile</a></li>
                            <li><a class="mobile-menu-link" href="contact.php">Contact</a></li>
                            <li class="has-droupdown third-lvl">
                                <a class="main" href="#">Zoom</a>
                                <ul class="submenu-third-lvl mm-collapse">
                                    <li><a href="zoom-meeting.php"></a>Zoom Meeting</li>
                                    <li><a href="zoom-details.php"></a>Zoom Details</li>
                                </ul>
                            </li>
                            <li class="has-droupdown third-lvl">
                                <a class="main" href="#">Event</a>
                                <ul class="submenu-third-lvl mm-collapse">
                                    <li><a href="event.php"></a>Event</li>
                                    <li><a href="event-two.php"></a>Event Two</li>
                                    <li><a href="event-details.php"></a>Event Details</li>
                                </ul>
                            </li>
                            <li class="has-droupdown third-lvl">
                                <a class="main" href="#">Shop</a>
                                <ul class="submenu-third-lvl mm-collapse">
                                    <li><a href="shop.php"></a>Shop</li>
                                    <li><a href="product-details.php"></a>Product Details</li>
                                    <li><a href="checkout.php"></a>Checkout</li>
                                    <li><a href="cart.php"></a>Cart</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="has-droupdown">
                        <a href="#" class="main">Course</a>
                        <ul class="submenu mm-collapse">
                            <li><a href="#" class="tag">Courses</a></li>
                            <li><a class="mobile-menu-link" href="course-one.php">Courses</a></li>
                            <li><a class="mobile-menu-link" href="course-two.php">Course List</a></li>
                            <li><a class="mobile-menu-link" href="course-three.php">Course Grid</a></li>
                            <li><a class="mobile-menu-link" href="course-four.php">Course List Two</a></li>
                            <li><a class="mobile-menu-link" href="course-five.php">Course Grid Two</a></li>
                            <li><a class="mobile-menu-link" href="course-six.php">Course Filter</a></li>
                        </ul>
                        <ul class="submenu mm-collapse">
                            <li><a href="#" class="tag">Courses Details</a></li>
                            <li><a class="mobile-menu-link" href="single-course.php">Courses Details</a></li>
                            <li><a class="mobile-menu-link" href="single-course-two.php">Courses Details V2</a></li>
                            <li><a class="mobile-menu-link" href="single-course-three.php">Courses Details V3</a></li>
                            <li><a class="mobile-menu-link" href="single-course-four.php">Courses Details V4</a></li>
                            <li><a class="mobile-menu-link" href="single-course-five.php">Courses Details V5</a></li>
                            <li><a class="mobile-menu-link" href="single-course-free.php">Courses Details Free</a></li>
                        </ul>
                        <ul class="submenu mm-collapse">
                            <li><a href="#" class="tag">Others</a></li>
                            <li><a class="mobile-menu-link" href="become-instructor.php">Become an Instructor</a></li>
                            <li><a class="mobile-menu-link" href="instructor-profile.php">Instructor Profile</a></li>
                            <li><a class="mobile-menu-link" href="instructor.php">Instructor</a></li>
                            <li><a class="mobile-menu-link" href="pricing.php">Membership Plan</a></li>
                            <li><a class="mobile-menu-link" href="log-in.php">Log In</a></li>
                            <li><a class="mobile-menu-link" href="registration.php">Registration</a></li>
                        </ul>
                    </li>
                    <li class="has-droupdown">
                        <a href="#" class="main">Dashboard</a>
                        <ul class="submenu mm-collapse">
                            <li class="has-droupdown third-lvl">
                                <a class="main" href="#">Instructor Dashboard</a>
                                <ul class="submenu-third-lvl mm-collapse">
                                    <li><a href="dashboard.php"></a>Dashboard</li>
                                    <li><a href="my-profile.php"></a>My Profile</li>
                                    <li><a href="enroll-course.php"></a>Enroll Course</li>
                                    <li><a href="wishlist.php"></a>Wishlist</li>
                                    <li><a href="reviews.php"></a>Reviews</li>
                                    <li><a href="quick-attempts.php"></a>Quick Attempts</li>
                                    <li><a href="order-history.php"></a>Order History</li>
                                    <li><a href="question-answer.php"></a>Question Answer</li>
                                    <li><a href="calender.php"></a>Calender</li>
                                    <li><a href="my-course.php"></a>My Course</li>
                                    <li><a href="announcement.php"></a>Announcement</li>
                                    <li><a href="assignments.php"></a>Assignments</li>
                                    <li><a href="certificate.php"></a>Certificate</li>
                                </ul>
                            </li>
                            <li class="has-droupdown third-lvl">
                                <a class="main" href="#">Students Dashboard</a>
                                <ul class="submenu-third-lvl mm-collapse">
                                    <li><a href="student-dashboard.php"></a>Dashboard</li>
                                    <li><a href="student-profile.php"></a>My Profile</li>
                                    <li><a href="student-enroll-course.php"></a>Enroll Course</li>
                                    <li><a href="student-wishlist.php"></a>Wishlist</li>
                                    <li><a href="student-reviews.php"></a>Reviews</li>
                                    <li><a href="student-quick-attempts.php"></a>Quick Attempts</li>
                                    <li><a href="student-order-history.php"></a>Order History</li>
                                    <li><a href="student-question-answer.php"></a>Question Answer</li>
                                    <li><a href="student-calender.php"></a>Calender</li>
                                    <li><a href="student-settings.php"></a>Students Settings</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="has-droupdown">
                        <a href="#" class="main">Blog</a>
                        <ul class="submenu mm-collapse">
                            <li><a class="mobile-menu-link" href="blog.php">Blog</a></li>
                            <li><a class="mobile-menu-link" href="blog-grid.php">Blog Grid</a></li>
                            <li><a class="mobile-menu-link" href="blog-list.php">Blog List</a></li>
                            <li><a class="mobile-menu-link" href="blog-right-sidebar.php">Blog Right Sidebar</a></li>
                            <li><a class="mobile-menu-link" href="blog-left-sidebar.php">Blog Left Sidebar</a></li>
                            <li><a class="mobile-menu-link" href="blog-details.php">Blog Details</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="buttons-area">
                <a href="#" class="rts-btn btn-border">Log In</a>
                <a href="#" class="rts-btn btn-primary">Sign Up</a>
            </div>

            <div class="rts-social-style-one pl--20 mt--50">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- mobile menu area end -->
    </div>
    <!-- header style two End -->

    <!-- modal -->
    <div id="myModal-1" class="modal fade" role="dialog">
        <div class="modal-dialog bg_image">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal"><i class="fa-light fa-x"></i></button>
                </div>
                <div class="modal-body text-center">
                    <div class="inner-content">
                        <div class="title-area">
                            <span class="pre">Get Our Courses Free</span>
                            <h4 class="title">Wonderful for Learning</h4>
                        </div>
                        <form action="#">
                            <input type="text" placeholder="Your Mail.." required>
                            <button>Download Now</button>
                            <span>Your information will never be shared with any third party</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts backto top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>
    <!-- rts backto top end -->

    <!-- offcanvase search -->
    <div class="search-input-area">
        <div class="container">
            <div class="search-input-inner">
                <div class="input-div">
                    <input class="search-input autocomplete" type="text" placeholder="Search by keyword or #">
                    <button><i class="far fa-search"></i></button>
                </div>
            </div>
        </div>
        <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>
    </div>
    <!-- offcanvase search -->
    <div id="anywhere-home" class="">
    </div>

<?php include "include_cc/script.php"; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('input[type="checkbox"], #searchInput');
    filters.forEach(filter => {
        filter.addEventListener('change', updateFilters);
    });
    document.getElementById('searchInput').addEventListener('input', updateFilters);
});

function updateFilters() {
    const params = new URLSearchParams(window.location.search);
    
    // Update search
    const search = document.getElementById('searchInput').value;
    if (search) params.set('search', search);
    else params.delete('search');
    
    // Update category
    const category = document.querySelector('input[name="category"]:checked');
    if (category) params.set('category', category.value);
    else params.delete('category');
    
    // Update price
    const price = document.querySelector('input[name="price"]:checked');
    if (price) params.set('price', price.value);
    else params.delete('price');
    
    // Reload page with new filters
    window.location.href = window.location.pathname + '?' + params.toString();
}
</script>

</body>

</html>