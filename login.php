<?php
// Get workshop ID if exists
if(isset($_GET['workshop_id'])){
    $ws_id = $_GET['workshop_id'];
} else {
    $ws_id = null;
}

// Phone Email Auth configuration
$CLIENT_ID = '13155789032170991970';
$REDIRECT_URL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$AUTH_URL = 'https://auth.phone.email/log-in?client_id='.$CLIENT_ID.'&redirect_url=http://127.0.0.1/campus-coach/controller/getstarted.php?ws_id='.$ws_id.'';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Coach | Guiding Future | Login</title>
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
    <style>
        .login-registration-wrapper {
            min-height: calc(100vh - 200px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 0;
        }
        .login-page-form-area {
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .account__social {
            margin: 30px 0;
        }
        .mt--20 {
            margin-top: 20px;
        }
    </style>
</head>

<body class="login-page">
    <!-- header style one -->
    <?php include "include_cc/header.php"; ?>
    <!-- header style end -->
    <div style="margin-top: 150px; margin-bottom: 250px;" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-page-form-area">
                        <h4 class="title">Get Started with CCH 👋</h4>
                        <p class="disc">Hey there! Ready to Start? Just using your mobile number you'll be in action in no time. Let's go!</p>
                        
                        <div style="color: white;" class="account__social">
                            <button class="rts-btn btn-primary" 
                                style="color: white; display: flex; align-items: center; justify-content:center; padding: 14px 30px; background-color: #FFC224; font-weight: 500; color: black; border: none; border-radius: 3px; font-size: inherit;cursor:pointer; width:100%"
                                id="btn_ph_login" name="btn_ph_login" type="button"
                                onclick="window.open('<?php echo $AUTH_URL; ?>', 'peLoginWindow', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0, width=500, height=560, top=' + (screen.height - 600) / 2 + ', left=' + (screen.width - 500) / 2);">
                                <img src="https://storage.googleapis.com/prod-phoneemail-prof-images/phem-widgets/phem-phone.svg"
                                    alt="phone email" style="margin-right:10px; color: black !important;">
                                Continue with Mobile Number
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer call to action area start -->
    <?php include "include_cc/footer.php"; ?>
    <!-- footer call to action area end -->

    <!-- cart area start -->
    <?php include "include_cc/cart.php"; ?>
    <!-- cart area end -->

    <!-- header style two -->
    <?php include "include_cc/sidebar.php"; ?>
    <!-- header style two End -->

    <!-- modal -->
    <?php include "include_cc/modal.php"; ?>

    <!-- rts backto top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>
    <!-- rts backto top end -->

    <!-- offcanvase search -->
    <?php include "include_cc/search.php"; ?>
    <!-- offcanvase search -->

    <?php include "include_cc/script.php"; ?>
</body>

</html>