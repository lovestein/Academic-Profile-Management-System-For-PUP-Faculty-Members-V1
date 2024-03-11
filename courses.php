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
                            <h2 class="text-center fw-bold w-100 text-primary">Coures</h2>
                        </div>
                        <div class="card-body">
                            <table id="coursesTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>No. of Access Codes</th>
                                        <th>No. of Lecute Materials</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT
                                                up.user_id,
                                                C.course_id,
                                                up.user_name,
                                                C.course_title,
                                                C.course_description,
                                                COALESCE(AC.accessCodesCount, 0) AS access_codes_count,
                                                COALESCE(LM.lectureMaterialsCount, 0) AS lecture_materials_count
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
                                            LEFT JOIN
                                                user_profiles up ON up.user_id = C.course_user_id
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
                                                <td><?= $data['course_title'] ?></td>
                                                <td><?= $data['course_description'] ?></td>
                                                <td><?= $data['access_codes_count'] ?></td>
                                                <td><?= $data['lecture_materials_count'] ?></td>
                                                <td class="justify-content-center d-flex gap-2">
                                                    <button value="<?= $data['course_id'] ?>" class="editCourseButton btn btn-success"><span class="icon-pencil"></span></button>
                                                    <button value="<?= $data['course_id'] ?>" class="deleteCourseButton btn btn-danger"><span class="icon-trash"></span></button>
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