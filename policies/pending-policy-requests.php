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
					<div class="table-responsive pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Policy Name</th>
									<th class="table-plus datatable-nosort">Customer Name</th>
									<th>Premium Amount</th>
									<th>Coverage Amount</th>
									<th>Age Limit</th>
									<th>Req Date</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody id="pending-policy-body">
								<!-- <tr>
									<td class="table-plus">Beginner</td>
									<td>Gimna Katugampala</td>
									<td>25</td>
									<td>Sagittarius</td>
									<td>45-90 </td>
									<td>29-03-2018</td>
									<td><span class="badge badge-pill badge-info">Pending</span></td>
									<td>
                                        <button data-toggle="modal" data-target="#bd-example-modal-lg" type="button" class="btn btn-primary btn-sm"><span class="icon-copy ti-eye"></span></button>
                                        <button id="sa-params" type="button" class="btn btn-success btn-sm"><span class="icon-copy ti-check"></span></button>
                                        <button id="sa-warning" type="button" class="btn btn-danger btn-sm"><span class="icon-copy ti-close"></span></button>
                                    </td>
								</tr> -->
							
							</tbody>
						</table>
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
        <h4 class="modal-title" id="myLargeModalLabel">Policy Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <div id="viewContent">
          <!-- Filled dynamically with policy data -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


		</div>
	</div>

	<script src="../scripts/policy_requests.js"></script>

	<?php include_once '../includes/footer.php'; ?>