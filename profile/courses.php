<div class="container-fluid">
    <!-- Courses -->
    <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
        <div class="card-body text-dark">
            <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                <h3 class="fw-bold text-primary w-100 m-0">List of Courses</h3>
                <button class="m-1 btn btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#modifyCoursesModal">
                    <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Course Details"></span>
                </button>
            </div>
            <p class="card-text m-0 fs-5">
                This is your course list available to the public online which can be accessed using an access code that you will provide. You may click the modify button to manage each specific course or create a new one. You may also click <strong>View Course Details</strong> to organize and make necessary adjusments for each specific course contents.
            </p>
        </div>
    </div>
    <!-- List of Courses -->
    <div id="listOfCourses">
        <?php
        $sql = "SELECT * FROM `courses` WHERE `course_user_id` = '$user_id'";
        $result = mysqli_query($con, $sql);
        $check_result = mysqli_num_rows($result) > 0;
        if ($result) {
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
                        <p class="card-text float-end">
                            <a href="./profileCourseDetails.php?courseID=<?= $data['course_id'] ?>" type="button" class="btn btn-link text-decoration-none">
                                View Course Details
                            </a>
                        </p>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<!-- Modals -->
<!-- Modify List of Courses Modal -->
<div class="modal fade" id="modifyCoursesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Modify Courses</h1>
            </div>
            <div class="modal-body">
                <div id="displayCourses" class="row g-2">
                    <?php
                    $sql = "SELECT
                                C.course_id AS courseID,
                                C.course_title AS courseTitle,
                                C.course_description AS courseDescription,
                                COALESCE(AC.accessCodesCount, 0) AS accessCodesCount,
                                COALESCE(LM.lectureMaterialsCount, 0) AS lectureMaterialsCount
                            FROM
                                courses C
                            LEFT JOIN
                                (SELECT
                                    access_course_id,
                                    COUNT(access_code_id) AS accessCodesCount
                                FROM
                                    access_codes
                                GROUP BY
                                    access_course_id) AC ON C.course_id = AC.access_course_id
                            LEFT JOIN
                                (SELECT
                                    lecture_course_id,
                                    COUNT(lecture_material_id) AS lectureMaterialsCount
                                FROM
                                    lecture_materials
                                GROUP BY
                                    lecture_course_id) LM ON C.course_id = LM.lecture_course_id
                            WHERE
                                C.course_user_id = $user_id;";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($check_result) {
                        while ($data = mysqli_fetch_array($result)) {
                    ?>
                            <div class="col-lg-12 col-md-12">
                                <label for="courseTitle" class="form-label fw-bold">Course Title</label>
                                <input value="<?= $data['courseTitle'] ?>" type="text" class="form-control bg-light" name="courseTitle" readonly>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <label for="courseDescription" class="form-label fw-bold">Course Description</label>
                                <textarea id="courseDescription" name="courseDescription" type="text" class="form-control bg-light" style="height: 100px;" readonly><?= $data['courseDescription'] ?></textarea>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label for="accessCodes" class="form-label fw-bold">No. of Access Codes</label>
                                <input value="<?= $data['accessCodesCount'] ?>" type="text" class="form-control bg-light" name="accessCodes" readonly>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label for="lectureMaterials" class="form-label fw-bold">No. of Lecture Materials</label>
                                <input value="<?= $data['lectureMaterialsCount'] ?>" type="text" class="form-control bg-light" name="lectureMaterials" readonly>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <label class="form-label fw-bold">Actions</label>
                                <div class="d-grid gap-2 ms-1 d-block">
                                    <button value="<?= $data['courseID'] ?>" class="editCourseButton btn btn-success"><span class="icon-pencil"></span></button>
                                    <button value="<?= $data['courseID'] ?>" class="deleteCourseButton btn btn-danger"><span class="icon-trash"></span></button>
                                </div>
                            </div>
                        <?php
                        }
                    } else if (!$check_result) {
                        ?>
                        <h4 class="text-center fw-bold">Click the create button below to make a new course.</h4>
                    <?php
                    } else {
                    ?>
                        <h4 class="text-center fw-bold">Data could not be retrieved.</h4>
                    <?php
                    }
                    ?>
                </div>
                <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#createCoursesModal">
                    <span class="icon-plus-circle fs-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Create New Course"></span>
                </button>
                <div class="modal-footer mt-2 pb-0 px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="saveCourses" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Create New Course Modal -->
<div class="modal fade" id="createCoursesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create New Course</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreateCourse" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateCourse" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createCourseForm" class="row g-2">
                    <input type="hidden" name="createCourseUserID" value="<?= $user_id ?>">
                    <h4 class="text-center">Course Details</h4>
                    <div class="col-lg-12 col-sm-12">
                        <label for="createCourseTitle" class="form-label fw-bold">Course Title</label>
                        <input type="text" class="form-control bg-light" name="createCourseTitle" placeholder="Enter course title.">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="createCourseDescription" class="form-label fw-bold">Course Description</label>
                        <textarea id="createCourseDescription" name="createCourseDescription" type="text" class="form-control bg-light" style="height: 100px;"></textarea>
                    </div>
                    <h4 class="text-center">Course Access Code Validity Date</h4>
                    <div class="col-lg-6 col-sm-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Start Date</span>
                            <input id="accessCodeStartDate" name="accessCodeStartDate" type="date" class="datePicker form-control" onkeydown="return false">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text">End Date</span>
                            <input id="accessCodeEndDate" name="accessCodeEndDate" type="date" class="datePicker form-control" onkeydown="return false">
                        </div>
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyCoursesModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Course Modal  -->
<div class="modal fade" id="editCoursesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Course</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditCourse" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditCourse" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editCourseForm" class="row g-2">
                    <input type="hidden" id="editCourseID" name="editCourseID">
                    <div class="col-lg-12 col-sm-12">
                        <label for="editCourseTitle" class="form-label fw-bold">Course Title</label>
                        <input id="editCourseTitle" type="text" class="form-control bg-light" name="editCourseTitle" placeholder="Enter course title.">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="editCourseDescription" class="form-label fw-bold">Course Description</label>
                        <textarea id="editCourseDescription" name="editCourseDescription" type="text" class="form-control bg-light" style="height: 100px;"></textarea>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="editAccessCodes" class="form-label fw-bold">No. of Access Codes</label>
                        <input id="editAccessCodes" type="text" class="form-control bg-light" name="editAccessCodes" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify access codes on course details" readonly>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="editLectureMaterials" class="form-label fw-bold">No. of Lecture Materials</label>
                        <input id="editLectureMaterials" type="text" class="form-control bg-light" name="editLectureMaterials" name="accessCodes" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify lecture materials on course details" readonly>
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyCoursesModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Course Modal -->
<div class="modal fade" id="deleteCoursesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Course</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeleteCourse" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeleteCourse" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deleteCourseForm" class="row g-2">
                    <input type="hidden" id="deleteCourseID" name="deleteCourseID">
                    <p class="text-center">This will <strong>permanently delete</strong> the course along with of its contents i.e (accesss codes, lecture materials) all together. Confirm deletion of <strong id="deleteCourseTitle"></strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyCoursesModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Create Lecture Material Modal -->
<div class="modal fade" id="createLectureMaterialsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create New Lecture Material</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreateLecture" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateLecture" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createLectureMaterialForm" class="row g-2">
                    <input type="hidden" name="lectureCourseID" id="lectureCourseID">
                    <h4 class="text-center">Lecture Material</h4>
                    <div class="col-lg-12 col-sm-12">
                        <label for="createLectureTitle" class="form-label fw-bold">Lecture Title</label>
                        <input type="text" class="form-control bg-light" name="createLectureTitle" placeholder="Enter lecture title.">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="createLectureDescription" class="form-label fw-bold">Lecture Description</label>
                        <textarea id="createLectureDescription" name="createLectureDescription" type="text" class="form-control bg-light" style="height: 100px;"></textarea>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="createLectureLink" class="form-label fw-bold">Lecture Reference Link</label>
                        <input type="text" class="form-control bg-light" name="createLectureLink" placeholder="Enter lecture reference link.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary position-relative" data-bs-dismiss="modal">
                            <a id="skipCreateLecture" href="#" class="text-decoration-none link-light stretched-link" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Skip and proceed to view course details">
                                Skip
                            </a>
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>