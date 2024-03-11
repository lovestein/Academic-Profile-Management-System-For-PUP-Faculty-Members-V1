<?php
$page_title = "Home";
include './includes/headerUser.php';
?>

<!-- Main Content & Login -->
<section>
    <div class="container-lg ">
        <div class="row vh-100 justify-content-center align-items-center pt-5">

            <!-- Title -->
            <div class="col-md-6 d-none d-md-block">
                <div class="h-100 text-center text-white text-md-start d-flex flex-column">
                    <h1>
                        <div class="display-1 fw-bold">PUP Faculty<br>Profile Page</div>
                        <div class="display-6">Get to know our faculty members! </div>
                    </h1>
                </div>
            </div>

            <!-- Card Login -->
            <div class="col-lg-5 col-md-6 pt-4">
                <div class="card rounded-5 p-1">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <img src="./assets/images/PUP-Logo.png" style="height: 80px;" class="mt-1">
                            <h2 class="fw-bold text-dark">PUP Faculty</h2>
                            <p class="text-muted">Sign in to start your session</p>
                        </div>

                        <form id="signInForm">
                            <div class="mb-2">
                                <label for="userEmail" class="form-label fw-bold">Email Address</label>
                                <input type="email" class="form-control bg-light" id="userEmail" name="userEmail" placeholder="Enter your email.">
                            </div>
                            <div class="mb-2">
                                <label for="userPassword" class="form-label fw-bold">Password</label>
                                <input type="password" class="form-control bg-light" id="userPassword" name="userPassword" placeholder="Enter your password">
                                <div class="text-end">
                                    <a href="" class="text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal"><small>Forgot Password?</small></a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary form-control rounded-pill fw-bold">Sign In</button>
                        </form>
                        <div class="card-text text-center">
                            By using this service, you understood and agree to the PUP Online Services Terms of Use and Privacy Statement <br>
                            Don't have an account? <a href="" class="text-primary fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#registerModal">Sign up</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- Register Account Modal -->
<div class="modal fade" id="registerModal" aria-hidden="true" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">
                    Create New Account
                </h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertRegister" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageRegister" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <!-- User Registration Form -->
                <form id="registerForm" class="row g-2">
                    <!-- Profile Picture -->
                    <div class="col-lg-12 col-md-12 text-center">
                        <img src="./assets/images/default-profile-image.jpg" id="previewRegisterUserImage" class="img-fluid mw-100 mh-100 rounded-circle border border-3 border-primary" style="height: 100px; width: 100px;">
                        <label for="registerUserImage" class="form-label fw-bold d-block" type="button">
                            <span class="icon-image me-2 text-primary"></span>Profile Picture
                        </label>
                        <input type="file" name="registerUserImage" id="registerUserImage" class="d-none">
                    </div>
                    <!-- Full Name -->
                    <div class="col-lg-7 col-md-12">
                        <label for="registerUserName" class="form-label fw-bold">Full Name<span class="icon-info-circle ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="This will be your full name displayed on your account."></span></label>
                        <input type="text" class="form-control bg-light" id="registerUserName" name="registerUserName" placeholder="Enter your full name.">
                    </div>
                    <!-- Honorifics -->
                    <div class="col-lg-5 col-md-12">
                        <label for="registerUserHonorifics" class="form-label fw-bold">Honorific(s)<span class="icon-info-circle ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="This will be your academic professional degree. If you have more than one simply include commas into the input field e.g. (MSIT, MSIS, MIT)"></span></label>
                        <input type="text" class="form-control bg-light" id="registerUserHonorifics" name="registerUserHonorifics" placeholder="Enter your honorific(s).">
                    </div>
                    <!-- College -->
                    <div class="col-lg-4 col-md-12">
                        <label for="registerUserCollege" class="form-label fw-bold">College</label>
                        <select id="registerUserCollege" class="form-select form-control bg-light" name="registerUserCollege">
                            <option selected></option>
                            <option value="College of Accountancy and Finance (CAF)">College of Accountancy and Finance (CAF)</option>
                            <option value="College of Architecture, Design and the Built Environment (CADBE)">College of Architecture, Design and the Built Environment (CADBE)</option>
                            <option value="College of Arts and Letters (CAL)">College of Arts and Letters (CAL)</option>
                            <option value="College of Business Administration (CBA)">College of Business Administration (CBA)</option>
                            <option value="College of Communication (COC)">College of Communication (COC)</option>
                            <option value="College of Computer and Information Sciences (CCIS)">College of Computer and Information Sciences (CCIS)</option>
                            <option value="College of Education (COED)">College of Education (COED)</option>
                            <option value="College of Engineering (CE)">College of Engineering (CE)</option>
                            <option value="College of Human Kinetics (CHK)">College of Human Kinetics (CHK)</option>
                            <option value="College of Law (CL)">College of Law (CL)</option>
                            <option value="College of Political Science and Public Administration (CPSPA)">College of Political Science and Public Administration (CPSPA)</option>
                            <option value="College of Social Sciences and Development (CSSD)">College of Social Sciences and Development (CSSD)</option>
                            <option value="College of Science (CS)">College of Science (CS)</option>
                            <option value="College of Tourism, Hospitality and Transportation Management (CTHTM)">College of Tourism, Hospitality and Transportation Management (CTHTM)</option>
                            <option value="Institute of Technology (ITech)">Institute of Technology (ITech)</option>
                        </select>
                    </div>
                    <!-- Department -->
                    <div class="col-lg-4 col-md-12">
                        <label for="registerUserDepartment" class="form-label fw-bold">Department</label>
                        <select id="registerUserDepartment" class="form-select form-control bg-light" name="registerUserDepartment">
                            <option selected></option>
                        </select>
                    </div>
                    <!-- University Position -->
                    <div class="col-lg-4 col-md-12">
                        <label for="registerUserUniversityPosition" class="form-label fw-bold">UniversityPosition</label>
                        <select id="registerUserUniversityPosition" class="form-select form-control bg-light" name="registerUserUniversityPosition">
                            <option selected></option>
                            <option value="Faculty">Faculty</option>
                            <option value="OfficialStaff">Official/Staff</option>
                        </select>
                    </div>
                    <!-- Account Username -->
                    <div class="col-lg-6 col-md-12">
                        <label for="registerUserAccountUsername" class="form-label fw-bold">Account Username</label>
                        <input type="text" class="form-control bg-light" id="registerUserAccountUsername" name="registerUserAccountUsername" placeholder="Enter your account username.">
                    </div>
                    <!-- Facult Rank -->
                    <div class="col-lg-6 col-md-12">
                        <label for="registerUserFacultyRank" class="form-label fw-bold">Faculty Rank</label>
                        <input type="text" class="form-control bg-light" id="registerUserFacultyRank" name="registerUserFacultyRank" placeholder="Enter your faculty rank.">
                    </div>
                    <!-- Email Address -->
                    <div class="col-lg-6 col-md-12">
                        <label for="registerUserEmail" class="form-label fw-bold">Email Address</label>
                        <input type="email" class="form-control bg-light" id="registerUserEmail" name="registerUserEmail" placeholder="Enter your email.">
                    </div>
                    <!-- Contact Number -->
                    <div class="col-lg-6 col-md-12">
                        <label for="registerUserContactno" class="form-label fw-bold">Contact Number <span>(<span id="contactNoCounter">0</span>/10)</span></label>
                        <span><small id="contactNoErrorMessage" class="text-danger"></small></span>
                        <span><small id="contactNoSuccessMessage" class="text-success"></small></span>
                        <div class="input-group mb-3">
                            <span class="input-group-text">+ 63</span>
                            <input type="tel" class="form-control bg-light" id="registerUserContactno" name="registerUserContactno" placeholder="Enter your contact number.">
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="col-lg-6 col-md-12">
                        <label for="registerUserPassword" class="form-label fw-bold">Password</label>
                        <span><small id="passwwordErrorMessage" class="text-danger"></small></span>
                        <span><small id="passwwordSuccessMessage" class="text-success"></small></span>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control bg-light border-end-0" id="registerUserPassword" name="registerUserPassword" placeholder="Enter your password">
                            <span class="input-group-text bg-transparent border-start-0" id="viewRegisterPassword"><span class="icon-eye" style="cursor: pointer;"></span></span>
                        </div>
                    </div>
                    <!-- Confirm Password -->
                    <div class="col-lg-6 col-md-12">
                        <label for="registerUserConfirmPassword" class="form-label fw-bold">*Confirm Password</label>
                        <span><small id="confirmPasswwordErrorMessage" class="text-danger"></small></span>
                        <span><small id="confirmPasswwordSuccessMessage" class="text-success"></small></span>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control bg-light border-end-0" id="registerUserConfirmPassword" name="registerUserConfirmPassword" placeholder="Confirm password">
                            <span class="input-group-text bg-transparent border-start-0" id="viewRegisterConfirmPassword"><span class="icon-eye" style="cursor: pointer;"></span></span>
                        </div>
                    </div>
                    <!-- User Type -->
                    <input type="hidden" id="registerUserType" name="registerUserType" value="User">
                    <div class="modal-footer">
                        <button type="button" id="registerUserCancel" class="btn btn-secondary">Close</button>
                        <button type="submit" class="btn btn-primary fw-bold">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">
                    Forgot Password?
                </h1>
            </div>
            <div class="modal-body">
                <p class="text-muted">
                    Please provide your email address where we can send the link to change your password.
                </p>
                <!-- Form Alert Message -->
                <div id="formAlertForgotPassword" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageForgotPassword" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="forgotPasswordForm">
                    <div class="mb-2">
                        <label for="userEmailForgotPassword" class="form-label fw-bold">Email Address</label>
                        <input type="email" class="form-control bg-light" id="userEmailForgotPassword" name="userEmailForgotPassword" placeholder="Enter your email.">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="submit" class="btn btn-primary fw-bold">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Verify Account Modal -->
<div class="modal fade" id="verifyAccountModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">
                    Verify Account
                </h1>
            </div>
            <div class="modal-body text-center">
                <h4 class="fw-bold">
                    You're almost set! Provide the verification code we've sent to your email to verify your account.
                </h4>
                <!-- Form Alert Message -->
                <div id="formAlertVerify" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageVerify" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="verifyUserForm">
                    <input id="userEmailVerify" type="hidden" required>
                    <input type="text" id="userVerificationCode" placeholder="Enter Verification Code" class="form-control text-center mb-2" style="height: 80px; font-size: 30px;">
                    <button id="verifyButton" type="submit" class="btn btn-sm btn-primary form-control rounded-pill fw-bold mb-2">
                        <h4>Verify Account</h4>
                    </button>
                    <button id="resendCodeButton" type="submit" class="btn btn-sm btn-info form-control rounded-pill fw-bold mb-2">
                        <h4>Resend Code</h4>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Successful Verification Modal -->
<div class="modal fade" id="successfulVerificationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-2">
            <div class="modal-body">
                <img src="./assets/images/verification-successful.png" alt="Verification Success" style="height: 200px;">
                <h3 class="fw-bold">Verification successful! You may now proceed to login to your account.</h3>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include './includes/footerUser.php';
?>