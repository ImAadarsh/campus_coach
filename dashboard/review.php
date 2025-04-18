<?php
include ("../include/private_page.php");
include ("../include/connect.php");

// Get all reviews for the current user
$reviews_sql = "SELECT tr.*, t.first_name, t.last_name, t.hero_img, b.id as booking_id
                FROM trainer_reviews tr
                JOIN bookings b ON tr.booking_id = b.id
                JOIN time_slots ts ON b.time_slot_id = ts.id
                JOIN trainer_availabilities ta ON ts.trainer_availability_id = ta.id
                JOIN trainers t ON ta.trainer_id = t.id
                WHERE tr.user_id = " . $_SESSION['userid'] . "
                ORDER BY tr.created_at DESC";

$reviews_result = mysqli_query($connect, $reviews_sql);
$reviews = mysqli_fetch_all($reviews_result, MYSQLI_ASSOC);
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

				<h2 class="main-title d-block d-lg-none">My Reviews</h2>

                <div class="d-sm-flex align-items-center justify-content-between mb-25">
                    <div class="fs-16">Showing <span class="color-dark fw-500">1–<?php echo count($reviews); ?></span> of <span class="color-dark fw-500"><?php echo count($reviews); ?></span> reviews</div>
                </div>

				<div class="bg-white card-box pt-0 border-20">
                    <div class="theme-details-one">
                        <div class="review-panel-one">
							<div class="position-relative z-1">
								<div class="review-wrapper">
                                    <?php if(empty($reviews)): ?>
                                        <div class="alert alert-info">
                                            <i class="bi bi-info-circle me-2"></i> You haven't written any reviews yet.
                                        </div>
                                    <?php else: ?>
                                        <?php foreach($reviews as $review): ?>
                                            <div class="review" id="review-<?php echo $review['id']; ?>">
                                                <img src="<?php echo $uri . $review['hero_img']; ?>" alt="" class="rounded-circle avatar">
                                                <div class="text">
                                                    <div class="d-sm-flex justify-content-between">
                                                        <div>
                                                            <h6 class="name"><?php echo htmlspecialchars($review['first_name'] . ' ' . $review['last_name']); ?></h6>
                                                            <div class="time fs-16"><?php echo date('d M, Y', strtotime($review['created_at'])); ?></div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <ul class="rating style-none d-flex xs-mt-10">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <li><i class="bi bi-star<?php echo $i <= $review['rating'] ? '-fill text-warning' : ''; ?>"></i></li>
                                                                <?php endfor; ?>
                                                            </ul>
                                                            <button class="btn btn-link edit-review-btn" data-review-id="<?php echo $review['id']; ?>">
                                                                <i class="bi bi-pencil"></i> Edit
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <p class="fs-20 mt-20 mb-30 review-content"><?php echo htmlspecialchars($review['review']); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
								</div>
							</div>						
						</div>
					</div>                    
                </div>
			</div>
		</div>
		<!-- /.dashboard-body -->

        <!-- Edit Review Modal -->
        <div class="modal fade" id="editReviewModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editReviewForm">
                            <input type="hidden" name="review_id" id="edit_review_id">
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <div class="stars">
                                    <?php for($i = 5; $i >= 1; $i--): ?>
                                        <i class="bi bi-star-fill star" data-rating="<?php echo $i; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <input type="hidden" name="rating" id="edit_rating" value="5">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Review</label>
                                <textarea class="form-control" name="review" id="edit_review" rows="4"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveReviewBtn">Save changes</button>
                    </div>
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

        <script>
            // Star rating functionality
            document.querySelectorAll('.stars .star').forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.dataset.rating;
                    const form = this.closest('.modal-body');
                    const hiddenInput = form.querySelector('input[name="rating"]');
                    const stars = form.querySelectorAll('.star');
                    
                    hiddenInput.value = rating;
                    
                    stars.forEach(s => {
                        if(s.dataset.rating <= rating) {
                            s.classList.add('text-warning');
                        } else {
                            s.classList.remove('text-warning');
                        }
                    });
                });
            });

            // Edit review functionality
            document.querySelectorAll('.edit-review-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const reviewId = this.dataset.reviewId;
                    const reviewElement = document.getElementById(`review-${reviewId}`);
                    const rating = reviewElement.querySelectorAll('.bi-star-fill').length;
                    const reviewContent = reviewElement.querySelector('.review-content').textContent;

                    document.getElementById('edit_review_id').value = reviewId;
                    document.getElementById('edit_rating').value = rating;
                    document.getElementById('edit_review').value = reviewContent;

                    // Set initial star rating
                    const stars = document.querySelectorAll('#editReviewModal .star');
                    stars.forEach(star => {
                        if(star.dataset.rating <= rating) {
                            star.classList.add('text-warning');
                        } else {
                            star.classList.remove('text-warning');
                        }
                    });

                    new bootstrap.Modal(document.getElementById('editReviewModal')).show();
                });
            });

            // Save edited review
            document.getElementById('saveReviewBtn').addEventListener('click', function() {
                const reviewId = document.getElementById('edit_review_id').value;
                const rating = document.getElementById('edit_rating').value;
                const review = document.getElementById('edit_review').value;

                $.ajax({
                    url: 'update_review.php',
                    method: 'POST',
                    data: {
                        review_id: reviewId,
                        rating: rating,
                        review: review
                    },
                    success: function(response) {
                        if(response.success) {
                            alert('Review updated successfully');
                            location.reload();
                        } else {
                            alert('Failed to update review: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Error connecting to server. Please try again.');
                    }
                });
            });
        </script>
		<?php include "include/footer.php" ?>

        <style>
            .stars {
                display: flex;
                gap: 0.25rem;
            }

            .stars .star {
                cursor: pointer;
                font-size: 1.25rem;
                color: #ddd;
                transition: color 0.2s;
            }

            .stars .star.text-warning {
                color: #ffc107;
            }

            .edit-review-btn {
                color: #6c757d;
                text-decoration: none;
                padding: 0.25rem 0.5rem;
            }

            .edit-review-btn:hover {
                color: #0d6efd;
            }
        </style>
	</div> <!-- /.main-page-wrapper -->
</body>

</html>