<!DOCTYPE html>
<html lang="en">
<!--<< Header Area >>-->

<head>
    <!-- ========== Meta Tags ========== -->
    <?php include "include/meta.php" ?>
    <!-- ======== Page title ============ -->
    <title>Contact Us | Campus Coach - India's Largest In-School Career Mentoring Program</title>

</head>

<body>
<?php
        /* Please replace XXXXXXXXXX with client id shown under profile section in admin dashboard (https://admin.phone.email) */
        if(isset($_GET['workshop_id'])){
            $ws_id = $_GET['workshop_id'];
        }else{
            $ws_id = null;
        }
        $CLIENT_ID = '13155789032170991970';
        $REDIRECT_URL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $AUTH_URL = 'https://auth.phone.email/log-in?client_id='.$CLIENT_ID.'&redirect_url=http://127.0.0.1/campus-coach/controller/getstarted.php?ws_id='.$ws_id.'';
    ?>

    <!-- Preloader Start -->
    <?php include "include/loader.php" ?>
    <?php include "include/header_sub.php" ?>
    <!-- Offcanvas Area Start -->
  <?php include "include/canvas.php" ?>

    <!--<< Breadcrumb Section Start >>-->
    <div class="breadcrumb-wrapper mb-100 bg-cover" style="background-image: url('assets/img/breadcrumb.png');">
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
                <h1 class="wow fadeInUp" data-wow-delay=".3s">User Authentication</h1>
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
                        Login/New Registration
                    </li>
                </ul>
            </div>
        </div>
    </div>
<br><br><br>
    <!-- Contact Section Start -->
    <section class="singUp-area mt-100 section-py-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="singUp-wrap">
                            <h2 class="title">Your Campus Coach!</h2>
                            <p>Hey there! Ready to Start? Just using your mobile number you'll be in action in no time. Let's go!</p>
                            <div class="account__social">
                            <button class="btn btn-two arrow-btn"
                style="display: flex; align-items: center; justify-content:center; padding: 14px 30px; background-color: #FFC224; font-weight: 500; color: black; border: none; border-radius: 3px; font-size: inherit;cursor:pointer; max-width:620px; width:100%"
                id="btn_ph_login" name="btn_ph_login" type="button"
                onclick="window.open('<?php echo $AUTH_URL; ?>', 'peLoginWindow', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0, width=500, height=560, top=' + (screen.height - 600) / 2 + ', left=' + (screen.width - 500) / 2);">
                <img  src="https://storage.googleapis.com/prod-phoneemail-prof-images/phem-widgets/phem-phone.svg"
                    alt="phone email" style="margin-right:10px; color: black !important;">
                Continue with Mobile Number
            </button>
                            </div>
                            
                           
                          
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--<< Map Section Start >>-->


    <!--<< Footer Section Start >>-->
    <!-- <?php include "include/footer.php" ?> -->



    <!--<< All JS Plugins >>-->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!--<< Viewport Js >>-->
    <script src="assets/js/viewport.jquery.js"></script>
    <!--<< Bootstrap Js >>-->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--<< Nice Select Js >>-->
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <!--<< Waypoints Js >>-->
    <script src="assets/js/jquery.waypoints.js"></script>
    <!--<< Counterup Js >>-->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!--<< Swiper Slider Js >>-->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!--<< MeanMenu Js >>-->
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <!--<< Magnific Popup Js >>-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!--<< Wow Animation Js >>-->
    <script src="assets/js/wow.min.js"></script>
    <!--<< Ajax Mail Js >>-->
    <script src="assets/js/ajax-mail.js"></script>
    <!--<< Main.js >>-->
    <script src="assets/js/main.js"></script>
</body>