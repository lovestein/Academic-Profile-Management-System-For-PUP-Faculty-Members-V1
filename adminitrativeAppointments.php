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
                            <h2 class="text-center fw-bold w-100 text-primary">Adminitrative Appointments</h2>
                        </div>
                        <div class="card-body">
                            <table id="administrativeAppointmentsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Position</th>
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
                                            aa.administrative_appointment_id ,
                                            aa.administrative_appointment_user_id ,
                                            aa.administrative_position,
                                            aa.administrative_start_date,
                                            aa.administrative_end_date
                                        FROM 
                                            administrative_appointments aa
                                        JOIN 
                                            user_profiles up ON aa.administrative_appointment_user_id = up.user_id
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
                                                <td><?= $data['administrative_position'] ?></td>
                                                <td><?= $data['administrative_start_date'] ?></td>
                                                <td><?= $data['administrative_end_date'] ?></td>
                                                <td class="justify-content-center d-flex gap-2">
                                                    <button value="<?= $data['administrative_appointment_id'] ?>" class="editAdminitrativeAppointmentButton btn btn-success"><span class="icon-pencil"></span></button>
                                                    <button value="<?= $data['administrative_appointment_id'] ?>" class="deleteAdminitrativeAppointmentButton btn btn-danger"><span class="icon-trash"></span></button>
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