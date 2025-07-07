<?php
include_once '../includes/header.php';
include_once '../includes/sub_header.php';
include_once '../includes/sidebar.php';
include_once '../includes/db_connection.php';
?>
<!-- Status Message Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="statusModalLabel">Claim Status Update</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="statusModalBody">
				<!-- Response text will be injected here -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="location.reload();">OK</button>
			</div>
		</div>
	</div>
</div>

<!-- Confirm Approval Modal -->
<div class="modal fade" id="confirmApprovalModal" tabindex="-1" role="dialog"
	aria-labelledby="confirmApprovalModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="confirmApprovalModalLabel">Confirm Approval</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are you sure you want to approve this claim?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" id="approvalCancelBtn"
					data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-success" id="approvalConfirmBtn">Yes, Approve</button>
			</div>
		</div>
	</div>
</div>

<body>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Pending Claims Request</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Manage Claims</a></li>
									<li class="breadcrumb-item active" aria-current="page">Pending Claims Request</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="card-box mb-30">
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th># Claim Code</th>
									<th>Amount</th>
									<th>Claimed By</th>
									<th>Nominee</th>
									<th>Comment</th>
									<th>Status</th>
									<th>Policy</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query = "SELECT c.*, p.full_name_nominee, g.first_name, l.policy_name, s.status
                                    FROM claim c
                                    LEFT JOIN policy_application_form p ON c.policy_application_form_id = p.id
                                    LEFT JOIN user_life_policy ul ON p.user_life_policy_life_policy_id = ul.id
                                    LEFT JOIN general_user_profile g ON ul.gup_id = g.id
                                    LEFT JOIN life_policy l ON ul.life_policy_id = l.id
                                    LEFT JOIN status s ON c.status_id = s.id
                                    WHERE c.status_id = 1";

								$result = $conn->query($query);
								while ($row = $result->fetch_assoc()):
									?>
									<tr>
										<td><?= htmlspecialchars($row['code']) ?></td>
										<td><?= htmlspecialchars($row['req_amount']) ?></td>
										<td><?= htmlspecialchars($row['first_name']) ?></td>
										<td><?= htmlspecialchars($row['full_name_nominee']) ?></td>
										<td><?= htmlspecialchars($row['cus_comment']) ?></td>
										<td><span class="badge badge-info">Pending</span></td>
										<td><?= htmlspecialchars($row['policy_name']) ?></td>
										<td>
											<button data-toggle="modal" data-target="#claimDetailsModal" type="button"
												class="btn btn-primary btn-sm view-claim" data-claim-id="<?= $row['id'] ?>">
												<i class="icon-copy fa fa-eye"></i>
											</button>
											<button type="button" class="btn btn-success btn-sm update-status"
												data-claim-id="<?= $row['id'] ?>" data-status="2">
												<i class="ti-check"></i>
											</button>
											<button type="button" class="btn btn-danger btn-sm reject-status"
												data-claim-id="<?= $row['id'] ?>">
												<i class="ti-close"></i>
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

	<!-- View Modal -->
	<div class="modal fade bs-example-modal-lg" id="claimDetailsModal" tabindex="-1" role="dialog"
		aria-labelledby="claimDetailsModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="claimDetailsModalLabel">Claim Details</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<!-- claim details loaded here -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Reject Comment Modal -->
	<div class="modal fade" id="rejectCommentModal" tabindex="-1" role="dialog"
		aria-labelledby="rejectCommentModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="rejectCommentModalLabel">Reject Claim</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<form id="rejectForm">
					<div class="modal-body">
						<input type="hidden" name="id" id="rejectClaimId">
						<div class="form-group">
							<label>Reason for rejection</label>
							<textarea name="admin_comment" class="form-control" required></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-danger">Reject</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php include_once '../includes/footer.php'; ?>

	<script>
		$(document).ready(function () {

			let claimIdToApprove = null;  // Store the claim id to approve on confirmation

			// View claim details in modal
			$('.view-claim').on('click', function () {
				const claimId = $(this).data('claim-id');
				$.post('../ajax/get_claim_details.php', { id: claimId }, function (data) {
					$('#claimDetailsModal .modal-body').html(data);
				});
			});

			// When approve button clicked, show confirmation modal
			$('.update-status').on('click', function () {
				claimIdToApprove = $(this).data('claim-id');
				$('#confirmApprovalModal').modal('show');
			});

			// When confirm approval clicked inside modal
			$('#approvalConfirmBtn').on('click', function () {
				if (!claimIdToApprove) {
					$('#confirmApprovalModal').modal('hide');
					showStatusModal('Invalid claim ID.');
					return;
				}

				$.post('../ajax/update_claim_status.php', { id: claimIdToApprove, status: 2 })
					.done(function (response) {
						$('#confirmApprovalModal').modal('hide');
						showStatusModal(response);
					})
					.fail(function () {
						$('#confirmApprovalModal').modal('hide');
						showStatusModal('Error updating claim status. Please try again.');
					});
			});

			// Trigger reject comment modal
			$('.reject-status').on('click', function () {
				const claimId = $(this).data('claim-id');
				$('#rejectClaimId').val(claimId);
				$('#rejectCommentModal').modal('show');
			});

			// Submit rejection with comment
			$('#rejectForm').on('submit', function (e) {
				e.preventDefault();
				const formData = $(this).serialize() + '&status=3';
				$.post('../ajax/update_claim_status.php', formData, function (response) {
					$('#rejectCommentModal').modal('hide');
					showStatusModal(response);
				}).fail(function () {
					$('#rejectCommentModal').modal('hide');
					showStatusModal('Error updating claim status. Please try again.');
				});
			});

			// Reusable modal function to show status messages
			function showStatusModal(message) {
				$('#statusModalBody').html(message);
				$('#statusModal').modal('show');
			}
		});
	</script>