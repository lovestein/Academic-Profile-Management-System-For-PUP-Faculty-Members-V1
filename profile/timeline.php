<!-- UPDATE USER PROFILE IMAGE DIR -->
<div class="container-fluid">
    <div class="row justify-content-center mt-3">
        <!-- Timeline Events/Announcement/Gallery -->
        <div class="col-lg-4 col-sm 12">
            <!-- Row -->
            <div class="row">
                <!-- Events -->
                <div class="col-lg-12 col-sm-6 mb-3 d-none d-md-block">
                    <div id="eventsCard" class="card p-1 border-0 shadow-lg rounded-5">
                        <div class="card-body text-dark">
                            <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                                <h3 class="fw-bold text-primary w-100 m-0">Events</h3>
                                <?php
                                $sql = "SELECT * FROM `timeline_posts` WHERE `timeline_post_user_id` = '$user_id'";
                                $result = mysqli_query($con, $sql);
                                $check_result = mysqli_num_rows($result) > 0;
                                if ($check_result) {
                                ?>
                                    <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modifyEventsModal">
                                        <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Events"></span>
                                    </button>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-text m-0 fs-4">
                                <?php
                                $sql = "SELECT * FROM `timeline_posts` WHERE `timeline_post_user_id` = '$user_id' AND `timeline_post_type` = 'Event'";
                                $result = mysqli_query($con, $sql);
                                $check_result = mysqli_num_rows($result) > 0;
                                if ($check_result) {
                                ?><ul>
                                        <?php
                                        while ($data = mysqli_fetch_array($result)) {
                                            $timeline_post_start_date = new DateTime($data['timeline_post_start_date']);
                                            $timeline_post_end_date = new DateTime($data['timeline_post_end_date']);
                                        ?>
                                            <li class="mb-3">
                                                <a href="<?= $data['timeline_post_url'] ?>" class="text-decoration-none fw-bold fst-italic" target="_blank">"<?= $data['timeline_post_title'] ?>"</a>
                                                <p class="text-muted ms-3 fs-6">Event Date: <strong><?= date_format($timeline_post_start_date, "F d, Y") ?></strong> — <strong><?= date_format($timeline_post_end_date, "F d, Y") ?></strong></p>
                                                <p class="ms-3 fs-6 m-0"><?= $data['timeline_post_description'] ?></p>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createTimelinePostEventsModal"><span class="icon-plus-circle fs-3"></span></button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Events -->
                <!-- Announcements -->
                <div class="col-lg-12 col-sm-6 mb-3 d-none d-md-block">
                    <div id="announcementsCard" class="card p-1 border-0 shadow-lg rounded-5">
                        <div class="card-body text-dark">
                            <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                                <h3 class="fw-bold text-primary w-100 m-0">Announcements</h3>
                                <?php
                                $sql = "SELECT * FROM `timeline_posts` WHERE `timeline_post_user_id` = '$user_id' AND `timeline_post_type` = 'Announcement'";
                                $result = mysqli_query($con, $sql);
                                $check_result = mysqli_num_rows($result) > 0;
                                if ($check_result) {
                                ?>
                                    <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modifyAnnouncementsModal">
                                        <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Announcements"></span>
                                    </button>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-text m-0 fs-4">
                                <?php
                                $sql = "SELECT * FROM `timeline_posts` WHERE `timeline_post_user_id` = '$user_id' AND `timeline_post_type` = 'Announcement'";
                                $result = mysqli_query($con, $sql);
                                $check_result = mysqli_num_rows($result) > 0;
                                if ($check_result) {
                                ?><ul>
                                        <?php
                                        while ($data = mysqli_fetch_array($result)) {
                                            $timeline_post_start_date = new DateTime($data['timeline_post_start_date']);
                                            $timeline_post_end_date = new DateTime($data['timeline_post_end_date']);
                                        ?>
                                            <li class="mb-3">
                                                <a href="<?= $data['timeline_post_url'] ?>" class="text-decoration-none fw-bold fst-italic" target="_blank">"<?= $data['timeline_post_title'] ?>"</a>
                                                <p class="ms-3 fs-6 m-0"><?= $data['timeline_post_description'] ?></p>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createTimelinePostAnnouncementsModal"><span class="icon-plus-circle fs-3"></span></button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Announcements -->
                <!-- Photos -->
                <div class="col-lg-12 col-sm-6 mb-4">
                    <div id="mediasCard" class="card p-1 border-0 shadow-lg rounded-5">
                        <div class="card-body text-dark">
                            <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                                <h3 class="fw-bold text-primary w-100 m-0">Photos</h3>
                                <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#viewGalleryModal">
                                    <span class="icon-eye" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Gallery"></span>
                                </button>
                            </div>
                            <!-- Gallery -->
                            <div class="container-fluid">
                                <div class="row">
                                    <?php
                                    $sql = "SELECT `timeline_post_id`, `timeline_post_media` FROM `timeline_posts` WHERE `timeline_post_user_id` = '$user_id' AND `timeline_post_media` IS NOT NULL ORDER BY `timeline_post_date` DESC LIMIT 3";
                                    $result = mysqli_query($con, $sql);
                                    $check_result = mysqli_num_rows($result) > 0;
                                    if ($check_result) {

                                        $counter = 1;
                                        while ($data = mysqli_fetch_array($result)) {
                                            if ($counter == 1) {
                                    ?>
                                                <div class="col-12 p-1" style="height: 200px;">
                                                    <div class="text-center h-100 w-100 d-flex flex-column">
                                                        <img src="./images/posts/<?= $data['timeline_post_media'] ?>" data-post-id="<?= $data['timeline_post_id'] ?>" class="viewImage img-fluid h-100 shadow-sm rounded-3" style="object-fit:cover;object-position: center;">
                                                    </div>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-6 p-1" style="height:200px;">
                                                    <div class="text-center h-100 w-100 d-flex flex-column">
                                                        <img src="./images/posts/<?= $data['timeline_post_media'] ?>" data-post-id="<?= $data['timeline_post_id'] ?>" class="viewImage img-fluid h-100 shadow-sm rounded-3" style="object-fit:cover;object-position: center;">
                                                    </div>
                                                </div>
                                    <?php
                                            }
                                            $counter++;
                                        }
                                    }
                                    else {
                                        ?>
                                        <div class="card-text fs-5">No photos yet.</div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Photos -->
            </div>
            <!-- Row -->
        </div>
        <!-- Timeline Events/Announcement/Gallery -->


        <!-- Timeline Posts -->
        <div class="col-lg-8 col-sm-12">
            <!-- Start A Post -->
            <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title">
                        <div class="row">

                            <!-- Profile Picture -->
                            <div class="col-2" style="height:100px; width:100px;">
                                <div class="text-center h-75 w-100 d-flex flex-column">
                                    <img src="./images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
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
                                    <div class="col-lg-4 col-md-12">
                                        <span class="icon-calendar-o me-2 text-warning"></span>Event
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <span class="icon-bullhorn me-2 text-danger"></span>Announcement
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- List Of Posts-->
            <div id="displayListofPosts">
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
                $sql = "SELECT * FROM `timeline_posts` WHERE `timeline_post_user_id` = $user_id ORDER BY `timeline_post_date` DESC LIMIT $offset, $total_records_per_page";

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
                                                    <img src="./images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                                                </div>
                                            </div>

                                            <!-- Profile Name & Date Posted -->
                                            <div class="col d-flex">
                                                <div class="w-100">
                                                    <h3 class="fw-bold text-primary"><?= $user_name ?></h3>
                                                    <div class="card-subtitle text-muted">Posted on <?= date_format($timeline_post_date, "F d, Y") ?> at <?= date_format($timeline_post_date, "h:i A") ?></div>
                                                </div>
                                                <div class="dropdown">
                                                    <span class="icon-dots-three-horizontal fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
                                                    <ul class="dropdown-menu">
                                                        <li><button value="<?= $data['timeline_post_id'] ?>" class="editTimelinePostButton dropdown-item">Edit</button></li>
                                                        <li><button value="<?= $data['timeline_post_id'] ?>" class="deleteTimelinePostButton dropdown-item">Delete</button></li>
                                                    </ul>
                                                </div>
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
                                                        <img src="./images/posts/<?= $data['timeline_post_media'] ?>" data-post-id="<?= $data['timeline_post_id'] ?>" class="viewImage img-fluid h-100 rounded-3" style="object-fit:cover; object-position:center;">
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
                                                    <img src="./images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                                                </div>
                                            </div>

                                            <!-- Profile Name & Date Posted -->
                                            <div class="col d-flex">
                                                <div class="w-100">
                                                    <h3 class="fw-bold text-primary"><?= $user_name ?></h3>
                                                    <div class="card-subtitle text-muted">Posted an <strong><span class="icon-calendar-o me-2 text-warning"></span>Event</strong> on <?= date_format($timeline_post_date, "F d, Y") ?> at <?= date_format($timeline_post_date, "h:i A") ?></div>
                                                </div>
                                                <div class="dropdown">
                                                    <span class="icon-dots-three-horizontal fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
                                                    <ul class="dropdown-menu">
                                                        <li><button value="<?= $data['timeline_post_id'] ?>" class="editTimelinePostEventButton dropdown-item">Edit</button></li>
                                                        <li><button value="<?= $data['timeline_post_id'] ?>" class="deleteTimelinePostButton dropdown-item">Delete</button></li>
                                                    </ul>
                                                </div>
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
                                                                    <img src="./images/posts/<?= $data['timeline_post_media'] ?>" data-post-id="<?= $data['timeline_post_id'] ?>" class="viewImage img-fluid h-100 rounded-3" style="object-fit:cover; object-position:center;">
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
                                                    <img src="./images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                                                </div>
                                            </div>

                                            <!-- Profile Name & Date Posted -->
                                            <div class="col d-flex">
                                                <div class="w-100">
                                                    <h3 class="fw-bold text-primary"><?= $user_name ?></h3>
                                                    <div class="card-subtitle text-muted">Posted an <strong><span class="icon-bullhorn me-2 text-danger"></span>Announcement</strong> on <?= date_format($timeline_post_date, "F d, Y") ?> at <?= date_format($timeline_post_date, "h:i A") ?></div>
                                                </div>
                                                <div class="dropdown">
                                                    <span class="icon-dots-three-horizontal fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
                                                    <ul class="dropdown-menu">
                                                        <li><button value="<?= $data['timeline_post_id'] ?>" class="editTimelinePostAnnouncementButton dropdown-item">Edit</button></li>
                                                        <li><button value="<?= $data['timeline_post_id'] ?>" class="deleteTimelinePostButton dropdown-item">Delete</button></li>
                                                    </ul>
                                                </div>
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
                                                                    <img src="./images/posts/<?= $data['timeline_post_media'] ?>" data-post-id="<?= $data['timeline_post_id'] ?>" class="viewImage img-fluid h-100 rounded-3" style="object-fit:cover; object-position:center;">
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
                            <img src="./images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
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
                            <img src="./images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
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
                            <img src="./images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
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
                            <img src="./images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
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
                            <img src="./images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
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
                            <img src="./images/profilePictures/<?= $_SESSION['auth_user']['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
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

<!-- View Gallery -->
<div class="modal fade" id="viewGalleryModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">View <?= $user_name ?>'s Gallery</h1>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php
                    $sql = "SELECT `timeline_post_id`, `timeline_post_media` FROM `timeline_posts` WHERE `timeline_post_user_id` = '$user_id' AND `timeline_post_media` IS NOT NULL ORDER BY `timeline_post_date`";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($check_result) {

                        while ($data = mysqli_fetch_array($result)) {
                    ?>
                            <div class="d-inline p-1" style="height:100px; width:100px;">
                                <div class="text-center h-100 w-100 d-flex flex-column">
                                    <img src="./images/posts/<?= $data['timeline_post_media'] ?>" data-post-id="<?= $data['timeline_post_id'] ?>" class="viewImageGallery img-fluid h-100 shadow-sm rounded-3" style="object-fit:cover;object-position: center;">
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        ?>
                        <h4 class="text-center fw-bold text-muted">No photos yet.</h4>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-center w-100">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Gallery Image -->
<div class="modal fade" id="viewGalleryImageModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header border-0">
                <h1 class="modal-title w-100 text-center fs-5">View Gallery Image</h1>
            </div>
            <div class="modal-body">
                <div class="row">
                    <img src="" id="viewFullGalleryImage" class="img-fluid rounded-3 mw-100 mh-100">
                </div>
            </div>
            <div class="modal-footer border-0">
                <div class="text-center w-100">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewGalleryModal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>