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
                            <h2 class="text-center fw-bold w-100 text-primary">Honor Awards</h2>
                        </div>
                        <div class="card-body">
                            <table id="honorAwardsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Award Title</th>
                                        <th>Award Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT 
                                                up.user_id,
                                                up.user_name,
                                                aw.awards_id,
                                                aw.awards_user_id,
                                                aw.award_title,
                                                aw.award_date
                                            FROM 
                                                honors_awards aw
                                            JOIN 
                                                user_profiles up ON aw.awards_user_id = up.user_id
                                            WHERE up.user_type = 'User'";

                                    // Result
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    // Check if data are retrieved
                                    $check_result = mysqli_num_rows($result) > 0;
                                    if ($check_result) {

                                        while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                            <tr>
                                                <td><?= $data['user_name'] ?></td>
                                                <td><?= $data['award_title'] ?></td>
                                                <td><?= $data['award_date'] ?></td>
                                                <td class="justify-content-center d-flex gap-2">
                                                    <button value="<?= $data['awards_id'] ?>" class="editHonorAwardsButton btn btn-success"><span class="icon-pencil"></span></button>
                                                    <button value="<?= $data['awards_id'] ?>" class="deleteHonorAwardsButton btn btn-danger"><span class="icon-trash"></span></button>
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