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
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Add Policy</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Policies</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add Policy</li>
								</ol>
							</nav>
						</div>
					
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<!-- <div class="clearfix">
						<h4 class="text-blue h4">Step wizard</h4>
						<p class="mb-30">jQuery Step wizard</p>
					</div> -->

					<div class="row">

					<div class="col-md-12 col-sm-12"><label>Images</label></div>
					<div class="col-md-4 col-sm-12 mb-3">

					<form class="dropzone" action="#" id="my-awesome-dropzone">
						<div class="fallback">
							<input type="file" name="file" />
						</div>
					</form>
					</div>

					<div class="col-md-4 col-sm-12 mb-3">
					<form class="dropzone" action="#" id="my-awesome-dropzone">
						<div class="fallback">
							<input type="file" name="file" />
						</div>
					</form>
					</div>

					<div class="col-md-4 col-sm-12 mb-3">
					<form class="dropzone" action="#" id="my-awesome-dropzone">
						<div class="fallback">
							<input type="file" name="file" />
						</div>
					</form>
					</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
							<label>Policy Name</label>
							<input class="form-control" type="text" >
						</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
							<label>Policy Term (Years)</label>
							<input class="form-control" type="number" >
						</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
							<label>Premium Amount</label>
							<input class="form-control" type="number" >
						</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
							<label>Coverage Amount</label>
							<input class="form-control" type="number" >
						</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
							<label>Eligibility (Min Age)</label>
							<input class="form-control" type="number" >
						</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
							<label>Eligibility (Max Age)</label>
							<input class="form-control" type="number" >
						</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<div class="form-group">
							<label>Description / Details</label>
							<textarea class="form-control"></textarea>
						</div>
						</div>

						<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label>Benefits & Features</label>
							<ul id="benefits-list" class="list-unstyled">
								<li class="d-flex mb-2">
									<input type="text" name="benefits[]" class="form-control me-2" placeholder="Enter a benefit">
									<button type="button" class="btn btn-danger btn-sm" onclick="removeBenefit(this)"><i class="icon-copy ion-close"></i></button>
								</li>
							</ul>
							<button type="button" class="btn btn-primary btn-sm" onclick="addBenefit()"><i class="icon-copy ion-plus-round"></i></button>
						</div>
					</div>

					
					<div class="col-md-12 text-center">
						<button type="button" class="btn btn-primary">Add Policy</button>
					</div>
					


					</div>

				</div>

				

				<!-- success Popup html Start -->
				<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-body text-center font-18">
								<h3 class="mb-20">Form Submitted!</h3>
								<div class="mb-30 text-center"><img src="../vendors/images/success.png"></div>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							</div>
							<div class="modal-footer justify-content-center">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
							</div>
						</div>
					</div>
				</div>
				<!-- success Popup html End -->
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				
			</div>
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



	<?php include_once '../includes/footer.php'; ?>
