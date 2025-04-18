<header style="padding-top: 10px !important; padding-bottom: 2px !important;" class="dashboard-header">
					<div class="d-flex align-items-center justify-content-end">
						<h4 class="m0 d-none d-lg-block">Dashboard</h4>
						<button class="dash-mobile-nav-toggler d-block d-md-none me-auto">
							<span></span>
						</button>
						<form action="#" class="search-form ms-auto position-relative">
							<input type="text" id="globalSearch" placeholder="Search here..">
							<button type="submit"><img src="../images/lazy.svg" data-src="images/icon/icon_43.svg" alt="" class="lazy-img m-auto"></button>
							<div class="search-results" style="display: none;">
								<div class="search-loading text-center py-3">
									<div class="spinner-border text-primary" role="status">
										<span class="visually-hidden">Loading...</span>
									</div>
								</div>
								<div class="search-items"></div>
							</div>
						</form>
						<div class="profile-notification position-relative dropdown-center ms-3 ms-md-5 me-4">
						
						</div>
						<div class="d-none d-md-block me-3">
									<a href="../index.php" style="background-color: #C11F21; color: #fff; padding-top: 0px !important; padding-bottom: 0px !important;" class="btn-one"><span style="padding-top: 0px !important; padding-bottom: 0px !important; font-size: 14px;">Return Home</span> <i class="fa-thin fa-arrow-up-right"></i></a>
						</div>
						<div class="user-data position-relative">
							<button class="user-avatar online position-relative rounded-circle dropdown-toggle" type="button" id="profile-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
								<?php echo $_SESSION['name'][0] ; ?>
							</button>
							<!-- /.user-avatar -->
							<div class="user-name-data">
								<ul class="dropdown-menu" aria-labelledby="profile-dropdown">
									<li>
										<a class="dropdown-item d-flex align-items-center" href="profile.php"><img src="../images/lazy.svg" data-src="images/icon/icon_23.svg" alt="" class="lazy-img"><span class="ms-2 ps-1">Profile</span></a>
									</li>
								
									<li>
										<a class="dropdown-item d-flex align-items-center" href="logout.php" data-bs-toggle="modal" data-bs-target="#deleteModal"><img src="../images/lazy.svg" data-src="images/icon/icon_25.svg" alt="" class="lazy-img"><span class="ms-2 ps-1">Logout</span></a>
									</li>
								</ul>
							</div>
						</div>
						<!-- /.user-data -->
					</div>
				</header>


<style>
.search-form {
    position: relative;
}

.search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    max-height: 400px;
    overflow-y: auto;
}

.search-item {
    padding: 10px 15px;
    border-bottom: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.search-item:last-child {
    border-bottom: none;
}

.search-item:hover {
    background-color: #f8f9fa;
}

.search-item .title {
    font-weight: 500;
    color: #333;
    margin-bottom: 2px;
}

.search-item .subtitle {
    font-size: 0.875rem;
    color: #6c757d;
}

.search-item .meta {
    font-size: 0.75rem;
    color: #6c757d;
}

.search-item .badge {
    font-size: 0.7rem;
    padding: 0.25em 0.5em;
}
</style>
		<!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                <div class="container">
                    <div class="remove-account-popup text-center modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						<img src="../assets/img/logo/logo.svg" data-src="../assets/img/logo/logo.svg" alt="" class="lazy-img m-auto">
						<h2>Are you sure?</h2>
						<p>Are you sure to logout from your account?.</p>
						<div class="button-group d-inline-flex justify-content-center align-items-center pt-15">
							<a href="logout.php" class="confirm-btn fw-500 tran3s me-3">Yes</a>
							<button type="button" class="btn-close fw-500 ms-3" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
						</div>
                    </div>
                    <!-- /.remove-account-popup -->
                </div>
            </div>
        </div>