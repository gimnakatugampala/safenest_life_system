<?php include_once '../includes/header.php'; ?>


<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/deskapp-logo.svg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
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


					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<a href="../edit-profile/" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<img src="../vendors/images/photo1.jpg" alt="" class="avatar-photo">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body pd-5">
												<div class="img-container">
													<img id="image" src="../vendors/images/photo2.jpg" alt="Picture">
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" value="Update" class="btn btn-primary">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<h5 class="text-center h5 mb-0">Gimna Katugampala</h5>
							<p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
										FerdinandMChilds@test.com
									</li>
									<li>
										<span>Phone Number:</span>
										619-229-0054
									</li>
									<li>
										<span>Country:</span>
										America
									</li>
									<li>
										<span>Address:</span>
										1807 Holden Street<br>
										San Diego, CA 92115
									</li>
								</ul>
							</div>
							
							
						</div>
					</div>


					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">User Details</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Personal Info</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Timeline Tab start -->
										 <div class="tab-pane fade show active height-100-p" id="timeline" role="tabpanel">
											<div class="profile-setting">
												<form>
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-12">
															<!-- <h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4> -->
															<div class="form-group">
																<label>Full Name</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Title</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Email</label>
																<input class="form-control form-control-lg" type="email">
															</div>
															<div class="form-group">
																<label>Date of birth</label>
																<input class="form-control form-control-lg date-picker" type="text">
															</div>
															<div class="form-group">
																<label>Gender</label>
																<div class="d-flex">
																<div class="custom-control custom-radio mb-5 mr-20">
																	<input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
																	<label class="custom-control-label weight-400" for="customRadio4">Male</label>
																</div>
																<div class="custom-control custom-radio mb-5">
																	<input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
																	<label class="custom-control-label weight-400" for="customRadio5">Female</label>
																</div>
																</div>
															</div>
															<div class="form-group">
																<label>Country</label>
																<select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen">
																	<option>United States</option>
																	<option>India</option>
																	<option>United Kingdom</option>
																</select>
															</div>
															<div class="form-group">
																<label>State/Province/Region</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Postal Code</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Phone Number</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Address</label>
																<textarea class="form-control"></textarea>
															</div>
															<div class="form-group">
																<label>Visa Card Number</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Paypal ID</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="customCheck1-1">
																	<label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification emails</label>
																</div>
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Update Information">
															</div>
														</li>
													</ul>
												</form>
											</div>
										</div>
										
										<!-- Timeline Tab End -->
										<!-- Tasks Tab start -->
										<div class="tab-pane fade" id="tasks" role="tabpanel">
												<div class="profile-setting">
												<form>
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4>
															<div class="form-group">
																<label>Full Name</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Title</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Email</label>
																<input class="form-control form-control-lg" type="email">
															</div>
															<div class="form-group">
																<label>Date of birth</label>
																<input class="form-control form-control-lg date-picker" type="text">
															</div>
															<div class="form-group">
																<label>Gender</label>
																<div class="d-flex">
																<div class="custom-control custom-radio mb-5 mr-20">
																	<input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
																	<label class="custom-control-label weight-400" for="customRadio4">Male</label>
																</div>
																<div class="custom-control custom-radio mb-5">
																	<input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
																	<label class="custom-control-label weight-400" for="customRadio5">Female</label>
																</div>
																</div>
															</div>
															<div class="form-group">
																<label>Country</label>
																<select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen">
																	<option>United States</option>
																	<option>India</option>
																	<option>United Kingdom</option>
																</select>
															</div>
															<div class="form-group">
																<label>State/Province/Region</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Postal Code</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Phone Number</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Address</label>
																<textarea class="form-control"></textarea>
															</div>
															<div class="form-group">
																<label>Visa Card Number</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Paypal ID</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="customCheck1-1">
																	<label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification emails</label>
																</div>
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Update Information">
															</div>
														</li>
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Social Media links</h4>
															<div class="form-group">
																<label>Facebook URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Twitter URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Linkedin URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Instagram URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Dribbble URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Dropbox URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Google-plus URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Pinterest URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Skype URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Vine URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Save & Update">
															</div>
														</li>
													</ul>
												</form>
											</div>
										</div>
										<!-- Tasks Tab End -->
										<!-- Setting Tab start -->
										
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
	
					<div class="footer-wrap pd-20 mb-20 card-box">
				</a>
			</div>
		</div>
	</div>
	<?php include_once '../includes/footer.php'; ?>