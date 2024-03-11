<?php
session_start();
include 'connection.php';
date_default_timezone_set('Asia/Manila');
if (!$_SESSION['auth'] || $_SESSION['auth_user_type'] != "Admin") {
    header("Location: ./index.php");
    exit(0);
}
$user_name = $_SESSION['auth_user']['user_name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../admin/plugins/jqvmap/jqvmap.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../admin/plugins/summernote/summernote-bs4.min.css">
    <!-- Data Table -->
    <link rel="stylesheet" href="../admin/datatables/datatables.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="../modules/main.css">
    <link rel="stylesheet" href="../modules/custom.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Wrapper -->
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav justify-content-center text-center d-flex ms-auto">
                <li class="nav-item fw-bold">
                    Admin Dashboard
                </li>
            </ul>
            <ul class="navbar-nav ms-auto"></ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <div class="brand-link text-decoration-none">
                <img src="../assets/images/PUP-Logo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text fw-bold text-primary">PUP Profiles</span>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../images/profilePictures/sample-profile.jpg" class="img-circle elevation-2" style="height: 30px; width: 30px;">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block text-decoration-none"><?= $user_name ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column h-100" data-widget="treeview" role="menu" data-accordion="false">

                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="../pages/admin.php" class="nav-link text-bg-primary">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <!-- User Details -->
                        <li class="nav-item">
                            <a href="#" class="nav-link text-bg-primary">
                                <i class="nav-icon icon-group"></i>
                                <p>
                                    User Details
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <!-- Academic Appointments -->
                                <li class="nav-item">
                                    <a href="../pages/academicAppointments.php" class="nav-link">
                                        <p>Academic Appointments</p>
                                    </a>
                                </li>
                                <!-- Honors & Awards -->
                                <li class="nav-item">
                                    <a href="../pages/honorsAwards.php" class="nav-link">
                                        <p>Honors & Awards</p>
                                    </a>
                                </li>
                                <!-- Administrative Appointments -->
                                <li class="nav-item">
                                    <a href="../pages/adminitrativeAppointments.php" class="nav-link">
                                        <p>Administrative Appointments</p>
                                    </a>
                                </li>
                                <!-- Other Accounts -->
                                <li class="nav-item">
                                    <a href="../pages/otherAccounts.php" class="nav-link">
                                        <p>Other Accounts</p>
                                    </a>
                                </li>
                                <!-- Research Interests -->
                                <li class="nav-item">
                                    <a href="../pages/researchInterests.php" class="nav-link">
                                        <p>Research Interests</p>
                                    </a>
                                </li>
                                <!-- PUP Advisees -->
                                <li class="nav-item">
                                    <a href="../pages/pupAdvisees.php" class="nav-link">
                                        <p>PUP Advisees</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <!-- News Feed -->
                        <li class="nav-item">
                            <a href="../pages/timelinePosts.php" class="nav-link text-bg-primary">
                                <i class="nav-icon fas icon-newspaper-o"></i>
                                <p>
                                    Timeline Posts
                                </p>
                            </a>
                        </li>

                        <!-- Publications -->
                        <li class="nav-item">
                            <a href="#" class="nav-link text-bg-primary">
                                <i class="nav-icon fas fa-book-open"></i>
                                <p>
                                    Publications
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <!-- Books -->
                                <li class="nav-item">
                                    <a href="../pages/books.php" class="nav-link">
                                        <p>Books</p>
                                    </a>
                                </li>
                                <!-- Research Papers/Reports -->
                                <li class="nav-item">
                                    <a href="../pages/publications.php" class="nav-link">
                                        <p>Research Papers/Reports</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Courses -->
                        <li class="nav-item">
                            <a href="#" class="nav-link text-bg-primary">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>
                                    Materials
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <!-- Access Codes -->
                                <li class="nav-item">
                                    <a href="../pages/courses.php" class="nav-link">
                                        <p>Courses</p>
                                    </a>
                                </li>
                                <!-- Access Codes -->
                                <li class="nav-item">
                                    <a href="../pages/accessCodes.php" class="nav-link">
                                        <p>Access Codes</p>
                                    </a>
                                </li>
                                <!-- Lecture Materials -->
                                <li class="nav-item">
                                    <a href="../pages/lectureMaterials.php" class="nav-link">
                                        <p>Lecture Materials</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Extensions -->
                        <li class="nav-item">
                            <a href="../pages/extensions.php" class="nav-link text-bg-primary">
                                <i class="nav-icon fas fa-handshake"></i>
                                <p>
                                    Extensions
                                </p>
                            </a>
                        </li>

                    </ul>

                    <!-- Logout -->
                    <ul class="nav nav-pills nav-sidebar flex-column bottom-0 position-absolute">
                        <li class="nav-item">
                            <div id="logoutAdmin" class="nav-link text-bg-secondary" style="cursor: pointer;">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>
                                    Logout
                                </p>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>