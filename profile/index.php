<?php include_once '../includes/header.php'; ?>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/deskapp-logo.svg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">Loading...</div>
		</div>
	</div>

	<?php include_once '../includes/sub_header.php'; ?>
	<?php include_once '../includes/sidebar.php'; ?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Profile</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="row">
					<!-- Left profile panel -->
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<a href="../edit-profile/" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<!-- Profile image with id for JS -->
								<img id="profile-photo" src="../vendors/images/photo1.jpg" alt="Profile" class="avatar-photo">
							</div>
							<h5 class="text-center h5 mb-0" id="profile-fullname"></h5>
							<p class="text-center text-muted font-14" id="profile-occupation"></p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul id="profile-contact-info">
									<!-- JS will inject contact info here -->
								</ul>
							</div>
						</div>
					</div>

					<!-- Right profile tab section -->
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">User Details</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Bank Info</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Timeline Tab start -->
										<div class="tab-pane fade show active height-100-p" id="timeline" role="tabpanel">
											<div class="profile-setting">
												<form>
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-12" id="user-info-placeholder">
															<!-- JS will inject user details here -->
														</li>
													</ul>
												</form>
											</div>
										</div>
										<!-- Timeline Tab End -->

										<!-- Bank Info Tab start -->
										<div class="tab-pane fade" id="tasks" role="tabpanel">
											<div class="profile-setting">
												<form>
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-12" id="bank-info-placeholder">
															<!-- JS will inject bank info here -->
														</li>
													</ul>
												</form>
											</div>
										</div>
										<!-- Bank Info Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div><!-- end right section -->
				</div>
			</div>

			<div class="footer-wrap pd-20 mb-20 card-box">
			</div>
		</div>
	</div>

<?php include_once '../includes/footer.php'; ?>

<!-- Include the dynamic data loading script -->
<script src="../scripts/profile.js"></script>
