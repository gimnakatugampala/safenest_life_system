<?php include_once '../includes/header.php'; ?>

<style>
	.wizard-content .wizard>.actions{
		display: none;
	}
</style>

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
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Policy Application Form</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Policies</a></li>
									<li class="breadcrumb-item active" aria-current="page">Policy Application Form</li>
								</ol>
							</nav>
						</div>
					
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<!-- <div class="clearfix">
						<h4 class="text-blue h4">Step wizard</h4>
						<p class="mb-30">jQuery Step wizard</p>
					</div> -->
					<div class="wizard-content">
						<form id="formPolicyApp"  class="tab-wizard wizard-circle wizard">
							<h5>Personal Info</h5>
						<!-- Step 1 -->
						<section>
						<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<label>First Name :</label>
								<input type="text" class="form-control" name="first_name" required>
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label>Last Name :</label>
								<input type="text" class="form-control" name="last_name" required>
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							<div class="form-group">
								<label>Full Name :</label>
								<input type="text" class="form-control" name="full_name" required>
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<label>Age :</label>
								<input type="text" class="form-control" name="age" required>
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label>Date of Birth :</label>
								<input type="date" class="form-control" name="dob" placeholder="Select Date" required>
							</div>
							</div>
						</div>
						</section>

							<!-- Step 2 -->
							<h5>Policy Details</h5>
							<section>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Policy Plan:</label>
											<select disabled class="custom-select col-12">
												
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Term/ Duration :</label>
											<select disabled class="custom-select col-12">
												
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Premium :</label>
											<select disabled class="custom-select col-12">
												
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Eligibility :</label>
											<select disabled class="custom-select col-12">
												
											</select>
										</div>
									</div>
									
								</div>
							</section>
							<!-- Step 3 -->
							<h5>Nominee Info</h5>
							<section>
							<div class="row">
								<div class="col-md-12">
								<div class="form-group">
									<label>Full Name :</label>
									<input type="text" class="form-control" name="nominee_full_name" required>
								</div>
								</div>

								<div class="col-md-6">
								<div class="form-group">
									<label>Relation :</label>
									<select id="relationSelect" class="form-control" name="nominee_relation" required>
									<option value="">Select...</option>
									</select>
								</div>
								</div>

								<div class="col-md-6">
								<div class="form-group">
									<label>Age :</label>
									<input type="text" class="form-control" name="nominee_age" placeholder="Age" required>
								</div>
								</div>
							</div>
							</section>

							<!-- Step 4 -->
							<h5>Declaration</h5>
							<section>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Comments (optional)</label>
											<textarea name="comment" class="form-control"></textarea>
										</div>
									</div>

									<div class="col-md-12">
									<div class="custom-control custom-checkbox mb-5">
										<input type="checkbox" class="custom-control-input" id="customCheck1" name="terms">
										<label class="custom-control-label" for="customCheck1">I accept the Terms and Conditions</label>
									</div>
									</div>


								</div>
							</section>
								<div class="d-flex justify-content-between mt-4">
								<button type="button" id="prevBtn" class="btn btn-secondary">Previous</button>
								<button type="button" id="nextBtn" class="btn btn-primary">Next</button>
								<button type="button" id="submitBtn" class="btn btn-success d-none">Submit</button>
							</div>
						</form>
					</div>
				</div>

				

		<!-- Success Popup Modal -->
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center font-18">
        <h3 class="mb-20 text-success">Form Submitted Successfully!</h3>
        <div class="mb-30 text-center">
          <img src="../vendors/images/success.png" alt="Success" style="max-width: 100px;">
        </div>
        <p>Your policy application has been submitted successfully. We will review your information and get back to you shortly.</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>

				<!-- success Popup html End -->
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				
			</div>
		</div>
	</div>

	<script src="../scripts/policy_application_form.js"></script>

	<?php include_once '../includes/footer.php'; ?>
