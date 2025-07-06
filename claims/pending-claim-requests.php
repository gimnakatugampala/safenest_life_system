<?php
include_once '../includes/header.php';
include_once '../includes/sub_header.php';
include_once '../includes/sidebar.php';
include_once '../includes/db_connection.php'; // ✅ Correct path

?>

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
		<button data-toggle="modal" data-target="#bd-example-modal-lg" type="button" class="btn btn-primary btn-sm view-claim" data-claim-id="<?= $row['id'] ?>">
			<i class="icon-copy fa fa-eye"></i>
		</button>
		<button type="button" class="btn btn-success btn-sm update-status" data-claim-id="<?= $row['id'] ?>" data-status="2">
			<i class="ti-check"></i>
		</button>
		<button type="button" class="btn btn-danger btn-sm update-status" data-claim-id="<?= $row['id'] ?>" data-status="3">
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

<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Claim Details</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body"></div>
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
		});
	});

	$('.update-status').on('click', function () {
		const claimId = $(this).data('claim-id');
		const status = $(this).data('status');
		const confirmText = status == 2 ? 'Approve' : 'Reject';
		if (confirm(`Are you sure to ${confirmText} this claim?`)) {
			$.post('../ajax/update_claim_status.php', { id: claimId, status: status }, function (response) {
				alert(response);
				location.reload();
			});
		}
	});
});
</script>
