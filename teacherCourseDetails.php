<?php
$page_title = "Course Details";
include './includes/headerUser.php';
if(!isset($_SESSION['validated'])){
    $_SESSION['validated'] = false;
    header(('Location: ./index.php'));
    exit(0);
}
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
        

        <!-- Lecture Materials -->
        <div class="card my-3 p-2 border-0 shadow-lg rounded-5">
            <div class="card-body text-dark">
                <div class="card-title border-2 border-bottom border-primary d-flex align-items-center pb-2">
                    <h3 class="fw-bold text-primary w-100 m-0">Lecture Materials</h3>
                    
                </div>

                <!-- List of Lecture Materials -->
                <div id="displayListOfLectureMaterials">
                    <?php
                    $sql = "SELECT * FROM `lecture_materials` WHERE `lecture_course_id` = '$course_id'";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($check_result) {
                        while ($data = mysqli_fetch_array($result)) {
                    ?>
                            <div class="card my-3 p-2 border-0 shadow-lg rounded-5">
                                <div class="card-body text-dark">
                                    <div class="card-title border-2 border-bottom border-primary d-flex align-items-center pb-2">
                                        <h3 class="fw-bold text-primary w-100 m-0"><?= $data['lecture_title'] ?></h3>
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
                    } else {
                        ?>
                        <h4 class="text-center fw-bold text-muted">No courses yet.</h4>
                        <?php
                    }
                    ?>
                </div>

            </div>
        </div>
        
       
    </div>
</section>


<?php
include './includes/footerUser.php';
?>