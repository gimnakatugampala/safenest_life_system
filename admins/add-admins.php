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
                <h4>Admins</h4>
              </div>
              <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Manage Admins</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Admins</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <!-- horizontal Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
          <form id="adminForm" class="row" novalidate>
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="first_name">First Name*</label>
                <input class="form-control" type="text" id="first_name" name="first_name" placeholder="Johnny" required>
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="last_name">Last Name*</label>
                <input class="form-control" type="text" id="last_name" name="last_name" placeholder="Brown" required>
              </div>
            </div>

            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="email">Email*</label>
                <input class="form-control" type="email" id="email" name="email" placeholder="example@gmail.com" required>
              </div>
            </div>

            <div class="col-sm-12 col-md-12" id="password-group">
              <div class="form-group">
                <label for="password">Password*</label>
                <div class="input-group">
                  <input class="form-control" type="password" id="password" name="password" required minlength="8">
                  <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword('password', this)">
                      <i class="fa fa-eye"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-12 col-md-12" id="confirm-password-group">
              <div class="form-group">
                <label for="confirm_password">Confirm Password*</label>
                <div class="input-group">
                  <input class="form-control" type="password" id="confirm_password" name="confirm_password" required minlength="8">
                  <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword('confirm_password', this)">
                      <i class="fa fa-eye"></i>
                    </span>
                  </div>
                </div>
                <div class="form-control-feedback text-danger" id="passwordError" style="display:none;">
                  Passwords do not match.
                </div>
              </div>
            </div>

            <div class="col-sm-12 col-md-12">
              <button type="submit" class="btn btn-primary btn-lg pull-right">Add Admin</button>
            </div>
          </form>
        </div>
        <!-- horizontal Basic Forms End -->

      </div>
      <div class="footer-wrap pd-20 mb-20 card-box"></div>
    </div>
  </div>

  <script src="../scripts/add_admins.js"></script>
  <?php include_once '../includes/footer.php'; ?>
