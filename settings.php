<?php
$page_title = "Settings";
include './includes/headerUser.php';
$user_id = $_SESSION['auth_user']['user_id'];
$sql = "SELECT * FROM `user_profiles` WHERE `user_id` = '$user_id'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
  $data = mysqli_fetch_assoc($result);
  $user_id = $data['user_id'];
  $user_name = $data['user_name'];
  $user_account_username = $data['user_account_username'];
  $user_honorifics = $data['user_honorifics'];
  $user_image = $data['user_image'];
  $user_faculty_rank = $data['user_faculty_rank'];
  $user_college = $data['user_college'];
  $user_department = $data['user_department'];
  $user_university_position = $data['user_college'];
  $user_contactno = $data['user_contactno'];
  $user_email = $data['user_email'];
  $user_password = $data['user_password'];
}
?>

<div class="container-lg">
  <div class="d-flex justify-content-center align-items-center my-3">
    <span class="icon-cog me-2 fs-3"></span>
    <h1 class="text-center fw-bold">Settings</h1>
  </div>
  <!-- Account Details -->
  <div id="accountDetails" class="card my-3 p-1 border-0 shadow rounded-5">

    <div class="card-body text-dark">
      <div class="card-title d-flex align-items-center mb-0">
        <h3 class="fw-bold text-primary w-100 m-0">Account Details</h3>
        <button id="editUserDetails" value="<?= $user_id ?>" class="m-1 btn btn-primary rounded-circle flex-shrink-1">
          <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Account Details"></span>
        </button>
      </div>
      <p class="m-0 text-muted d-block border-2 border-bottom border-primary">This information will be displayed publicily displayed. Discretion of which contact details to provide is advised.</p>
      <div class="card-text fs-5">
        <div class="row">
          <div class="col-lg-6 pb-3">

            <!-- Full Name/Honorifics/Account URL -->
            <div class="card border-0 rounded-5 shadow mt-3">
              <div class="card-body text-dark">
                <div class="card-text fs-5 row g-2">
                  <!-- Profile Picture -->
                  <div class="col-lg-12 col-md-12 text-center">
                    <img src="./images/profilePictures/<?= $user_image ?>" class="img-fluid mt-3 mw-100 mh-100 rounded-circle border border-3 border-primary" style="height: 200px; width: 200px;">
                  </div>
                  <!-- Full Name -->
                  <div class="col-lg-7 col-md-12">
                    <label for="viewUsername" class="form-label fw-bold">Full Name</label>
                    <input type="text" value="<?= $user_name ?>" class="form-control bg-light" id="viewUsername" name="viewUsername" readonly>
                  </div>
                  <!-- Honorifics -->
                  <div class="col-lg-5 col-md-12">
                    <label for="viewHonorifics" class="form-label fw-bold">Honorific(s)</label>
                    <input type="text" value="<?= $user_honorifics ?>" class="form-control bg-light" id="viewHonorifics" name="viewHonorifics" readonly>
                  </div>
                  <!-- Account Profile URL -->
                  <div class="col-lg-12 col-md-12">
                    <label for="viewAccountURL" class="form-label fw-bold">Account Profile URL</label>
                    <div class="input-group">
                      <input type="text" class="form-control border-end-0 bg-light" value="http://localhost/pup_profiles_modified/teacher.php?username=<?= $user_account_username ?>" readonly>
                      <button class="clipBoardButton btn border border-start-0 bg-light" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Copy to Clipboard">
                        <span class="icon-clipboard"></span>
                      </button>
                    </div>
                  </div>
                  <!-- Change Password -->
                  <div class="d-block float-end text-primary mt-5">
                    <small id="" class="float-end fs-6 mt-1 me-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                      Change Password?
                    </small>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6 pb-3">

            <!-- Contact Details -->
            <div class="card border-0 rounded-5 shadow mt-3">
              <div class="card-body text-dark">
                <div class="card-title mb-1 border-primary border-bottom border-2 d-flex align-items-center justify-content-center">
                  <h3 class="mb-0">Contact Details</h3><span class="icon-info-circle text-primary ms-2"></span>
                </div>
                <div class="card-text fs-5 row g-2">
                  <!-- Contact Number -->
                  <div class="col-lg-6 col-md-12">
                    <label for="registerUserContactno" class="form-label fw-bold">Contact Number</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text">+ 63</span>
                      <input type="tel" value="<?= $user_contactno ?>" class="form-control bg-light" id="registerUserContactno" name="registerUserContactno" readonly>
                    </div>
                  </div>
                  <!-- Email Address -->
                  <div class="col-lg-6 col-md-12">
                    <label for="registerUserEmail" class="form-label fw-bold">Email Address</label>
                    <input type="email" value="<?= $user_email ?>'] ?>" class="form-control bg-light" id="registerUserEmail" name="registerUserEmail" readonly>
                  </div>
                </div>
              </div>
            </div>
            <!-- University Designation -->
            <div class="card border-0 rounded-5 shadow mt-3">
              <div class="card-body text-dark">
                <div class="card-title mb-1 border-primary border-bottom border-2 d-flex align-items-center justify-content-center">
                  <h3 class="mb-0">University Designation</h3><span class="icon-info-circle text-primary ms-2"></span>
                </div>
                <div class="card-text fs-5 row g-2">
                  <!-- College -->
                  <div class="col-lg-12 col-md-12">
                    <label for="viewCollege" class="form-label fw-bold">College</label>
                    <input type="text" value="<?= $user_college ?>" class="form-control bg-light" id="viewCollege" name="viewCollege" readonly>
                  </div>
                  <!-- Department -->
                  <div class="col-lg-12 col-md-12">
                    <label for="viewDepartment" class="form-label fw-bold">Department</label>
                    <input type="text" value="<?= $user_department ?>" class="form-control bg-light" id="viewDepartment" name="viewDepartment" readonly>
                  </div>
                  <!-- University Position -->
                  <div class="col-lg-6 col-md-12">
                    <label for="viewUniversityPosition" class="form-label fw-bold">University Position</label>
                    <input type="text" value="<?= $user_university_position ?>" class="form-control bg-light" id="viewUniversityPosition" name="viewUniversityPosition" readonly>
                  </div>
                  <!-- Facult Rank -->
                  <div class="col-lg-6 col-md-12">
                    <label for="registerUserFacultyRank" class="form-label fw-bold">Faculty Rank</label>
                    <input type="text" value="<?= $user_faculty_rank ?>" class="form-control bg-light" id="registerUserFacultyRank" name="registerUserFacultyRank" readonly>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modals -->
<!-- Modify Account Details Modal -->
<div class="modal fade" id="modifyAccountDetailsModal" aria-hidden="true" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title w-100 text-center fs-5">
          Modify Account Details
        </h1>
      </div>
      <div class="modal-body">
        <!-- Form Alert Message -->
        <div id="formAlertEditUserDetails" class="toast w-100 my-2">
          <div class="d-flex">
            <div id="formAlertMessageEditUserDetails" class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
        <!-- User Registration Form -->
        <form id="editUserDetailsForm" class="row g-2">
          <input type="hidden" name="editUserID" id="editUserID">
          <!-- Profile Picture -->
          <div class="col-lg-12 col-md-12 text-center">
            <img src="" id="previeweditUserImage" class="img-fluid mw-100 mh-100 rounded-circle border border-3 border-primary" style="height: 100px; width: 100px;">
            <label for="editUserImage" class="form-label fw-bold d-block" type="button">
              <span class="icon-image me-2 text-primary"></span>Profile Picture
            </label>
            <input type="file" name="editUserImage" id="editUserImage" class="d-none">
          </div>
          <!-- Profile Picture Image Value -->
          <input type="hidden" name="editUserImageValue" id="editUserImageValue">
          <!-- Full Name -->
          <div class="col-lg-7 col-md-12">
            <label for="editUserName" class="form-label fw-bold">Full Name<span class="icon-info-circle ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="This will be your full name displayed on your account."></span></label>
            <input type="text" class="form-control bg-light" id="editUserName" name="editUserName" placeholder="Enter your full name.">
          </div>
          <!-- Honorifics -->
          <div class="col-lg-5 col-md-12">
            <label for="editUserHonorifics" class="form-label fw-bold">Honorific(s)<span class="icon-info-circle ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="This will be your academic professional degree. If you have more than one simply include commas into the input field e.g. (MSIT, MSIS, MIT)"></span></label>
            <input type="text" class="form-control bg-light" id="editUserHonorifics" name="editUserHonorifics" placeholder="Enter your honorific(s).">
          </div>
          <!-- College -->
          <div class="col-lg-6 col-md-12">
            <label for="editUserCollege" class="form-label fw-bold">College</label>
            <select id="editUserCollege" class="form-select form-control bg-light" name="editUserCollege">
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
          <div class="col-lg-6 col-md-12">
            <label for="editUserDepartment" class="form-label fw-bold">Department</label>
            <select id="editUserDepartment" class="form-select form-control bg-light" name="editUserDepartment">
              <option selected></option>
            </select>
          </div>
          <!-- University Position -->
          <div class="col-lg-6 col-md-12">
            <label for="editUserUniversityPosition" class="form-label fw-bold">UniversityPosition</label>
            <select id="editUserUniversityPosition" class="form-select form-control bg-light" name="editUserUniversityPosition">
              <option selected></option>
              <option value="Faculty">Faculty</option>
              <option value="OfficialStaff">Official/Staff</option>
            </select>
          </div>
          <!-- Facult Rank -->
          <div class="col-lg-6 col-md-12">
            <label for="editUserFacultyRank" class="form-label fw-bold">Faculty Rank</label>
            <input type="text" class="form-control bg-light" id="editUserFacultyRank" name="editUserFacultyRank" placeholder="Enter your faculty rank.">
          </div>
          <!-- Email Address -->
          <div class="col-lg-6 col-md-12">
            <label for="editUserEmail" class="form-label fw-bold">Email Address</label>
            <input type="email" class="form-control bg-light" id="editUserEmail" name="editUserEmail" placeholder="Enter your email.">
          </div>
          <!-- Contact Number -->
          <div class="col-lg-6 col-md-12">
            <label for="editUserContactno" class="form-label fw-bold">Contact Number <span>(<span id="editContactNoCounter">0</span>/10)</span></label>
            <span><small id="editContactNoErrorMessage" class="text-danger"></small></span>
            <span><small id="editContactNoSuccessMessage" class="text-success"></small></span>
            <div class="input-group mb-3">
              <span class="input-group-text">+ 63</span>
              <input type="tel" class="form-control bg-light" id="editUserContactno" name="editUserContactno" placeholder="Enter your contact number.">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="editUserCancel" class="btn btn-secondary">Close</button>
            <button type="submit" class="btn btn-primary fw-bold">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title w-100 text-center fs-5">
          Change Password
        </h1>
      </div>
      <div class="modal-body">
        <!-- Form Alert Message -->
        <div id="formAlertChangePassword" class="toast w-100 my-2">
          <div class="d-flex">
            <div id="formAlertMessageChangePassword" class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
        <!-- User Registration Form -->
        <form id="changePasswordForm" class="row g-2">
          <!-- User ID -->
          <input type="hidden" name="changePasswordUserID" id="changePasswordUserID" value="<?= $user_id ?>">
          <!-- Current Password -->
          <div class="col-lg-12 col-md-12">
            <label for="changePasswordCurrentPassword" class="form-label fw-bold">Current Password</label>
            <input type="password" class="form-control bg-light" id="changePasswordCurrentPassword" name="changePasswordCurrentPassword" placeholder="Enter your current password.">
          </div>
          <!-- New Password -->
          <div class="col-lg-12 col-md-12">
            <label for="changePasswordNewPassword" class="form-label fw-bold">New Password</label>
            <span><small id="changePasswwordErrorMessage" class="text-danger"></small></span>
            <span><small id="changePasswwordSuccessMessage" class="text-success"></small></span>
            <div class="input-group mb-3">
              <input type="password" class="form-control bg-light border-end-0" id="changePasswordNewPassword" name="changePasswordNewPassword" placeholder="Enter your new password">
              <span class="input-group-text bg-transparent border-start-0" id="viewChangePasswordNewPassword"><span class="icon-eye" style="cursor: pointer;"></span></span>
            </div>
          </div>
          <!-- Confirm New Password -->
          <div class="col-lg-12 col-md-12">
            <label for="changePasswordConfirmNewPassword" class="form-label fw-bold">*Confirm New Password</label>
            <span><small id="cnahngePasswordConfirmPasswwordErrorMessage" class="text-danger"></small></span>
            <span><small id="cnahngePasswordConfirmPasswwordSuccessMessage" class="text-success"></small></span>
            <div class="input-group mb-3">
              <input type="password" class="form-control bg-light border-end-0" id="changePasswordConfirmNewPassword" name="changePasswordConfirmNewPassword" placeholder="Confirm new password">
              <span class="input-group-text bg-transparent border-start-0" id="viewChangePasswordConfirmNewPassword"><span class="icon-eye" style="cursor: pointer;"></span></span>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary fw-bold">Update Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include './includes/footerUser.php';
?>