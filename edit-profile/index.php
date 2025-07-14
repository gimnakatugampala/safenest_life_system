<?php include_once '../includes/header.php'; ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet" />

<style>

.card-box {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 25px;
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0,0,0,0.05);
}

.profile-setting form {
  margin-top: 15px;
}

.profile-edit-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.profile-edit-list li {
  padding: 0;
  margin: 0;
}

.form-group {
  margin-bottom: 18px;
}

form label {
  font-weight: 600;
  margin-bottom: 6px;
  display: block;
  color: #333;
}

.form-control.form-control-lg {
  border: 1.5px solid #ccc;
  border-radius: 6px;
  padding: 12px 15px;
  font-size: 16px;
  transition: border-color 0.3s ease;
  width: 100%;
  box-sizing: border-box;
}

.form-control.form-control-lg:focus {
  border-color: #3a8ee6;
  outline: none;
  box-shadow: 0 0 8px rgba(58,142,230,0.4);
}

.btn-primary {
  padding: 10px 28px;
  border-radius: 6px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #357ABD;
}

ul.profile-edit-list li {
  list-style: none;
}

@media (max-width: 575px) {
  .btn-primary {
    width: 100%;
  }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
							<h4>Edit Profile</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
			<div class="row">

				<!-- LEFT: Profile Photo & Info -->
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
					<div class="pd-20 card-box height-100-p">
						<div class="profile-photo">
							<a href="#" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
							<img id="profile-photo" src="../vendors/images/photo1.jpg" alt="" class="avatar-photo">

							<!-- Modal for Cropper -->
							<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Update Profile Image</h5>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<input type="file" name="profile_image" id="profile_image" accept="image/*" class="form-control mb-2">
											<div>
												<img id="image_preview" style="width: 100%; max-height: 400px;" />
											</div>
										</div>
										<div class="modal-footer">
											<button id="crop_and_upload" class="btn btn-primary">Crop & Upload</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<h5 class="text-center h5 mb-0" id="profile-name">-</h5>
						<p class="text-center text-muted font-14" id="profile-occupation">-</p>
						<div class="profile-info">
							<h5 class="mb-20 h5 text-blue">Contact Information</h5>
							<ul>
								<li><span>Email Address:</span> <span id="profile-email">-</span></li>
								<li><span>Phone Number:</span> <span id="profile-phone">-</span></li>
								<li><span>Country:</span> <span id="profile-country">-</span></li>
								<li><span>Address:</span> <span id="profile-address">-</span></li>
							</ul>
						</div>
					</div>
				</div>

				<!-- RIGHT: Forms for User Details & Bank Info -->
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

									<!-- User Details Form -->
									<div class="tab-pane fade show active" id="timeline" role="tabpanel">
										<div class="profile-setting">
											<form id="edit-profile-form">
												<ul class="profile-edit-list row">
													<li class="weight-500 col-md-12">
														<div class="form-group">
															<label>Full Name</label>
															<input type="text" name="full_name" class="form-control form-control-lg" required>
														</div>
														<div class="form-group">
															<label>Email</label>
															<input type="email" name="email" class="form-control form-control-lg" required>
														</div>
														<div class="form-group">
															<label>Date of Birth</label>
															<input type="date" name="dob" class="form-control form-control-lg">
														</div>
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" name="phone_number" class="form-control form-control-lg">
														</div>
														<div class="form-group">
															<label>Occupation</label>
															<input type="text" name="occupation" class="form-control form-control-lg">
														</div>
														<div class="form-group">
															<label>Address</label>
															<textarea name="address" class="form-control form-control-lg" rows="2"></textarea>
														</div>
														<div class="form-group">
															<label>City</label>
															<input type="text" name="city" class="form-control form-control-lg">
														</div>
														<div class="form-group">
															<label>State</label>
															<input type="text" name="state" class="form-control form-control-lg">
														</div>
														<div class="form-group">
															<label>Province</label>
															<input type="text" name="province" class="form-control form-control-lg">
														</div>
														<div class="form-group">
															<label>Postal Code</label>
															<input type="text" name="postal_code" class="form-control form-control-lg">
														</div>
														<div class="form-group">
															<label>Gender</label>
															<select name="gender_id" class="form-control form-control-lg">
																<option value="">Select Gender</option>
																<option value="1">Male</option>
																<option value="2">Female</option>
															</select>
														</div>
														<div class="form-group">
															<label>Country</label>
															<select name="country_id" class="form-control form-control-lg">
																<option value="">Select Country</option>
																<option value="1">Sri Lanka</option>
																<option value="2">India</option>
																<option value="3">United Kingdom</option>
																<option value="4">United States</option>
															</select>
														</div>
														<button type="submit" class="btn btn-primary">Update Profile</button>
													</li>
												</ul>
											</form>
										</div>
									</div>

									<!-- Bank Info Form -->
									<div class="tab-pane fade" id="tasks" role="tabpanel">
										<div class="profile-setting">
											<form id="edit-bank-form">
												<ul class="profile-edit-list row">
													<li class="weight-500 col-md-12">
														<div class="form-group">
															<label>Bank Account Number</label>
															<input type="text" name="bank_account_no" class="form-control form-control-lg">
														</div>
														<div class="form-group">
															<label>Bank Name</label>
															<input type="text" name="bank_name" class="form-control form-control-lg">
														</div>
														<div class="form-group">
															<label>Branch Name</label>
															<input type="text" name="bank_branch_name" class="form-control form-control-lg">
														</div>
														<div class="form-group">
															<label>Account Holder Name</label>
															<input type="text" name="bank_account_holder_name" class="form-control form-control-lg">
														</div>
														<button type="submit" class="btn btn-primary">Update Bank Info</button>
													</li>
												</ul>
											</form>
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

<?php include_once '../includes/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script src="../scripts/edit_profile.js"></script>
