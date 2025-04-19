<?php error_reporting( E_ALL ); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Coach | Guiding Future </title>
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

<?php
// Include database connection
include "include/connect.php";

// Add this function at the top of the file after the database connection
function getInitials($name) {
    $words = explode(' ', $name);
    $initials = '';
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    return substr($initials, 0, 2);
}

// Get trainer ID from URL or set default
$trainer_id = isset($_GET['trainer_id']) ? intval($_GET['trainer_id']) : 1;

// Fetch trainer details
$trainer_query = "SELECT * FROM trainers WHERE id = $trainer_id";
$trainer_result = mysqli_query($connect, $trainer_query);
$trainer = mysqli_fetch_assoc($trainer_result);

// If trainer not found, use default data
// Get trainer statistics

$stats_query = "SELECT 
                (SELECT COUNT(DISTINCT user_id) FROM bookings 
                    JOIN time_slots ON bookings.time_slot_id = time_slots.id 
                    JOIN trainer_availabilities ON time_slots.trainer_availability_id = trainer_availabilities.id 
                    WHERE trainer_availabilities.trainer_id = $trainer_id) as students,
                (SELECT COUNT(bookings.id) FROM bookings 
                    JOIN time_slots ON bookings.time_slot_id = time_slots.id 
                    JOIN trainer_availabilities ON time_slots.trainer_availability_id = trainer_availabilities.id 
                    WHERE trainer_availabilities.trainer_id = $trainer_id) as sessions,
                (SELECT AVG(rating) FROM trainer_reviews WHERE trainer_id = $trainer_id) as avg_rating";


$stats_result = mysqli_query($connect, $stats_query);

$stats = mysqli_fetch_assoc($stats_result);

// Default values if no stats found
$students = $stats && $stats['students'] ? $stats['students'] : 2000;
$sessions = $stats && $stats['sessions'] ? $stats['sessions'] : 100;
$avg_rating = $stats && $stats['avg_rating'] ? round($stats['avg_rating'], 1) : 4.5;



// Get specializations

$specialization_query = "SELECT specialization FROM trainer_specializations WHERE trainer_id = $trainer_id";

$specialization_result = mysqli_query($connect, $specialization_query);

$specializations = [];
while ($spec = mysqli_fetch_assoc($specialization_result)) {
    $specializations[] = $spec['specialization'];
}

// Profile image path

$hero_img = isset($trainer['profile_img']) && strpos($trainer['profile_img'], 'http') === false 
    ? $uri . $trainer['profile_img'] 
    : (isset($trainer['profile_img']) ? $trainer['profile_img'] : 'Gaurava.png');


$profile_img = isset($trainer['hero_img']) && strpos($trainer['hero_img'], 'http') === false 
    ? $uri . $trainer['hero_img'] 
    : (isset($trainer['hero_img']) ? $trainer['hero_img'] : 'gaurava_bg.png');


?>

    <!-- header style one -->
<?php include 'include_cc/header.php'; ?>
    <!-- header style end -->


    <!-- rts banner area five -->
    <div class="rts-banner-five bg_image">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-xl-1 order-lg-1 order-md-2 order-sm-2 order-2">
                    <!-- banner five area start -->
                    <div class="rts-banner-five-content-wrapper pt--100 pb--150">
                        <span class="pre-title">Hello! I'm</span>
                        <h1 class="title-m-5">
                            <?php echo $trainer['first_name']; ?> <br>
                            <span><?php echo $trainer['last_name']; ?></span>
                            <img src="assets_cc/images/banner/shape/01.svg" alt="banner-image">
                        </h1>
                        <div class="banner-btn-author-wrapper">
                            <a href="course-one.php?trainer_id=<?php echo $trainer_id; ?>" class="rts-btn btn-primary-white radious-0">Book Session</a>
                            <div class="rts-wrapper-stars-area">
                                <h5 class="title"><?php echo $avg_rating; ?> <span style="font-size: 18px; font-weight: 500; color: #fff;"> Star Instructor Rating</span> </h5>
                                <?php 
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= floor($avg_rating)) {
                                        echo '<i class="fa-solid fa-star"></i>';
                                    } else if ($i - 0.5 <= $avg_rating) {
                                        echo '<i class="fa-solid fa-star-half-stroke"></i>';
                                    } else {
                                        echo '<i class="fa-regular fa-star"></i>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php if(!empty($trainer['short_about'])): ?>
                        <p style="font-size: 18px; font-weight: 500; color: #fff;" class="disc mt-3"><?php echo $trainer['short_about']; ?></p>
                        <?php endif; ?>
                    </div>
                    <!-- banner five area end -->
                </div>
                <div class="col-lg-6 order-xl-2 order-lg-2 order-md-1 order-sm-1 order-1  justify-content-xl-end justify-content-md-center justify-content-sm-center d-flex align-items-end">
                    <!-- banner five image area start -->
                    <div class="banner-five-thumbnail">
                        <img src="<?php echo $hero_img; ?>" alt="<?php echo $trainer['first_name'].' '.$trainer['last_name']; ?>">
                    </div>
                    <!-- banner five image area end -->
                </div>
            </div>
        </div>
        <!-- banner- absolute-area -->
        <div class="banner-absolute-wrapper">
            <div class="sm-image-wrapper">
                <div class="images-wrap">
                    <img src="assets_cc/images/banner/shape/06.png" alt="banner">
                    <img class="two" src="assets_cc/images/banner/shape/07.png" alt="banner">
                    <img class="three" src="assets_cc/images/banner/shape/08.png" alt="banner">
                </div>
                <div class="info">
                    <h6 class="title"><?php echo number_format($students); ?>+ students</h6>
                    <span>Mentored</span>
                </div>
            </div>
            <div class="review-thumb">
                <!-- single review -->
                <div class="review-single two">
                    <img src="assets_cc/images/banner/08.png" alt="banner">
                    <div class="info-right">
                        <h6 class="title"><?php echo number_format($sessions); ?>+
                        </h6>
                        <span>Sessions</span>
                    </div>
                </div>
                <!-- single review end -->
            </div>
        </div>
        <!-- banner- absolute-area end -->
    </div>
    <!-- rts banner area five end -->

    <!-- rts fun facts area start -->

    <!-- rts fun facts area end -->

    

    <!-- rts about area start -->
    <div class="rts-about-area-five rts-section-gapBottom mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- about left- style-five -->
                    <div class="about-left-style-five">
                        <div class="title-wrapper">
                            <h2 class="title-stroke">Instructor</h2>
                        </div>
                        <?php 
                        // Split about text into paragraphs
                        $about_paragraphs = explode("\n", $trainer['about']);
                        foreach($about_paragraphs as $paragraph) {
                            if(trim($paragraph) != '') {
                                echo '<p class="disc mb--30">' . trim($paragraph) . '</p>';
                            }
                        }
                        ?>

                        <div class="call-sign-area-start">
                            <div class="call-btn-area">
                                <div class="icon">
                                    <i class="fa-regular fa-phone"></i>
                                </div>
                                <div class="information">
                                    <p>Connect with me</p>
                                    <a href="#"><?php echo str_repeat('*', strlen($trainer['mobile'])); ?></a>
                                </div>
                            </div>
                            <div class="sign-area-start">
                                <img width="100px" src="assets_cc/images/logo/logo-1.svg" alt="about">
                            </div>
                        </div>
                    </div>
                    <!-- about left- style-five end -->
                </div>
                <div class="col-lg-6 pl--50 pl_md--15 pl_sm--10 mt_md--50  mt_sm--50">
                    <!-- about area top wrapper -->
                    <div class="about-thumbnail-right-5">
                        <p>Hey there, my name is <?php echo $trainer['first_name'].' '.$trainer['last_name']; ?>. I'm <br> <?php echo $trainer['designation']; ?></p>
                        <img src="<?php echo $profile_img; ?>" alt="<?php echo $trainer['first_name'].' '.$trainer['last_name']; ?>">
                    </div>
                    <!-- about area top wrapper end -->
                </div>
            </div>
        </div>
        <!-- <div class="badge-wrapper">
            <img src="assets_cc/images/about/03.png" alt="about">
        </div> -->
    </div>
    <!-- rts about area end -->

    <!-- rts students feedbacka area start -->
    <div class="rts-students-feedback-area ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-w-style-center">
                        <h2 class="title">My Students Feedback</h2>
                        <p>Read what my students say about their learning experience</p>
                    </div>
                </div>
            </div>
            <div class="row mt--50">
                <div class="col-lg-12">
                    <div class="swiper-feedback-wrapper-5">
                        <div class="swiper swiper-data" data-swiper='{
                                "spaceBetween":30,
                                "slidesPerView":3,
                                "loop": true,
                                "navigation":{
                                    "nextEl":".swiper-button-next",
                                    "prevEl":".swiper-button-prev"
                                },
                                "pagination":{
                                    "el":".swiper-pagination",
                                    "clickable":"true"
                                },
                                "autoplay":{
                                    "delay":"2000"
                                },
                                "breakpoints":{"320":{
                                    "slidesPerView":1,
                                    "spaceBetween":30},
                                "480":{
                                    "slidesPerView":1,
                                    "spaceBetween":30},
                                "640":{
                                    "slidesPerView":2,
                                    "spaceBetween":30},
                                "940":{
                                    "slidesPerView":2,
                                    "spaceBetween":30},
                                "1140":{
                                    "slidesPerView":3,
                                    "spaceBetween":30}
                                }
                            }'>
                            <div class="swiper-wrapper">
                                <?php
                                // Get trainer reviews
                                $reviews_query = "SELECT tr.*, u.first_name, u.last_name, u.icon 
                                                FROM trainer_reviews tr 
                                                JOIN users u ON tr.user_id = u.id 
                                                WHERE tr.trainer_id = $trainer_id 
                                                ORDER BY tr.created_at DESC 
                                                LIMIT 10";
                                $reviews_result = mysqli_query($connect, $reviews_query);
                                
                                if (mysqli_num_rows($reviews_result) > 0) {
                                    while ($review = mysqli_fetch_assoc($reviews_result)) {
                                        $user_img = !empty($review['icon']) ? $uri . $review['icon'] : 'assets_cc/images/students-feedback/02.png';
                                        $rating = intval($review['rating']);
                                        $user_name = $review['first_name'] . ' ' . $review['last_name'];
                                ?>
                                <div class="swiper-slide">
                                    <!-- single students feedbacka rea start -->
                                    <div class="single-students-feedback-5">
                                        <div class="stars">
                                            <?php
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                } else {
                                                    echo '<i class="fa-regular fa-star"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <p class="disc">
                                            <?php echo !empty($review['review']) ? $review['review'] : 'Great experience with this instructor. Highly recommended!'; ?>
                                        </p>
                                        <div class="authore-area">
                                            <div class="initials-avatar" style="width: 50px; height: 50px; background-color: #4a90e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 18px;">
                                                <?php echo getInitials($user_name); ?>
                                            </div>
                                            <div class="author">
                                                <h6 class="title"><?php echo $user_name; ?></h6>
                                                <span>Student</span>
                                            </div>
                                        </div>
                                        <div class="quote">
                                            <img src="assets_cc/images/students-feedback/19.png" alt="feedback">
                                        </div>
                                    </div>
                                    <!-- single students feedbacka rea end -->
                                </div>
                                <?php
                                    }
                                } else {
                                    // Default reviews if none found
                                    $default_reviews = [
                                      
                                    ];
                                    
                                    foreach ($default_reviews as $review) {
                                ?>
                                <div class="swiper-slide">
                                    <!-- single students feedbacka rea start -->
                                    <div class="single-students-feedback-5">
                                        <div class="stars">
                                            <?php
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $review['rating']) {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                } else {
                                                    echo '<i class="fa-regular fa-star"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <p class="disc">
                                            <?php echo $review['text']; ?>
                                        </p>
                                        <div class="authore-area">
                                            <img src="<?php echo $review['img']; ?>" alt="feedback">
                                            <div class="author">
                                                <h6 class="title"><?php echo $review['name']; ?></h6>
                                                <span>Student</span>
                                            </div>
                                        </div>
                                        <div class="quote">
                                            <img src="assets_cc/images/students-feedback/19.png" alt="feedback">
                                        </div>
                                    </div>
                                    <!-- single students feedbacka rea end -->
                                </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="left-align-arrow-btn">
                                <div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
                                <div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts students feedbacka area end -->
    <!-- why choose us section area start -->
    <div class="why-choose-us bg-blue bg-choose-us-one bg_image rts-section-gap shape-move">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="why-choose-us-area-image pb--50">
                        <img class="one" src="assets_cc/images/why-choose/02.jpg" alt="why-choose">
                        <div class="border-img">
                            <img class="two ml--20" src="assets_cc/images/why-choose/03.jpg" alt="why-choose">
                        </div>
                        <div class="circle-animation">
                            <a class="uni-circle-text uk-background-white dark:uk-background-gray-80 uk-box-shadow-large uk-visible@m" href="#view_in_opensea">
                                <svg class="uni-circle-text-path uk-text-secondary uni-animation-spin" viewBox="0 0 100 100" width="140" height="140">
                                    <defs>
                                        <path id="circle" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0">
                                        </path>
                                    </defs>
                                    <text font-size="11.2">
                                        <textPath xlink:href="#circle">About Instructor • Specializations •</textPath>
                                    </text>
                                </svg>
                                <i class="fa-regular fa-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pl--90 pl_sm--15 pt_sm--50">
                    <div class="title-area-left-style">
                        <div class="pre-title">
                            <img src="assets_cc/images/banner/bulb-2.png" alt="icon">
                            <span>Why Choose Me</span>
                        </div>
                        <h2 class="title">Specialized Career Guidance for Future-Ready Skills</h2>
                        <p class="post-title">I help students develop the skills and knowledge needed to succeed in an ever-evolving job market, with personalized mentoring tailored to your unique goals.</p>
                    </div>
                    <div class="why-choose-main-wrapper-1">
                        <?php
                        // Get specializations or use default ones
                        if (empty($specializations)) {
                            $specializations = [
                                'Career Planning',
                                'Industry Insights',
                                'Skill Development',
                                'Interview Preparation',
                                'Resume Building',
                                'Future Technologies'
                            ];
                        }
                        
                        // Icons for specializations
                        $icons = [
                            'assets_cc/images/why-choose/icon/01.png',
                            'assets_cc/images/why-choose/icon/02.png',
                            'assets_cc/images/why-choose/icon/03.png',
                            'assets_cc/images/why-choose/icon/04.png',
                            'assets_cc/images/why-choose/icon/05.png',
                            'assets_cc/images/why-choose/icon/06.png'
                        ];
                        
                        // Display specializations (up to 6)
                        $count = 0;
                        foreach ($specializations as $specialization) {
                            if ($count >= 6) break;
                            $icon = $icons[$count];
                        ?>
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="<?php echo $icon; ?>" alt="icon">
                            </div>
                            <h6 class="title"><?php echo $specialization; ?></h6>
                        </div>
                        <!-- single choose reason end -->
                        <?php
                            $count++;
                        }
                        
                        // Fill in remaining slots if needed
                        while ($count < 6) {
                            $default_specs = [
                                'Expert Guidance',
                                'Interactive Learning',
                                'Affordable Sessions',
                                'Career Advancement',
                                'Personalized Plans',
                                'Support Community'
                            ];
                            $icon = $icons[$count];
                        ?>
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="<?php echo $icon; ?>" alt="icon">
                            </div>
                            <h6 class="title"><?php echo $default_specs[$count]; ?></h6>
                        </div>
                        <!-- single choose reason end -->
                        <?php
                            $count++;
                        }
                        ?>
                    </div>
                    <a href="course-one.php?trainer_id=<?php echo $trainer_id; ?>" class="rts-btn btn-primary-white with-arrow">Book a Session <i class="fa-regular fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="shape-image">
            <div class="shape one" data-speed="0.04" data-revert="true"><img src="assets_cc/images/banner/15.png" alt=""></div>
            <div class="shape two" data-speed="0.04"><img src="assets_cc/images/banner/shape/banner-shape02-w.svg" alt=""></div>
            <div class="shape three" data-speed="0.04"><img src="assets_cc/images/banner/16.png" alt=""></div>
        </div>
    </div>
    <!-- why choose us section area end -->



    <!-- contact area start -->
    <div class="rts-contact-area rts-section-gap bg-category-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="contact-thumbnail-img">
                        <img src="assets_cc/images/contact/01.png" alt="contact">
                    </div>
                </div>
                <div class="col-lg-6 pl--70 pl_sm--15 pl_md--15 mt_md--50 mt_sm--50">
                    <!-- contact- area right template -->
                    <div class="contact-area-right-5">
                        <h2 class="title">Get in Touch with <?php echo $trainer['first_name']; ?> for Career Guidance</h2>
                        <form action="#" class="contact-form-1">
                            <input type="hidden" name="trainer_id" value="<?php echo $trainer_id; ?>">
                            <div class="single-input">
                                <label for="name">Your Name*</label>
                                <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
                            </div>
                            <div class="single-input">
                                <label for="email">Your Email*</label>
                                <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                            </div>
                            <div class="single-input">
                                <label for="message">Message*</label>
                                <textarea id="message" name="message" placeholder="Tell us about your career goals and how we can help"></textarea>
                            </div>
                            <button type="submit" class="rts-btn btn-primary radious-0">Send Message</button>
                        </form>
                    </div>
                    <!-- contact- area right template end -->
                </div>
            </div>
        </div>
    </div>
    <!-- contact area end -->

    <div class="rts-section-gapTop bg-light-1 mt_sm--50 mt_md--50">
        <div class="container-full">
            <div class="row">
                <div class="col-lg-12">
                    <div class="call-to-sction style-three with-full-width bg_image">
                        <h2 class="title">Sign up for career updates and<br>exclusive mentoring opportunities</h2>
                        <form action="#" class="cta-form">
                            <input type="email" placeholder="Enter your email..." required>
                            <button type="submit" class="rts-btn btn-primary">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer style home five -->
  <?php include 'include_cc/footer_instructor.php'; ?>
    <!-- footer style home five end -->




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


</body>

</html>