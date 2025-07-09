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
											<a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Bank Info</a>
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
																<label><b>Full Name</b></label>
																<p class="m-0 p-0">K D K Gimna Katugampala</p>
															</div>
															<div class="form-group">
																<label><b>Occupation</b></label>
																<p class="m-0 p-0">Software Engineer</p>
															</div>
															<div class="form-group">
																<label><b>Email</b></label>
																<p class="m-0 p-0">gimnakatugampala1@gmail.com</p>
															</div>
															<div class="form-group">
																<label><b>Date of birth</b></label>
																<p class="m-0 p-0">2000-06-20</p>
															</div>
															<div class="form-group">
																<label><b>Gender</b></label>
																<p class="m-0 p-0">Male</p>
															</div>
															<div class="form-group">
																<label><b>Country</b></label>
																<p class="m-0 p-0">Sri Lanka</p>
															</div>
															<div class="form-group">
																<label><b>State/Province/Region</b></label>
																<p class="m-0 p-0">Western Province</p>
															</div>
															<div class="form-group">
																<label><b>Postal Code</b></label>
																<p class="m-0 p-0">10600</p>
															</div>
															<div class="form-group">
																<label><b>Phone Number</b></label>
																<p class="m-0 p-0">94 764961707</p>
															</div>
															<div class="form-group">
																<label><b>Address</b></label>
																<p class="m-0 p-0">393/5, Awissawella Road Megoda Kolonnawa , Wellampitiya, Colombo.</p>
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
														<li class="weight-500 col-md-12">
															<h4 class="text-blue h5 mb-20">Your Bank Info</h4>
															<div class="form-group">
																<label><b>Bank Account No</b></label>
																<p class="m-0 p-0">194-2-001-3-0035584</p>
															</div>
															<div class="form-group">
																<label><b>Bank Name</b></label>
																<p class="m-0 p-0">People's Bank</p>
															</div>
															<div class="form-group">
																<label><b>Bank Branch Name</b></label>
																<p class="m-0 p-0">Kolonnawa</p>
															</div>
															<div class="form-group">
																<label><b>Account Holder Name</b></label>
																<p class="m-0 p-0">K D K Gimna Katugampala</p>
															</div>
														
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
	
					<div class="footer-wrap pd-20 mb-20 card-box">
				</a>
			</div>
		</div>
	</div>
	<?php include_once '../includes/footer.php'; ?>