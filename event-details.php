<?php include "include/connect.php"; ?>
<?php include "include/session.php"; ?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug function
function debug($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}
$id = $_GET['id'];
$sql = "SELECT * FROM workshops where id='$id'";
$results = $connect->query($sql);
$final = $results->fetch_assoc();


$cid = $final['category_id'];
$csql = "SELECT * FROM categories where id='$cid'";
$cresults = $connect->query($csql);
$cfinal = $cresults->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
    <!--<< Header Area >>-->
    <head>
        <!-- ========== Meta Tags ========== -->
                <?php include "include/meta.php" ?>
        <!-- ======== Page title ============ -->
        <title><?php echo $final['title'] ?> | Campus Coach</title>
        
    </head>
    <body>

        <!-- Preloader Start -->
           <?php include "include/loader.php" ?>

        <!-- Offcanvas Area Start -->
  <?php include "include/canvas.php" ?>

        <!-- Header Top Section Start -->
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
                    <h1 class="wow fadeInUp" data-wow-delay=".3s"><?php echo $final['title'] ?></h1>
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
                            Event Details
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!--<< Event Details Section Start >>-->
        <section class="event-details-section fix section-padding">
            <div class="container">
                <div class="event-details-wrapper">
                    <div class="row g-5">
                        <div class="col-lg-8">
                            <div class="event-details-items">
                                <div class="details-image">
                                    <img src="<?php echo $uri.$final['banner_image'] ?>" alt="img">
                                </div>
                                <div class="event-details-content">
                                    <div class="post-items">
                                        <span class="post-date">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            <?php echo date('M d, Y', strtotime($final['start_date'])); ?>
                                        </span>
                                    </div>
                                    <h2><?php echo $final['title'] ?></h2>
                                    <p class="mb-3">
                                    <?php echo $final['description'] ?>
                                    </p>
                                    
                                    <h2>Requirements for the event</h2>
                                    
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <ul class="list">
                                            <?php 
                                            $learnings = explode('<br>', $final['requirements']);
                                            foreach ($learnings as $learning) {
                                                // Trim to remove any extra whitespace
                                                $learning = trim($learning);
                                                if (!empty($learning)) {
                                                    echo '<li>';
                                                    echo '<i class="fa-solid fa-check"></i>';
                                                    echo '' . htmlspecialchars($learning) . '';
                                                    echo '</li>';
                                                }
                                            }
                                            ?>
                                            </ul>
                                        </div>
                                       
                                    </div>
                                    
                                </div>
                                <div class="about-author">
                                    <div class="about-button">
                                        <a href="contact.php" class="theme-btn">
                                            Register Yourself <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                    <div class="author-icon">
                                       <div class="icon">
                                            <i class="fa-solid fa-phone"></i>
                                       </div>
                                        <div class="content">
                                            <span>Call Us Now</span>
                                            <h5>
                                                <a href="tel:+2085550112">+91 92463 08588</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="details-list-area">
                                <h3>Event Information:</h3>
                                <ul class="details-list">
                                    <li>
                                        <span>
                                           <img src="assets/img/event/icon/01.svg" alt="img" class="me-2">
                                           Start Date:
                                        </span>
                                        <?php echo date('M d, Y', strtotime($final['start_date'])); ?>
                                    </li>
                                    <li>
                                        <span>
                                            <img src="assets/img/event/icon/02.svg" alt="img" class="me-2">
                                            Duration:
                                        </span>
                                        <?php echo $final['duration'] ?>
                                    </li>
                                    <li>
                                        <span>
                                            <img src="assets/img/event/icon/03.svg" alt="img" class="me-2">
                                            Location:
                                        </span>
                                        <?php echo $final['location'] ?>, <?php echo $final['state'] ?>
                                    </li>
                                    <li>
                                        <span>
                                            <img src="assets/img/event/icon/04.svg" alt="img" class="me-2">
                                            Phone:
                                        </span>
                                        319-555-1225
                                    </li>
                                    <li>
                                        <span>
                                            <img src="assets/img/event/icon/05.svg" alt="img" class="me-2">
                                            Email:
                                        </span>
                                        Info@gmail.com
                                    </li>
                                    <li>
                                        <span>
                                            <img src="assets/img/event/icon/06.svg" alt="img" class="me-2">
                                            Language
                                        </span>
                                        <?php echo $final['language'] ?>
                                    </li>
                                </ul>
                                <a href="event-details.php" class="theme-btn w-100">
                                    Get Tickets Now <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                                <div class="social-icon d-flex align-items-center">
                                    <span>Share: </span>
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                                </div>
                            </div>
                            <div class="map-items">
                                <iframe src="<?php echo $final['map'] ?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--<< Footer Section Start >>-->
     <?php include "include/script.php" ?>

        <?php include "include/script.php" ?>
    </body>
</html>