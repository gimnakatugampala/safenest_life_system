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
								<h4>Policies</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Policies</a></li>
									<li class="breadcrumb-item active" aria-current="page">All Policies</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				
				<div class="header-search">
				<form onsubmit="return false;">           
					<div class="form-group mb-4 position-relative">
					<input type="text"
							id="policySearch"                    
							class="form-control search-input"
							placeholder="Search policies…">

					<!-- optional search icon -->
					<i class="fa fa-search position-absolute"
						style="right:12px;top:50%;transform:translateY(-50%);opacity:.5;"></i>
					</div>
				</form>
				</div>


				<div class="product-wrap">
					<div class="product-list">
						 <ul id="policy-list" class="row">
							<!-- <li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img1.jpg" alt=""></div>

									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="../policies/policy-details.php" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li>

							<li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img2.jpg" alt=""></div>
								
									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="../policies/policy-details.php" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li>

							<li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img3.jpg" alt=""></div>
									
									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="../policies/policy-details.php" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li>
							
							<li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img4.jpg" alt=""></div>
									
									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="../policies/policy-details.php" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li>

							<li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img2.jpg" alt=""></div>
									
									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="#" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li>

							<li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img4.jpg" alt=""></div>
									
									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="#" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li>

							<li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img1.jpg" alt=""></div>
								
									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="#" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li>

							<li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img3.jpg" alt=""></div>
									
									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="#" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li>

							<li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img1.jpg" alt=""></div>
									
									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="#" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li>

							<li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img2.jpg" alt=""></div>
									
									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="#" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li>


							<li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img3.jpg" alt=""></div>
								
									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="#" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li>

							<li class="col-lg-4 col-md-6 col-sm-12">
								<div class="product-box">
									<div class="producct-img"><img src="../vendors/images/product-img4.jpg" alt=""></div>
								
									<div class="product-caption text-center">
										<h4><a href="#">Gufram Bounce Black</a></h4>

										<div class="contact-name text-center">
											<p>UI/UX designer</p>
										</div>
										
										
										<div class="price text-center">
											<h6 class="text-muted"><del>LKR 55,000/=</del></h6><h3>LKR 50,000/=</h3>
										</div>

										<hr>
											<div class="pricing-card-body">
											<div class="pricing-points">
												<ul>
													<li>2 TB of space</li>
													<li>120 days of file recovery</li>
													<li>Smart Sync</li>
													<li>Dropbox Paper admin tools</li>
													<li>Granular sharing permissions</li>
													<li>User and company-managed groups</li>
													<li>Live chat support</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="d-flex justify-content-center">
											<a href="#" class="btn btn-outline-primary">Select Now</a>
										</div>
									</div>
								</div>
							</li> -->

						</ul>
					</div>
				<!-- pagination container -->
				<div class="blog-pagination mb-30">
				<div class="btn-toolbar justify-content-center mb-15">
					<div id="pager" class="btn-group"></div>   <!-- JS injects buttons here -->
				</div>
				</div>

				</div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				
			</div>
		</div>
	</div>

	<script src="../scripts/all_policies.js"></script>
	<?php include_once '../includes/footer.php'; ?>