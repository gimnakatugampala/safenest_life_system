<?php

include_once '../includes/header.php';
include_once '../includes/sub_header.php';
include_once '../includes/sidebar.php';
include_once '../includes/db_connection.php';

if (!isset($_SESSION['user_id'])) {
	die("Unauthorized access.");
}
$user_id = $_SESSION['user_id'];
?>

<body>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Add Claim Request</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Manage Claims</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add Claim Request</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="card-box mb-30">
					<div class="pd-20">
						<form class="row" method="POST" action="../ajax/submit_claim.php" enctype="multipart/form-data">

							<div class="col-md-6">
								<div class="form-group">
									<label>Select Policy</label>
									<select class="custom-select" name="policy_id" required>
										<option value="" selected disabled>Choose...</option>
										<?php
										$stmt = $conn->prepare("
				SELECT ul.id AS user_policy_id, l.policy_name
				FROM user_life_policy ul
				INNER JOIN life_policy l ON ul.life_policy_id = l.id
				WHERE ul.status_id = 2 AND ul.is_paid = 1 AND ul.gup_id = ?
			");
										$stmt->bind_param("i", $user_id);
										$stmt->execute();
										$result = $stmt->get_result();

										while ($row = $result->fetch_assoc()):
											$policyId = $row['user_policy_id'];
											$policyName = htmlspecialchars($row['policy_name']);
											?>
											<option value="<?= $policyId ?>"><?= $policyId ?> - <?= $policyName ?></option>
										<?php endwhile;
										$stmt->close(); ?>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Amount</label>
									<input class="form-control" type="number" name="amount" required min="1"
										placeholder="Amount">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label>Comment</label>
									<textarea class="form-control" name="comment" required
										placeholder="Add your comment here..."></textarea>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Prescriptions <span class="text-danger">*</span></label>
									<input type="file" name="prescription" class="form-control-file"
										accept=".pdf,.jpg,.jpeg,.png" required>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Bills & Cash Receipts <span class="text-danger">*</span></label>
									<input type="file" name="bills" class="form-control-file"
										accept=".pdf,.jpg,.jpeg,.png" required>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Diagnosis Ticket (If Available)</label>
									<input type="file" name="diagnosis" class="form-control-file"
										accept=".pdf,.jpg,.jpeg,.png">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Other Files (If Available)</label>
									<input type="file" name="other" class="form-control-file"
										accept=".pdf,.jpg,.jpeg,.png">
								</div>
							</div>

							<div class="col-md-12 text-right">
								<button type="reset" class="btn btn-secondary">Clear</button>
								<button type="submit" class="btn btn-primary">Submit Claim Request</button>
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>
	</div>

	<?php include_once '../includes/footer.php'; ?>