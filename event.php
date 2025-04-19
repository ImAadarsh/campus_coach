<?php include "include/connect.php"; ?>

<?php
// Fetch events from database
$event_query = "SELECT * FROM events ORDER BY date_time DESC";
$event_result = mysqli_query($connect, $event_query);
?>

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
                        <h1 class="title">Events</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="index.php">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="Instructor.php">All Events</a>
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bread crumb area end -->



    <div class="up-coming-events rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- single up coming events -->
                    <div class="upcoming-events-main-wrapper-1">
                        <?php
                        if(mysqli_num_rows($event_result) > 0) {
                            while($event = mysqli_fetch_assoc($event_result)) {
                                $event_date = date("F d, Y", strtotime($event['date_time']));
                                $event_time = date("h:i a", strtotime($event['date_time']));
                        ?>
                        <!-- single -->
                        <div class="single-upcoming-events">
                            <a href="event-details.php?id=<?php echo $event['id']; ?>" class="thumbnail">
                                <img src="assets_cc/images/events/<?php echo $event['image']; ?>" alt="<?php echo $event['name']; ?>">
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
                            <a href="<?php echo $event['link']; ?>" class="rts-btn btn-primary with-arrow">Get Ticket <i class="fa-light fa-arrow-right"></i></a>
                        </div>
                        <!-- single -->
                        <?php
                            }
                        } else {
                            echo '<div class="col-12 text-center"><p>No events found.</p></div>';
                        }
                        ?>
                    </div>
                    <!-- single up coming events end -->
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
  
    <!-- header style two End -->

    <!-- modal -->
  
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