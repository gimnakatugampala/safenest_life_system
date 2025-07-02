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
								<h4>Add Request Claims</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Manage Claims</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add Request Claims</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>


				<!-- Export Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
					</div>
					<div class="pb-20">
                        <form class="row">

                         <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 col-md-12 col-form-label">Select Policy</label>
                                    	<div class="col-sm-12 col-md-12">
                                        <select class="custom-select col-12">
                                            <option selected="">Choose...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
							        </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 col-md-12 col-form-label">Amount</label>
                                    <div class="col-sm-12 col-md-12">
                                        <input class="form-control" type="text" placeholder="Amount">
                                    </div>
                                </div>
                            </div>
							

                    

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12 col-md-12 col-form-label">Comment</label>
                                    <div class="col-sm-12 col-md-12">
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 col-md-12 col-form-label">Prescriptions</label>
                                    <div class="col-sm-12 col-md-12">
                                       <input type="file" class="form-control-file form-control height-auto">
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 col-md-12 col-form-label">Bills & Cash Receipts</label>
                                    <div class="col-sm-12 col-md-12">
                                       <input type="file" class="form-control-file form-control height-auto">
                                    </div>
                                </div>
                            </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 col-md-12 col-form-label">Diagnosetic Ticket</label>
                                    <div class="col-sm-12 col-md-12">
                                       <input type="file" class="form-control-file form-control height-auto">
                                    </div>
                                </div>
                            </div>

                               <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 col-md-12 col-form-label">Other</label>
                                    <div class="col-sm-12 col-md-12">
                                       <input type="file" class="form-control-file form-control height-auto">
                                    </div>
                                </div>
                            </div>


                        </form>
					</div>
				</div>
				<!-- Export Datatable End -->
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				
			</div>

            <!-- Large Modal -->
             <div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
											tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
											quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
											consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
											cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
											proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
											tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
											quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
											consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
											cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
											proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary">Save changes</button>
										</div>
									</div>
								</div>
							</div>

		</div>
	</div>

	<?php include_once '../includes/footer.php'; ?>