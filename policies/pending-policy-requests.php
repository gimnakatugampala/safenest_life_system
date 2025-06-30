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
								<h4>Pending Policies Request</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Policies</a></li>
									<li class="breadcrumb-item active" aria-current="page">Pending Policies Request</li>
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
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Policy Name</th>
									<th class="table-plus datatable-nosort">Customer Name</th>
									<th>Amount</th>
									<th>Duration</th>
									<th>Age Limit</th>
									<th>Requested Date</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="table-plus">Beginner</td>
									<td>Gimna Katugampala</td>
									<td>25</td>
									<td>Sagittarius</td>
									<td>45-90 </td>
									<td>29-03-2018</td>
									<td><span class="badge badge-pill badge-primary">Primary</span></td>
									<td>$162,700</td>
								</tr>
							
							</tbody>
						</table>
					</div>
				</div>
				<!-- Export Datatable End -->
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				
			</div>
		</div>
	</div>

	<?php include_once '../includes/footer.php'; ?>