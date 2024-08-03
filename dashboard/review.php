<!DOCTYPE html>
<html lang="en">

<?php include "include/meta.php" ?>

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
		<?php include "include/aside.php" ?>
		<!-- /.dash-aside-navbar -->

		<!-- 
		=============================================
			Dashboard Body
		============================================== 
		-->
		<div class="dashboard-body">
			<div class="position-relative">
				<!-- ************************ Header **************************** -->
				<?php include "include/header.php" ?>
				<!-- End Header -->

				<h2 class="main-title d-block d-lg-none">Reviews</h2>

                <div class="d-sm-flex align-items-center justify-content-between mb-25">
                    <div class="fs-16">Showing <span class="color-dark fw-500">1–5</span> of <span class="color-dark fw-500">40</span> results</div>
                    <div class="d-flex ms-auto xs-mt-30">
                        <div class="short-filter d-flex align-items-center ms-sm-auto">
                            <div class="fs-16 me-2">Short by:</div>
                            <select class="nice-select">
                                <option value="0">Newest</option>
                                <option value="1">Best Rating</option>
                                <option value="3">Rating Low</option>
                                <option value="4">Rating High</option>
                            </select>
                        </div>
                    </div>
                </div>

				<div class="bg-white card-box pt-0 border-20">
                    <div class="theme-details-one">
                        <div class="review-panel-one">
							<div class="position-relative z-1">
								<div class="review-wrapper">
									<div class="review">
										<img src="../images/media/img_01.jpg" alt="" class="rounded-circle avatar">
										<div class="text">
											<div class="d-sm-flex justify-content-between">
												<div>
													<h6 class="name">Zubayer Al Hasan</h6>
													<div class="time fs-16">17 Aug, 23</div>
												</div>
												<ul class="rating style-none d-flex xs-mt-10">
													<li><span class="fst-italic me-2">(4.7 Rating)</span> </li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
												</ul>
											</div>
											<p class="fs-20 mt-20 mb-30">Lorem ipsum dolor sit amet consectetur. Pellentesque sed nulla facili diam posuere aliquam suscipit quam.</p>
											<div class="d-flex review-help-btn">
												<a href="#" class="me-5"><i class="fa-sharp fa-regular fa-thumbs-up"></i> <span>Helpful</span></a>
												<a href="#" class="me-5"><i class="fa-sharp fa-regular fa-flag-swallowtail"></i> <span>Flag</span></a>
                                                <a href="#"><i class="fa-sharp fa-regular fa-reply"></i> <span>Reply</span></a>
											</div>
										</div>
										<!-- /.text -->
									</div>
									<!-- /.review -->

									<div class="review">
										<img src="../images/media/img_03.jpg" alt="" class="rounded-circle avatar">
										<div class="text">
											<div class="d-sm-flex justify-content-between">
												<div>
													<h6 class="name">Rashed Kabir</h6>
													<div class="time fs-16">13 Jun, 23</div>
												</div>
												<ul class="rating style-none d-flex xs-mt-10">
													<li><span class="fst-italic me-2">(4.9 Rating)</span> </li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
												</ul>
											</div>
											<p class="fs-20 mt-20 mb-30">Lorem ipsum dolor sit amet consectetur. Pellentesque sed nulla facili diam posuere aliquam suscipit quam.</p>
											<ul class="style-none d-flex flex-wrap review-gallery pb-30">
												<li><a href="../images/listing/img_large_01.jpg" class="d-block" data-fancybox="revImg" data-caption="Duplex orkit villa"><img src="../images/listing/img_48.jpg" alt=""></a></li>
												<li><a href="../images/listing/img_large_02.jpg" class="d-block" data-fancybox="revImg" data-caption="Duplex orkit villa"><img src="../images/listing/img_49.jpg" alt=""></a></li>
												<li><a href="../images/listing/img_large_03.jpg" class="d-block" data-fancybox="revImg" data-caption="Duplex orkit villa"><img src="../images/listing/img_50.jpg" alt=""></a></li>
												<li>
													<div class="position-relative more-img">
														<img src="../images/listing/img_50.jpg" alt="">
														<span>13+</span>
														<a href="../images/listing/img_large_04.jpg" class="d-block" data-fancybox="revImg" data-caption="Duplex orkit villa."></a>
														<a href="../images/listing/img_large_05.jpg" class="d-block" data-fancybox="revImg" data-caption="Duplex orkit villa."></a>
														<a href="../images/listing/img_large_06.jpg" class="d-block" data-fancybox="revImg" data-caption="Duplex orkit villa."></a>
													</div>
												</li>
											</ul>
											<div class="d-flex review-help-btn">
												<a href="#" class="me-5"><i class="fa-sharp fa-regular fa-thumbs-up"></i> <span>Helpful</span></a>
												<a href="#" class="me-5"><i class="fa-sharp fa-regular fa-flag-swallowtail"></i> <span>Flag</span></a>
                                                <a href="#"><i class="fa-sharp fa-regular fa-reply"></i> <span>Reply</span></a>
											</div>
											
										</div>
										<!-- /.text -->
									</div>
									<!-- /.review -->

									<div class="review">
										<img src="../images/media/img_02.jpg" alt="" class="rounded-circle avatar">
										<div class="text">
											<div class="d-sm-flex justify-content-between">
												<div>
													<h6 class="name">Perty Jinta</h6>
													<div class="time fs-16">17 Aug, 23</div>
												</div>
												<ul class="rating style-none d-flex xs-mt-10">
													<li><span class="fst-italic me-2">(4.7 Rating)</span> </li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
												</ul>
											</div>
											<p class="fs-20 mt-20 mb-30">Lorem ipsum dolor sit amet consectetur. Amet amet id cursus dignissim. Eget vitae amet tempus sit mattis. Semper integer condimentum nunc augue aliquet quam a tincidunt.</p>
											<div class="d-flex review-help-btn">
												<a href="#" class="me-5"><i class="fa-sharp fa-regular fa-thumbs-up"></i> <span>Helpful</span></a>
												<a href="#" class="me-5"><i class="fa-sharp fa-regular fa-flag-swallowtail"></i> <span>Flag</span></a>
                                                <a href="#"><i class="fa-sharp fa-regular fa-reply"></i> <span>Reply</span></a>
											</div>
										</div>
										<!-- /.text -->
									</div>
									<!-- /.review -->

                                    <div class="review border-0 pb-0">
										<img src="../images/media/img_01.jpg" alt="" class="rounded-circle avatar">
										<div class="text">
											<div class="d-sm-flex justify-content-between">
												<div>
													<h6 class="name">Milon Ahmed</h6>
													<div class="time fs-16">7 Jan, 23</div>
												</div>
												<ul class="rating style-none d-flex xs-mt-10">
													<li><span class="fst-italic me-2">(4.7 Rating)</span> </li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
													<li><i class="fa-sharp fa-solid fa-star"></i></li>
												</ul>
											</div>
											<p class="fs-20 mt-20 mb-30">Lorem ipsum dolor sit amet consectetur. Pellentesque sed nulla facili diam posuere aliquam suscipit quam.</p>
											<div class="d-flex review-help-btn">
												<a href="#" class="me-5"><i class="fa-sharp fa-regular fa-thumbs-up"></i> <span>Helpful</span></a>
												<a href="#" class="me-5"><i class="fa-sharp fa-regular fa-flag-swallowtail"></i> <span>Flag</span></a>
                                                <a href="#"><i class="fa-sharp fa-regular fa-reply"></i> <span>Reply</span></a>
											</div>
										</div>
										<!-- /.text -->
									</div>
									<!-- /.review -->
								</div>
								<!-- /.review-wrapper -->
							</div>						
						</div>
						<!-- /.review-panel-one -->
                    </div>                    
                </div>
				<!-- /.card-box -->

				<ul class="pagination-one d-flex align-items-center style-none pt-40">
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li>....</li>
                    <li class="ms-2"><a href="#" class="d-flex align-items-center">Last <img src="../images/icon/icon_46.svg" alt="" class="ms-2"></a></li>
                </ul>	
			</div>
		</div>
		<!-- /.dashboard-body -->


		<!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                <div class="container">
                    <div class="remove-account-popup text-center modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						<img src="../images/lazy.svg" data-src="images/icon/icon_22.svg" alt="" class="lazy-img m-auto">
						<h2>Are you sure?</h2>
						<p>Are you sure to delete your account? All data will be lost.</p>
						<div class="button-group d-inline-flex justify-content-center align-items-center pt-15">
							<a href="#" class="confirm-btn fw-500 tran3s me-3">Yes</a>
							<button type="button" class="btn-close fw-500 ms-3" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
						</div>
                    </div>
                    <!-- /.remove-account-popup -->
                </div>
            </div>
        </div>
		


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