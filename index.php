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
?>

    <!-- header style one -->
<?php include "include_cc/header.php"; ?>
    <!-- header style end -->

    <!-- banner area start -->
    <div class="banner-area-one shape-move">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-xl-1 order-lg-1 order-sm-2 order-2">
                    <div class="banner-content-one">
                        <div class="inner">
                            <div class="pre-title-banner">
                                <img src="assets_cc/images/banner/bulb.png" width="22" alt="icon">
                                <span>Career Guidance & Mentoring</span>
                            </div>
                            <h1 class="title-banner">
                            Shape Your
                            Future  <br>
                                with <span>Confidence</span>
                                <img src="assets_cc/images/banner/02.png" alt="banner">
                            </h1>
                            <p class="disc">India's largest in-school career mentoring program for 11th and 12th grade students. We guide you to make informed decisions about your future careers and campuses.</p>
                            <div class="banner-btn-author-wrapper">
                                <a href="course-five.php" class="rts-btn btn-primary with-arrow">Book a Session <i class="fa-regular fa-arrow-right"></i></a>
                                <div class="sm-image-wrapper">
                                    <div class="images-wrap">
                                        <img src="assets_cc/images/banner/shape/06.png" alt="banner">
                                        <img class="two" src="assets_cc/images/banner/shape/07.png" alt="banner">
                                        <img class="three" src="assets_cc/images/banner/shape/08.png" alt="banner">
                                    </div>
                                    <div class="info">
                                        <h6 class="title">100k+ students</h6>
                                        <span>Join Our Community</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order--xl-2 order-lg-2 order-sm-1 order-1">
                    <div class="banner-right-img">
                        <img src="assets_cc/images/banner/01.png" alt="banner">
                    </div>
                </div>
            </div>
        </div>
        <div class="review-thumb">
            <!-- single review -->
            <div class="review-single">
                <img src="assets_cc/images/banner/03.png" alt="banner">
                <div class="info-right">
                    <h6 class="title">4.5</h6>
                    <span>(2.4k Review)</span>
                </div>
            </div>
            <!-- single review end -->
            <!-- single review -->
            <div class="review-single two">
                <img src="assets_cc/images/banner/04.png" alt="banner">
                <div class="info-right">
                    <h6 class="title">100+
                    </h6>
                    <span>Mentors</span>
                </div>
            </div>
            <!-- single review end -->
        </div>
        <div class="shape-image">
            <div class="shape one" data-speed="0.04" data-revert="true"><img src="assets_cc/images/banner/shape/banner-shape01.svg" alt="shape_image"></div>
            <div class="shape two" data-speed="0.04"><img src="assets_cc/images/banner/shape/banner-shape02.svg" alt="shape_image"></div>
            <div class="shape three" data-speed="0.04"><img src="assets_cc/images/banner/shape/banner-shape03.svg" alt="shape_image"></div>
        </div>
    </div>
    <!-- banner area end -->

    <!-- brand area start -->
    <div class="brand-area-one ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-style-one ">
                        <div class="left-title">
                            <h6 class="title">Trusted by:</h6>
                        </div>
                        <div class="swiper mySwiper-category-1 swiper-data" data-swiper='{
                            "spaceBetween":30,
                            "slidesPerView":6,
                            "loop": true,
                            "speed": 1500,
                            "autoplay":{
                                "delay":"4000"
                            },
                            "breakpoints":{
                            "0":{
                                "slidesPerView":2,
                                "spaceBetween":30},
                            "320":{
                                "slidesPerView":2,
                                "spaceBetween":30},
                            "480":{
                                "slidesPerView":3,
                                "spaceBetween":30},
                            "640":{
                                "slidesPerView":4,
                                "spaceBetween":30},
                            "840":{
                                "slidesPerView":4,
                                "spaceBetween":30},
                            "1140":{
                                "slidesPerView":6,
                                "spaceBetween":30}
                            }
                        }'>
                            <div class="swiper-wrapper">
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="assets_cc/images/brand/08.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="assets_cc/images/brand/09.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="assets_cc/images/brand/10.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="assets_cc/images/brand/11.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="assets_cc/images/brand/12.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="assets_cc/images/brand/13.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand area end -->

    <!-- about area start -->
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-12">
                    <!-- about-one-imagearea -->
                    <div class="about-one-left-image">
                        <div class="first-order">
                            <div class="thumb-one">
                                <img src="assets_cc/images/about/03.jpg" alt="about">
                                <div class="information">
                                    <div class="left">
                                        <h3 class="title"><span class="  fadeInDownBig">100</span>k</h3>
                                        <span class="review">Students</span>
                                    </div>
                                    <div class="right">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="49" height="45" viewBox="0 0 49 45" fill="none">
                                            <path d="M48.8274 16.6142C48.9437 16.2489 48.6895 15.9121 48.347 15.8791L43.9873 15.4516C43.2272 14.0595 42.4698 12.6582 41.709 11.2689C41.5065 11.1576 41.2882 11.0795 41.0652 11.0189C40.7736 10.7695 40.3334 10.8874 40.1849 11.2263L38.2501 15.6537L33.5064 16.5701C33.0455 16.6585 32.8859 17.2398 33.237 17.5515L36.8497 20.7596L36.2555 25.5544C36.2134 25.8934 36.478 26.1914 36.8187 26.1914C37.1004 26.1914 36.9733 26.1592 41.2735 23.6691L45.6495 25.7162C46.0788 25.9151 46.545 25.5367 46.4444 25.0799L45.5377 20.9545C46.6626 19.6901 47.7911 18.4053 49 17.2246C48.9425 17.0212 48.8849 16.8177 48.8274 16.6142ZM41.4841 22.5141C41.3152 22.4357 41.1175 22.4431 40.9564 22.5392L37.5233 24.5523L38.0129 20.603C38.0362 20.4182 37.9663 20.2334 37.8267 20.1093L34.8506 17.4666L38.7582 16.7113C38.9419 16.6758 39.0959 16.5524 39.1706 16.3817L40.7643 12.7346L42.6898 16.2184C42.7799 16.3817 42.9451 16.4903 43.131 16.5081L47.0914 16.8968L44.374 19.8041C44.2465 19.9401 44.1941 20.1307 44.2343 20.3133L45.089 24.2005L41.4841 22.5141Z" fill="white" />
                                            <path d="M13.5127 43.6945C13.7226 44.09 13.9886 44.5051 14.2119 44.9073L34.4773 44.996C34.7177 44.6152 34.975 44.1581 35.2263 43.7281C35.6251 43.6329 35.7421 43.2581 35.6236 42.9743C35.2068 41.9737 34.1408 39.9902 33.3038 39.0198C32.0198 37.5315 30.8133 36.6313 29.2695 36.0098C29.0481 35.9208 28.7272 36.0088 28.5856 36.2204C27.7723 37.4376 26.2 38.2875 24.7623 38.2875C23.2957 38.2875 21.8878 37.5366 20.9962 36.2781C20.866 36.0945 20.5556 35.9924 20.3341 36.0748C19.4047 36.4229 18.5926 36.8161 17.9851 37.2115C15.9561 38.5299 14.4023 40.809 13.1497 42.8642C12.9682 43.1629 13.0779 43.5944 13.5127 43.6945ZM18.604 38.1633C19.0606 37.8662 19.6638 37.5677 20.3537 37.2886C21.4618 38.6279 23.0749 39.4226 24.7623 39.4226C26.4002 39.4226 28.1676 38.5368 29.2346 37.2323C31.6115 38.3184 33.0432 40.2861 34.211 42.6233L14.6562 42.5937C15.7392 40.9014 17.0336 39.1839 18.604 38.1633Z" fill="white" />
                                            <path d="M19.756 30.1313C19.9121 31.2014 20.2411 32.3617 20.9415 33.3687C23.2636 36.7061 28.2059 36.3779 29.2731 31.0068C29.3286 30.7913 29.3773 30.5797 29.4202 30.3691C30.9482 30.0657 31.047 27.9821 30.196 27.3302C31.2172 23.3953 27.9328 20.0259 24.4208 21.5083C24.5621 21.2392 24.4702 20.9047 24.2043 20.7529C23.9319 20.597 23.5857 20.6916 23.4294 20.9628C23.3404 21.1184 23.2721 21.2828 23.2136 21.4503C22.7494 21.2134 22.2332 21.6644 22.4455 22.1672C20.6248 22.2992 19.0325 24.0625 19.3937 27.0238C18.0892 27.4481 18.1645 29.458 19.756 30.1313ZM21.8734 32.7198C21.2197 31.7807 20.8677 30.5504 20.7771 28.8879C22.6569 28.9417 25.3019 27.7461 26.6844 26.1086C26.9802 27.206 27.4758 28.2307 28.3977 28.8893C28.3216 29.9825 28.2012 31.1223 27.7656 32.1427C27.3004 33.2335 26.4801 34.0427 25.5718 34.3065C24.1566 34.7196 22.6387 33.8202 21.8734 32.7198ZM20.4929 25.7383C20.6798 23.8314 22.1208 22.9441 23.2059 23.3957C23.4298 23.491 23.6892 23.4304 23.8503 23.2486C24.5808 22.4231 26.0156 22.0595 27.0458 22.4386C28.9851 23.1516 29.8257 25.6421 28.8327 27.7838C28.0116 27.0339 27.7037 25.7493 27.5055 24.4443C27.4135 23.8434 26.5697 23.7934 26.3995 24.3689C25.8715 26.1642 22.5556 27.8878 20.6781 27.7578C20.4984 26.9618 20.4358 26.3207 20.4929 25.7383Z" fill="white" />
                                            <path d="M32.7133 6.03677L28.0902 5.58264C26.927 3.95966 25.856 2.24302 24.9835 0.449742C24.6327 0.313532 24.2646 0.229653 23.8923 0.175012C23.6066 -0.120622 23.1245 -0.0259308 22.9645 0.340414L20.6004 5.75003L14.8036 6.86964C14.3427 6.95796 14.183 7.53929 14.5342 7.85106L18.9487 11.7715L18.2226 17.6312C18.1647 18.0979 18.6696 18.4285 19.0729 18.1899L24.1658 15.2028L29.5133 17.7044C29.9416 17.9032 30.409 17.5258 30.3082 17.0681L29.1998 12.0238C30.5803 10.5656 31.9653 9.05626 33.345 7.60783C33.2833 7.35989 33.2216 7.11199 33.1599 6.8641C33.348 6.50531 33.111 6.07503 32.7133 6.03677ZM24.3764 14.0477C24.2076 13.9694 24.0099 13.9768 23.8488 14.0729L19.4904 16.6291L20.1119 11.6149C20.1352 11.4301 20.0654 11.2454 19.9257 11.1212L16.1478 7.76607L21.1085 6.8083C21.2921 6.77283 21.4462 6.64941 21.5212 6.47796L23.5439 1.84801L25.9882 6.2703C26.0784 6.43362 26.2436 6.54225 26.4294 6.55999L31.4581 7.05366L28.008 10.7451C27.8805 10.881 27.828 11.0717 27.8683 11.2542L28.9528 16.1887L24.3764 14.0477Z" fill="white" />
                                            <path d="M3.20913 25.5542C3.1512 26.021 3.65611 26.3515 4.05937 26.1129L8.22707 23.669L12.6032 25.7161C13.0324 25.915 13.4986 25.5366 13.398 25.0798L12.6382 21.6227C13.7118 20.162 14.8738 18.6499 16.1916 17.426C16.0123 17.1823 15.8814 16.908 15.7777 16.6237C15.9023 16.2557 15.6466 15.9123 15.3006 15.879L11.3639 15.493C10.632 14.1393 9.93623 12.8115 9.19689 11.4525C8.80498 11.2269 8.37884 11.0633 7.93903 10.9583C7.65691 10.7944 7.27552 10.9135 7.13849 11.2262L5.20374 15.6536L0.459984 16.57C-0.000908753 16.6583 -0.160524 17.2397 0.190612 17.5514L3.8033 20.7595L3.20913 25.5542ZM1.80426 17.4664L5.71182 16.7112C5.89546 16.6757 6.04955 16.5523 6.12419 16.3816L7.71788 12.7345L9.6434 16.2182C9.73356 16.3816 9.89873 16.4902 10.0846 16.5079L14.045 16.8966L11.3276 19.8039C11.2001 19.9399 11.1477 20.1306 11.1879 20.3131L12.0426 24.2004L8.43769 22.5139C8.26882 22.4356 8.07113 22.443 7.91003 22.5391L4.47692 24.5521L4.96652 20.6028C4.9898 20.4181 4.91996 20.2333 4.78029 20.1092L1.80426 17.4664Z" fill="white" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="thumb-bottom">
                                <img src="assets_cc/images/about/02.jpg" alt="about">
                            </div>
                        </div>
                        <div class="second-order">
                            <img src="assets_cc/images/about/01.jpg" alt="about">
                            <div class="vedio-icone">
                                <a class="video-play-button play-video popup-video" href="https://www.youtube.com/watch?v=ezbJwaLmOeM">
                                    <span></span>
                                </a>
                                <div class="video-overlay">
                                    <a class="video-overlay-close">×</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- about-one-imagearea end -->
                </div>
                <div class="col-xl-6 col-lg-12 pl--60 pl_lg--15 pl_md--10 pl_sm--10 pt_lg--50 pt_md--50 pt_sm--50">
                    <div class="title-area-left-style">
                        <div class="pre-title">
                            <img src="assets_cc/images/banner/bulb.png" alt="icon">
                            <span>Gateway to Lifelong Learning</span>
                        </div>
                        <h2 class="title">Beyond 2025: Preparing You for the Careers That Will Determine Tomorrow</h2>
                        <p class="post-title">We guide students to adapt and excel in an evolving job landscape where continuous upskilling is key to staying relevant in an automated world.</p>
                    </div>
                    <div class="about-inner-right-one">
                        <div class="what-you-get">
                            <!-- single-facilities -->
                            <div class="single-facilityes">
                                <div class="icon">
                                    <img src="assets_cc/images/about/icon/01.png" alt="icon-image">
                                </div>
                                <div class="information">
                                    <h5 class="title">Future-Ready Careers</h5>
                                    <p>Preparing for emerging careers beyond 2025.</p>
                                </div>
                            </div>
                            <!-- single-facilities end -->
                            <!-- single-facilities -->
                            <div class="single-facilityes">
                                <div class="icon">
                                    <img src="assets_cc/images/about/icon/02.png" alt="icon-image">
                                </div>
                                <div class="information">
                                    <h5 class="title">Continuous Learning</h5>
                                    <p>Adapt, learn, and upskill to stay relevant.</p>
                                </div>
                            </div>
                            <!-- single-facilities end -->
                        </div>
                        <div class="author-area">
                            <div class="single-author-and-info">
                                <img style="width:55px; height: 60px;" src="Gaurava.png" alt="about">
                                <div class="information">
                                    <a href="#">
                                        <h6 class="title">Gaurava Yadav</h6>
                                    </a>
                                    <p class="desig">Founder CEO | IPN FORUM</p>
                                </div>
                            </div>
                            <a href="#" class="rts-btn btn-primary">About Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about area end -->

        <!-- course area start -->
        <div class="course-area-start rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-between-area">
                        <div class="title-area-left-style">
                            <div class="pre-title">
                                <img src="assets_cc/images/banner/bulb.png" alt="icon">
                                <!-- <span>Courses</span> -->
                            </div>
                            <h2 class="title">Explore Featured Counsellors</h2>
                            <p class="post-title">Connect with expert career mentors to guide your future path</p>
                        </div>
                        <div class="button-group filters-button-group">
                            <button class="button is-checked" data-filter="*">All Categories</button>
                            <?php
                            $cat_query = "SELECT * FROM categories WHERE is_deleted = 0 LIMIT 4";
                            $cat_result = mysqli_query($connect, $cat_query);
                            while($cat_row = mysqli_fetch_assoc($cat_result)) {
                                echo '<button class="button" data-filter=".'.$cat_row['name'].'">'.$cat_row['name'].'</button>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ms-portfolio-filter-area main-isotop">
                <div class="portfolio_wrap">
                    <div class="filter row g-5 mt--20 portfolio-feed personal">

                        <?php
                        $trainer_query = "SELECT * FROM trainers ORDER BY id DESC LIMIT 8";
                        $trainer_result = mysqli_query($connect, $trainer_query);
                        
                        if(mysqli_num_rows($trainer_result) > 0) {
                            while($trainer = mysqli_fetch_assoc($trainer_result)) {
                                // Get trainer specializations
                                $specialization_query = "SELECT specialization FROM trainer_specializations WHERE trainer_id = ".$trainer['id']." LIMIT 1";
                                $specialization_result = mysqli_query($connect, $specialization_query);
                                $specialization = "";
                                if(mysqli_num_rows($specialization_result) > 0) {
                                    $spec_row = mysqli_fetch_assoc($specialization_result);
                                    $specialization = $spec_row['specialization'];
                                }
                                
                                // Get trainer rating
                                $rating_query = "SELECT AVG(rating) as avg_rating, COUNT(id) as review_count FROM trainer_reviews WHERE trainer_id = ".$trainer['id'];
                                $rating_result = mysqli_query($connect, $rating_query);
                                $rating = 0;
                                $review_count = 0;
                                if(mysqli_num_rows($rating_result) > 0) {
                                    $rating_row = mysqli_fetch_assoc($rating_result);
                                    $rating = round($rating_row['avg_rating'], 1);
                                    $review_count = $rating_row['review_count'];
                                }
                        ?>
                        <div class="flash grid-item-p element-item transition <?php echo $specialization; ?> col-xl-3 col-lg-4 col-md-6 col-sm-6" data-category="transition">
                            <!-- rts single course -->
                            <div class="rts-single-course">
                                <a href="mypage.php?trainer_id=<?php echo $trainer['id']; ?>" class="thumbnail">
                                    <img src="<?php echo $uri.$trainer['profile_img']; ?>" alt="<?php echo $trainer['first_name'].' '.$trainer['last_name']; ?>">
                                </a>
                                <div class="save-icon" data-bs-toggle="modal" data-bs-target="#exampleModal-login">
                                    <i class="fa-sharp fa-light fa-bookmark"></i>
                                </div>
                                <div class="tags-area-wrapper">
                                    <div class="single-tag">
                                        <span><?php echo $specialization; ?></span>
                                    </div>
                                </div>
                                <div class="lesson-studente">
                                    <div class="lesson">
                                        <i class="fa-light fa-calendar-lines-pen"></i>
                                        <span>Available for Booking</span>
                                    </div>
                                    <div class="lesson">
                                        <i class="fa-light fa-user-group"></i>
                                        <span><?php echo $review_count; ?>+ Reviews</span>
                                    </div>
                                </div>
                                <a href="mypage.php?trainer_id=<?php echo $trainer['id']; ?>">
                                    <h5 class="title"><?php echo $trainer['first_name'].' '.$trainer['last_name']; ?></h5>
                                </a>
                                <p class="teacher"><?php echo $trainer['designation']; ?></p>
                                <div class="rating-and-price">
                                    <div class="rating-area">
                                        <span><?php echo $rating; ?></span>
                                        <div class="stars">
                                            <ul>
                                                <?php
                                                for($i = 1; $i <= 5; $i++) {
                                                    if($i <= $rating) {
                                                        echo '<li><i class="fa-sharp fa-solid fa-star"></i></li>';
                                                    } else {
                                                        echo '<li><i class="fa-sharp fa-regular fa-star"></i></li>';
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="price-area">
                                        <a href="mypage.php?trainer_id=<?php echo $trainer['id']; ?>" class="rts-btn btn-primary">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- rts single course end -->
                        </div>
                        <?php
                            }
                        } else {
                            // Fallback to static content if no trainers in database
                        ?>
                        <div class="flash grid-item-p element-item transition creative col-xl-3 col-lg-4 col-md-6 col-sm-6" data-category="transition">
                            <!-- rts single course -->
                            <div class="rts-single-course">
                                <a href="mypage.php" class="thumbnail">
                                    <img src="Gaurava.png" alt="course">
                                </a>
                                <div class="save-icon" data-bs-toggle="modal" data-bs-target="#exampleModal-login">
                                    <i class="fa-sharp fa-light fa-bookmark"></i>
                                </div>
                                <div class="tags-area-wrapper">
                                    <div class="single-tag">
                                        <span>Education</span>
                                    </div>
                                </div>
                                <div class="lesson-studente">
                                    <div class="lesson">
                                        <i class="fa-light fa-calendar-lines-pen"></i>
                                        <span>25 Sessions</span>
                                    </div>
                                    <div class="lesson">
                                        <i class="fa-light fa-user-group"></i>
                                        <span>100+ Students</span>
                                    </div>
                                </div>
                                <a href="mypage.php">
                                    <h5 class="title">Mr. Gaurava Yadav</h5>
                                </a>
                                <p class="teacher">Founder CEO | IPN FORUM</p>
                                <div class="rating-and-price">
                                    <div class="rating-area">
                                        <span>4.5</span>
                                        <div class="stars">
                                            <ul>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="price-area">
                                        <div class="not price">
                                        ₹1999
                                        </div>
                                        <div class="price">
                                        ₹999
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- rts single course end -->
                        </div>
                        <?php } ?>


                        

                        


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- course area end -->

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
                                <svg class="uni-circle-text-path uk-text-secondary uni-animation-spin" viewBox="0 0 100 100" width="200" height="200">
                                    <defs>
                                        <path id="circle" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0">
                                        </path>
                                    </defs>
                                    <text font-size="11.2">
                                        <textPath xlink:href="#circle">About Univercity • About Collage •</textPath>
                                    </text>
                                </svg>
                                <i class="fa-regular fa-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pl--90 pl_md--15 mt_md--50 pl_sm--15 pt_sm--50">
                    <div class="title-area-left-style">
                        <div class="pre-title">
                            <img src="assets_cc/images/banner/bulb-2.png" alt="icon">
                            <span>Why Choose Us</span>
                        </div>
                        <h2 class="title">Campus Coach | Guiding Future Your Path to
                            Excellence & Success</h2>
                        <p class="post-title">We are passionate about education and dedicated to providing high- <br> quality learning resources for learners of all backgrounds.</p>
                    </div>
                    <div class="why-choose-main-wrapper-1">
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets_cc/images/why-choose/icon/01.png" alt="icon">
                            </div>
                            <h6 class="title">Expert
                                Instructors</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets_cc/images/why-choose/icon/02.png" alt="icon">
                            </div>
                            <h6 class="title">Interactive
                                Learning</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets_cc/images/why-choose/icon/03.png" alt="icon">
                            </div>
                            <h6 class="title">Affordable
                                Learning</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets_cc/images/why-choose/icon/04.png" alt="icon">
                            </div>
                            <h6 class="title">Career
                                Advance</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets_cc/images/why-choose/icon/05.png" alt="icon">
                            </div>
                            <h6 class="title">Course
                                Selection</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets_cc/images/why-choose/icon/06.png" alt="icon">
                            </div>
                            <h6 class="title">Support
                                Community</h6>
                        </div>
                        <!-- single choose reason end -->
                    </div>
                    <a href="mypage.php" class="rts-btn btn-primary-white with-arrow">Explore Trainers<i class="fa-regular fa-arrow-right"></i></a>
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

    <!-- up coming events area start -->
    <div class="up-coming-events rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-center-style">
                        <div class="pre-title">
                            <img src="assets_cc/images/banner/bulb.png" alt="icon">
                            <span>Our Events</span>
                        </div>
                        <h2 class="title">Upcoming Career Events</h2>
                        <p class="post-title">Join our interactive events to explore career opportunities and enhance your skills</p>
                    </div>
                </div>
            </div>
            <div class="row mt--50">
                <div class="col-lg-12">
                    <!-- single up coming events -->
                    <div class="upcoming-events-main-wrapper-1">
                        <?php
                        $event_query = "SELECT * FROM events ORDER BY date_time DESC LIMIT 3";
                        $event_result = mysqli_query($connect, $event_query);
                        
                        if(mysqli_num_rows($event_result) > 0) {
                            while($event = mysqli_fetch_assoc($event_result)) {
                                $event_date = date("F d, Y", strtotime($event['date_time']));
                                $event_time = date("h:i a", strtotime($event['date_time']));
                        ?>
                        <!-- single -->
                        <div class="single-upcoming-events">
                            <div class="img-information">
                                <a href="event-details.php?id=<?php echo $event['id']; ?>" class="thumbnail">
                                    <img src="<?php echo $uri.$event['image']; ?>" alt="<?php echo $event['name']; ?>">
                                </a>
                                <div class="information">
                                    <div class="date-details">
                                        <div class="date">
                                            <i class="fa-thin fa-calendar-days"></i>
                                            <p><?php echo $event_date; ?></p>
                                        </div>
                                        <div class="time">
                                            <i class="fa-regular fa-clock"></i>
                                            <p><?php echo $event_time; ?></p>
                                        </div>
                                        <div class="location">
                                            <i class="fa-thin fa-location-dot"></i>
                                            <p><?php echo $event['location']; ?></p>
                                        </div>
                                    </div>
                                    <a href="event-details.php?id=<?php echo $event['id']; ?>">
                                        <h5 class="title"><?php echo $event['name']; ?></h5>
                                    </a>
                                </div>
                            </div>
                            <a href="<?php echo !empty($event['link']) ? $event['link'] : 'event-details.php?id='.$event['id']; ?>" class="rts-btn btn-primary with-arrow">Get Ticket <i class="fa-light fa-arrow-right"></i></a>
                        </div>
                        <!-- single -->
                        <?php
                            }
                        } else {
                            // Fallback to static content if no events in database
                        ?>
                        <!-- single -->
                        <div class="single-upcoming-events">
                            <div class="img-information">
                                <a href="event-details.php" class="thumbnail">
                                    <img src="assets_cc/images/events/01.jpg" alt="events">
                                </a>
                                <div class="information">
                                    <div class="date-details">
                                        <div class="date">
                                            <i class="fa-thin fa-calendar-days"></i>
                                            <p> December 26, 2023</p>
                                        </div>
                                        <div class="time">
                                            <i class="fa-regular fa-clock"></i>
                                            <p>10:30 am</p>
                                        </div>
                                        <div class="location">
                                            <i class="fa-thin fa-location-dot"></i>
                                            <p>Yarra Park, Melbourne</p>
                                        </div>
                                    </div>
                                    <a href="event-details.php">
                                        <h5 class="title">EduFest 2023: Igniting Minds, Transforming Lives </h5>
                                    </a>
                                </div>
                            </div>
                            <a href="event-details.php" class="rts-btn btn-primary with-arrow">Get Ticket <i class="fa-light fa-arrow-right"></i></a>
                        </div>
                        <!-- single -->
                        <!-- single -->
                        <div class="single-upcoming-events">
                            <div class="img-information">
                                <a href="event-details.php" class="thumbnail">
                                    <img src="assets_cc/images/events/02.jpg" alt="events">
                                </a>
                                <div class="information">
                                    <div class="date-details">
                                        <div class="date">
                                            <i class="fa-thin fa-calendar-days"></i>
                                            <p> December 26, 2023</p>
                                        </div>
                                        <div class="time">
                                            <i class="fa-regular fa-clock"></i>
                                            <p>10:30 am</p>
                                        </div>
                                        <div class="location">
                                            <i class="fa-thin fa-location-dot"></i>
                                            <p>Yarra Park, Melbourne</p>
                                        </div>
                                    </div>
                                    <a href="event-details.php">
                                        <h5 class="title">EdTech Summit: Revolutionizing Learning</h5>
                                    </a>
                                </div>
                            </div>
                            <a href="event-details.php" class="rts-btn btn-primary with-arrow">Get Ticket <i class="fa-light fa-arrow-right"></i></a>
                        </div>
                        <!-- single -->
                        <!-- single -->
                        <div class="single-upcoming-events">
                            <div class="img-information">
                                <a href="event-details.php" class="thumbnail">
                                    <img src="assets_cc/images/events/03.jpg" alt="events">
                                </a>
                                <div class="information">
                                    <div class="date-details">
                                        <div class="date">
                                            <i class="fa-thin fa-calendar-days"></i>
                                            <p> December 26, 2023</p>
                                        </div>
                                        <div class="time">
                                            <i class="fa-regular fa-clock"></i>
                                            <p>10:30 am</p>
                                        </div>
                                        <div class="location">
                                            <i class="fa-thin fa-location-dot"></i>
                                            <p>Yarra Park, Melbourne</p>
                                        </div>
                                    </div>
                                    <a href="event-details.php">
                                        <h5 class="title">Teaching Tomorrow: A Symposium on Modern</h5>
                                    </a>
                                </div>
                            </div>
                            <a href="event-details.php" class="rts-btn btn-primary with-arrow">Get Ticket <i class="fa-light fa-arrow-right"></i></a>
                        </div>
                        <?php } ?>
                        <!-- single -->
                    </div>
                    <!-- single up coming events end -->
                </div>
            </div>
        </div>
    </div>
    <!-- up coming events area end -->

    <!-- fun facts area start -->
    <div class="fun-facts-area-1 shape-move bg_image ptb--50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="fun-facts-main-wrapper-1">
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="assets_cc/images/fun-facts/01.svg" alt="icon">
                            </div>
                            <h5 class="title"><span class="">65,972</span></h5>
                            <span class="enr">Students Enrolled</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="assets_cc/images/fun-facts/02.svg" alt="icon">
                            </div>
                            <h5 class="title"><span class="">5,321</span></h5>
                            <span class="enr">Completed Course</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="assets_cc/images/fun-facts/03.svg" alt="icon">
                            </div>
                            <h5 class="title"><span class="">44,239</span></h5>
                            <span class="enr">Students Learner</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="assets_cc/images/fun-facts/04.svg" alt="icon">
                            </div>
                            <h5 class="title"><span class="">75,992</span></h5>
                            <span class="enr">Students Enrolled</span>
                        </div>
                        <!-- single end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-image">
            <div class="shape one" data-speed="0.04" data-revert="true"><img src="assets_cc/images/banner/15.png" alt=""></div>
            <div class="shape three" data-speed="0.04"><img src="assets_cc/images/banner/16.png" alt=""></div>
        </div>
    </div>
    <!-- fun facts area end -->


    <!-- conclusion area end -->

    <!-- feedback area start -->
    <!-- rts testimonials area  -->
    <div class="testimonials-area rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-center-style">
                        <div class="pre-title">
                            <img src="assets_cc/images/banner/bulb.png" alt="icon">
                            <span>Student Review</span>
                        </div>
                        <h2 class="title">Our Students Feedback</h2>
                        <p class="post-title">You'll find something to spark your curiosity and enhance</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-full mt--50">
            <div class="row">
                <div class="col-lg-12">
                    <div class="marque-main-wrapper-parent-flex">
                        <div class="marquree-wrapper-1">
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/02.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Rajeev Verma</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/03.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Jack Benjamin</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/04.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Samuel John </h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/05.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Samantha Willow</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                        </div>
                        <div class="marquree-wrapper-1">
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/06.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Kirti Tiwari</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/07.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Jaya Sharma</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/08.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Adi Gupta</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/09.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Komal Pratap</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                        </div>
                    </div>
                    <div class="marque-main-wrapper-parent-flex">
                        <div class="marquree-wrapper-2">
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/02.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Parul Goyal</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/03.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Jack Benjamin</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/04.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Samuel John </h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/05.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Samantha Willow</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                        </div>
                        <div class="marquree-wrapper-2">
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/06.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Preetk Mehra</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/07.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Neha Srivastava</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/08.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Prerna Singh</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                            <!-- single testimonials-area -->
                            <div class="single-testimonials-area-1">
                                <div class="stars-area">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <p class="disc">
                                    I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary.
                                </p>
                                <div class="feedback-author">
                                    <img src="assets_cc/images/students-feedback/09.png" alt="students-feedback">
                                    <div class="information">
                                        <h5 class="title">Swati Ahuja</h5>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonials-area end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts testimonials area end -->
    <!-- feedback area end -->

    <!-- rts blog area start -->
    <div class=" rts-blog-area">
        <div class="container pb--130">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-center-style">
                        <div class="pre-title">
                            <img src="assets_cc/images/banner/bulb.png" alt="icon">
                            <span>News & Articles</span>
                        </div>
                        <h2 class="title">Latest Career Insights</h2>
                        <p class="post-title">Stay updated with the latest trends and opportunities in the career landscape</p>
                    </div>
                </div>
            </div>
            <div class="row g-5 mt--20">
                <?php
                $blog_query = "SELECT blogs.*, blog_categories.name as category_name 
                               FROM blogs 
                               LEFT JOIN blog_categories ON blogs.category_id = blog_categories.id 
                               WHERE blogs.is_deleted = 0 
                               ORDER BY blogs.created_at DESC LIMIT 3";
                $blog_result = mysqli_query($connect, $blog_query);
                
                if(mysqli_num_rows($blog_result) > 0) {
                    while($blog = mysqli_fetch_assoc($blog_result)) {
                        $blog_date = date("F d, Y", strtotime($blog['created_at']));
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="single-blog-style-one">
                        <a href="blog-details.php?id=<?php echo $blog['id']; ?>" class="thumbnail">
                            <img src="<?php echo $uri.$blog['banner']; ?>" alt="<?php echo $blog['title']; ?>">
                            <div class="tags-area">
                                <span><?php echo $blog['category_name']; ?></span>
                            </div>
                        </a>
                        <div class="blog-top-area">
                            <div class="single">
                                <i class="fa-light fa-calendar-days"></i>
                                <p><?php echo $blog_date; ?></p>
                            </div>
                            <div class="single">
                                <i class="fa-light fa-user"></i>
                                <p><?php echo $blog['author_name']; ?></p>
                            </div>
                        </div>
                        <a href="blog-details.php?id=<?php echo $blog['id']; ?>">
                            <h5 class="title"><?php echo $blog['title']; ?></h5>
                        </a>
                        <div class="button-area">
                            <a href="blog-details.php?id=<?php echo $blog['id']; ?>" class="rts-btn btn-primary readmore-btn">Read More <i class="fa-regular fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    // Fallback to static content if no blogs in database
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="single-blog-style-one">
                        <a href="blog-details.php" class="thumbnail">
                            <img src="assets_cc/images/blog/01.jpg" alt="blog">
                            <div class="tags-area">
                                <span>Marketing</span>
                            </div>
                        </a>
                        <div class="blog-top-area">
                            <div class="single">
                                <i class="fa-light fa-calendar-days"></i>
                                <p>October 26, 2023</p>
                            </div>
                            <div class="single">
                                <i class="fa-light fa-user"></i>
                                <p>Jon Adam</p>
                            </div>
                        </div>
                        <a href="blog-details.php">
                            <h5 class="title">Announcing the winners the 2023 Education com Story Challenge!</h5>
                        </a>
                        <div class="button-area">
                            <a href="blog-details.php" class="rts-btn btn-primary readmore-btn">Read More <i class="fa-regular fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="single-blog-style-one">
                        <a href="blog-details.php" class="thumbnail">
                            <img src="assets_cc/images/blog/02.jpg" alt="blog">
                            <div class="tags-area">
                                <span>Business</span>
                            </div>
                        </a>
                        <div class="blog-top-area">
                            <div class="single">
                                <i class="fa-light fa-calendar-days"></i>
                                <p>October 26, 2023</p>
                            </div>
                            <div class="single">
                                <i class="fa-light fa-user"></i>
                                <p>Jon Adam</p>
                            </div>
                        </div>
                        <a href="blog-details.php">
                            <h5 class="title">Azure AI Fundamentals: How to Pass the AI-900 Exam</h5>
                        </a>
                        <div class="button-area">
                            <a href="blog-details.php" class="rts-btn btn-primary readmore-btn">Read More <i class="fa-regular fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="single-blog-style-one">
                        <a href="blog-details.php" class="thumbnail">
                            <img src="assets_cc/images/blog/01.jpg" alt="blog">
                            <div class="tags-area">
                                <span>Accounting</span>
                            </div>
                        </a>
                        <div class="blog-top-area">
                            <div class="single">
                                <i class="fa-light fa-calendar-days"></i>
                                <p>October 26, 2023</p>
                            </div>
                            <div class="single">
                                <i class="fa-light fa-user"></i>
                                <p>Jon Adam</p>
                            </div>
                        </div>
                        <a href="blog-details.php">
                            <h5 class="title">How to Become a Business Man to Intelligence Analyst in 6 Simple</h5>
                        </a>
                        <div class="button-area">
                            <a href="blog-details.php" class="rts-btn btn-primary readmore-btn">Read More <i class="fa-regular fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- rts blog area end -->

    <!-- cart area start -->
    <?php include "include_cc/cart.php"; ?>
    <!-- cart area edn -->

    <!-- footer call to action area start -->
<?php include "include_cc/footer.php"; ?> 
    <!-- footer call to action area end -->

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
                            <li><a class="mobile-menu-link" href="mypage.php">Courses Details</a></li>
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