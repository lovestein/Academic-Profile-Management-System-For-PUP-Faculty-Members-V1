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
                            <h2 class="text-center fw-bold w-100 text-primary">Research Interests</h2>
                        </div>
                        <div class="card-body">
                            <table id="researchInterestsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Research Interest Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT 
                                                up.user_id,
                                                up.user_name,
                                                ri.research_interest_id   ,
                                                ri.research_interest_user_id,
                                                ri.research_interest_description
                                            FROM 
                                                research_interests ri
                                            JOIN 
                                                user_profiles up ON ri.research_interest_user_id = up.user_id
                                            WHERE 
                                                up.user_type = 'User'";

                                    // Result
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    // Check if data are retrieved
                                    $check_result = mysqli_num_rows($result) > 0;
                                    if ($check_result) {

                                        while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                            <tr>
                                                <td><?= $data['user_name'] ?></td>
                                                <td><?= $data['research_interest_description'] ?></td>
                                                <td class="justify-content-center d-flex gap-2">
                                                    <button value="<?= $data['research_interest_id'] ?>" class="editAcademicAppointmentButton btn btn-success"><span class="icon-pencil"></span></button>
                                                    <button value="<?= $data['research_interest_id'] ?>" class="deleteAcademicAppointmentButton btn btn-danger"><span class="icon-trash"></span></button>
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