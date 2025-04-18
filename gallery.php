<!DOCTYPE html>
<html lang="en">
    <!--<< Header Area >>-->
    <head>
        <!-- ========== Meta Tags ========== -->
                <?php include "include/meta.php" ?>
        <!-- ======== Page title ============ -->
        <title>Gallery | Campus Coach</title>
        
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
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Event Gallery</h1>
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
                            Gallery
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Clases Section Start -->
        <section class="clases-section section-padding">
            <div class="container">
                <div class="row g-4">

                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="clases-items mt-0">
                            <div class="clases-bg style-2"></div>
                            <div class="clases-image">
                                <img src="assets/img/classes/01.png" alt="img">
                            </div>
                            <div class="clases-content">
                                <h4>
                                    <a href="#">Event Name</a>
                                </h4>
                                
                            </div>
                        </div>
                    </div>
                    
                  
                </div>
            </div>
        </section>

        <!--<< Footer Section Start >>-->
        <?php include "include/footer.php" ?>

        <?php include "include/script.php" ?>
    </body>
</html>