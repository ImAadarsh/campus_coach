<!DOCTYPE html>
<html lang="en">
<head>
    <style>

        .dash-aside-navbar {
            width: 250px;
            height: 100vh;
            background-color: white;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .position-relative {
            position: relative;
        }

        .logo {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        .blur-content {
            filter: blur(5px);
            pointer-events: none;
            user-select: none;
            opacity: 0.7;
        }

        .blur-content::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.5);
            pointer-events: none;
        }

        .dasboard-main-nav {
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .style-none {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .style-none li a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: var(--text-color);
            text-decoration: none;
        }

        .style-none li a img {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }

        .nav-title {
            padding: 10px 20px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .profile-complete-status {
            padding: 20px;
        
        }

        .progress-value {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .progress-line {
            height: 5px;

            position: relative;
        }

        .inner-line {
            height: 100%;
            background-color: var(--primary-color);
            position: absolute;
            left: 0;
            top: 0;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            padding: 20px;
 
            text-decoration: none;
            position: relative;
            z-index: 1;
        }

        .logout-btn .icon {
            margin-right: 10px;
            width: 30px;
            height: 30px;
  
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-btn .icon img {
            width: 15px;
            height: 15px;
        }

        .close-btn {
            display: none;
        }

        @media (max-width: 768px) {
            .close-btn {
                display: block;
                position: absolute;
                top: 20px;
                right: 20px;
                background: none;
                border: none;
                font-size: 24px;
                cursor: pointer;
                z-index: 1;
            }
        }
    </style>
	    <?php
  include "../include/session.php" ; 
    $mobile = $_SESSION['mobile'];
    $token = $_SESSION['token'];
    if($_SESSION['is_data']==1){
        header('location: index.php');
    }
    include "include/meta.php" ?>
</head>


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
		<aside class="dash-aside-navbar">
        <div class="position-relative">
            <div class="logo">
                <a href="index.php">
                    <img src="../assets/img/logo/logo.svg" alt="Logo">
                </a>
                <button class="close-btn"><i class="fa-light fa-circle-xmark"></i></button>
            </div>
            <div class="blur-content">
                <nav class="dasboard-main-nav">
                    <ul class="style-none">
                        <li><a class="active" href="#">
                            <i mg src="images/icon/icon_1.svg" alt="">
                            <span>Campus Coach</span>             </a></li>
                        <li><a href="#">
                            <img src="images/icon/icon_2.svg" alt="">
                            <span>Campus Coach</span>
                        </a></li>
                    </ul>
                </nav>
                <div class="nav-title">Campus Coach</div>
                <nav class="dasboard-main-nav">
                    <ul class="style-none">
                        <li><a href="#">
                            <img src="images/icon/icon_3.svg" alt="">
                            <span>Campus Coach</span>
                        </a></li>
                        <li><a href="#" >
                            <img src="images/icon/icon_4_active.svg" alt="">
                            <span>Account Campus Coach</span>
                        </a></li>
                        <li><a href="#">
                            <img src="images/icon/icon_5.svg" alt="">
                            <span>Campus Coach</span>
                        </a></li>
                    </ul>
                </nav>
                <div class="nav-title">Campus Coach</div>
                <nav class="dasboard-main-nav">
                    <ul class="style-none">
                        <li><a href="#">
                            <img src="images/icon/icon_6.svg" alt="">
                            <span>Campus Coach</span>
                        </a></li>
                        <li><a href="#">
                            <img src="images/icon/icon_7.svg" alt="">
                            <span>Add New Property</span>
                        </a></li>
                        <li><a href="#">
                            <img src="images/icon/icon_8.svg" alt="">
                            <span>Campus Coach</span>
                        </a></li>
                        <li><a href="#">
                            <img src="images/icon/icon_9.svg" alt="">
                            <span>Saved Campus Coach</span>
                        </a></li>
                        <li><a href="#">
                            <img src="images/icon/icon_10.svg" alt="">
                            <span>Campus Coach</span>
                        </a></li>
                    </ul>
                </nav>
                <div class="profile-complete-status">
                    <div class="progress-value">82%</div>
                    <div class="progress-line">
                        <div class="inner-line" style="width:82%;"></div>
                    </div>
                    <p>Profile Complete</p>
                </div>
            </div>
            <div class="logout-section">
                <a href="#" class="logout-btn">
                    <div class="icon">
                        <img src="images/icon/icon_41.svg" alt="">
                    </div>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </aside>
		<!-- /.dash-aside-navbar -->

		<!-- 
		=============================================
			Dashboard Body
		============================================== 
		-->
		<div class="dashboard-body">
			<div class="position-relative">
				<!-- ************************ Header **************************** -->
				<header class="dashboard-header">
					<div class="d-flex align-items-center justify-content-end">
						<h4 class="m0 d-none d-lg-block">Complete Profile</h4>
						<button class="dash-mobile-nav-toggler d-block d-md-none me-auto">
							<span></span>
						</button>
						<form action="#" class="search-form ms-auto">
							<!-- <input type="text" placeholder="Search here.."> -->
							<!-- <button><img src="../images/lazy.svg" data-src="images/icon/icon_43.svg" alt="" class="lazy-img m-auto"></button> -->
						</form>
						<div class="profile-notification position-relative dropdown-center ms-3 ms-md-5 me-4">
							<button class="noti-btn dropdown-toggle" type="button" id="notification-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
								<!-- <img src="../images/lazy.svg" data-src="images/icon/icon_11.svg" alt="" class="lazy-img">
								<div class="badge-pill"></div> -->
							</button>
						
						</div>
						<div class="d-none d-md-block me-3">
							<a href="../index.php" class="btn-two"><span>Return Home</span> <i class="fa-thin fa-arrow-up-right"></i></a>
						</div>
						
						<!-- /.user-data -->
					</div>
				</header>
				<!-- End Header -->

				<h2 class="main-title d-block d-lg-none">Campus Coach Registration</h2>
<form action="../controller/profilecreation.php" method="POST" enctype="multipart/form-data">
<div class="bg-white card-box border-20">
    <h4 class="dash-title-three">Student Information</h4>
    <div class="dash-input-wrapper mb-30">
        <label for="first-name">First Name*</label>
        <input type="text" id="first-name" name="first_name" placeholder="Your First Name" required>
    </div>
    <div class="dash-input-wrapper mb-30">
        <label for="last-name">Last Name*</label>
        <input type="text" id="last-name" name="last_name" placeholder="Your Last Name" required>
    </div>
    <div class="dash-input-wrapper mb-30">
        <label for="email">Email*</label>
        <input type="email" id="email" name="email" placeholder="Your Email Address" required>
    </div>
    <div class="dash-input-wrapper mb-30">
        <label for="mobile">Mobile* &nbsp;&nbsp;(Can't be changed)</label>
        <input type="tel" id="mobile" name="mobile" value="<?php echo $mobile ?>" placeholder="Your Mobile Number" readonly disabled>
    </div>
</div>
<!-- /.card-box -->

<div class="bg-white card-box border-20 mt-40">
    <h4 class="dash-title-three">School Details</h4>
    <div class="row align-items-end">
        <div class="col-md-6">
            <div class="dash-input-wrapper mb-30">
                <label for="school">School Name*</label>
                <input type="text" id="school" name="school" placeholder="Your School Name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dash-input-wrapper mb-30">
                <label for="city">City*</label>
                <input type="text" id="city" name="city" placeholder="Your City" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dash-input-wrapper mb-30">
                <label for="grade">Grade*</label>
                <select id="grade" name="grade" class="nice-select" required>
                    <option value="">Select Grade</option>
                    <option value="09">09th Grade</option>
                    <option value="10">10th Grade</option>
					<option value="11">11th Grade</option>
                    <option value="12">12th Grade</option>
                </select>
            </div>
        </div>
    </div>
</div>
<!-- /.card-box -->

<div class="button-group d-inline-flex align-items-center mt-30">
    <button type="submit" name="data" class="dash-btn-two tran3s me-3">Create Profile</button>
    <a href="#" class="dash-cancel-btn tran3s">Cancel</a>
</div>
</form>
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
	</div> <!-- /.main-page-wrapper -->
</body>

</html>