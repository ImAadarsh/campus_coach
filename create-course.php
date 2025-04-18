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
                        <h1 class="title">Create Course</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="index.php">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="create-course.php">Create Course</a>
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bread crumb area end -->


    <!-- create course area start -->
    <div class="crea-te-course-area-start ptb--100">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="create-course-area-main-wrapper-inner">
                        <div class="accordion" id="accordionExample">
                            <!-- single accordion nitem area start -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Course Info
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="course-information-area">
                                            <form action="#" class="top-form-create-course">
                                                <div class="single-input">
                                                    <label for="name">Course Title</label>
                                                    <input id="name" type="text" placeholder="New Course">
                                                </div>
                                                <div class="single-input">
                                                    <label for="slug">Course Slug</label>
                                                    <input id="slug" type="text" placeholder="New Course">
                                                </div>
                                                <span class="pt--20 d-block">Permalink: https://demo.themeum.com/tutor/courses/new-course-45/</span>
                                                <div class="single-input">
                                                    <label for="message-2">About Course</label>
                                                    <textarea id="message-2" placeholder="New Course"></textarea>
                                                </div>
                                            </form>
                                            <div class="course-setting-title">
                                                <h5 class="title">Course Settings</h5>
                                                <div class="create-course-tab-area">
                                                    <ul class="nav nav-tabs" id="myTab-2" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"> <i class="fa-regular fa-gear"></i> General</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="fa-regular fa-meter-droplet"></i> Content Drip</button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent-2">
                                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                            <div class="generale-tab-main-wrapper">
                                                                <!-- generale content taeb -->
                                                                <div class="generale-tab-content">
                                                                    <div class="single-checkbox-filter">
                                                                        <div class="check-box">
                                                                            <input type="checkbox" id="type-1">
                                                                            <label for="type-1">Enable</label><br>
                                                                        </div>
                                                                    </div>

                                                                    <div class="disable">
                                                                        <i class="fa-light fa-circle-check"></i>
                                                                        <span>Enable / Disable content drip</span>
                                                                    </div>
                                                                </div>
                                                                <div class="choosea-category-input">
                                                                    <label for="choose">Choose a category</label>
                                                                    <input id="choose" type="text" placeholder="Search Course Category ex Design, Development, Business">
                                                                </div>
                                                                <div class="choosea-category-input">
                                                                    <label for="choose">Choose Price</label>
                                                                    <div class="check-box-wrapper">
                                                                        <div class="single-checkbox-filter">
                                                                            <div class="check-box">
                                                                                <input type="checkbox" id="type-3">
                                                                                <label for="type-3">Free</label><br>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-checkbox-filter">
                                                                            <div class="check-box">
                                                                                <input type="checkbox" id="type-2">
                                                                                <label for="type-2">Paid</label><br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="regular-price-discount-price-area">
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">$</span>
                                                                            <input id="regular" type="number" class="form-control" placeholder="regular Price" aria-label="Username" aria-describedby="basic-addon1">
                                                                        </div>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon2">$</span>
                                                                            <input id="discount" type="number" class="form-control" placeholder="Discounted Price" aria-label="Username" aria-describedby="basic-addon1">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- generale content taeb end -->

                                                                <h6 class="title mt--20">Course Thumbnail</h6>
                                                                <div class="course-thumbnail-upload-area">
                                                                    <div class="thumbnail-area">
                                                                        <img src="assets_cc/images/dashboard/05.png" alt="dashboard">
                                                                    </div>
                                                                    <div class="information">
                                                                        <span>Size: 700 X 430 Pixels</span>
                                                                        <span>File Support:</span>
                                                                        <div class="input-file-type-btn">
                                                                            <input type="file" id="real-file" hidden />
                                                                            <button type="button" class="rts-btn btn-primary" id="custom-button">CHOOSE A FILE</button>
                                                                            <span id="custom-text">No file chosen, yet.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div class="generale-tab-content">
                                                                <div class="single-checkbox-filter">
                                                                    <div class="check-box">
                                                                        <input type="checkbox" id="type-12">
                                                                        <label for="type-12">Enable</label><br>
                                                                    </div>
                                                                </div>

                                                                <div class="disable">
                                                                    <i class="fa-light fa-circle-check"></i>
                                                                    <span>Enable / Disable content drip</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single accordion nitem area end -->
                        </div>
                        <div class="accordion" id="accordionExampls2">
                            <!-- single accordion nitem area start -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        Course Video
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExampls2">
                                    <div class="accordion-body">
                                        <h6 class="title">Course Title</h6>
                                        <div class="course-info-video-link">
                                            <select class="nice-select" name="price">
                                                <option>Select Video Source</option>
                                                <option value="asc">External URL</option>
                                                <option value="desc">Youtube Video</option>
                                                <option value="pop">Vimeo Video</option>
                                            </select>
                                            <input type="text" placeholder="Please Enter your Video Link">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single accordion nitem area end -->
                        </div>
                        <div class="accordion" id="accordionExampls3">
                            <!-- single accordion nitem area start -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        Course Builder
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExampls3">
                                    <div class="accordion-body">
                                        <button class="rts-btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add new Topic <i class="fa-regular fa-circle-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- single accordion nitem area end -->
                        </div>
                        <div class="accordion" id="accordionExampls5">
                            <!-- single accordion nitem area start -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                        Course Attachments
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse show" aria-labelledby="headingFive" data-bs-parent="#accordionExampls5">
                                    <div class="accordion-body">
                                        <button class="rts-btn btn-border"><i class="fa-solid fa-paperclip"></i> Upload Attachments</button>
                                    </div>
                                </div>
                            </div>
                            <!-- single accordion nitem area end -->
                        </div>
                        <div class="accordion" id="accordionExampls6">
                            <!-- single accordion nitem area start -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                        Additional Data
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse show" aria-labelledby="headingSix" data-bs-parent="#accordionExampls6">
                                    <div class="accordion-body">
                                        <form action="#" class="additional-data-form">
                                            <!-- single input form -->
                                            <div class="single-input-area">
                                                <label for="learn">What Will I Learn?</label>
                                                <textarea id="learn" placeholder="Write here the course benefits (One per line)"></textarea>
                                            </div>
                                            <!-- single input form end -->
                                            <!-- single input form -->
                                            <div class="single-input-area mt--25">
                                                <label for="target">Targeted Audience</label>
                                                <textarea id="target" placeholder="Specify the target audience that will benefit the most from the course. (One line per target audience.)"></textarea>
                                            </div>
                                            <!-- single input form end -->
                                            <div class="course-duration-input-area">
                                                <div class="half-single-input">
                                                    <p>Total Course Duration</p>
                                                    <input id="hour" type="number" placeholder="00">
                                                    <label for="hour">Hour</label>
                                                </div>
                                                <div class="half-single-input">
                                                    <input id="min" type="number" placeholder="00">
                                                    <label for="min">Min</label>
                                                </div>
                                            </div>
                                            <div class="single-input-area mt--25">
                                                <label for="meterials">Materials Included</label>
                                                <textarea id="meterials" placeholder="A list of assets you will be providing for the students in this course (One Per line)"></textarea>
                                            </div>
                                            <div class="single-input-area mt--25">
                                                <label for="meterials-2">Requirements/Instructions</label>
                                                <textarea id="meterials-2" placeholder="Additional requirements of special instructions for the students (one per line) "></textarea>
                                            </div>
                                            <div class="single-input-area mt--25">
                                                <label for="tags">Course Tag</label>
                                                <textarea id="tags" placeholder="Search Course Tags ex. Design , Development, Business"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- single accordion nitem area end -->
                        </div>
                        <div class="accordion" id="accordionExampls7">
                            <!-- single accordion nitem area start -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeven">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                        Certificate Template
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse show" aria-labelledby="headingSeven" data-bs-parent="#accordionExampls7">
                                    <div class="accordion-body">
                                        <ul class="nav nav-tabs certificate-template-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="home-tabs" data-bs-toggle="tab" data-bs-target="#homes" type="button" role="tab" aria-controls="homes" aria-selected="true"><i class="fa-sharp fa-light fa-pager"></i> Landscape</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="profile-tab-2" data-bs-toggle="tab" data-bs-target="#profiles" type="button" role="tab" aria-controls="profiles" aria-selected="false"><i class="fa-sharp fa-light fa-pager"></i> Portrait</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content certificates-checkbox-tabs" id="myTabContent">
                                            <div class="tab-pane fade show active" id="homes" role="tabpanel" aria-labelledby="home-tabs">
                                                <div class="row g-5 mt--15">
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number1" name="radio-group" value="number1">
                                                            <label for="number1">
                                                                <img src="assets_cc/images/dashboard/certificates/04.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number2" name="radio-group" value="number2">
                                                            <label for="number2">
                                                                <img src="assets_cc/images/dashboard/certificates/05.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number3" name="radio-group" value="number3">
                                                            <label for="number3">
                                                                <img src="assets_cc/images/dashboard/certificates/06.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number4" name="radio-group" value="number4">
                                                            <label for="number4">
                                                                <img src="assets_cc/images/dashboard/certificates/07.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number5" name="radio-group" value="number5">
                                                            <label for="number5">
                                                                <img src="assets_cc/images/dashboard/certificates/08.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number6" name="radio-group" value="number6">
                                                            <label for="number6">
                                                                <img src="assets_cc/images/dashboard/certificates/09.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="profiles" role="tabpanel" aria-labelledby="profile-tab">
                                                <div class="row g-5 mt--15">
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number7" name="radio-group" value="number7">
                                                            <label for="number7">
                                                                <img src="assets_cc/images/dashboard/certificates/11.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number8" name="radio-group" value="number8">
                                                            <label for="number8">
                                                                <img src="assets_cc/images/dashboard/certificates/12.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number9" name="radio-group" value="number9">
                                                            <label for="number9">
                                                                <img src="assets_cc/images/dashboard/certificates/13.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number10" name="radio-group" value="number10">
                                                            <label for="number10">
                                                                <img src="assets_cc/images/dashboard/certificates/14.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number11" name="radio-group" value="number11">
                                                            <label for="number11">
                                                                <img src="assets_cc/images/dashboard/certificates/15.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="rts-image-check-box">
                                                            <input type="radio" id="number12" name="radio-group" value="number12">
                                                            <label for="number12">
                                                                <img src="assets_cc/images/dashboard/certificates/16.png" alt="Certificate Image">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="preview-course-button-area">
                                                    <button class="rts-btn btn-primary"> <i class="fa-light fa-eye"></i>Preview</button>
                                                    <button class="rts-btn btn-border">Publish <i class="fa-light fa-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single accordion nitem area end -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 rts-sticky-column-item">
                    <div class="course-upload-tips-wrapper theiaStickySidebar">
                        <h5 class="title">Course Upload Tips</h5>
                        <div class="single-check-wrapper">
                            <i class="fa-light fa-circle-check"></i>
                            <span>Set the Course Price option or make it free.</span>
                        </div>
                        <div class="single-check-wrapper">
                            <i class="fa-light fa-circle-check"></i>
                            <span>Standard size for the course thumbnail is
                            700x430.</span>
                        </div>
                        <div class="single-check-wrapper">
                            <i class="fa-light fa-circle-check"></i>
                            <span>Video section controls the course overview video.</span>
                        </div>
                        <div class="single-check-wrapper">
                            <i class="fa-light fa-circle-check"></i>
                            <span>Course Builder is where you create & organize
                            a course.</span>
                        </div>
                        <div class="single-check-wrapper">
                            <i class="fa-light fa-circle-check"></i>
                            <span>Add Topics in the Course Builder section to create
                            lessons, quizzes, and assignments.</span>
                        </div>
                        <div class="single-check-wrapper">
                            <i class="fa-light fa-circle-check"></i>
                            <span>Prerequisites refers to the fundamental courses
                            to complete before taking this particular course.</span>
                        </div>
                        <div class="single-check-wrapper">
                            <i class="fa-light fa-circle-check"></i>
                            <span>Information from the Additional Data section
                            shows up on the course single page.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- create course area end -->

    <!-- footer dashboards area -->
<?php include "include_cc/footer.php"; ?> 
    <!-- footer dashboards area end -->

    <!-- Modal -->
    <div class="modal announcement fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Topic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" class="modal-form">
                        <select class="nice-select" name="price">
                            <option>Select New Topic</option>
                            <option value="asc">Recently Update Web Design </option>
                            <option value="desc">Web Design Course</option>
                            <option value="pop">Update Web Design</option>
                            <option value="low">Recently Update Web</option>
                            <option value="high">Course: New Courses</option>
                        </select>
                        <div class="single-input mt--20">
                            <label for="course">Topic Title</label>
                            <input id="course" type="text" placeholder="Topic title">
                        </div>
                        <div class="single-input">
                            <label for="message">Summary</label>
                            <textarea id="message" placeholder="Summary..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="rts-btn btn-primary">Publish</button>
                </div>
            </div>
        </div>
    </div>


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