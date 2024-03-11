<?php
$page_title = "Course Details";
include './includes/headerUser.php';
$user_id = $_SESSION['auth_user']['user_id'];
$course_id = $_GET['courseID'];
?>

<!-- Cover Photo -->
<section class="bg-img-cover">
    <div class="container-lg">
        <div class="row justify-content-center align-items-center p-5">
            <div class="col text-center">
                <?php
                $sql = "SELECT `course_title` FROM `courses` WHERE `course_id` = '$course_id'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    while ($data = mysqli_fetch_array($result)) {
                ?>
                        <h1 class="text-primary fw-bold display-2"><?= $data['course_title'] ?></h1>
                    <?php
                    }
                } else {
                    ?>
                    <h1 class="text-primary fw-bold display-2">Course title could not be retrieved.</h1>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- Course Contents -->
<section>
    <div class="container-fluid">
        <!-- Course Description -->
        <div class="card mt-3 p-2 border-0 shadow-lg rounded-5">
            <div class="card-body text-dark">
                <div class="card-title border-2 border-bottom border-primary d-flex align-items-center pb-2">
                    <h3 class="fw-bold text-primary w-100 m-0">Course Description</h3>
                </div>
                <div class="card-text m-0 fs-5">
                    <?php
                    $sql = "SELECT `course_description` FROM `courses` WHERE `course_id` = '$course_id'";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($data = mysqli_fetch_array($result)) {
                    ?>
                            <p><?= $data['course_description'] ?></p>
                        <?php
                        }
                    } else {
                        ?>
                        <p>Course description could not be retrieved.</p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Access Codes -->
            <div class="col-lg-4 col-sm-12">

                <!-- Access Codes -->
                <div class="card my-3 p-2 border-0 shadow-lg rounded-5">
                    <div class="card-body text-dark">
                        <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                            <h3 class="fw-bold text-primary w-100 m-0">Access Codes</h3>
                            <button id="" class="m-1 btn btn-primary rounded-circle flex-shrink-1" value="" data-bs-toggle="modal" data-bs-target="#modifyAccessCodesModal">
                                <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Access Codes"></span>
                            </button>
                        </div>

                        <!-- List of Access Codes -->
                        <div id="displayListOfAccessCodes" class="card-text m-0 fs-5">

                            <?php
                            $sql = "SELECT * FROM `access_codes` WHERE `access_course_id` = '$course_id'";
                            $result = mysqli_query($con, $sql);
                            $check_result = mysqli_num_rows($result) > 0;
                            if ($check_result) {
                                while ($data = mysqli_fetch_array($result)) {
                                    $start_date = new DateTime($data['access_code_start_date']);
                                    $end_date = new DateTime($data['access_code_end_date']);
                            ?>
                                    <p class="card-subtitle text-center text-muted fw-bold"><small>Validity: <?= date_format($start_date, "m/d/Y") ?> — <?= date_format($end_date, "m/d/Y") ?></small></p>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control text-center" value="<?= $data['access_code'] ?>" readonly>
                                        <button class="clipBoardButton btn btn-outline-secondary" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Copy to Clipboard">
                                            <span class="icon-clipboard"></span>
                                        </button>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <h4 class="text-center fw-bold text-muted">No access codes yet.</h4>
                            <?php
                            }
                            ?>
                        </div>

                        <!-- Generate New Access Code -->
                        <button class="btn btn-info form-control rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#createAccessCodesModal">Generate New Access Code</button>
                    </div>
                </div>

            </div>

            <!-- Lecture Materials -->
            <div class="col-lg-8 col-sm-12">
                <div class="card my-3 p-2 border-0 shadow-lg rounded-5">
                    <div class="card-body text-dark">
                        <div class="card-title border-2 border-bottom border-primary d-flex align-items-center pb-2">
                            <h3 class="fw-bold text-primary w-100 m-0">Lecture Materials</h3>
                            <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#insertLectureMaterialsModal">
                                <span class="icon-plus-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Create New Lecture Material"></span>
                            </button>
                        </div>

                        <!-- List of Lecture Materials -->
                        <div id="displayListOfLectureMaterials">
                            <?php
                            $sql = "SELECT * FROM `lecture_materials` WHERE `lecture_course_id` = '$course_id'";
                            $result = mysqli_query($con, $sql);
                            $check_result = mysqli_num_rows($result) > 0;
                            if ($result) {
                                while ($data = mysqli_fetch_array($result)) {
                            ?>
                                    <div class="card my-3 p-2 border-0 shadow-lg rounded-5">
                                        <div class="card-body text-dark">
                                            <div class="card-title border-2 border-bottom border-primary d-flex align-items-center pb-2">
                                                <h3 class="fw-bold text-primary w-100 m-0"><?= $data['lecture_title'] ?></h3>
                                                <div class="dropdown">
                                                    <span class="icon-dots-three-horizontal fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
                                                    <ul class="dropdown-menu">
                                                        <li><button value="<?= $data['lecture_material_id'] ?>" class="editLectureMaterialButton dropdown-item">Edit</button></li>
                                                        <li><button value="<?= $data['lecture_material_id'] ?>" class="deleteLectureMaterialButton dropdown-item">Delete</button></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-text m-0 fs-5">
                                                <p>
                                                    <?= $data['lecture_description'] ?>
                                                </p>
                                                <p class="card-subtitle text-muted fw-bold"><small>Reference Link:</small></p>
                                                <div class="position-relative">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control text-info" value="<?= $data['lecture_url'] ?>" readonly>
                                                        <button class="clipBoardButton btn btn-outline-secondary" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Copy to Clipboard">
                                                            <span class="icon-clipboard"></span>
                                                        </button>
                                                    </div>
                                                    <a href="<?= $data['lecture_url'] ?>" class="stretched-link" target="_blank"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modals -->
<!-- Lecture Materials -->
<!-- Insert Lecture Material Modal -->
<div class="modal fade" id="insertLectureMaterialsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Insert New Lecture Material</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertInsertLectureMaterial" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageInsertLectureMaterial" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="insertLectureMaterialForm" class="row g-2">
                    <input type="hidden" name="insertLectureCourseID" id="insertLectureCourseID" value="<?= $course_id ?>">
                    <div class="col-lg-12 col-sm-12">
                        <label for="insertLectureTitle" class="form-label fw-bold">Lecture Title</label>
                        <input type="text" class="form-control bg-light" name="insertLectureTitle" placeholder="Enter lecture title.">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="insertLectureDescription" class="form-label fw-bold">Lecture Description</label>
                        <textarea id="insertLectureDescription" name="insertLectureDescription" type="text" class="form-control bg-light" style="height: 100px;"></textarea>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="insertLectureLink" class="form-label fw-bold">Lecture Reference Link</label>
                        <input type="text" class="form-control bg-light" name="insertLectureLink" placeholder="Enter lecture reference link.">
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

<!-- Edit Lecture Material Modal -->
<div class="modal fade" id="editLectureMaterialsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit New Lecture Material</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditLectureMaterial" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditLectureMaterial" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editLectureMaterialForm" class="row g-2">
                    <input type="hidden" name="editLectureMaterialID" id="editLectureMaterialID">
                    <div class="col-lg-12 col-sm-12">
                        <label for="editLectureTitle" class="form-label fw-bold">Lecture Title</label>
                        <input id="editLectureTitle" name="editLectureTitle" type="text" class="form-control bg-light" placeholder="Enter lecture title.">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="editLectureDescription" class="form-label fw-bold">Lecture Description</label>
                        <textarea id="editLectureDescription" name="editLectureDescription" type="text" class="form-control bg-light" style="height: 100px;"></textarea>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="editLectureLink" class="form-label fw-bold">Lecture Reference Link</label>
                        <input id="editLectureLink" name="editLectureLink" type="text" class="form-control bg-light" placeholder="Enter lecture reference link.">
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

<!-- Delete Lecture Material Modal -->
<div class="modal fade" id="deleteLectureMaterialsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Lecture Material</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeleteLectureMaterial" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeleteLectureMaterial" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deleteLectureMaterialForm" class="row g-2">
                    <input type="hidden" id="deleteLectureMaterialID" name="deleteLectureMaterialID">
                    <p>Confirm deletion of <strong id="deleteLectureMaterialTitle"></strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Access Codes -->
<!-- Create Access Code -->
<div class="modal fade" id="createAccessCodesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Generate New Access Code</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreateAccessCode" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateAccessCode" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createAccessCodeForm" class="row g-2">
                    <input type="hidden" name="createAccessCourseID" id="createAccessCourseID" value="<?= $course_id ?>">
                    <h5>Provide Validity Date</h5>
                    <div class="col-lg-6 col-sm-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Start Date</span>
                            <input id="createAccessCodeStartDate" name="createAccessCodeStartDate" type="date" class="datePicker form-control" onkeydown="return false">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text">End Date</span>
                            <input id="createAccessCodeEndDate" name="createAccessCodeEndDate" type="date" class="datePicker form-control" onkeydown="return false">
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

<!-- Successful Access Code -->
<div class="modal fade" id="successAccessCodeModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">New Access Code</h1>
            </div>
            <div class="modal-body">
                <p class="card-subtitle text-center text-muted fw-bold">Validity: <strong id="newAccessCodeStartDate"></strong> — <strong id="newAccessCodeEndDate"></strong></p>
                <div class="input-group mb-3">
                    <input id="newAccessCode" type="text" class="form-control text-center" readonly>
                    <button class="clipBoardButton btn btn-outline-secondary" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Copy to Clipboard">
                        <span class="icon-clipboard"></span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modify List of Access Codes -->
<div class="modal fade" id="modifyAccessCodesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Modify Access Codes</h1>
            </div>
            <div class="modal-body">
                <div id="displayAccessCodes" class="row g-2">
                    <?php
                    $sql = "SELECT * FROM `access_codes` WHERE `access_course_id` = '$course_id'";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($result) {
                        while ($data = mysqli_fetch_array($result)) {
                            $start_date = new DateTime($data['access_code_start_date']);
                            $end_date = new DateTime($data['access_code_end_date']);
                    ?>
                            <div class="col-lg-4 col-md-12">
                                <label for="accessCode" class="form-label fw-bold">Access Code</label>
                                <input value="<?= $data['access_code'] ?>" type="text" class="form-control bg-light" name="accessCode" readonly>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label for="validityDate" class="form-label fw-bold">Validity Date</label>
                                <input value="<?= date_format($start_date, "F d, Y") ?> — <?= date_format($end_date, "F d, Y") ?>" type="text" class="form-control bg-light" name="validityDate" readonly>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <label class="form-label fw-bold">Actions</label>
                                <div class="d-grid gap-2 ms-1 d-md-block">
                                    <button value="<?= $data['access_code_id'] ?>" class="editAccessCodeButton btn btn-success"><span class="icon-pencil"></span></button>
                                    <button value="<?= $data['access_code_id'] ?>" class="deleteAccessCodeButton btn btn-danger"><span class="icon-trash"></span></button>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <p>Data could not be retrieved.</p>
                    <?php
                    }
                    ?>
                </div>
                <div class="modal-footer mt-2 pb-0 px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="saveAccessCodes" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Access Code -->
<div class="modal fade" id="editAccessCodesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Access Code</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditAccessCode" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditAccessCode" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editAccessCodeForm" class="row g-2">
                    <input type="hidden" name="editAccessCodeID" id="editAccessCodeID">
                    <div class="col-lg-4 col-sm-12">
                        <label for="editAccessCode" class="form-label fw-bold">Access Code</label>
                        <input id="editAccessCode" name="editAccessCode" type="text" class="form-control" readonly>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label for="editAccessCodeStartDate" class="form-label fw-bold">Valid From</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Start Date</span>
                            <input id="editAccessCodeStartDate" name="editAccessCodeStartDate" type="date" class="datePicker form-control" onkeydown="return false">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label for="editAccessCodeEndDate" class="form-label fw-bold">Valid Until</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">End Date</span>
                            <input id="editAccessCodeEndDate" name="editAccessCodeEndDate" type="date" class="datePicker form-control" onkeydown="return false">
                        </div>
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary position-relative" data-bs-toggle="modal" data-bs-target="#modifyAccessCodesModal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Access Code Modal -->
<div class="modal fade" id="deleteAccessCodesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Access Code</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeleteAccessCode" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeleteAccessCode" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deleteAccessCodeForm" class="row g-2">
                    <input type="hidden" id="deleteAccessCodeID" name="deleteAccessCodeID">
                    <p>Confirm deletion of access code — <strong id="deleteAccessCode"></strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modifyAccessCodesModal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include './includes/footerUser.php';
?>