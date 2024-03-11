<?php
include '../includes/headerAdmin.php';
?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid p-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-center fw-bold w-100 text-primary">Access Codes</h2>
                        </div>
                        <div class="card-body">
                            <table id="accessCodesTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Course Title</th>
                                        <th>Access Code</th>
                                        <th>Valid From</th>
                                        <th>Until</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT 
                                                c.course_id,
                                                c.course_title,
                                                ac.access_code_id,
                                                ac.access_course_id,
                                                ac.access_code,
                                                ac.access_code_start_date,
                                                ac.access_code_end_date,
                                                ac.access_code_status
                                            FROM 
                                                access_codes ac
                                            JOIN 
                                                courses c ON ac.access_course_id = c.course_id";

                                    // Result
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    // Check if data are retrieved
                                    $check_result = mysqli_num_rows($result) > 0;
                                    if ($check_result) {

                                        while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                            <tr>
                                                <td><?= $data['course_title'] ?></td>
                                                <td><?= $data['access_code'] ?></td>
                                                <td><?= $data['access_code_start_date'] ?></td>
                                                <td><?= $data['access_code_end_date'] ?></td>
                                                <td><?= $data['access_code_status'] ?></td>
                                                <td class="justify-content-center d-flex gap-2">
                                                    <button value="<?= $data['access_code_id'] ?>" class="editAccessCodeButton btn btn-success"><span class="icon-pencil"></span></button>
                                                    <button value="<?= $data['access_code_id'] ?>" class="deleteAccessCodeButton btn btn-danger"><span class="icon-trash"></span></button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include '../includes/footerAdmin.php';
?>