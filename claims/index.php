<?php
include_once '../includes/header.php';
include_once '../includes/sub_header.php';
include_once '../includes/sidebar.php';
include_once '../includes/db_connection.php';
?>

<body>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Claims</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Manage Claims</a></li>
									<li class="breadcrumb-item active" aria-current="page">Claims</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="card-box mb-30">
					<div class="pd-20"></div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap table-responsive">
							<thead>
								<tr>
									<th># Claim Code</th>
									<th>Amount</th>
									<th>Claimed By</th>
									<th>Nominee</th>
									<th>Requested Date</th>
									<th>Comment</th>
									<th>Status</th>
									<th>Policy</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query = "SELECT c.*, c.created_at AS requested_date, p.full_name_nominee, g.first_name, g.last_name, l.policy_name, s.status 
	FROM claim c
	LEFT JOIN policy_application_form p ON c.policy_application_form_id = p.id
	LEFT JOIN user_life_policy ul ON p.user_life_policy_life_policy_id = ul.id
	LEFT JOIN general_user_profile g ON ul.gup_id = g.id
	LEFT JOIN life_policy l ON ul.life_policy_id = l.id
	LEFT JOIN status s ON c.status_id = s.id
	ORDER BY c.id DESC";

								$result = $conn->query($query);
								while ($row = $result->fetch_assoc()):
									?>
									<tr>
										<td><?= htmlspecialchars($row['code']) ?></td>
										<td><?= htmlspecialchars($row['req_amount']) ?></td>
										<td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
										<td><?= htmlspecialchars($row['full_name_nominee']) ?></td>
										<td><?= htmlspecialchars(date('Y-m-d', strtotime($row['requested_date']))) ?></td>
										<td><?= htmlspecialchars($row['cus_comment']) ?></td>
										<td><span
												class="badge badge-pill badge-<?= strtolower($row['status']) == 'approved' ? 'success' : (strtolower($row['status']) == 'rejected' ? 'danger' : 'info') ?>"><?= htmlspecialchars($row['status']) ?></span>
										</td>
										<td><?= htmlspecialchars($row['policy_name']) ?></td>
										<td>
											<button type="button" class="btn btn-sm btn-primary view-claim"
												data-claim-id="<?= $row['id'] ?>" data-toggle="modal"
												data-target="#claimDetailsModal">
												<i class="icon-copy fa fa-eye"></i>
											</button>
										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- View Claim Details Modal -->
	<div class="modal fade" id="claimDetailsModal" tabindex="-1" role="dialog" aria-labelledby="claimDetailsModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="claimDetailsModalLabel">Claim Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- AJAX-loaded content goes here -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<?php include_once '../includes/footer.php'; ?>

	<script>
		$(document).ready(function () {
			$('.view-claim').on('click', function () {
				const claimId = $(this).data('claim-id');
				$.post('../ajax/get_claim_details.php', { id: claimId }, function (data) {
					$('#claimDetailsModal .modal-body').html(data);
				});
			});
		});
	</script>