<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Get user data
$userId = $_SESSION['userid'];
$sql = "SELECT * FROM users WHERE id = $userId";
$result = mysqli_query($connect, $sql);
$user = mysqli_fetch_assoc($result);

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = mysqli_real_escape_string($connect, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($connect, $_POST['last_name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    // $mobile = mysqli_real_escape_string($connect, $_POST['mobile']);
    $school = mysqli_real_escape_string($connect, $_POST['school']);
    $city = mysqli_real_escape_string($connect, $_POST['city']);
    $grade = mysqli_real_escape_string($connect, $_POST['grade']);
    $about = mysqli_real_escape_string($connect, $_POST['about']);

    // Handle profile image upload
    $profileImage = $user['icon'];
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png'];
        $filename = $_FILES['profile_image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $newFilename = 'profile_' . $userId . '_' . time() . '.' . $ext;
            $uploadPath = '../uploads/profiles/' . $newFilename;
            
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadPath)) {
                $profileImage = 'uploads/profiles/' . $newFilename;
            }
        }
    }

    // Update user data
    $updateSql = "UPDATE users SET 
        first_name = '$firstName',
        last_name = '$lastName',
        email = '$email',
        school = '$school',
        city = '$city',
        grade = '$grade',
        about = '$about',
        icon = '$profileImage'
        WHERE id = $userId";

    if (mysqli_query($connect, $updateSql)) {
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating profile: " . mysqli_error($connect);
    }
}
?>
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

				<div class=" border-20 ">
					<div class="row gx-3">
						<div class="col-lg-4 rounded-3">
							<div class="profile-sidebar border-25 p-4 rounded-3">
								<div class="text-center mb-4">
									<div class="profile-image-wrapper position-relative d-inline-block">
										<?php if (!empty($user['icon'])): ?>
											<img src="<?php echo $uri . $user['icon']; ?>" alt="<?php echo $user['first_name']; ?>" class="rounded-circle" width="150">
										<?php else: ?>
											<div class="profile-initials rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; font-size: 3rem; font-weight: 600;">
												<?php 
												$initials = strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1));
												echo $initials;
												?>
											</div>
										<?php endif; ?>
										<label for="profile_image" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 cursor-pointer">
											<i class="bi bi-camera"></i>
										</label>
									</div>
									<h4 class="mt-3 mb-1"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></h4>
									<p class="text-muted mb-0"><?php echo $user['email']; ?></p>
								</div>

								<div class="profile-stats">
									<div class="d-flex justify-content-between align-items-center mb-3">
										<span class="text-muted">Total Bookings</span>
										<span class="fw-bold"><?php 
											$bookingsSql = "SELECT COUNT(*) as total FROM bookings WHERE user_id = $userId";
											$bookingsResult = mysqli_query($connect, $bookingsSql);
											echo mysqli_fetch_assoc($bookingsResult)['total'];
										?></span>
									</div>
									<div class="d-flex justify-content-between align-items-center mb-3">
										<span class="text-muted">Completed Sessions</span>
										<span class="fw-bold"><?php 
											$completedSql = "SELECT COUNT(*) as total FROM bookings b 
												JOIN payments p ON b.id = p.booking_id 
												WHERE b.user_id = $userId AND p.status = 'completed'";
											$completedResult = mysqli_query($connect, $completedSql);
											echo mysqli_fetch_assoc($completedResult)['total'];
										?></span>
									</div>
									<div class="d-flex justify-content-between align-items-center">
										<span class="text-muted">Member Since</span>
										<span class="fw-bold"><?php echo date('M Y', strtotime($user['created_at'])); ?></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-8 rounded-3">
							<div class="profile-content border-25 p-4 rounded-3">
								<h4 class="mb-4">Profile Information</h4>
								
								<?php if (isset($_SESSION['success'])): ?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<?php 
										echo $_SESSION['success'];
										unset($_SESSION['success']);
										?>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
								<?php endif; ?>

								<?php if (isset($_SESSION['error'])): ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<?php 
										echo $_SESSION['error'];
										unset($_SESSION['error']);
										?>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
								<?php endif; ?>

								<form method="POST" enctype="multipart/form-data">
									<input type="file" id="profile_image" name="profile_image" class="d-none" accept="image/*">
									
									<div class="row gx-3">
										<div class="col-md-6">
											<div class="form-group mb-3">
												<label class="form-label">First Name</label>
												<input type="text" class="form-control" name="first_name" value="<?php echo $user['first_name']; ?>" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group mb-3">
												<label class="form-label">Last Name</label>
												<input type="text" class="form-control" name="last_name" value="<?php echo $user['last_name']; ?>" required>
											</div>
										</div>
									</div>

									<div class="row gx-3">
										<div class="col-md-6">
											<div class="form-group mb-3">
												<label class="form-label">Email</label>
												<input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group mb-3">
												<label class="form-label">Mobile (Can't be changed)</label>
												<input disabled type="text" class="form-control" name="mobile" value="<?php echo $user['mobile']; ?>" required>
											</div>
										</div>
									</div>

									<div class="row gx-3">
										<div class="col-md-6">
											<div class="form-group mb-3">
												<label class="form-label">School</label>
												<input type="text" class="form-control" name="school" value="<?php echo $user['school']; ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group mb-3">
												<label class="form-label">City</label>
												<input type="text" class="form-control" name="city" value="<?php echo $user['city']; ?>">
											</div>
										</div>
									</div>

									<div class="row gx-3">
										<div class="col-md-6">
											<div class="form-group mb-3">
												<label class="form-label">Grade</label>
												<input type="text" class="form-control" name="grade" value="<?php echo $user['grade']; ?>">
											</div>
										</div>
									</div>

									<div class="form-group mb-4">
										<label class="form-label">About</label>
										<textarea class="form-control" name="about" rows="4"><?php echo $user['about']; ?></textarea>
									</div>

									<div class="d-flex justify-content-end">
										<button type="submit" class="btn btn-primary">
											<i class="bi bi-save me-2"></i>Save Changes
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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

		<script>
			$(document).ready(function() {
				// Remove loader after page loads
				setTimeout(function() {
					$('#preloader').fadeOut(500, function() {
						$(this).remove();
					});
				}, 500);

				// Handle profile image upload
				$('#profile_image').change(function() {
					if (this.files && this.files[0]) {
						var reader = new FileReader();
						reader.onload = function(e) {
							$('.profile-image-wrapper img').attr('src', e.target.result);
						}
						reader.readAsDataURL(this.files[0]);
					}
				});
			});
		</script>
			<?php include "include/footer.php" ?>
	</div> <!-- /.main-page-wrapper -->

<style>
.profile-sidebar {
    background: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.profile-image-wrapper {
    position: relative;
}

.profile-image-wrapper img,
.profile-initials {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.profile-initials {
    background: linear-gradient(45deg, #4e73df, #224abe);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    font-weight: 600;
    color: #fff;
}

.profile-image-wrapper label {
    cursor: pointer;
    transition: all 0.3s ease;
}

.profile-image-wrapper label:hover {
    transform: scale(1.1);
}

.profile-stats {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
}

.profile-content {
    background: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.form-control {
    border: 1px solid #e0e0e0;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.btn-primary {
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}
</style>
</body>

</html>