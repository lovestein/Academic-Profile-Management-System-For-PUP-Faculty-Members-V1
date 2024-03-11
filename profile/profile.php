<!-- Teacher - My Profile -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Bio/Profile Card -->
            <div id="biographyCard" class="card my-3 p-2 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                        <h3 class="fw-bold text-primary w-100 m-0">Biography</h3>
                        <?php
                        $sql = "SELECT `user_biography` AS Biography FROM `user_profiles` WHERE `user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                            while ($data = mysqli_fetch_array($result)) {
                                if ($data['Biography'] !== NULL) {
                        ?>
                                    <button id="editBiographyButton" class="m-1 btn btn-primary rounded-circle" value="<?= $user_id ?>" data-bs-toggle="modal" data-bs-target="#editBioModal">
                                        <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Biography Details"></span>
                                    </button>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <p class="card-text m-0 fs-5">
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $sql = "SELECT `user_biography` AS Biography FROM `user_profiles` WHERE `user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                            while ($data = mysqli_fetch_array($result)) {
                                if ($data['Biography'] == NULL) {
                        ?>
                                    <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createBioModal"><span class="icon-plus-circle fs-3"></span></button>
                        <?php
                                } else {
                                    echo $data['Biography'];
                                }
                            }
                        }
                        ?>
                    </p>
                </div>
            </div>

            <!-- Academic Appointments -->
            <div id="academicAppointmentsCard" class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                        <h3 class="fw-bold text-primary w-100 m-0">Academic Appointments</h3>
                        <?php
                        $sql = "SELECT * FROM `academic_appointments` WHERE `academic_appointment_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?>
                            <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modifyAcademicAppointmentsModal">
                                <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Academic Appointments"></span>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-text m-0 fs-5">
                        <?php
                        $sql = "SELECT * FROM `academic_appointments` WHERE `academic_appointment_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?><ul>
                                <?php
                                while ($data = mysqli_fetch_array($result)) {
                                ?>
                                    <li>Assigned as <?= $data['academic_position'] ?> in the field of <?= $data['academic_field'] ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        <?php
                        } else {
                        ?>
                            <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createAcademicAppointmentsModal"><span class="icon-plus-circle fs-3"></span></button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Honors & Awards -->
            <div id="honorsAwardsCard" class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                        <h3 class="fw-bold text-primary w-100 m-0">Honors & Awards</h3>
                        <?php
                        $sql = "SELECT * FROM `honors_awards` WHERE `awards_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?>
                            <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modifyHonorsAwardsModal">
                                <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Honors & Awards"></span>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-text m-0 fs-5">
                        <?php
                        $sql = "SELECT * FROM `honors_awards` WHERE `awards_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?><ul>
                                <?php
                                while ($data = mysqli_fetch_array($result)) {
                                    $date = new DateTime($data['award_date']);
                                ?>
                                    <li><strong><?= $data['award_title'] ?></strong> — <?= date_format($date, "F d, Y") ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        <?php
                        } else {
                        ?>
                            <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createHonorsAwardsModal"><span class="icon-plus-circle fs-3"></span></button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Adminisitrative Appointments -->
            <div id="administrativeAppointmentCard" class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                        <h3 class="fw-bold text-primary w-100 m-0">Adminisitrative Appointments</h3>
                        <?php
                        $sql = "SELECT * FROM `administrative_appointments` WHERE `administrative_appointment_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?>
                            <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modifyAdministrativeAppointmentsModal">
                                <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Administrative Appointments"></span>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-text m-0 fs-5">
                        <?php
                        $sql = "SELECT * FROM `administrative_appointments` WHERE `administrative_appointment_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?><ul>
                                <?php
                                while ($data = mysqli_fetch_array($result)) {
                                    $start_date = new DateTime($data['administrative_start_date']);
                                    $end_date = new DateTime($data['administrative_end_date']);
                                ?>
                                    <li><strong><?= $data['administrative_position'] ?></strong>, <strong><?= $data['administrative_organization'] ?></strong> (<?= date_format($start_date, "F, Y") ?> — <?= date_format($end_date, "F, Y") ?>)</li>
                                <?php
                                }
                                ?>
                            </ul>
                        <?php
                        } else {
                        ?>
                            <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createAdministrativeAppointmentsModal"><span class="icon-plus-circle fs-3"></span></button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <!-- Other Accounts -->
            <div id="otherAccountsCard" class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                        <h3 class="fw-bold text-primary w-100 m-0">Other Accounts</h3>
                        <?php
                        $sql = "SELECT * FROM `other_accounts` WHERE `link_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?>
                            <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modifyOtherAccountsModal">
                                <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Other Accounts"></span>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-text m-0 fs-5">
                        <?php
                        $sql = "SELECT * FROM `other_accounts` WHERE `link_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?>
                            <?php
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                                <div class="position-relative">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text bg-transparent border-end-0 p-0 ps-2">
                                            <span class="<?= $data['link_name'] ?>"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                                        </div>
                                        <input type="text" class="form-control text-info border-start-0 border-end-0" value="<?= $data['link_url'] ?>" readonly>
                                        <button class="clipBoardButton btn border border-start-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Copy to Clipboard">
                                            <span class="icon-clipboard"></span>
                                        </button>
                                    </div>
                                    <a href="<?= $data['link_url'] ?>" class="stretched-link" target="_blank"></a>
                                </div>
                            <?php
                            }
                            ?>

                        <?php
                        } else {
                        ?>
                            <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createOtherAccountsModal"><span class="icon-plus-circle fs-3"></span></button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Research Interests -->
            <div id="researchInterestsCard" class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                        <h3 class="fw-bold text-primary w-100 m-0">Research Interests</h3>
                        <?php
                        $sql = "SELECT * FROM `research_interests` WHERE `research_interest_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?>
                            <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modifyResearchInterestsModal">
                                <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Research Interests"></span>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-text m-0 fs-5">
                        <?php
                        $sql = "SELECT * FROM `research_interests` WHERE `research_interest_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?><ul>
                                <?php
                                while ($data = mysqli_fetch_array($result)) {
                                ?>
                                    <li>
                                        <?= $data['research_interest_description'] ?>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        <?php
                        } else {
                        ?>
                            <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createResearchInterestsModal"><span class="icon-plus-circle fs-3"></span></button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- PUP Advisees -->
            <div id="pupAdviseesCard" class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                        <h3 class="fw-bold text-primary w-100 m-0">PUP Advisees</h3>
                        <?php
                        $sql = "SELECT * FROM `pup_advisees` WHERE `advisee_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?>
                            <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modifyPupAdviseesModal">
                                <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify PUP Advisees"></span>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-text m-0 fs-5">
                        <?php
                        $sql = "SELECT * FROM `pup_advisees` WHERE `advisee_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                        ?><ul>
                                <?php
                                while ($data = mysqli_fetch_array($result)) {
                                ?>
                                    <li><strong><?= $data['advisee_course_name'] ?></strong> (<?= $data['advisee_course_year'] ?> - <?= $data['advisee_course_section'] ?>)</li>
                                <?php
                                }
                                ?>
                            </ul>
                        <?php
                        } else {
                        ?>
                            <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createPupAdviseesModal"><span class="icon-plus-circle fs-3"></span></button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


<!-- Biography Modals -->
<!-- Create Biography Modal-->
<div class="modal fade" id="createBioModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5" id="staticBackdropLabel">Create Biography</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreateBiography" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateBiography" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createBiographyForm">
                    <input name="createBiographyID" type="hidden" value="<?= $user_id ?>">
                    <textarea id="userCreateBiography" name="userCreateBiography" type="text" class="form-control bg-light" style="height: 300px;"></textarea>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Biography Modal -->
<div class="modal fade" id="editBioModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5" id="staticBackdropLabel">Edit Biography</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditBiography" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditBiography" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editBiographyForm">
                    <input id="editBiographyID" name="editBiographyID" type="hidden">
                    <textarea id="userEditBiography" name="userEditBiography" type="text" class="form-control bg-light" style="height: 300px;"></textarea>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Academic Appointmens Modals -->
<!-- Create Academic Appointment Modal -->
<div class="modal fade" id="createAcademicAppointmentsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create Academic Appointments</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreateAcademicAppointment" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateAcademicAppointment" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createAcademicAppointmentForm" class="row g-2">
                    <input type="hidden" name="academicAppoinmentUserID" value="<?= $user_id ?>">
                    <div class="col-6">
                        <label for="createAcademicPosition" class="form-label fw-bold">Academic Position</label>
                        <input id="createAcademicPosition" type="text" class="form-control bg-light" name="createAcademicPosition" placeholder="Enter your academic position.">
                    </div>
                    <div class="col-6">
                        <label for="createAcademicField" class="form-label fw-bold">Academic Field</label>
                        <input id="createAcademicField" type="text" class="form-control bg-light" name="createAcademicField" placeholder="Enter your academic field.">
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

<!-- Modify List of Academic Appointments Modal -->
<div class="modal fade" id="modifyAcademicAppointmentsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Modify Academic Appointments</h1>
            </div>
            <div class="modal-body">
                <div id="displayAcademicAppointment" class="row g-2">
                    <?php
                    $sql = "SELECT * FROM `academic_appointments` WHERE `academic_appointment_user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($result) {
                        while ($data = mysqli_fetch_array($result)) {
                    ?>
                            <div class="col-lg-5 col-md-6">
                                <label for="academicPosition" class="form-label fw-bold">Academic Position</label>
                                <input value="<?= $data['academic_position'] ?>" type="text" class="form-control bg-light" name="academicPosition" placeholder="Enter your academic position." disabled>
                            </div>
                            <div class="col-lg-5 col-md-6">
                                <label for="academicField" class="form-label fw-bold">Academic Field</label>
                                <input id="academicField" value="<?= $data['academic_field'] ?>" type="text" class="form-control bg-light" name="editAcademicField" placeholder="Enter your academic field." disabled>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <label class="form-label fw-bold">Actions</label>
                                <div class="d-grid gap-2 ms-1 d-md-block">
                                    <button value="<?= $data['academic_appointment_id'] ?>" class="editAcademicAppointmentButton btn btn-success"><span class="icon-pencil"></span></button>
                                    <button value="<?= $data['academic_appointment_id'] ?>" class="deleteAcademicAppointmentButton btn btn-danger"><span class="icon-trash"></span></button>
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
                <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#insertAcademicAppointmentsModal"><span class="icon-plus-circle fs-3"></span></button>
                <div class="modal-footer mt-2 pb-0 px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="saveAcademicAppointments" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Insert Academic Appointment Modal -->
<div class="modal fade" id="insertAcademicAppointmentsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Insert Academic Appointment</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertInsertAcademicAppointment" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageInsertAcademicAppointment" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="insertAcademicAppointmentForm" class="row g-2">
                    <input type="hidden" name="insertAcademicAppointmentUserID" value="<?= $user_id ?>">
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertAcademicPosition" class="form-label fw-bold">Academic Position</label>
                        <input type="text" class="form-control bg-light" name="insertAcademicPosition" placeholder="Enter your academic position.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertAcademicField" class="form-label fw-bold">Academic Field</label>
                        <input type="text" class="form-control bg-light" name="insertAcademicField" placeholder="Enter your academic field.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyAcademicAppointmentsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Academic Appointment Modal  -->
<div class="modal fade" id="editAcademicAppointmentsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Academic Appointment</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditAcademicAppointment" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditAcademicAppointment" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editAcademicAppointmentForm" class="row g-2">
                    <input type="hidden" id="editAcademicAppointmentID" name="editAcademicAppointmentID">
                    <div class="col-lg-6 col-sm-12">
                        <label for="editAcademicPosition" class="form-label fw-bold">Academic Position</label>
                        <input id="editAcademicPosition" type="text" class="form-control bg-light" name="editAcademicPosition" placeholder="Enter your academic position.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="editAcademicField" class="form-label fw-bold">Academic Field</label>
                        <input id="editAcademicField" type="text" class="form-control bg-light" name="editAcademicField" placeholder="Enter your academic field.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyAcademicAppointmentsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Academnic Appointment Modal -->
<div class="modal fade" id="deleteAcademicAppointmentsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Academic Appointment</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeleteAcademicAppointment" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeleteAcademicAppointment" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deleteAcademicAppointmentForm" class="row g-2">
                    <input type="hidden" id="deleteAcademicAppointmentID" name="deleteAcademicAppointmentID">
                    <p>Confirm deletion of academic position of <strong id="deleteAcademicPosition"></strong> in the field of <strong id="deleteAcademicField"></strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyAcademicAppointmentsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Honors & Awards Modals -->
<!-- Create Honors & Awards Modal -->
<div class="modal fade" id="createHonorsAwardsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create Honors & Awards</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreateHonorsAwards" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateHonorsAwards" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createHonorsAwardsForm" class="row g-2">
                    <input type="hidden" name="awardsUserID" value="<?= $user_id ?>">
                    <div class="col-6">
                        <label for="createAwardTitle" class="form-label fw-bold">Award Title</label>
                        <input id="createAwardTitle" type="text" class="form-control bg-light" name="createAwardTitle" placeholder="Enter your award title.">
                    </div>
                    <div class="col-6">
                        <label for="createAwardDate" class="form-label fw-bold">Award Date</label>
                        <input id="createAwardDate" type="date" class="form-control bg-light" name="createAwardDate" placeholder="Enter your award date.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modify List of Honors & Awards Modal -->
<div class="modal fade" id="modifyHonorsAwardsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Modify Honors & Awards</h1>
            </div>
            <div class="modal-body">
                <div id="displayHonorsAwards" class="row g-2">
                    <?php
                    $sql = "SELECT * FROM `honors_awards` WHERE `awards_user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($result) {
                        while ($data = mysqli_fetch_array($result)) {
                    ?>
                            <div class="col-lg-5 col-md-6">
                                <label for="awardTitle" class="form-label fw-bold">Award Title</label>
                                <input value="<?= $data['award_title'] ?>" type="text" class="form-control bg-light" name="awardTitle" disabled>
                            </div>
                            <div class="col-lg-5 col-md-6">
                                <label for="awardDate" class="form-label fw-bold">Award Date</label>
                                <input value="<?= $data['award_date'] ?>" type="date" class="form-control bg-light" name="awardDate" disabled>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <label class="form-label fw-bold">Actions</label>
                                <div class="d-grid gap-2 ms-1 d-md-block">
                                    <button value="<?= $data['awards_id'] ?>" class="editHonorAwardButton btn btn-success"><span class="icon-pencil"></span></button>
                                    <button value="<?= $data['awards_id'] ?>" class="deleteHonorAwardButton btn btn-danger"><span class="icon-trash"></span></button>
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
                <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#insertHonorsAwardsModal"><span class="icon-plus-circle fs-3"></span></button>
                <div class="modal-footer mt-2 pb-0 px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="saveHonorsAwards" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Insert Honor & Award Modal -->
<div class="modal fade" id="insertHonorsAwardsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Insert Honor & Award</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertInsertHonorAward" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageInsertHonorAward" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="insertHonorAwardForm" class="row g-2">
                    <input type="hidden" name="insertAwardUserID" value="<?= $user_id ?>">
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertAwardTitle" class="form-label fw-bold">Award Title</label>
                        <input type="text" class="form-control bg-light" name="insertAwardTitle" placeholder="Enter your award title.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertAwardDate" class="form-label fw-bold">Academic Field</label>
                        <input type="date" class="form-control bg-light" name="insertAwardDate" placeholder="Enter your award date.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyHonorsAwardsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Honor & Award Modal  -->
<div class="modal fade" id="editHonorsAwardsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Honor & Award</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditHonorAward" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditHonorAward" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editHonorAwardForm" class="row g-2">
                    <input type="hidden" id="editAwardID" name="editAwardID">
                    <div class="col-lg-6 col-sm-12">
                        <label for="editAwardTitle" class="form-label fw-bold">Award Title</label>
                        <input id="editAwardTitle" type="text" class="form-control bg-light" name="editAwardTitle" placeholder="Enter your academic position.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="editAwardDate" class="form-label fw-bold">Academic Field</label>
                        <input id="editAwardDate" type="date" class="form-control bg-light" name="editAwardDate" placeholder="Enter your academic field.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyHonorsAwardsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Honor & Award Modal -->
<div class="modal fade" id="deleteHonorsAwardsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Honor Award</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeleteHonorAward" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeleteHonorAward" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deleteHonorAwardForm" class="row g-2">
                    <input type="hidden" id="deleteAwardsID" name="deleteAwardsID">
                    <p>Confirm deletion of honor award of <strong id="deleteAwardTitle"></strong> on <strong id="deleteAwardDate"></strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyHonorsAwardsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Administrative Appointments Modals -->
<!-- Create Administrative Appointments Modal -->
<div class="modal fade" id="createAdministrativeAppointmentsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create Adminisitrative Appointment</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreateAdministrativeAppointments" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateAdministrativeAppointments" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createAdministrativeAppointmentsForm" class="row g-2">
                    <input type="hidden" name="administrativeAppointmentUserID" value="<?= $user_id ?>">
                    <div class="col-lg-4 col-md-6">
                        <label for="createAdministrativePosition" class="form-label fw-bold">Adminisitrative Position</label>
                        <input id="createAdministrativePosition" type="text" class="form-control bg-light" name="createAdministrativePosition" placeholder="Enter your administrative position.">
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <label for="createAdministrativeOrganization" class="form-label fw-bold">Adminisitrative Organization</label>
                        <input id="createAdministrativeOrganization" type="text" class="form-control bg-light" name="createAdministrativeOrganization" placeholder="Enter your administrative organization.">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label for="createAdministrativeStartDate" class="form-label fw-bold">Start Date</label>
                        <input id="createAdministrativeStartDate" type="date" class="form-control bg-light" name="createAdministrativeStartDate" placeholder="Enter your start date.">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label for="createAdministrativeEndDate" class="form-label fw-bold">End Date</label>
                        <input id="createAdministrativeEndDate" type="date" class="form-control bg-light" name="createAdministrativeEndDate" placeholder="Enter your end date.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modify List of Administrative Appointments Modal -->
<div class="modal fade" id="modifyAdministrativeAppointmentsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Modify Administrative Appointments</h1>
            </div>
            <div class="modal-body">
                <div id="displayAdministrativeAppointments" class="row g-2">
                    <?php
                    $sql = "SELECT * FROM `administrative_appointments` WHERE `administrative_appointment_user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($result) {
                        while ($data = mysqli_fetch_array($result)) {
                    ?>
                            <div class="col-lg-3 col-md-6">
                                <label for="administrativePosition" class="form-label fw-bold">Administrative Position</label>
                                <input value="<?= $data['administrative_position'] ?>" type="text" class="form-control bg-light" name="administrativePosition" disabled>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label for="administrativeOrganization" class="form-label fw-bold">Administrative Organization</label>
                                <input value="<?= $data['administrative_organization'] ?>" type="text" class="form-control bg-light" name="administrativeOrganization" disabled>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <label for="administrativeStartDate" class="form-label fw-bold">Start Date</label>
                                <input value="<?= $data['administrative_start_date'] ?>" type="date" class="form-control bg-light" name="administrativeStartDate" disabled>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <label for="administrativeEndDate" class="form-label fw-bold">End Date</label>
                                <input value="<?= $data['administrative_end_date'] ?>" type="date" class="form-control bg-light" name="administrativeEndDate" disabled>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <label class="form-label fw-bold">Actions</label>
                                <div class="d-grid gap-2 ms-1 d-lg-block">
                                    <button value="<?= $data['administrative_appointment_id'] ?>" class="editAdministrativeAppointmentButton btn btn-success"><span class="icon-pencil"></span></button>
                                    <button value="<?= $data['administrative_appointment_id'] ?>" class="deleteAdministrativeAppointmentButton btn btn-danger"><span class="icon-trash"></span></button>
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
                <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#insertAdministrativeAppointmentsModal"><span class="icon-plus-circle fs-3"></span></button>
                <div class="modal-footer mt-2 pb-0 px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="saveAdministrativeAppointments" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Insert Administrative Appointment Modal -->
<div class="modal fade" id="insertAdministrativeAppointmentsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Insert Administrative Appointment</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertInsertAdministrativeAppointment" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageInsertAdministrativeAppointment" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="insertAdministrativeAppointmentForm" class="row g-2">
                    <input type="hidden" name="insertAdministrativeAppointmentUserID" value="<?= $user_id ?>">
                    <div class="col-lg-4 col-sm-12">
                        <label for="insertAdministrativePosition" class="form-label fw-bold">Administrative Position</label>
                        <input id="insertAdministrativePosition" type="text" class="form-control bg-light" name="insertAdministrativePosition" placeholder="Enter your administrative position.">
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label for="insertAdministrativeOrganization" class="form-label fw-bold">Administrative Organization</label>
                        <input id="insertAdministrativeOrganization" type="text" class="form-control bg-light" name="insertAdministrativeOrganization" placeholder="Enter your administrative organization.">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <label for="insertAdministrativeStartDate" class="form-label fw-bold">Start Date</label>
                        <input id="insertAdministrativeStartDate" type="date" class="form-control bg-light" name="insertAdministrativeStartDate" placeholder="Enter your start date.">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <label for="insertAdministrativeEndDate" class="form-label fw-bold">End Date</label>
                        <input id="insertAdministrativeEndDate" type="date" class="form-control bg-light" name="insertAdministrativeEndDate" placeholder="Enter your end date.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyAdministrativeAppointmentsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Administrative Appointment Modal  -->
<div class="modal fade" id="editAdministrativeAppointmentsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Administrative Appointment</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditAdministrativeAppointment" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditAdministrativeAppointment" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editAdministrativeAppointmentForm" class="row g-2">
                    <input type="hidden" id="editAdministrativeAppointmentID" name="editAdministrativeAppointmentID">
                    <div class="col-lg-4 col-sm-12">
                        <label for="editAdministrativePosition" class="form-label fw-bold">Administrative Position</label>
                        <input id="editAdministrativePosition" type="text" class="form-control bg-light" name="editAdministrativePosition" placeholder="Enter your administrative position.">
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label for="editAdministrativeOrganization" class="form-label fw-bold">Administrative Organization</label>
                        <input id="editAdministrativeOrganization" type="text" class="form-control bg-light" name="editAdministrativeOrganization" placeholder="Enter your administrative organization.">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <label for="editAdministrativeStartDate" class="form-label fw-bold">Start Date</label>
                        <input id="editAdministrativeStartDate" type="date" class="form-control bg-light" name="editAdministrativeStartDate" placeholder="Enter your start date.">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <label for="editAdministrativeEndDate" class="form-label fw-bold">End Date</label>
                        <input id="editAdministrativeEndDate" type="date" class="form-control bg-light" name="editAdministrativeEndDate" placeholder="Enter your end date.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyAdministrativeAppointmentsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Administrative Appointment Modal -->
<div class="modal fade" id="deleteAdministrativeAppointmentsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Administrative Appointment</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeleteAdministrativeAppointment" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeleteAdministrativeAppointment" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deleteAdministrativeAppointmentForm" class="row g-2">
                    <input type="hidden" id="deleteAdministrativeAppointmentID" name="deleteAdministrativeAppointmentID">
                    <p>Confirm deletion of administrative appointment as <strong id="deleteAdministrativePosition"></strong> in <strong id="deleteAdministrativeOrganization"></strong> from <strong id="deleteAdministrativeStartDate"></strong> until <strong id="deleteAdministrativeEndDate"></strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyHonorsAwardsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Other Accounts Modals -->
<!-- Create Other Accounts Modal -->
<div class="modal fade" id="createOtherAccountsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create Other Account</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreateOtherAccount" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateOtherAccount" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createOtherAccountForm" class="row g-2">
                    <input type="hidden" name="otherAccountUserID" value="<?= $user_id ?>">
                    <div class="col-md-6">
                        <label for="createLinkName" class="form-label fw-bold">Link Name</label>
                        <select id="createLinkName" class="form-select form-control bg-light" name="createLinkName">
                            <option selected>Select Account Link</option>
                            <option value="icon-orcid">ORCID</option>
                            <option value="icon-facebook">Facebook</option>
                            <option value="icon-linkedin">LinkedIn</option>
                            <option value="icon-google-scholar">Google Scholar</option>
                            <option value="icon-academia">Academia</option>
                            <option value="icon-github">Github</option>
                            <option value="icon-x">Twitter/X</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="createLinkUrl" class="form-label fw-bold">Link URL</label>
                        <input id="createLinkUrl" type="text" class="form-control bg-light" name="createLinkUrl" placeholder="Enter your link url.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modify List of Other Accounts Modal -->
<div class="modal fade" id="modifyOtherAccountsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Modify Other Accounts</h1>
            </div>
            <div class="modal-body">
                <div id="displayOtherAccounts" class="row g-2">
                    <?php
                    $sql = "SELECT * FROM `other_accounts` WHERE `link_user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($result) {
                        while ($data = mysqli_fetch_array($result)) {
                    ?>
                            <div class="col-lg-10 col-md-12">
                                <label for="linkUrl" class="form-label fw-bold">Link URL</label>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <span class="<?= $data['link_name'] ?>"><span class="path1"></span><span class="path2"></span></span>
                                    </span>
                                    <input value="<?= $data['link_url'] ?>" type="text" class="form-control bg-light" name="linkUrl" disabled>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <label class="form-label fw-bold">Actions</label>
                                <div class="d-grid gap-2 ms-1 d-lg-block">
                                    <button value="<?= $data['link_id'] ?>" class="editOtherAccountButton btn btn-success"><span class="icon-pencil"></span></button>
                                    <button value="<?= $data['link_id'] ?>" class="deleteOtherAccountButton btn btn-danger"><span class="icon-trash"></span></button>
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
                <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#insertOtherAccountsModal"><span class="icon-plus-circle fs-3"></span></button>
                <div class="modal-footer mt-2 pb-0 px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="saveOtherAccounts" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Insert Other Account Modal -->
<div class="modal fade" id="insertOtherAccountsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Insert Other Account</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertInsertOtherAccount" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageInsertOtherAccount" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="insertOtherAccountForm" class="row g-2">
                    <input type="hidden" name="insertOtherAccountUserID" value="<?= $user_id ?>">
                    <div class="col-md-6">
                        <label for="insertLinkName" class="form-label fw-bold">Link Name</label>
                        <select id="insertLinkName" class="form-select form-control bg-light" name="insertLinkName">
                            <option selected>Select Account Link</option>
                            <option value="icon-orcid">ORCID</option>
                            <option value="icon-facebook">Facebook</option>
                            <option value="icon-linkedin">LinkedIn</option>
                            <option value="icon-google-scholar">Google Scholar</option>
                            <option value="icon-academia">Academia</option>
                            <option value="icon-github">Github</option>
                            <option value="icon-x">Twitter/X</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="insertLinkUrl" class="form-label fw-bold">Link URL</label>
                        <input id="insertLinkUrl" type="text" class="form-control bg-light" name="insertLinkUrl" placeholder="Enter your link url.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyOtherAccountsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Other Account Modal  -->
<div class="modal fade" id="editOtherAccountsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Other Account</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditOtherAccount" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditOtherAccount" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editOtherAccountForm" class="row g-2">
                    <input type="hidden" id="editOtherAccountID" name="editOtherAccountID">
                    <div class="col-md-6">
                        <label for="editLinkName" class="form-label fw-bold">Link Name</label>
                        <select id="editLinkName" class="form-select form-control bg-light" name="editLinkName">
                            <!-- <option selected>Select Account Link</option> -->
                            <option value="icon-orcid">ORCID</option>
                            <option value="icon-facebook">Facebook</option>
                            <option value="icon-linkedin">LinkedIn</option>
                            <option value="icon-google-scholar">Google Scholar</option>
                            <option value="icon-academia">Academia</option>
                            <option value="icon-github">Github</option>
                            <option value="icon-x">Twitter/X</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="editLinkUrl" class="form-label fw-bold">Link URL</label>
                        <input id="editLinkUrl" type="text" class="form-control bg-light" name="editLinkUrl" placeholder="Enter your link url.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyOtherAccountsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Other Account Modal -->
<div class="modal fade" id="deleteOtherAccountsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Other Account</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeleteOtherAccount" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeleteOtherAccount" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deleteOtherAccountForm" class="row g-2">
                    <input type="hidden" id="deleteOtherAccountID" name="deleteOtherAccountID">
                    <p>Confirm deletion of this other account?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyOtherAccountsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Research Interests Modals -->
<!-- Create Research Interest -->
<div class="modal fade" id="createResearchInterestsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create Research Interest</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreateResearchInterest" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateResearchInterest" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createResearchInterestForm" class="row g-2">
                    <input type="hidden" name="researchInterestUserID" value="<?= $user_id ?>">
                    <div class="col">
                        <label for="createResearchInterestDescription" class="form-label fw-bold">Research Interest Description</label>
                        <input id="createResearchInterestDescription" type="text" class="form-control bg-light" name="createResearchInterestDescription" placeholder="Enter your research interest.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modify List of Research Interest Modal -->
<div class="modal fade" id="modifyResearchInterestsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Modify Research Interests</h1>
            </div>
            <div class="modal-body">
                <div id="displayResearchInterests" class="row g-2">
                    <?php
                    $sql = "SELECT * FROM `research_interests` WHERE `research_interest_user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($result) {
                        while ($data = mysqli_fetch_array($result)) {
                    ?>
                            <div class="col-lg-10 col-md-12">
                                <label for="linkUrl" class="form-label fw-bold">Research Interest</label>
                                <input value="<?= $data['research_interest_description'] ?>" type="text" class="form-control bg-light" name="linkUrl" disabled>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <label class="form-label fw-bold">Actions</label>
                                <div class="d-grid gap-2 ms-1 d-lg-block">
                                    <button value="<?= $data['research_interest_id'] ?>" class="editResearchInterestButton btn btn-success"><span class="icon-pencil"></span></button>
                                    <button value="<?= $data['research_interest_id'] ?>" class="deleteResearchInterestButton btn btn-danger"><span class="icon-trash"></span></button>
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
                <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#insertResearchInterestsModal"><span class="icon-plus-circle fs-3"></span></button>
                <div class="modal-footer mt-2 pb-0 px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="saveResearchInterests" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Insert Research Interest Modal -->
<div class="modal fade" id="insertResearchInterestsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Insert Research Interest</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertInsertResearchInterest" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageInsertResearchInterest" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="insertResearchInterestForm" class="row g-2">
                    <input type="hidden" name="insertResearchInterestUserID" value="<?= $user_id ?>">
                    <div class="col">
                        <label for="insertResearchInterestDescription" class="form-label fw-bold">Research Interest Description</label>
                        <input id="insertResearchInterestDescription" type="text" class="form-control bg-light" name="insertResearchInterestDescription" placeholder="Enter your research interest.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyResearchInterestsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Research Interest Modal  -->
<div class="modal fade" id="editResearchInterestsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Research Interest</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditResearchInterest" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditResearchInterest" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editResearchInterestForm" class="row g-2">
                    <input type="hidden" id="editResearchInterestID" name="editResearchInterestID">
                    <div class="col">
                        <label for="editResearchInterestDescription" class="form-label fw-bold">Research Interest Description</label>
                        <input id="editResearchInterestDescription" type="text" class="form-control bg-light" name="editResearchInterestDescription" placeholder="Enter your research interest.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyResearchInterestsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Research Interest Modal -->
<div class="modal fade" id="deleteResearchInterestsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Research Interest</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeleteResearchInterest" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeleteResearchInterest" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deleteResearchInterestForm" class="row g-2">
                    <input type="hidden" id="deleteResearchInterestID" name="deleteResearchInterestID">
                    <p>Confirm deletion of <strong id="deleteResearchInterestDescription"></strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyResearchInterestsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- PUP Advisees Modals -->
<!-- Create PUP Advisee Modal -->
<div class="modal fade" id="createPupAdviseesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create PUP Advisee</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreatePupAdvisee" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreatePupAdvisee" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createPupAdviseeForm" class="row g-2">
                    <input type="hidden" name="PupAdviseeUserID" value="<?= $user_id ?>">
                    <div class="col-lg-4 col-md-12">
                        <label for="createCourseName" class="form-label fw-bold">Course Name</label>
                        <input id="createCourseName" type="text" class="form-control bg-light" name="createCourseName" placeholder="Enter course name.">
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <label for="createCourseYear" class="form-label fw-bold">Course Year</label>
                        <select id="createCourseYear" class="form-select form-control bg-light" name="createCourseYear">
                            <option selected>Select Year Level</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <label for="createCourseSection" class="form-label fw-bold">Course Section</label>
                        <input id="createCourseSection" type="text" class="form-control bg-light" name="createCourseSection" placeholder="Enter course section.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modify List of PUP Advisee Modal -->
<div class="modal fade" id="modifyPupAdviseesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Modify PUP Advisees</h1>
            </div>
            <div class="modal-body">
                <div id="displayPupAdvisees" class="row g-2">
                    <?php
                    $sql = "SELECT * FROM `pup_advisees` WHERE `advisee_user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($result) {
                        while ($data = mysqli_fetch_array($result)) {
                    ?>
                            <div class="col-lg-7 col-md-7">
                                <label for="courseName" class="form-label fw-bold">Course Name</label>
                                <input value="<?= $data['advisee_course_name'] ?>" type="text" class="form-control bg-light" name="courseName" disabled>
                            </div>
                            <div class="col-lg-3 col-md-5">
                                <label for="courseName" class="form-label fw-bold">Course Year & Section</label>
                                <input value="<?= $data['advisee_course_year'] ?> - <?= $data['advisee_course_section'] ?>" type="text" class="form-control bg-light" name="courseName" disabled>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <label class="form-label fw-bold">Actions</label>
                                <div class="d-grid gap-2 ms-1 d-lg-block">
                                    <button value="<?= $data['advisee_id'] ?>" class="editPupAdviseeButton btn btn-success"><span class="icon-pencil"></span></button>
                                    <button value="<?= $data['advisee_id'] ?>" class="deletePupAdviseeButton btn btn-danger"><span class="icon-trash"></span></button>
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
                <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#insertPupAdviseesModal"><span class="icon-plus-circle fs-3"></span></button>
                <div class="modal-footer mt-2 pb-0 px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="savePupAdvisees" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Insert PUP Advisee Modal -->
<div class="modal fade" id="insertPupAdviseesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Insert PUP Advisee</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertInsertPupAdvisee" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageInsertPupAdvisee" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="insertPupAdviseeForm" class="row g-2">
                    <input type="hidden" name="insertPupAdviseeUserID" value="<?= $user_id ?>">
                    <div class="col-lg-4 col-md-12">
                        <label for="insertCourseName" class="form-label fw-bold">Course Name</label>
                        <input id="insertCourseName" type="text" class="form-control bg-light" name="insertCourseName" placeholder="Enter course name.">
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <label for="insertCourseYear" class="form-label fw-bold">Course Year</label>
                        <select id="insertCourseYear" class="form-select form-control bg-light" name="insertCourseYear">
                            <option selected>Select Year Level</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <label for="insertCourseSection" class="form-label fw-bold">Course Section</label>
                        <input id="insertCourseSection" type="text" class="form-control bg-light" name="insertCourseSection" placeholder="Enter course section.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyPupAdviseesModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit PUP Advisee Modal  -->
<div class="modal fade" id="editPupAdviseesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit PUP Advisee</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditPupAdvisee" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditPupAdvisee" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editPupAdviseeForm" class="row g-2">
                    <input type="hidden" id="editAdviseeID" name="editAdviseeID">
                    <div class="col-lg-4 col-md-12">
                        <label for="editCourseName" class="form-label fw-bold">Course Name</label>
                        <input id="editCourseName" type="text" class="form-control bg-light" name="editCourseName" placeholder="Enter course name.">
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <label for="editCourseYear" class="form-label fw-bold">Course Year</label>
                        <select id="editCourseYear" class="form-select form-control bg-light" name="editCourseYear">
                            <!-- <option selected>Select Year Level</option> -->
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <label for="editCourseSection" class="form-label fw-bold">Course Section</label>
                        <input id="editCourseSection" type="text" class="form-control bg-light" name="editCourseSection" placeholder="Enter course section.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyPupAdviseesModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete PUP Advisee Modal -->
<div class="modal fade" id="deletePupAdviseesModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete PUP Advisee</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeletePupAdvisee" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeletePupAdvisee" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deletePupAdviseeForm" class="row g-2">
                    <input type="hidden" id="deleteAdviseeID" name="deleteAdviseeID">
                    <p>Confirm deletion of <strong id="deleteCourseName"></strong> <strong>(<span id="deleteCourseYear"></span> - <span id="deleteCourseSection"></span>)</strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyPupAdviseesModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>