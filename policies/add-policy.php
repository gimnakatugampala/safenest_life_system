<?php
include_once '../includes/header.php';
include_once '../includes/db_connection.php';
?>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/deskapp-logo.svg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">Loading...</div>
		</div>
	</div>

	<?php include_once '../includes/sub_header.php'; ?>
	<?php include_once '../includes/sidebar.php'; ?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Add Policy</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="../policies/">Policies</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add Policy</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<form id="formPolicy" action="../ajax/submit_policy.php" method="POST"
						enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12 col-sm-12"><label>Images</label></div>
							<?php for ($i = 0; $i < 3; $i++): ?>
								<div class="col-md-4 col-sm-12 mb-3">
									<input type="file" name="images[]" accept="image/*" required>
								</div>
							<?php endfor; ?>

							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Policy Name</label>
									<input class="form-control" type="text" name="policy_name" required>
								</div>
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Policy Term (Years)</label>
									<input class="form-control" type="number" name="term_years" required>
								</div>
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Premium Amount</label>
									<input class="form-control" type="number" name="premium_amount" required>
								</div>
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Coverage Amount</label>
									<input class="form-control" type="number" name="coverage_amount" required>
								</div>
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Eligibility (Min Age)</label>
									<input class="form-control" type="number" name="min_age" required>
								</div>
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Eligibility (Max Age)</label>
									<input class="form-control" type="number" name="max_age" required>
								</div>
							</div>

							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<label>Description / Details</label>
									<textarea class="form-control" name="description" required></textarea>
								</div>
							</div>

							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<label>Select Cover</label>
									<div class="d-flex">
										<select class="custom-select me-2" id="coverDropdown">
											<option value="" disabled selected>Choose cover...</option>
											<?php
											$coverResult = $conn->query("SELECT id, cover_code, cover_name FROM covers ORDER BY cover_name ASC");
											while ($cover = $coverResult->fetch_assoc()):
												?>
												<option value="<?= $cover['id'] ?>">
													<?= htmlspecialchars($cover['cover_code']) ?> -
													<?= htmlspecialchars($cover['cover_name']) ?>
												</option>
											<?php endwhile; ?>
										</select>
										<button type="button" class="btn btn-primary" onclick="addCoverToPolicy()"
											title="Add Cover">
											<i class="icon-copy ion-plus-round"></i>
										</button>
									</div>
									<small class="form-text text-muted">You can add multiple covers one-by-one.</small>
								</div>

								<!-- Selected Covers List -->
								<div class="form-group">
									<label>Selected Covers</label>
									<ul id="selected-covers" class="list-group">
										<!-- Dynamically added covers will appear here -->
									</ul>
								</div>
							</div>


							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<label>Benefits</label>
									<ul id="benefits-list" class="list-unstyled">
										<li class="d-flex mb-2">
											<input type="text" name="benefits[]" class="form-control me-2"
												placeholder="Enter a benefit">
											<button type="button" class="btn btn-danger btn-sm"
												onclick="removeBenefit(this)"><i
													class="icon-copy ion-close"></i></button>
										</li>
									</ul>
									<button type="button" class="btn btn-primary btn-sm" onclick="addBenefit()"><i
											class="icon-copy ion-plus-round"></i></button>
								</div>
							</div>

							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-primary">Add Policy</button>
							</div>
						</div>
					</form>
				</div>

				<div class="modal fade" id="success-modal" tabindex="-1" role="dialog"
					aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-body text-center font-18">
								<h3 class="mb-20">Form Submitted!</h3>
								<div class="mb-30 text-center"><img src="../vendors/images/success.png"></div>
								Your policy has been successfully added.
							</div>
							<div class="modal-footer justify-content-center">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box"></div>
		</div>
	</div>

	<script>
		function addBenefit() {
			const ul = document.getElementById("benefits-list");
			const li = document.createElement("li");
			li.className = "d-flex mb-2";
			li.innerHTML = `
			  <input type="text" name="benefits[]" class="form-control me-2" placeholder="Enter a benefit">
			  <button type="button" class="btn btn-danger btn-sm" onclick="removeBenefit(this)"><i class="icon-copy ion-close"></i></button>
			`;
			ul.appendChild(li);
		}

		function removeBenefit(button) {
			const li = button.parentElement;
			li.remove();
		}
	</script>

	<script src="../scripts/add_policy.js"></script>

	<script>
		const coverDropdown = document.getElementById("coverDropdown");
		const selectedCoversList = document.getElementById("selected-covers");

		function addCoverToPolicy() {
			const selectedOption = coverDropdown.options[coverDropdown.selectedIndex];
			const coverId = selectedOption.value;
			const coverText = selectedOption.text;

			if (!coverId || document.getElementById("cover-li-" + coverId)) return;

			// Add to list
			const li = document.createElement("li");
			li.className = "list-group-item d-flex justify-content-between align-items-center";
			li.id = "cover-li-" + coverId;
			li.innerHTML = `
			<span>${coverText}</span>
			<input type="hidden" name="covers[]" value="${coverId}">
			<button type="button" class="btn btn-sm btn-danger" onclick="removeCover(${coverId})">
				<i class="ion-close"></i>
			</button>
		`;
			selectedCoversList.appendChild(li);
		}

		function removeCover(coverId) {
			const li = document.getElementById("cover-li-" + coverId);
			if (li) li.remove();
		}
	</script>

	<?php include_once '../includes/footer.php'; ?>