<!-- Teacher's Profile Page In Public View -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Bio/Profile Card -->
            <div class="card my-3 p-2 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex">
                        <h3 class="fw-bold text-primary w-100">Biography</h3>
                    </div>
                    <?php
                    $sql = "SELECT `user_biography` FROM `user_profiles` WHERE `user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;

                    if ($check_result) {
                        while (mysqli_fetch_array($result)) {
                            if ($data['user_biography'] !== NULL) {
                    ?>
                                <p class="card-text fs-5"><?= $data['user_biography'] ?></p>
                            <?php
                            } else {
                            ?>
                                <p class="card-text fs-5">No biography yet.</p>
                        <?php
                            }
                        }
                    } else {
                        ?>
                        <p class="card-text fs-5">Data not found.</p>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <!-- Academic Appointments -->
            <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex">
                        <h3 class="fw-bold text-primary w-100">Academic Appointments</h3>
                    </div>
                    <div class="card-text fs-5">
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
                            No academic appointments yet.
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Honors & Awards -->
            <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex">
                        <h3 class="fw-bold text-primary w-100">Honors & Awards</h3>
                    </div>
                    <div class="card-text fs-5">
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
                            No honors or awards yet.
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Adminisitrative Appointments -->
            <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex">
                        <h3 class="fw-bold text-primary w-100">Adminisitrative Appointments</h3>
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
                            No administrative appointments yet.
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <!-- Other Accounts -->
            <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex">
                        <h3 class="fw-bold text-primary w-100">Other Accounts</h3>
                    </div>
                    <div class="card-text fs-5">
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
                            No other accounts yet.
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Research Interests -->
            <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex">
                        <h3 class="fw-bold text-primary w-100">Research Interests</h3>
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
                            No research interests yet.
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- PUP Advisees -->
            <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                <div class="card-body text-dark">
                    <div class="card-title border-2 border-bottom border-primary d-flex">
                        <h3 class="fw-bold text-primary w-100">PUP Advisees</h3>
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
                            No class advisees yet.
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>