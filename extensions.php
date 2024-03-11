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
                            <h2 class="text-center fw-bold w-100 text-primary">Extensions</h2>
                        </div>
                        <div class="card-body">
                            <table id="extensionsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Organization</th>
                                        <th>Relationship</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT 
                                                up.user_id,
                                                up.user_name,
                                                e.extension_id,
                                                e.extension_user_id,
                                                e.extension_name,
                                                e.extension_relationship,
                                                e.extension_start_date,
                                                e.extension_end_date
                                            FROM 
                                                extensions e
                                            JOIN 
                                                user_profiles up ON e.extension_user_id = up.user_id";

                                    // Result
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    // Check if data are retrieved
                                    $check_result = mysqli_num_rows($result) > 0;
                                    if ($check_result) {

                                        while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                            <tr>
                                                <td><?= $data['user_name'] ?></td>
                                                <td><?= $data['extension_name'] ?></td>
                                                <td><?= $data['extension_relationship'] ?></td>
                                                <td><?= $data['extension_start_date'] ?></td>
                                                <td><?= $data['extension_end_date'] ?></td>
                                                <td class="justify-content-center d-flex gap-2">
                                                    <button value="<?= $data['extension_id'] ?>" class="editExtensionButton btn btn-success"><span class="icon-pencil"></span></button>
                                                    <button value="<?= $data['extension_id'] ?>" class="deleteExtensionButton btn btn-danger"><span class="icon-trash"></span></button>
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