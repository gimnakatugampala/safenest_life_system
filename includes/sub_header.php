<?php
// Start session if not started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure user is logged in, else redirect (optional)
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Grab user info from session safely
$userEmail = htmlspecialchars($_SESSION['user_email'] ?? 'User');
$userName = htmlspecialchars($_SESSION['user_name'] ?? 'User'); // If you have user_name
$userImage = $_SESSION['user_image'] ?? '../vendors/images/photo1.jpg'; // Default avatar path
?>

<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>

        <div class="header-search">
            <form method="get" action="../search_results.php" class="position-relative">
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input type="text" name="q" class="form-control search-input" placeholder="Search Here" aria-label="Search" autocomplete="off" required>

                    <div class="dropdown">
                        <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ion-arrow-down-c"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-3" style="min-width: 300px;">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="search-from">From</label>
                                <div class="col-sm-12 col-md-10">
                                    <input id="search-from" name="from" type="date" class="form-control form-control-sm form-control-line" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="search-to">To</label>
                                <div class="col-sm-12 col-md-10">
                                    <input id="search-to" name="to" type="date" class="form-control form-control-sm form-control-line" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="search-subject">Subject</label>
                                <div class="col-sm-12 col-md-10">
                                    <input id="search-subject" name="subject" type="text" class="form-control form-control-sm form-control-line" />
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="header-right">
        <!-- Settings button (example) -->
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar" aria-label="Settings">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>

        <!-- Notifications dropdown -->
        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Notifications">
                    <i class="icon-copy dw dw-notification"></i>
                    <span class="badge notification-active"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" style="width: 300px;">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul class="list-unstyled mb-0">
                            <!-- Example notification items - replace with dynamic content -->
                            <li>
                                <a href="#">
                                    <img src="../vendors/images/img.jpg" alt="John Doe" class="rounded-circle" width="40" height="40">
                                    <h3>John Doe</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                </a>
                            </li>
                            <!-- Add more notifications here -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- User profile dropdown -->
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center" href="#" role="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="user-icon mr-2">
                        <img src="<?= htmlspecialchars($userImage) ?>" alt="User Image" class="rounded-circle" width="40" height="40">
                    </span>
                    <span class="user-name"><?= $userEmail ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../profile/"><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="../auth/logout.php"><i class="dw dw-logout"></i> Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
  Notes:
  - Make sure to include Bootstrap's JS + jQuery for dropdowns to work.
  - Adjust notification and search form actions as needed.
  - For logout, point the link to your logout.php script that destroys session.
-->
