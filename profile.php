<?php
$page_title = "My Profile";
include './includes/headerUser.php';

// User ID
$user_id = $_SESSION['auth_user']['user_id'];
$sql = "SELECT * FROM `user_profiles` WHERE `user_id` = '$user_id' AND `user_type` = 'User'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $user_name = $data['user_name'];
    $user_honorifics = $data['user_honorifics'];
    $user_image = $data['user_image'];
    $user_faculty_rank = $data['user_faculty_rank'];
    $user_college = $data['user_college'];
    $user_contactno = $data['user_contactno'];
    $user_email = $data['user_email'];
}

?>

<!-- Profile Header -->
<section>
    <div class="card m-3 shadow-lg rounded-4 border-0" style="background-image: url(./assets/images/Profile-Image-Background.png); background-size:cover; background-repeat: no-repeat; background-position: center;">
        <div class="row g-0 align-items-center text-white">
            <div class="col-md-2 col-sm-12 text-center">
                <img src="./images/profilePictures/<?= $user_image ?>" class="img-fluid shadow-lg profile-img border border-5 border-primary">
            </div>
            <div class="col-md-7 text-center text-md-start">
                <div class="card-body m-2">
                    <!-- Teacher Name -->
                    <?php if ($user_honorifics !== "") : ?>
                        <h5 class="card-title fw-bold display-6">
                            <?= $user_name ?> , <?= $user_honorifics ?>
                        </h5>
                    <?php else : ?>
                        <h5 class="card-title fw-bold display-6">
                            <?= $user_name ?>
                        </h5>
                    <?php endif; ?>
                    <p class="card-text fw-bold fs-4"><?= $user_faculty_rank ?> <br><?= $user_college ?></p>
                </div>
            </div>
            <div class="col-md-3 text-center text-md-start">
                <div class="card-body">
                    <h4 class="card-title fw-bold">Contacts</h4>
                    <!-- Teacher Contact Number -->
                    <a href="tel:+<?= $user_contactno ?>" class="card-text fs-5 link-light text-decoration-none d-flex align-items-center">
                        <span class="icon-phone me-2 text-primary fw-bold"></span>+63 - <?= $user_contactno ?>
                    </a>
                    <!-- Teacher Email Address -->
                    <a href="mailto:<?= $user_email ?>" class="card-text fs-5 link-light text-decoration-none d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Click this to send an e-mail to this faculty member.">
                        <span class="icon-envelope me-2 text-primary fw-bold"></span><?= $user_email ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profile Sections -->
<section>
    <div class="container-fluid">
        <!-- Button Tabs -->
        <ul class="nav nav-pills fs-5 p-1 m-1 fw-bold justify-content-center gap-3 nav-justified flex-column flex-sm-row border-3 border-bottom border-primary" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="timeline-tab" data-bs-toggle="tab" data-bs-target="#timeline-tab-pane" type="button" role="tab" aria-controls="timeline-tab-pane" aria-selected="false">Timeline</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="publications-tab" data-bs-toggle="tab" data-bs-target="#publications-tab-pane" type="button" role="tab" aria-controls="publications-tab-pane" aria-selected="false">Selected Publications</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="extensions-tab" data-bs-toggle="tab" data-bs-target="#extensions-tab-pane" type="button" role="tab" aria-controls="extensions-tab-pane" aria-selected="false">Extensions</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="courses-tab" data-bs-toggle="tab" data-bs-target="#courses-tab-pane" type="button" role="tab" aria-controls="courses-tab-pane" aria-selected="false">Courses</button>
            </li>
        </ul>

        <!-- Sections Contents -->
        <div class="tab-content" id="myTabContent">
            <!-- Bio/Profile Content -->
            <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <?php include './profile/profile.php'; ?>
            </div>

            <!-- Timeline Content -->
            <div class="tab-pane fade" id="timeline-tab-pane" role="tabpanel" aria-labelledby="timeline-tab" tabindex="0">
                <?php include './profile/timeline.php'; ?>
            </div>

            <!-- Selected Publications Content -->
            <div class="tab-pane fade" id="publications-tab-pane" role="tabpanel" aria-labelledby="publications-tab" tabindex="0">
                <?php include './profile/publications.php'; ?>
            </div>

            <!-- Extensions Content -->
            <div class="tab-pane fade" id="extensions-tab-pane" role="tabpanel" aria-labelledby="extensions-tab" tabindex="0">
                <?php include './profile/extensions.php'; ?>
            </div>

            <!-- Courses -->
            <div class="tab-pane fade" id="courses-tab-pane" role="tabpanel" aria-labelledby="courses-tab" tabindex="0">
                <?php include './profile/courses.php'; ?>
            </div>

        </div>
    </div>
</section>


<?php
include './includes/footerUser.php';
?>