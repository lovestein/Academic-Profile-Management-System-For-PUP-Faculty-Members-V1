<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['input'])) {
    $input = $_POST['input'];

    // Ensure proper escaping to prevent SQL injection
    $escapedInput = mysqli_real_escape_string($con, $input);

    $sql = "SELECT * FROM `user_profiles` WHERE `user_name` LIKE '{$escapedInput}%'";
    $result = mysqli_query($con, $sql);

    // Check if the query was successful
    if ($result) {
        $check_result = mysqli_num_rows($result) > 0;

        if ($check_result) {
            while ($data = mysqli_fetch_assoc($result)) {
?>
                <li>
                    <a href="http://localhost/pup_profiles/pages/teacher.php?username=<?= $data['user_account_username'] ?>" class="viewUserAccount dropdown-item" data-account-username="<?= $data['user_account_username'] ?>">
                        <div class="row">
                            <div class="col-2" style="height:50px; width:70px;">
                                <div class="text-center h-100 w-100 d-flex flex-column">
                                    <img src="../images/profilePictures/<?= $data['user_image'] ?>" alt="" class="img-fluid h-100 rounded-circle border border-5 border-primary" style="object-fit:cover;">
                                </div>
                            </div>
                            <div class="col d-flex">
                                <div class="w-100 h-100">
                                    <h6><?= $data['user_name'] ?></h6>
                                    <p class="text-muted mb-1"><small><?= $data['user_faculty_rank'] ?></small></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            <?php
            }
        } else {
            ?>
            <li>
                <p class="dropdown-item text-center fw-bold m-0">Faculty member not found.</p>
            </li>
<?php
        }
    } else {
        // Handle query failure
        echo "Query failed: " . mysqli_error($con);
    }
}
?>