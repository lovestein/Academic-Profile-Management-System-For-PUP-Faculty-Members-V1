<div class="container-fluid">
    <div class="row justify-content-center mt-3">
        <div class="col-lg-4 col-sm-12">
            <div class="row">

                <!-- Events -->
                <div class="col-lg-12 col-sm-6 mb-3 d-none d-md-block">
                    <div id="eventsCard" class="card p-1 border-0 shadow-lg rounded-5">
                        <div class="card-body text-dark">
                            <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                                <h3 class="fw-bold text-primary w-100 m-0">Events</h3>

                            </div>
                            <div class="card-text fs-5">
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
                                    No events yet.
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
                            </div>
                            <div class="card-text fs-5">
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
                                    No announcements yet.
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
                                    } else {
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
        </div>

        <div class="col-lg-8 col-sm-12">

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
                                                    <img src="./images/profilePictures/<?= $user_image ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
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
                                                    <img src="./images/profilePictures/<?= $user_image ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
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
                                                    <img src="./images/profilePictures/<?= $user_image ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
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
                                <li class="page-item"><a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?>" <?= ($page_no > 1) ? 'href=?page_no=' . $previous_page . '&username=' . $user_account_username : ''; ?>>Previous</a></li>
                                <?php for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                    if ($page_no !== $counter) {
                                ?>
                                        <li class="page-item"><a class="page-link" href="?page_no=<?= $counter; ?>&username=<?= $user_account_username; ?>"><?= $counter; ?></a></li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item"><a class="page-link active"><?= $counter; ?></a></li>
                                <?php
                                    }
                                } ?>

                                <li class="page-item"><a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?>" <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' . $next_page . '&username=' . $user_account_username : ''; ?>>Next</a></li>
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