<?php include_once '../includes/a_header.php'; ?>


<body class="login-page">
	<!-- <div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="../vendors/images/deskapp-logo.svg" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="../register.html">Register</a></li>
				</ul>
			</div>
		</div>
	</div> -->
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<!-- <div class="col-md-6 col-lg-7">
					<img src="../vendors/images/login-page-img.png" alt="">
				</div> -->
				<div class="col-md-12 col-lg-12">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login To Safenest</h2>
						</div>
						<form id="loginForm">
						
							<div class="input-group custom">
								<input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Email" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="**********" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
						
								<div id="loginMsg" class="text-danger text-center py-2"></div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
					
										<button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="../auth/register.php">Create Account</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="../scripts/login.js"></script>

	<!-- js -->
<?php include_once '../includes/a_footer.php'; ?>