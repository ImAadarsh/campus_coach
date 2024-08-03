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

				<h2 class="main-title d-block d-lg-none">Profile</h2>

				<div class="bg-white card-box border-20">
                    <div class="user-avatar-setting d-flex align-items-center mb-30">
                        <img src="../images/lazy.svg" data-src="images/avatar_02.jpg" alt="" class="lazy-img user-img">
                        <div class="upload-btn position-relative tran3s ms-4 me-3">
                            Upload new photo
                            <input type="file" id="uploadImg" name="uploadImg" placeholder="">
                        </div>
                        <button class="delete-btn tran3s">Delete</button>
                    </div>
                    <!-- /.user-avatar-setting -->
					<div class="row">
						<div class="col-12">
							<div class="dash-input-wrapper mb-30">
								<label for="">Username*</label>
								<input type="text" placeholder="JonyRio">
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-sm-6">
							<div class="dash-input-wrapper mb-30">
								<label for="">First Name*</label>
								<input type="text" placeholder="Mr Johny">
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-sm-6">
							<div class="dash-input-wrapper mb-30">
								<label for="">Last Name*</label>
								<input type="text" placeholder="Riolek">
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-sm-6">
							<div class="dash-input-wrapper mb-30">
								<label for="">Email*</label>
								<input type="email" placeholder="companyinc@mail.com">
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-sm-6">
							<div class="dash-input-wrapper mb-30">
								<label for="">Position*</label>
								<select class="nice-select">
									<option>Agent</option>
									<option>Agency</option>
								</select>
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-sm-6">
							<div class="dash-input-wrapper mb-30">
								<label for="">Phone Number*</label>
								<input type="tel" placeholder="+880 01723801729">
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-sm-6">
							<div class="dash-input-wrapper mb-30">
								<label for="">Website*</label>
								<input type="text" placeholder="http://somename.com">
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-12">
							<div class="dash-input-wrapper">
								<label for="">About*</label>
								<textarea class="size-lg" placeholder="I am working for the last 4 years as a web designer, graphics designer and well as UI/UX designer............."></textarea>
								<div class="alert-text">Brief description for your profile. URLs are hyperlinked.</div>
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
					</div>
                    
                    
                </div>
				<!-- /.card-box -->

				<div class="bg-white card-box border-20 mt-40">
                    <h4 class="dash-title-three">Social Media</h4>

                    <div class="dash-input-wrapper mb-20">
                        <label for="">Network 1</label>
                        <input type="text" placeholder="https://www.facebook.com/zubayer0145">
                    </div>
                    <!-- /.dash-input-wrapper -->
                    <div class="dash-input-wrapper mb-20">
                        <label for="">Network 2</label>
                        <input type="text" placeholder="https://twitter.com/FIFAcom">
                    </div>
                    <!-- /.dash-input-wrapper -->
					<a href="#" class="dash-btn-one"><i class="bi bi-plus"></i> Add more link</a>
                </div>
				<!-- /.card-box -->

				<div class="bg-white card-box border-20 mt-40">
                    <h4 class="dash-title-three">Address & Location</h4>
					<div class="row">
						<div class="col-12">
							<div class="dash-input-wrapper mb-25">
								<label for="">Address*</label>
								<input type="text" placeholder="19 Yawkey Way">
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-lg-3">
							<div class="dash-input-wrapper mb-25">
								<label for="">Country*</label>
								<select class="nice-select">
									<option>Afghanistan</option>
									<option>Albania</option>
									<option>Algeria</option>
									<option>Andorra</option>
									<option>Angola</option>
									<option>Antigua and Barbuda</option>
									<option>Argentina</option>
									<option>Armenia</option>
									<option>Australia</option>
									<option>Austria</option>
									<option>Azerbaijan</option>
									<option>Bahamas</option>
									<option>Bahrain</option>
									<option>Bangladesh</option>
									<option>Barbados</option>
									<option>Belarus</option>
									<option>Belgium</option>
									<option>Belize</option>
									<option>Benin</option>
									<option>Bhutan</option>
								</select>
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-lg-3">
							<div class="dash-input-wrapper mb-25">
								<label for="">City*</label>
								<select class="nice-select">
									<option>Boston</option>
									<option>Tokyo</option>
									<option>Delhi</option>
									<option>Shanghai</option>
									<option>Mumbai</option>
									<option>Bangalore</option>
								</select>
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-lg-3">
							<div class="dash-input-wrapper mb-25">
								<label for="">Zip Code*</label>
								<input type="number" placeholder="1708">
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-lg-3">
							<div class="dash-input-wrapper mb-25">
								<label for="">State*</label>
								<select class="nice-select">
									<option>Maine</option>
									<option>Tokyo</option>
									<option>Delhi</option>
									<option>Shanghai</option>
									<option>Mumbai</option>
									<option>Bangalore</option>
								</select>
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
						<div class="col-12">
							<div class="dash-input-wrapper mb-25">
								<label for="">Map Location*</label>
								<div class="position-relative">
									<input type="text" placeholder="XC23+6XC, Moiran, N105">
									<button class="location-pin tran3s"><img src="../images/lazy.svg" data-src="images/icon/icon_16.svg" alt="" class="lazy-img m-auto"></button>
								</div>
								<div class="map-frame mt-30">
									<div class="gmap_canvas h-100 w-100">
										<iframe class="gmap_iframe h-100 w-100" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=dhaka collage&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
									</div>
								</div>
							</div>
							<!-- /.dash-input-wrapper -->
						</div>
					</div>
                </div>
				<!-- /.card-box -->

				<div class="button-group d-inline-flex align-items-center mt-30">
					<a href="#" class="dash-btn-two tran3s me-3">Save</a>
					<a href="#" class="dash-cancel-btn tran3s">Cancel</a>
				</div>				
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