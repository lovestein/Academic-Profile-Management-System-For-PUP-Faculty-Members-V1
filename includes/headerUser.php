<?php
session_start();
include 'connection.php';
date_default_timezone_set('Asia/Manila');

if ($page_title == "My Profile" && (!isset($_SESSION['auth']) || $_SESSION['auth_user_type'] != "User")) {
    header("Location: ./index.php");
    exit(0);
} else if ((isset($_SESSION['auth']) && $_SESSION['auth_user_type'] == "User") && $page_title == "Home") {
    
    header("Location: ./profile.php");
    exit(0);
}
 else if ((isset($_SESSION['auth']) && $_SESSION['auth_user_type'] == "Admin") && $page_title == "Home") {
    header("Location: ./admin.php");
    exit(0);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./modules/main.css">
    <link rel="stylesheet" href="./modules/custom.css">
    <title><?php echo $page_title; ?> | PUP Profiles</title>
</head>

<body>

    <?php if ($page_title == "Home" || $page_title == "Update Password") : ?>
        <!-- Home Navbar -->
        <nav class="navbar fixed-top navbar-expand-md navbar-light" style="background-color: rgb(255,255,255,0.5);" style="z-index: -1;">
            <div class="container-fluid">
                <a href="" class="navbar-brand align-items-center">
                    <span class="text-primary fw-bold fs-2">
                        <img src="./assets/images/PUP-Logo.png" alt="" class="img-fluid mh-100 d-inline-block" style="height: 40px;">
                        PUP | Profiles
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse justify-content-center align-center" id="main-nav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item px-3">
                            <a href="" class="nav-link" disabled></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Background Image -->
        <img id="backgroundImage" src="./assets/images/PUP-Background.png" alt="" class="bg-img img-fluid d-none">
    <?php else : ?>
        <!-- User Navbar -->
        <nav id="navBar" class="navbar navbar-expand-md navbar-light border-bottom">
            <div class="container-fluid">
                <a href="" class="navbar-brand align-items-center">
                    <span class="text-primary fs-2 fw-bold">
                        <img src="./assets/images/PUP-Logo.png" alt="" class="img-fluid mh-100 d-inline-block" style="height: 40px;">
                        PUP | Profiles
                    </span>
                </a>
                <!-- Toggle button for mobile nav -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse justify-content-center align-center" id="main-nav">
                    <ul class="navbar-nav text-center ms-auto">
                        <?php if (isset($_SESSION['auth_user']) && $_SESSION['auth_user_type'] == "User") : ?>
                            <li class="nav-item dropdown text-primary fw-bold">
                                <?php 
                                $user_id = $_SESSION['auth_user']['user_id'];
                                $sql = "SELECT * FROM `user_profiles` WHERE `user_id` = '$user_id'";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                  $data = mysqli_fetch_assoc($result);
                                  $user_id = $data['user_id'];
                                  $user_name = $data['user_name'];
                                  $user_image = $data['user_image'];
                                  $user_faculty_rank = $data['user_faculty_rank'];
                                }
                                ?>
                                <button class="btn bg-transparent border-0 nav-link w-100" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-flex align-items-center" id="userNavbarDetails">
                                        <span>
                                            <img src="./images/profilePictures/<?= $user_image ?>" class="img-fluid mh-100 d-inline-block rounded-circle border border-2 border-primary m-1" style="height: 35px; width: 35px; object-fit:cover;">
                                        </span>
                                        <span class="text-start ms-2 text-primary">
                                            <?= $user_name ?>
                                            <small class="d-block text-muted tex-start p-0 m-0" style="font-size: 10px;">
                                                <?= $user_faculty_rank ?>
                                            </small>
                                        </span>
                                    </span>
                                </button>
                                <div class="dropdown-menu" style="z-index: 9999;">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <span class="icon-user-circle-o mx-2"></span>
                                        <a href="./profile.php" class="dropdown-item px-0">My Profile</a>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <span class="icon-cog mx-2"></span>
                                        <a href="./settings.php" class="dropdown-item px-0">Settings</a>
                                    </div>
                                    <button id="logoutButton" class="dropdown-item border-top" type="submit" name="logoutButton">Log Out</button>
                                </div>
                            </li>
                        <?php else : ?>
                            <li class="nav-item px-3 bg-primary rounded-3">
                                <a href="./index.php" class="nav-link fw-bold text-white"><span class="icon-user-circle-o me-2"></span>Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <!-- Alert Message -->
    <div id="alert" class="toast position-absolute top-0 end-0" style="margin-top: 80px; margin-right: 5px; z-index: 1;">
        <div class="d-flex">
            <div id="alertMessage" class="toast-body">

            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>