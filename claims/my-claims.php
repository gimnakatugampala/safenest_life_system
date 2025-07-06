<?php

include_once '../includes/header.php';
include_once '../includes/sub_header.php';
include_once '../includes/sidebar.php';
include_once '../includes/db_connection.php';

// Check user login
$userId = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;

if (!$userId) {
	echo "<script>alert('User not logged in.'); window.location.href = '../auth/login.php';</script>";
	exit;
}
?>

<body>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>My Claims</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Manage Claims</a></li>
									<li class="breadcrumb-item active" aria-current="page">My Claims</li>
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
									<th>Requested Date</th>
									<th>Comment</th>
									<th>Status</th>
									<th>Policy</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query = "SELECT c.*, c.created_at, p.full_name_nominee, g.first_name, g.last_name, l.policy_name, s.status 
                                    FROM claim c
                                    LEFT JOIN policy_application_form p ON c.policy_application_form_id = p.id
                                    LEFT JOIN user_life_policy ul ON p.user_life_policy_life_policy_id = ul.id
                                    LEFT JOIN general_user_profile g ON ul.gup_id = g.id
                                    LEFT JOIN life_policy l ON ul.life_policy_id = l.id
                                    LEFT JOIN status s ON c.status_id = s.id
                                    WHERE g.id = ?
                                    ORDER BY c.id DESC";

								$stmt = $conn->prepare($query);
								if ($stmt === false) {
									// Prepare failed, show error
									echo '<tr><td colspan="9" class="text-danger">Database error. Please try again later.</td></tr>';
								} else {
									$stmt->bind_param("i", $userId);
									$stmt->execute();
									$result = $stmt->get_result();

									if ($result->num_rows === 0) {
										echo '<tr><td colspan="9" class="text-center">No claims found.</td></tr>';
									} else {
										while ($row = $result->fetch_assoc()):
											$statusLower = strtolower($row['status']);
											$badgeClass = 'info';
											if ($statusLower === 'approved') {
												$badgeClass = 'success';
											} elseif ($statusLower === 'rejected') {
												$badgeClass = 'danger';
											}
											?>
											<tr>
												<td><?= htmlspecialchars($row['code']) ?></td>
												<td><?= htmlspecialchars(number_format((float) $row['req_amount'], 2)) ?></td>
												<td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
												<td><?= htmlspecialchars($row['full_name_nominee']) ?></td>
												<td><?= !empty($row['created_at']) ? htmlspecialchars(date('Y-m-d', strtotime($row['created_at']))) : 'N/A' ?>
												</td>
												<td><?= htmlspecialchars($row['cus_comment']) ?></td>
												<td><span
														class="badge badge-pill badge-<?= $badgeClass ?>"><?= htmlspecialchars($row['status']) ?></span>
												</td>
												<td><?= htmlspecialchars($row['policy_name']) ?></td>
												<td>
													<button data-toggle="modal" data-target="#bd-example-modal-lg" type="button"
														class="btn btn-primary btn-sm view-claim" data-claim-id="<?= (int) $row['id'] ?>">
														<i class="icon-copy fa fa-eye"></i>
													</button>
												</td>
											</tr>
											<?php
										endwhile;
									}
									$stmt->close();
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog"
		aria-labelledby="claimDetailsLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="claimDetailsLabel">Claim Details</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- AJAX claim detail will load here -->
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
					$('#bd-example-modal-lg .modal-body').html(data);
				}).fail(function () {
					$('#bd-example-modal-lg .modal-body').html('<p class="text-danger">Unable to load claim details. Please try again later.</p>');
				});
			});
		});
	</script>