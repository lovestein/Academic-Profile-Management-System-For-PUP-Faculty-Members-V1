<?php
$page_title = "Update Password";
include '../includes/headerUser.php';
?>

<section>
    <div class="container-lg">
        <div class="row vh-100 justify-content-center align-items-center pt-4">
            <!-- Card Register -->
            <div class="col-lg-7 pt-5">
                <div class="card rounded-5 p-2">
                    <div class="card-title text-center">
                        <img src="../assets/images/PUP-Logo.png" style="height: 80px;" class="mt-1">
                        <h1 class="fw-bold text-dark">PUP Faculty</h1>
                        <p class="text-muted fs-5">Forgot Password</p>
                    </div>
                    <h4 class="fw-bold text-center px-3">
                        Please provide your new password to update your account.
                    </h4>
                    <div class="card-body">
                        <form id="updatePasswordForm">
                            <input type="hidden" name="userEmail" value="<?php echo $_GET['user_email']; ?>" required>
                            <div class="mb-2">
                                <label for="inputPassword" class="form-label fw-bold">Password</label>
                                <input type="password" class="form-control bg-light" name="userPassword" placeholder="Enter your password">
                            </div>
                            <div class="mb-2">
                                <label for="inputConfirmPassword" class="form-label fw-bold">*Confirm Password</label>
                                <input type="password" class="form-control bg-light" name="userConfirmPassword" placeholder="Confirm password">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary form-control rounded-pill fw-bold mb-2">
                                <h4>Update Password</h4>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
include '../includes/footerUser.php';
?>