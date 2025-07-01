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
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Admins</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Manage Admins</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add Admins</li>
								</ol>
							</nav>
						</div>
					
					</div>
				</div>
		

				<!-- horizontal Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<form class="row">

						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label>First Name</label>
								<input class="form-control" type="text" placeholder="Johnny">
							</div>
						</div>

						<div class="col-sm-12 col-md-6">
							<div class="form-group">
							<label>Last Name</label>
							<input class="form-control" type="text" placeholder="Brown">
						</div>
						</div>

					<div class="col-sm-12 col-md-12">
						<div class="form-group">
							<label>Email</label>
							<input class="form-control" placeholder="exmaple@gmail.com" type="email">
						</div>
					</div>
<div class="col-sm-12 col-md-12">
	<div class="form-group" id="password-group">
		<label>Password</label>
		<div class="input-group">
			<input class="form-control" type="password" id="password">
			<div class="input-group-append">
				<span class="input-group-text" onclick="togglePassword('password', this)">
					<i class="fa fa-eye"></i>
				</span>
			</div>
		</div>
	</div>
</div>

<div class="col-sm-12 col-md-12">
	<div class="form-group" id="confirm-password-group">
		<label>Confirm Password</label>
		<div class="input-group">
			<input class="form-control" type="password" id="confirm_password">
			<div class="input-group-append">
				<span class="input-group-text" onclick="togglePassword('confirm_password', this)">
					<i class="fa fa-eye"></i>
				</span>
			</div>
		</div>
		<div class="form-control-feedback text-danger" id="passwordError" style="display:none;">
			Passwords do not match.
		</div>
	</div>
</div>



					<div class="col-sm-12 col-md-12">
					<button type="submit" class="btn btn-primary btn-lg pull-right">Add Admin</button>
					</div>
					
					</form>
					
				</div>
				<!-- horizontal Basic Forms End -->

				

				

			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				
			</div>
		</div>
	</div>

	<script>
document.getElementById('adminForm').addEventListener('submit', function(e) {
	const password = document.getElementById('password');
	const confirmPassword = document.getElementById('confirm_password');
	const errorMsg = document.getElementById('passwordError');
	const confirmGroup = document.getElementById('confirm-password-group');

	if (password.value !== confirmPassword.value) {
		e.preventDefault(); // prevent form submission

		// Add danger class
		confirmGroup.classList.remove('has-success');
		confirmGroup.classList.add('has-danger');
		errorMsg.style.display = 'block';
	} else {
		// Add success class
		confirmGroup.classList.remove('has-danger');
		confirmGroup.classList.add('has-success');
		errorMsg.style.display = 'none';
	}
});
</script>


	<script>
		function togglePassword(fieldId, iconSpan) {
			const field = document.getElementById(fieldId);
			const icon = iconSpan.querySelector('i');
			if (field.type === "password") {
				field.type = "text";
				icon.classList.remove("fa-eye");
				icon.classList.add("fa-eye-slash");
			} else {
				field.type = "password";
				icon.classList.remove("fa-eye-slash");
				icon.classList.add("fa-eye");
			}
		}
		</script>

    
	<?php include_once '../includes/footer.php'; ?>