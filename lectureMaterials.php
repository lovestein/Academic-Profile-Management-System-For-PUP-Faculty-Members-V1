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
                            <h2 class="text-center fw-bold w-100 text-primary">Lecture Materials</h2>
                        </div>
                        <div class="card-body">
                            <table id="lectureMaterialssTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Course Title</th>
                                        <th>Lecture Material Title</th>
                                        <th>Lecture URL</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT 
                                                c.course_id,
                                                c.course_title,
                                                lm.lecture_material_id,
                                                lm.lecture_course_id,
                                                lm.lecture_title,
                                                lm.lecture_url
                                            FROM 
                                                lecture_materials lm
                                            JOIN 
                                                courses c ON lm.lecture_course_id = c.course_id";

                                    // Result
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    // Check if data are retrieved
                                    $check_result = mysqli_num_rows($result) > 0;
                                    if ($check_result) {

                                        while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                            <tr>
                                                <td><?= $data['course_title'] ?></td>
                                                <td><?= $data['lecture_title'] ?></td>
                                                <td><?= $data['lecture_url'] ?></td>
                                                <td class="justify-content-center d-flex gap-2">
                                                    <button value="<?= $data['lecture_material_id'] ?>" class="editLectureMaterialButton btn btn-success"><span class="icon-pencil"></span></button>
                                                    <button value="<?= $data['lecture_material_id'] ?>" class="deleteLectureMaterialButton btn btn-danger"><span class="icon-trash"></span></button>
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