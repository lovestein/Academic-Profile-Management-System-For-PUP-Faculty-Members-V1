<div class="container-fluid">
    <!-- List of Courses -->
    <div id="listOfCourses">
        <?php
        $sql = "SELECT * FROM `courses` WHERE `course_user_id` = '$user_id'";
        $result = mysqli_query($con, $sql);
        $check_result = mysqli_num_rows($result) > 0;
        if ($check_result) {
            while ($data = mysqli_fetch_array($result)) {
        ?>
                <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                    <div class="card-body text-dark">
                        <div class="card-title border-2 border-bottom border-primary d-flex">
                            <h3 class="fw-bold text-primary w-100"><?= $data['course_title'] ?></h3>
                        </div>
                        <p class="card-text fs-5">
                            <?= $data['course_description'] ?>
                        </p>
                        <div class="card-text float-end">
                            <p id="provideAccessCode" data-course-id="<?= $data['course_id'] ?>" class="btn btn-link text-decoration-none m-0" style="cursor: pointer;">
                                View Course Details <span class="icon-eye ms-1"></span>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            <h4 class="text-center fw-bold text-muted my-3">No courses yet.</h4>
        <?php
        }
        ?>
    </div>
</div>

<!-- Modals -->
<!-- Validate Access Code Modal -->
<div class="modal fade" id="validateCourseAccessCodeModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Course Access Code</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertValidateCourseAccessCode" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageValidateCourseAccessCode" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="validateCourseAccessCodeForm" class="row g-2" autocomplete="off">
                    <input type="hidden" id="validateCourseAccessCodeID" name="validateCourseAccessCodeID">
                    <input type="text" id="validateCourseAccessCode" name="validateCourseAccessCode" placeholder="Enter Access Code" class="form-control text-center mb-2" style="height: 80px; font-size: 30px;">
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Access Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>