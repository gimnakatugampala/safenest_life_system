<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Sanitize session data
$userEmail = htmlspecialchars($_SESSION['user_email'] ?? 'User');
$userName = htmlspecialchars($_SESSION['user_name'] ?? 'User');

// Define base URL of your system (adjust if hosted elsewhere)
$baseURL = 'http://localhost/safenest_life_system/';

// Default image URL (fallback)
$defaultImage = $baseURL . 'vendors/images/photo1.jpg';

// Get image path from session (relative to project root)
$userImageFromSession = $_SESSION['user_image'] ?? '';

// Check physical file existence on server
$physicalImagePath = $_SERVER['DOCUMENT_ROOT'] . '/safenest_life_system/' . ltrim($userImageFromSession, '/');

// If image is valid and exists, prepend base URL to get full web path
if (!empty($userImageFromSession) && file_exists($physicalImagePath)) {
    $userImage = $baseURL . ltrim($userImageFromSession, '/');
} else {
    $userImage = $defaultImage;
}
?>

<!-- HTML HEADER -->
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
                                <label class="col-sm-12 col-md-2 col-form-label">From</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="date" name="from" class="form-control form-control-sm form-control-line">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">To</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="date" name="to" class="form-control form-control-sm form-control-line">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="text" name="subject" class="form-control form-control-sm form-control-line">
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
        <!-- Settings -->
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>

        <!-- Notifications -->
        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-copy dw dw-notification"></i>
                    <span class="badge notification-active"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" style="width: 300px;">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#">
                                    <img src="<?= $baseURL ?>vendors/images/img.jpg" alt="John Doe" class="rounded-circle" width="40" height="40">
                                    <h3>John Doe</h3>
                                    <p>Lorem ipsum dolor sit amet...</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- User profile dropdown -->
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-top: 4px; padding-bottom: 4px;">
                    <span class="user-icon mr-2" style="display: flex; align-items: center;">
                        <img src="<?= htmlspecialchars($userImage) ?>" alt="User Image" 
                             style="width:55px; height:55px; object-fit: cover; border-radius: 50%; display: block; margin-top: -4px;" />
                    </span>
                    <span class="user-name" style="line-height: 60px;"><?= $userEmail ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../profile/"><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="../auth/logout.php"><i class="dw dw-logout"></i> Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Required JS for dropdowns -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
