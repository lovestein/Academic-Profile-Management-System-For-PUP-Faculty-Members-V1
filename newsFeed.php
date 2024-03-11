<?php
$page_title = "News Feed";
include '../includes/headerUser.php';
?>
<!-- Page Contents -->
<div class="container-fluid">
    <div class="row justify-content-center mt-3">
        <!-- Profile Thumnail/College Filter -->
        <div class="col-lg-3 mb-3">
            <!-- If User is logged in, display profile thumbnail -->
            <?php if (isset($_SESSION['auth_user'])  && $_SESSION['auth_user_type'] == "User") : ?>
                <div class="card card-widget widget-user shadow my-3 rounded-4 border-0 d-none d-md-block">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background: url('../assets/images/Profile-Image-Background.png') center center;">
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle rounded-circle border border-3 border-primary" src="../images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="User Avatar">
                    </div>
                    <div class="card-footer rounded-bottom-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="description-block mt-2 text-center">
                                    <h3 class="w-100 text-center mb-0 mt-0 text-primary"><?= $_SESSION['auth_user']['user_name'] ?></h3>
                                    <h6 class="w-100 text-center mt-0"><?= $_SESSION['auth_user']['user_faculty_rank'] ?></>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- College Filter -->
            <div class="col-lg-12 col-sm-10 my-3 sticky-lg-top" style="top: 1em;">
                <div class="card shadow mb-3 rounded-4 border-0 sticky-lg-top" style="top: 1em;">
                    <div class="card-body">
                        <div class="card-title text-center pt-2 border-bottom">
                            <h3 class="fw-bold">Colleges, Departments</h3>
                            <div class="card-subtitle mb-2 text-muted">Filter for colleges or departments</div>
                        </div>
                        <form id="filterNewsFeedCollegeDepartmentForm">
                            <div class="input-group mb-3">
                                <label class="input-group-text fw-bold" for="filterNewsFeedColleges">College</label>
                                <select id="filterNewsFeedColleges" class="form-select form-control" name="filterNewsFeedColleges">
                                    <option selected></option>
                                    <option value="College of Accountancy and Finance (CAF)">College of Accountancy and Finance (CAF)</option>
                                    <option value="College of Architecture, Design and the Built Environment (CADBE)">College of Architecture, Design and the Built Environment (CADBE)</option>
                                    <option value="College of Arts and Letters (CAL)">College of Arts and Letters (CAL)</option>
                                    <option value="College of Business Administration (CBA)">College of Business Administration (CBA)</option>
                                    <option value="College of Communication (COC)">College of Communication (COC)</option>
                                    <option value="College of Computer and Information Sciences (CCIS)">College of Computer and Information Sciences (CCIS)</option>
                                    <option value="College of Education (COED)">College of Education (COED)</option>
                                    <option value="College of Engineering (CE)">College of Engineering (CE)</option>
                                    <option value="College of Human Kinetics (CHK)">College of Human Kinetics (CHK)</option>
                                    <option value="College of Law (CL)">College of Law (CL)</option>
                                    <option value="College of Political Science and Public Administration (CPSPA)">College of Political Science and Public Administration (CPSPA)</option>
                                    <option value="College of Social Sciences and Development (CSSD)">College of Social Sciences and Development (CSSD)</option>
                                    <option value="College of Science (CS)">College of Science (CS)</option>
                                    <option value="College of Tourism, Hospitality and Transportation Management (CTHTM)">College of Tourism, Hospitality and Transportation Management (CTHTM)</option>
                                    <option value="Institute of Technology (ITech)">Institute of Technology (ITech)</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text fw-bold" for="filterNewsFeedDepartment">Department</label>
                                <select id="filterNewsFeedDepartment" name="filterNewsFeedDepartment" class="form-select">
                                    <option selected></option>
                                </select>
                            </div>
                            <div class="float-end">
                                <button class="btn btn-warning text-white fw-bold rounded-pill">Clear</button>
                                <button type="submit" class="btn btn-primary text-white fw-bold rounded-pill">Enter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!-- News Feed Posts -->
        <div class="col-lg-6 col-sm-12">
            <!-- If User is logged in, display  Start A Post -->
            <?php if (isset($_SESSION['auth_user'])  && $_SESSION['auth_user_type'] == "User") : ?>
                <!-- Start A Post -->
                <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                    <div class="card-body text-dark">
                        <div class="card-title">
                            <div class="row">

                                <!-- Profile Picture -->
                                <div class="col-2" style="height:100px; width:100px;">
                                    <div class="text-center h-75 w-100 d-flex flex-column">
                                        <img src="../images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                                    </div>
                                </div>

                                <!-- Post Description (will trigger Create Post Modal) -->
                                <div class="col d-flex">
                                    <div class="w-100 h-75">
                                        <input type="text" class="form-control bg-light h-100 rounded-pill" placeholder="Start A Post." data-bs-toggle="modal" data-bs-target="#createTimelinePostsModal" readonly>
                                    </div>
                                </div>

                                <!-- Post Media -->
                                <div class="col-12 border-top">
                                    <div class="row justify-content-center align-items-center text-center fs-5 fw-bold mt-2">
                                        <div class="col-lg-4 col-md-12">
                                            <span class="icon-image me-2 text-success"></span>Photo
                                        </div>
                                        <div class="col-lg-4 col-md-12" data-bs-toggle="modal" data-bs-target="#createTimelinePostEventsModal" style="cursor: pointer;">
                                            <span class="icon-calendar-o me-2 text-warning"></span>Event
                                        </div>
                                        <div class="col-lg-4 col-md-12" data-bs-toggle="modal" data-bs-target="#createTimelinePostAnnouncementsModal" style="cursor: pointer;">
                                            <span class="icon-bullhorn me-2 text-danger"></span>Announcement
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- List Of Posts-->
            <div id="displayListofNewsFeedPosts">
                <?php
                // Get page number
                if (isset($_GET['page_no']) && $_GET['page_no'] !== "") {
                    $page_no = $_GET['page_no'];
                } else {
                    $page_no = 1;
                }

                // Total rows of records to display
                $total_records_per_page = 10;

                // Get the page offset for the LIMIT query
                $offset = ($page_no - 1) * $total_records_per_page;

                // Get previous page
                $previous_page = $page_no - 1;

                // Get next page
                $next_page = $page_no + 1;

                // Get total count of records
                $result_count = mysqli_query($con, "SELECT COUNT(*) AS total_records FROM `timeline_posts`") or die(mysqli_error($con));

                // Total records
                $records = mysqli_fetch_array($result_count);

                // Store total_records to a variable
                $total_records = $records['total_records'];

                // Get total pages
                $total_no_of_pages = ceil($total_records / $total_records_per_page);

                // Query string 
                $sql = "SELECT 
                        tp.timeline_post_id,
                        tp.timeline_post_user_id,
                        up.user_name,
                        up.user_college,
                        up.user_department,
                        up.user_image,
                        tp.timeline_post_type,
                        tp.timeline_post_title,
                        tp.timeline_post_description,
                        tp.timeline_post_start_date,
                        tp.timeline_post_end_date,
                        tp.timeline_post_url,
                        tp.timeline_post_media,
                        tp.timeline_post_date
                    FROM 
                        timeline_posts tp
                    JOIN 
                        user_profiles up ON tp.timeline_post_user_id = up.user_id
                    WHERE up.user_type = 'User'
                    ORDER BY tp.timeline_post_date DESC
                    LIMIT $offset, $total_records_per_page";

                // Result
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                // Check if data are retrieved
                $check_result = mysqli_num_rows($result) > 0;
                if ($check_result) {

                    while ($data = mysqli_fetch_array($result)) {
                        $timeline_post_date = new DateTime($data['timeline_post_date']);
                        $timeline_post_start_date = new DateTime($data['timeline_post_start_date']);
                        $timeline_post_end_date = new DateTime($data['timeline_post_end_date']);

                        // Timeline Posts
                        if ($data['timeline_post_type'] == "Post") {
                ?>
                            <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                                <div class="card-body text-dark">
                                    <div class="card-title">
                                        <div class="row">
                                            <!-- Profile Picture -->
                                            <div class="col-2" style="height:100px; width:100px;">
                                                <div class="text-center h-75 w-100 d-flex flex-column">
                                                    <img src="../images/profilePictures/<?= $data['user_image'] ?>" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                                                </div>
                                            </div>

                                            <!-- Profile Name & Date Posted -->
                                            <div class="col d-flex">
                                                <div class="w-100">
                                                    <h3 class="fw-bold text-primary"><?= $data['user_name'] ?></h3>
                                                    <div class="card-subtitle text-muted">Posted on <?= date_format($timeline_post_date, "F d, Y") ?> at <?= date_format($timeline_post_date, "h:i A") ?></div>
                                                </div>
                                                <?php if (isset($_SESSION['auth_user']) &&  $_SESSION['auth_user']['user_id'] == $data['timeline_post_user_id']) : ?>

                                                    <div class="dropdown">
                                                        <span class="icon-dots-three-horizontal fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
                                                        <ul class="dropdown-menu">
                                                            <li><button value="<?= $data['timeline_post_id'] ?>" class="editTimelinePostButton dropdown-item">Edit</button></li>
                                                            <li><button value="<?= $data['timeline_post_id'] ?>" class="deleteTimelinePostButton dropdown-item">Delete</button></li>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Post Description -->
                                            <div class="col-12">
                                                <div class="card-text fs-5">
                                                    <p><?= $data['timeline_post_description'] ?></p>
                                                </div>
                                            </div>

                                            <!-- Post Media -->
                                            <?php
                                            if ($data['timeline_post_media'] !== NULL) {
                                            ?>
                                                <div class="col-12" style="height:500px;">
                                                    <div class="text-center h-100 w-100 d-flex flex-column">
                                                        <img src="../images/posts/<?= $data['timeline_post_media'] ?>" data-post-id="<?= $data['timeline_post_id'] ?>" class="viewImage img-fluid h-100 rounded-3" style="object-fit:cover; object-position:center;">
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php
                        }
                        // Timeline Post Events 
                        else if ($data['timeline_post_type'] == "Event") {
                        ?>
                            <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                                <div class="card-body text-dark">
                                    <div class="card-title">
                                        <div class="row">
                                            <!-- Profile Picture -->
                                            <div class="col-2" style="height:100px; width:100px;">
                                                <div class="text-center h-75 w-100 d-flex flex-column">
                                                    <img src="../images/profilePictures/<?= $data['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                                                </div>
                                            </div>

                                            <!-- Profile Name & Date Posted -->
                                            <div class="col d-flex">
                                                <div class="w-100">
                                                    <h3 class="fw-bold text-primary"><?= $data['user_name'] ?></h3>
                                                    <div class="card-subtitle text-muted">Posted an <strong><span class="icon-calendar-o me-2 text-warning"></span>Event</strong> on <?= date_format($timeline_post_date, "F d, Y") ?> at <?= date_format($timeline_post_date, "h:i A") ?></div>
                                                </div>
                                                <?php if (isset($_SESSION['auth_user']) &&  $_SESSION['auth_user']['user_id'] == $data['timeline_post_user_id']) : ?>
                                                    <div class="dropdown">
                                                        <span class="icon-dots-three-horizontal fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
                                                        <ul class="dropdown-menu">
                                                            <li><button value="<?= $data['timeline_post_id'] ?>" class="editTimelinePostEventButton dropdown-item">Edit</button></li>
                                                            <li><button value="<?= $data['timeline_post_id'] ?>" class="deleteTimelinePostButton dropdown-item">Delete</button></li>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Post Event Contents -->
                                            <div class="col-12">
                                                <div class="card-text fs-5">
                                                    <h2 class="text-center fw-bold border-2 border-bottom border-warning"><?= $data['timeline_post_title'] ?></h3>
                                                        <h5 class="text-muted fw-bold">Event Date: <?= date_format($timeline_post_start_date, "F d, Y h:i A") ?> — <?= date_format($timeline_post_end_date, "F d, Y h:i A") ?></h5>
                                                        <p><?= $data['timeline_post_description'] ?></p>
                                                        <!-- Post Event Media -->
                                                        <?php
                                                        if ($data['timeline_post_media'] !== NULL) {
                                                        ?>
                                                            <div class="col-12" style="height:500px;">
                                                                <div class="text-center h-100 w-100 d-flex flex-column">
                                                                    <img src="../images/posts/<?= $data['timeline_post_media'] ?>" data-post-id="<?= $data['timeline_post_id'] ?>" class="viewImage img-fluid h-100 rounded-3" style="object-fit:cover; object-position:center;">
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <!-- Post Event Reference Link -->
                                                        <a href="<?= $data['timeline_post_url'] ?>" target="_blank" class="text-decoration-none text-primary float-end"><span class="icon-eye me-2"></span>View Event Details</a>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php
                        }
                        // Timeline Post Announcements 
                        else {
                        ?>
                            <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                                <div class="card-body text-dark">
                                    <div class="card-title">
                                        <div class="row">
                                            <!-- Profile Picture -->
                                            <div class="col-2" style="height:100px; width:100px;">
                                                <div class="text-center h-75 w-100 d-flex flex-column">
                                                    <img src="../images/profilePictures/<?= $data['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                                                </div>
                                            </div>

                                            <!-- Profile Name & Date Posted -->
                                            <div class="col d-flex">
                                                <div class="w-100">
                                                    <h3 class="fw-bold text-primary"><?= $data['user_name'] ?></h3>
                                                    <div class="card-subtitle text-muted">Posted an <strong><span class="icon-bullhorn me-2 text-danger"></span>Announcement</strong> on <?= date_format($timeline_post_date, "F d, Y") ?> at <?= date_format($timeline_post_date, "h:i A") ?></div>
                                                </div>
                                                <?php if (isset($_SESSION['auth_user']) &&  $_SESSION['auth_user']['user_id'] == $data['timeline_post_user_id']) : ?>
                                                    <div class="dropdown">
                                                        <span class="icon-dots-three-horizontal fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
                                                        <ul class="dropdown-menu">
                                                            <li><button value="<?= $data['timeline_post_id'] ?>" class="editTimelinePostAnnouncementButton dropdown-item">Edit</button></li>
                                                            <li><button value="<?= $data['timeline_post_id'] ?>" class="deleteTimelinePostButton dropdown-item">Delete</button></li>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Post Announcement Contents -->
                                            <div class="col-12">
                                                <div class="card-text fs-5">
                                                    <h2 class="text-center fw-bold border-2 border-bottom border-danger"><?= $data['timeline_post_title'] ?></h3>
                                                        <p><?= $data['timeline_post_description'] ?></p>
                                                        <!-- Post Announcements Media -->
                                                        <?php
                                                        if ($data['timeline_post_media'] !== NULL) {
                                                        ?>
                                                            <div class="col-12" style="height:500px;">
                                                                <div class="text-center h-100 w-100 d-flex flex-column">
                                                                    <img src="../images/posts/<?= $data['timeline_post_media'] ?>" data-post-id="<?= $data['timeline_post_id'] ?>" class="viewImage img-fluid h-100 rounded-3" style="object-fit:cover; object-position:center;">
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <!-- Post Announcement Reference Link -->
                                                        <a href="<?= $data['timeline_post_url'] ?>" target="_blank" class="text-decoration-none text-primary float-end"><span class="icon-eye me-2"></span>View Announcement Details</a>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php
                        }
                    }
                    if ($total_records > $total_records_per_page) {
                        ?>
                        <!-- Pagination Buttons -->
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?>" <?= ($page_no > 1) ? 'href=?page_no=' . $previous_page : ''; ?>>Previous</a></li>
                                <?php for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                    if ($page_no !== $counter) {
                                ?>
                                        <li class="page-item"><a class="page-link" href="?page_no=<?= $counter; ?>"><?= $counter; ?></a></li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item"><a class="page-link active"><?= $counter; ?></a></li>
                                <?php
                                    }
                                } ?>

                                <li class="page-item"><a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?>" <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' . $next_page : ''; ?>>Next</a></li>
                            </ul>
                        </nav>
                        <!-- Page Number -->
                        <div class="text-center">
                            <strong>Page <?= $page_no ?> of <?= $total_no_of_pages ?></strong>
                        </div>
                    <?php
                    }
                }
                // No data found 
                else {
                    ?>
                    <h4 class="text-muted text-center mt-5">No posts yet.</h4>
                <?php
                }
                ?>

            </div>

        </div>


        <!-- Teachers Thumbnail List -->
        <div class="col-lg-3 col-sm-12 d-none d-md-block">
            <div class="card my-3 p-2 border-0 shadow-lg rounded-5 sticky-lg-top" style="top: 1em;">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex">
                        <h5 class="fw-bold text-primary w-100 text-center">Faculty, Officials & Staff</h5>
                    </div>
                    <!-- Teachers List -->

                    <?php
                    $sql = "SELECT * FROM `user_profiles` ORDER BY RAND() LIMIT 4";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;

                    if ($check_result) {
                        while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="card border-0 shadow-sm rounded-4 my-2">
                                <div class="card-body text-dark p-2">
                                    <div class="card-title">
                                        <div class="d-flex align-items-center">
                                            <!-- Profile Picture -->
                                            <div style="height:50px; width:50px;">
                                                <div class="text-center h-100 w-100 d-flex flex-column">
                                                    <img src="../images/profilePictures/<?= $data['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                                                </div>
                                            </div>
                                            <!-- Profile Name & Date Posted -->
                                            <div class="ms-3" style="max-width: 180px;">
                                                <?php if ($data['user_honorifics'] !== '') : ?>
                                                    <h6 class="fw-bold text-primary mb-0">
                                                        <?= $data['user_name'] ?> , <?= $data['user_honorifics'] ?>
                                                    </h6>
                                                <?php else : ?>
                                                    <h6 class="fw-bold text-primary mb-0">
                                                        <?= $data['user_name'] ?>
                                                    </h6>
                                                <?php endif; ?>
                                                <small class="text-muted"><?= $data['user_faculty_rank'] ?></small>
                                            </div>
                                        </div>
                                        <a href="http://localhost/pup_profiles/pages/teacher.php?username=<?= $data['user_account_username'] ?>" class="viewUserAccount text-decoration-none float-end me-1" data-account-username="<?= $data['user_account_username'] ?>"><small>View Profile</small></a>
                                    </div>

                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <h6 class="text-center fw bold text-muted">No faculty yet.</h6>
                    <?php
                    }
                    ?>


                    <!-- Redirect to Colleges Page -->
                    <p class="card-text float-end mt-2"><a href="./colleges.php" class="link-primary text-decoration-none">See More</a></p>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Timeline Posts Modals -->
<!-- Create Timeline Post Modal -->
<div class="modal fade" id="createTimelinePostsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create New Post</h1>
            </div>
            <div class="modal-body">
                <div class="row pb-2">
                    <!-- User Profile Picture -->
                    <div class="col-4" style="height:80px; width:80px;">
                        <div class="text-center h-75 w-100 d-flex flex-column ">
                            <!-- To be updated -->
                            <img src="../images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                        </div>
                    </div>
                    <!-- User Details -->
                    <div class="col-8 d-flex">
                        <div class="w-100">
                            <h4 class="fw-bold text-primary"><?= $_SESSION['auth_user']['user_name'] ?></h4>
                            <div class="card-subtitle text-muted">This post will be displayed on your timeline.</div>
                        </div>
                    </div>
                </div>
                <!-- Form Alert Message -->
                <div id="formAlertCreateTimelinePost" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateTimelinePost" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <!-- Create Timeline Post Form -->
                <form id="createTimelinePostForm" class="row g-2">
                    <!-- Post User ID -->
                    <input type="hidden" name="createTimelinePostUserID" id="createTimelinePostUserID" value="<?= $_SESSION['auth_user']['user_id'] ?>">
                    <!-- Post Type -->
                    <input type="hidden" name="createTimelinePostTypePost" id="createTimelinePostTypePost" value="Post">
                    <!-- Post Description -->
                    <div class="col-12">
                        <textarea name="createTimelinePostDescription" id="createTimelinePostDescription" rows="3" class="form-control bg-light"></textarea>
                    </div>
                    <!-- Image Preview -->
                    <img src="" id="createTimelinePostImagePreview" class="rounded-3 mw-100 mh-100">
                    <p id="createTimelinePostRemoveImage" class="text-center text-info fw-bold" style="display: none;cursor: pointer;">Remove Image</p>

                    <!-- Post Media Options -->
                    <div class="col-12 border-top mt-2">
                        <div class="row justify-content-center align-items-center text-center fs-5 fw-bold mt-2">
                            <!-- Post Media -->
                            <div class="col-4">
                                <label id="createTimelinePostShowImage" for="createTimelinePostMedia" class="form-label fw-bold" type="button">
                                    <span class="icon-image me-2 text-success"></span>Photo
                                </label>
                                <input type="file" name="createTimelinePostMedia" id="createTimelinePostMedia" class="d-none">
                            </div>
                            <!-- Post Event Template -->
                            <div class="col-4">
                                <div class="fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#createTimelinePostEventsModal">
                                    <span class="icon-calendar-o me-2 text-warning"></span>Event
                                </div>
                            </div>
                            <!-- Post Announcement Template-->
                            <div class="col-lg-4 col-md-12">
                                <div class="fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#createTimelinePostAnnouncementsModal">
                                    <span class="icon-bullhorn me-2 text-danger"></span>Announcement
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Post Date -->
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Timeline Post Modal -->
<div class="modal fade" id="editTimelinePostsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Post</h1>
            </div>
            <div class="modal-body">
                <div class="row pb-2">
                    <!-- User Profile Picture -->
                    <div class="col-4" style="height:80px; width:80px;">
                        <div class="text-center h-75 w-100 d-flex flex-column ">
                            <!-- To be updated -->
                            <img src="../images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                        </div>
                    </div>
                    <!-- User Details -->
                    <div class="col-8 d-flex">
                        <div class="w-100">
                            <h4 class="fw-bold text-primary"><?= $_SESSION['auth_user']['user_name'] ?></h4>
                            <div class="card-subtitle text-muted">Changes to this post will be updated on your timeline.</div>
                        </div>
                    </div>
                </div>
                <!-- Form Alert Message -->
                <div id="formAlertEditTimelinePost" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditTimelinePost" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <!-- Edit Timeline Post Form -->
                <form id="editTimelinePostForm" class="row g-2">
                    <!-- TimeLine Post ID -->
                    <input type="hidden" name="editTimelinePostID" id="editTimelinePostID">
                    <!-- Post Description -->
                    <div class="col-12">
                        <textarea name="editTimelinePostDescription" id="editTimelinePostDescription" rows="3" class="form-control"></textarea>
                    </div>
                    <!-- Image Preview -->
                    <img src="" id="editTimelinePostImagePreview" class="rounded-3 mw-100 mh-100">
                    <p id="editTimelinePostRemoveImage" class="text-center text-info fw-bold" style="display: none;cursor: pointer;">Remove Image</p>
                    <!-- Post Media Options -->
                    <div class="col-12 border-top mt-2">
                        <div class="row justify-content-center align-items-center text-center fs-5 fw-bold mt-2">
                            <!-- Post Media -->
                            <div class="col-4">
                                <label id="editTimelinePostShowImage" for="editTimelinePostMedia" class="form-label fw-bold" type="button">
                                    <span class="icon-image me-2 text-success"></span>Photo
                                </label>
                                <input type="file" name="editTimelinePostMedia" id="editTimelinePostMedia" class="d-none">
                            </div>
                        </div>
                    </div>
                    <!-- Image Value -->
                    <input type="hidden" name="editTimelinePostImageValue" id="editTimelinePostImageValue">
                    <!-- Post Date -->
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Timeline Post Events Modals -->
<!-- Create Timeline Post Event Modal -->
<div class="modal fade" id="createTimelinePostEventsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create New Event</h1>
            </div>
            <div class="modal-body">
                <div class="row pb-2">
                    <!-- User Profile Picture -->
                    <div class="col-4" style="height:80px; width:80px;">
                        <div class="text-center h-75 w-100 d-flex flex-column ">
                            <!-- To be updated -->
                            <img src="../images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                        </div>
                    </div>
                    <!-- User Details -->
                    <div class="col-8 d-flex">
                        <div class="w-100">
                            <h4 class="fw-bold text-primary"><?= $_SESSION['auth_user']['user_name'] ?></h4>
                            <div class="card-subtitle text-muted">This event will be displayed on your timeline.</div>
                        </div>
                    </div>
                </div>
                <!-- Form Alert Message -->
                <div id="formAlertCreateTimelinePostEvent" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateTimelinePostEvent" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <!-- Create Timeline PostEvent Form -->
                <form id="createTimelinePostEventForm" class="row g-2">
                    <!-- PostEvent User ID -->
                    <input type="hidden" name="createTimelinePostEventUserID" id="createTimelinePostEventUserID" value="<?= $_SESSION['auth_user']['user_id'] ?>">
                    <!-- Post Type Event -->
                    <input type="hidden" name="createTimelinePostTypeEvent" id="createTimelinePostTypeEvent" value="Event">
                    <!-- Post Event Title -->
                    <div class="col-12">
                        <label for="createTimelinePostEventTitle" class="form-label fw-bold">Event Title</label>
                        <input type="text" name="createTimelinePostEventTitle" id="createTimelinePostEventTitle" class="form-control bg-light">
                    </div>
                    <!-- Post Event Description -->
                    <div class="col-12">
                        <label for="createTimelinePostEventDescription" class="form-label fw-bold">Event Description</label>
                        <textarea name="createTimelinePostEventDescription" id="createTimelinePostEventDescription" rows="3" class="form-control bg-light"></textarea>
                    </div>
                    <!-- Post Event Stat Date -->
                    <div class="col-lg-6 col-md-12">
                        <label for="createTimelinePostEventStartDate" class="form-label fw-bold">Start Date</label>
                        <input type="datetime-local" name="createTimelinePostEventStartDate" id="createTimelinePostEventStartDate" class="form-control bg-light">
                    </div>
                    <!-- Post Event End Date -->
                    <div class="col-lg-6 col-md-12">
                        <label for="createTimelinePostEventEndDate" class="form-label fw-bold">End Date</label>
                        <input type="datetime-local" name="createTimelinePostEventEndDate" id="createTimelinePostEventEndDate" class="form-control bg-light">
                    </div>
                    <!-- Post Event Reference Link -->
                    <div class="col-12">
                        <label for="createTimelinePostEventLink" class="form-label fw-bold">Event Reference Link</label>
                        <input type="text" name="createTimelinePostEventLink" id="createTimelinePostEventLink" class="form-control bg-light">
                    </div>
                    <!-- Image Preview -->
                    <img src="" id="createTimelinePostEventImagePreview" class="rounded-3 mw-100 mh-100">
                    <p id="createTimelinePostEventRemoveImage" class="text-center text-info fw-bold" style="display: none;cursor: pointer;">Remove Image</p>

                    <!-- Post Media Options -->
                    <div class="col-12 border-top mt-2">
                        <div class="row justify-content-center align-items-center text-center fs-5 fw-bold mt-2">
                            <!-- Post Media -->
                            <div class="col-12">
                                <label for="createTimelinePostEventMedia" class="form-label fw-bold" type="button">
                                    <span class="icon-image me-2 text-success"></span>Photo
                                </label>
                                <input type="file" name="createTimelinePostEventMedia" id="createTimelinePostEventMedia" class="d-none">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Timeline Post Event Modal -->
<div class="modal fade" id="editTimelinePostEventsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Post Event</h1>
            </div>
            <div class="modal-body">
                <div class="row pb-2">
                    <!-- User Profile Picture -->
                    <div class="col-4" style="height:80px; width:80px;">
                        <div class="text-center h-75 w-100 d-flex flex-column ">
                            <!-- To be updated -->
                            <img src="../images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                        </div>
                    </div>
                    <!-- User Details -->
                    <div class="col-8 d-flex">
                        <div class="w-100">
                            <h4 class="fw-bold text-primary"><?= $_SESSION['auth_user']['user_name'] ?></h4>
                            <div class="card-subtitle text-muted">Changes to this event will be updated on your timeline.</div>
                        </div>
                    </div>
                </div>
                <!-- Form Alert Message -->
                <div id="formAlertEditTimelinePostEvent" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditTimelinePostEvent" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <!-- Edit Timeline PostEvent Form -->
                <form id="editTimelinePostEventForm" class="row g-2">
                    <!-- TimeLine Post Event ID -->
                    <input type="hidden" name="editTimelinePostEventID" id="editTimelinePostEventID">
                    <!-- Post Event Title -->
                    <div class="col-12">
                        <label for="editTimelinePostEventTitle" class="form-label fw-bold">Event Title</label>
                        <input type="text" name="editTimelinePostEventTitle" id="editTimelinePostEventTitle" class="form-control bg-light">
                    </div>
                    <!-- Post Event Description -->
                    <div class="col-12">
                        <label for="editTimelinePostEventDescription" class="form-label fw-bold">Event Description</label>
                        <textarea name="editTimelinePostEventDescription" id="editTimelinePostEventDescription" rows="3" class="form-control bg-light"></textarea>
                    </div>
                    <!-- Post Event Stat Date -->
                    <div class="col-lg-6 col-md-12">
                        <label for="editTimelinePostEventStartDate" class="form-label fw-bold">Start Date</label>
                        <input type="datetime-local" name="editTimelinePostEventStartDate" id="editTimelinePostEventStartDate" class="form-control bg-light">
                    </div>
                    <!-- Post Event End Date -->
                    <div class="col-lg-6 col-md-12">
                        <label for="editTimelinePostEventEndDate" class="form-label fw-bold">End Date</label>
                        <input type="datetime-local" name="editTimelinePostEventEndDate" id="editTimelinePostEventEndDate" class="form-control bg-light">
                    </div>
                    <!-- Post Event Reference Link -->
                    <div class="col-12">
                        <label for="editTimelinePostEventLink" class="form-label fw-bold">Event Reference Link</label>
                        <input type="text" name="editTimelinePostEventLink" id="editTimelinePostEventLink" class="form-control bg-light">
                    </div>
                    <!-- Image Preview -->
                    <img src="" id="editTimelinePostEventImagePreview" class="rounded-3 mw-100 mh-100">
                    <p id="editTimelinePostEventRemoveImage" class="text-center text-info fw-bold" style="display: none;cursor: pointer;">Remove Image</p>
                    <!-- Post Event Media Options -->
                    <div class="col-12 border-top mt-2">
                        <div class="row justify-content-center align-items-center text-center fs-5 fw-bold mt-2">
                            <!-- PostEvent Media -->
                            <div class="col-4">
                                <label id="editTimelinePostEventShowImage" for="editTimelinePostEventMedia" class="form-label fw-bold" type="button">
                                    <span class="icon-image me-2 text-success"></span>Photo
                                </label>
                                <input type="file" name="editTimelinePostEventMedia" id="editTimelinePostEventMedia" class="d-none">
                            </div>
                        </div>
                    </div>
                    <!-- Image Value -->
                    <input type="hidden" name="editTimelinePostEventImageValue" id="editTimelinePostEventImageValue">
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Timeline Post Announcements Modals -->
<!-- Create Timeline Post Announcements Modal -->
<div class="modal fade" id="createTimelinePostAnnouncementsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create New Announcement</h1>
            </div>
            <div class="modal-body">
                <div class="row pb-2">
                    <!-- User Profile Picture -->
                    <div class="col-4" style="height:80px; width:80px;">
                        <div class="text-center h-75 w-100 d-flex flex-column ">
                            <!-- To be updated -->
                            <img src="../images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                        </div>
                    </div>
                    <!-- User Details -->
                    <div class="col-8 d-flex">
                        <div class="w-100">
                            <h4 class="fw-bold text-primary"><?= $_SESSION['auth_user']['user_name'] ?></h4>
                            <div class="card-subtitle text-muted">This event will be displayed on your timeline.</div>
                        </div>
                    </div>
                </div>
                <!-- Form Alert Message -->
                <div id="formAlertCreateTimelinePostAnnouncement" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateTimelinePostAnnouncement" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <!-- Create Timeline PostAnnouncement Form -->
                <form id="createTimelinePostAnnouncementForm" class="row g-2">
                    <!-- PostAnnouncement User ID -->
                    <input type="hidden" name="createTimelinePostAnnouncementUserID" id="createTimelinePostAnnouncementUserID" value="<?= $_SESSION['auth_user']['user_id'] ?>">
                    <!-- Post Type Announcement -->
                    <input type="hidden" name="createTimelinePostTypeAnnouncement" id="createTimelinePostTypeAnnouncement" value="Announcement">
                    <!-- Post Announcement Title -->
                    <div class="col-12">
                        <label for="createTimelinePostAnnouncementTitle" class="form-label fw-bold">Announcement Title</label>
                        <input type="text" name="createTimelinePostAnnouncementTitle" id="createTimelinePostAnnouncementTitle" class="form-control bg-light">
                    </div>
                    <!-- Post Announcement Description -->
                    <div class="col-12">
                        <label for="createTimelinePostAnnouncementDescription" class="form-label fw-bold">Announcement Description</label>
                        <textarea name="createTimelinePostAnnouncementDescription" id="createTimelinePostAnnouncementDescription" rows="3" class="form-control bg-light"></textarea>
                    </div>
                    <!-- Post Announcement Reference Link -->
                    <div class="col-12">
                        <label for="createTimelinePostAnnouncementLink" class="form-label fw-bold">Announcement Reference Link</label>
                        <input type="text" name="createTimelinePostAnnouncementLink" id="createTimelinePostAnnouncementLink" class="form-control bg-light">
                    </div>
                    <!-- Image Preview -->
                    <img src="" id="createTimelinePostAnnouncementImagePreview" class="rounded-3 mw-100 mh-100">
                    <p id="createTimelinePostAnnouncementRemoveImage" class="text-center text-info fw-bold" style="display: none;cursor: pointer;">Remove Image</p>

                    <!-- Post Media Options -->
                    <div class="col-12 border-top mt-2">
                        <div class="row justify-content-center align-items-center text-center fs-5 fw-bold mt-2">
                            <!-- Post Media -->
                            <div class="col-12">
                                <label for="createTimelinePostAnnouncementMedia" class="form-label fw-bold" type="button">
                                    <span class="icon-image me-2 text-success"></span>Photo
                                </label>
                                <input type="file" name="createTimelinePostAnnouncementMedia" id="createTimelinePostAnnouncementMedia" class="d-none">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Timeline Post Announcement Modal -->
<div class="modal fade" id="editTimelinePostAnnouncementsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Post Announcement</h1>
            </div>
            <div class="modal-body">
                <div class="row pb-2">
                    <!-- User Profile Picture -->
                    <div class="col-4" style="height:80px; width:80px;">
                        <div class="text-center h-75 w-100 d-flex flex-column ">
                            <!-- To be updated -->
                            <img src="../images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                        </div>
                    </div>
                    <!-- User Details -->
                    <div class="col-8 d-flex">
                        <div class="w-100">
                            <h4 class="fw-bold text-primary"><?= $_SESSION['auth_user']['user_name'] ?></h4>
                            <div class="card-subtitle text-muted">Changes to this announcement will be updated on your timeline.</div>
                        </div>
                    </div>
                </div>
                <!-- Form Alert Message -->
                <div id="formAlertEditTimelinePostAnnouncement" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditTimelinePostAnnouncement" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <!-- Edit Timeline PostAnnouncement Form -->
                <form id="editTimelinePostAnnouncementForm" class="row g-2">
                    <!-- PostAnnouncement User ID -->
                    <input type="hidden" name="editTimelinePostAnnouncementID" id="editTimelinePostAnnouncementID">
                    <!-- Post Announcement Title -->
                    <div class="col-12">
                        <label for="editTimelinePostAnnouncementTitle" class="form-label fw-bold">Announcement Title</label>
                        <input type="text" name="editTimelinePostAnnouncementTitle" id="editTimelinePostAnnouncementTitle" class="form-control bg-light">
                    </div>
                    <!-- Post Announcement Description -->
                    <div class="col-12">
                        <label for="editTimelinePostAnnouncementDescription" class="form-label fw-bold">Announcement Description</label>
                        <textarea name="editTimelinePostAnnouncementDescription" id="editTimelinePostAnnouncementDescription" rows="3" class="form-control bg-light"></textarea>
                    </div>
                    <!-- Post Announcement Reference Link -->
                    <div class="col-12">
                        <label for="editTimelinePostAnnouncementLink" class="form-label fw-bold">Announcement Reference Link</label>
                        <input type="text" name="editTimelinePostAnnouncementLink" id="editTimelinePostAnnouncementLink" class="form-control bg-light">
                    </div>
                    <!-- Image Preview -->
                    <img src="" id="editTimelinePostAnnouncementImagePreview" class="rounded-3 mw-100 mh-100">
                    <p id="editTimelinePostAnnouncementRemoveImage" class="text-center text-info fw-bold" style="display: none;cursor: pointer;">Remove Image</p>

                    <!-- Post Media Options -->
                    <div class="col-12 border-top mt-2">
                        <div class="row justify-content-center align-items-center text-center fs-5 fw-bold mt-2">
                            <!-- Post Media -->
                            <div class="col-12">
                                <label for="editTimelinePostAnnouncementMedia" class="form-label fw-bold" type="button">
                                    <span class="icon-image me-2 text-success"></span>Photo
                                </label>
                                <input type="file" name="editTimelinePostAnnouncementMedia" id="editTimelinePostAnnouncementMedia" class="d-none">
                            </div>
                        </div>
                    </div>
                    <!-- Image Value -->
                    <input type="hidden" name="editTimelinePostAnnouncementImageValue" id="editTimelinePostAnnouncementImageValue">
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Timeline Post/Event/Announcement Modal -->
<div class="modal fade" id="deleteTimelinePostsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Timeline Post</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeleteTimelinePost" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeleteTimelinePost" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deleteTimelinePostForm" class="row g-2">
                    <input type="hidden" id="deleteTimelinePostID" name="deleteTimelinePostID">
                    <p>Confirm deletion of this post created on <strong id="deleteTimelinePostDate"></strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Image -->
<div class="modal fade" id="viewImageModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header border-0">
                <h1 class="modal-title w-100 text-center fs-5">View Image</h1>
            </div>
            <div class="modal-body">
                <div class="row">
                    <img src="" id="viewFullImage" class="img-fluid rounded-3 mw-100 mh-100">
                </div>
            </div>
            <div class="modal-footer border-0">
                <div class="text-center w-100">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footerUser.php';
?>