// Enable Tooltips
const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

// Copy to Clipboard
$(document).on("click", ".clipBoardButton", function () {
  // Get the input field associated with the clicked button
  var inputField = $(this).prev("input.form-control")[0];

  // Select the text in the input field
  inputField.select();
  inputField.setSelectionRange(0, 99999); // For mobile devices

  // Copy the selected text to clipboard
  document.execCommand("copy");

  // Deselect the text
  inputField.setSelectionRange(0, 0);

  // Change the button icon and tooltip after copying to clipboard
  $(this)
    .find("span")
    .removeClass("icon-clipboard")
    .addClass("icon-clipboard-check");
  $(this).attr("data-bs-title", "Copied!").tooltip("dispose").tooltip("show");
});

// Class Style For Alerts
const successMessage = "text-bg-success";
const failMessage = "text-bg-danger";
const warningMessage = "text-bg-warning";

// Disable Past Dates on Date Picker
$(function () {
  var dtToday = new Date();

  var month = dtToday.getMonth() + 1;
  var day = dtToday.getDate();
  var year = dtToday.getFullYear();
  if (month < 10) month = "0" + month.toString();
  if (day < 10) day = "0" + day.toString();

  var maxDate = year + "-" + month + "-" + day;
  $(".datePicker").attr("min", maxDate);
});

// Alert Message
function displayMessage(classStyle, messageContent) {
  var option = {
    animation: true,
    delay: 3000,
  };

  var alert = $("#alert");
  alert.find("#alertMessage").text(messageContent);
  alert.addClass(classStyle);

  var showToast = new bootstrap.Toast(alert, option);
  showToast.show();

  setTimeout(() => {
    alert.removeClass(classStyle);
  }, 3500);
}

// Sign In
$("#signInForm").on("submit", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("signInButton", true);
  $.ajax({
    type: "POST",
    url: "./functions/loginUser.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100 || res.status == 104 || res.status == 105) {
        displayMessage("text-bg-danger", res.message);
      } else if (res.status == 101) {
        $("#userEmailVerify").val(res.email);
        $("#verifyAccountModal").modal("show");
      } else if (res.status == 102 || res.status == 103) {
        displayMessage(successMessage, res.message);
        setTimeout(() => {
          window.location.href = res.redirect;
        }, 3000);
      }
    },
  });
});

// Verify Account
$("#verifyUserForm").on("click", "#verifyButton", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertVerify");
    alert.find("#formAlertMessageVerify").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var data = {
    userEmail: $("#userEmailVerify").val(),
    userVerificationCode: $("#userVerificationCode").val(),
  };

  $.ajax({
    type: "POST",
    url: "./functions/verifyUser.php",
    data: data,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 201 || res.status == 202) {
        displayFormMessage(failMessage, res.message);
      } else if (res.status == 203) {
        setTimeout(() => {
          $("#verifyAccountModal").modal("hide");
          $("#verifyUserForm")[0].reset();
        }, 3000);
        setTimeout(() => {
          $("#successfulVerificationModal").modal("show");
        }, 3500);
        setTimeout(() => {
          $("#successfulVerificationModal").modal("hide");
        }, 5500);
      }
    },
  });

  displayFormMessage(
    warningMessage,
    "Please wait while we verify your account."
  );
});

// Resend Code
$("#verifyUserForm").on("click", "#resendCodeButton", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertVerify");
    alert.find("#formAlertMessageVerify").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var data = {
    userEmail: $("#userEmailVerify").val(),
  };

  $.ajax({
    type: "POST",
    url: "./functions/resendCode.php",
    data: data,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 301) {
        displayFormMessage(successMessage, res.message);
      } else if (res.status == 302) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
  displayFormMessage(
    warningMessage,
    "Please wait while we send you a new verification code to your email."
  );
});

// Logout
$("#logoutButton, #logoutAdmin").on("click", function (e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: "./functions/logoutUser.php",
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 400) {
        window.location.href = res.redirect;
      }
    },
  });
});

// Forgot Password
$("#forgotPasswordForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertForgotPassword");
    alert.find("#formAlertMessageForgotPassword").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 4000);
  }

  var data = {
    userEmail: $("#userEmailForgotPassword").val(),
  };

  $.ajax({
    type: "POST",
    url: "./functions/forgotPassword.php",
    data: data,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
      } else if (res.status == 101 || res.status == 102 || res.status == 103) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });

  displayFormMessage(
    warningMessage,
    "Please wait while we send you an email to update your password."
  );
});

// Update Password
$("#updatePasswordForm").on("submit", function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("updatePasswordButton", true);
  $.ajax({
    type: "POST",
    url: "./functions/updatePassword.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayMessage(successMessage, res.message);
        setTimeout(() => {
          window.location.href = res.redirect;
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayMessage(failMessage, res.message);
      }
    },
  });
});

// Register User
$("#registerForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertRegister");
    alert.find("#formAlertMessageRegister").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("registerButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/registerUser.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#registerModal").modal("hide");
          $("#userEmailVerify").val(res.email);
          $("#verifyAccountModal").modal("show");
          $("#registerForm")[0].reset();
          $("#previewRegisterUserImage").attr(
            "src",
            "./assets/images/default-profile-image.jpg"
          );
        }, 3000);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Register User - College Department Options
$(document).on("change", "#registerUserCollege", function () {
  // Get the selected value
  var selectedCollege = $(this).val();

  // Disable the registerUserDepartment select element initially
  $("#registerUserDepartment").prop("disabled", true);

  // Clear previous options in registerUserDepartment
  $("#registerUserDepartment").empty();

  // Enable registerUserDepartment based on selected College
  // Current colleges that has college departments as of November 2023 are (CCSIS, CBA)
  if (selectedCollege === "College of Accountancy and Finance (CAF)") {
    $("#registerUserDepartment").prop("disabled", false);
    // Set options for College A
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (
    selectedCollege ===
    "College of Architecture, Design and the Built Environment (CADBE)"
  ) {
    $("#registerUserDepartment").prop("disabled", false);
    // Set options for CADBE
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Arts and Letters (CAL)") {
    $("#registerUserDepartment").prop("disabled", false);
    // Set options for College CAL
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Business Administration (CBA)") {
    $("#registerUserDepartment").prop("disabled", false);
    // Set departments for CBA
    $("#registerUserDepartment").append('<option value="None">None</option>');
    $("#registerUserDepartment").append(
      '<option value="Department of Management">Department of Management</option>'
    );
    $("#registerUserDepartment").append(
      '<option value="Department of Marketing">Department of Marketing</option>'
    );
    $("#registerUserDepartment").append(
      '<option value="Department of Office Administration">Department of Office Administration</option>'
    );
    $("#registerUserDepartment").append(
      '<option value="Department of Entrepreneurship">Department of Entrepreneurship</option>'
    );
  } else if (selectedCollege === "College of Communication (COC)") {
    $("#registerUserDepartment").prop("disabled", false);
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (
    selectedCollege === "College of Computer and Information Sciences (CCIS)"
  ) {
    $("#registerUserDepartment").prop("disabled", false);
    $("#registerUserDepartment").append('<option value="None">None</option>');
    $("#registerUserDepartment").append(
      '<option value="Department of Computer Science">Department of Computer Science</option>'
    );
    $("#registerUserDepartment").append(
      '<option value="Department of Information Technology">Department of Information Technology</option>'
    );
    $("#registerUserDepartment").append(
      '<option value="Department of Information Systems and Sciences">Department of Information Systems and Sciences</option>'
    );
  } else if (selectedCollege === "College of Education (COED)") {
    $("#registerUserDepartment").prop("disabled", false);
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Engineering (CE)") {
    $("#registerUserDepartment").prop("disabled", false);
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Human Kinetics (CHK)") {
    $("#registerUserDepartment").prop("disabled", false);
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Law (CL)") {
    $("#registerUserDepartment").prop("disabled", false);
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (
    selectedCollege ===
    "College of Political Science and Public Administration (CPSPA)"
  ) {
    $("#registerUserDepartment").prop("disabled", false);
    // Set options for the CSPA
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (
    selectedCollege === "College of Social Sciences and Development (CSSD)"
  ) {
    $("#registerUserDepartment").prop("disabled", false);
    // Set options for the CSSD
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Science (CS)") {
    $("#registerUserDepartment").prop("disabled", false);
    // Set options for the CS
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (
    selectedCollege ===
    "College of Tourism, Hospitality and Transportation Management (CTHTM)"
  ) {
    $("#registerUserDepartment").prop("disabled", false);
    // Set options for the CTHTM
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "Institute of Technology (ITech)") {
    $("#registerUserDepartment").prop("disabled", false);
    // Set options for the ITech
    $("#registerUserDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  }
});

// Register User/Edit User - Validate Contact Number Length & Data Type
$(document).ready(function () {
  $("#registerUserContactno, #editUserContactno").on("input", function () {
    var input = $(this)
      .val()
      .replace(/[^1-9]/g, "");

    if (input.length > 10) {
      input = input.substring(0, 10);
    }

    $(this).val(input);
    $("#contactNoCounter, #editContactNoCounter").text(input.length);

    if (input.length === 10) {
      // Success scenario
      $("#contactNoSuccessMessage, #editContactNoSuccessMessage")
        .html(
          '<span class="icon-check-circle me-2"></span>Valid contact number'
        )
        .removeClass("text-danger")
        .addClass("text-success");
      $("#contactNoErrorMessag0, #editContactNoErrorMessage").text("");

      // Show success message for 1 second and then hide
      setTimeout(function () {
        $("#contactNoSuccessMessage, #editContactNoSuccessMessage").text("");
      }, 1000);
    } else {
      // Error scenario
      $("#contactNoErrorMessage, #editContactNoErrorMessage")
        .html(
          '<span class="icon-exclamation-circle me-2"></span>Contact number must be 10 digits'
        )
        .removeClass("text-success")
        .addClass("text-danger");
      $("#contactNoSuccessMessage, #editContactNoSuccessMessage").text("");

      // Show error message for 1 second and then hide
      setTimeout(function () {
        $("#contactNoErrorMessage, #editContactNoErrorMessage").text("");
      }, 1000);
    }
  });
});

// Register User/Edit User - Profile Image Preview
$("#registerUserImage, #editUserImage").on("change", function (e) {
  // Validate Image File Type Function
  function isValidImageType(file) {
    // Define the allowed file types
    var allowedTypes = ["image/jpeg", "image/jpg", "image/png"];

    // Check if the selected file type is in the allowed types
    return allowedTypes.includes(file.type);
  }

  // Get the selected file
  var file = e.target.files[0];

  // Check if the selected file is an image (jpg, jpeg, or png)
  if (!file || !isValidImageType(file)) {
    alert("Please select a valid image file (jpg, jpeg, or png).");
    // Clear the input field
    $(this).val("");
    return;
  }

  // Create a FileReader
  var reader = new FileReader();

  // Set a callback function to run when the file is loaded
  reader.onload = function (e) {
    // Update the src attribute of the image preview
    $("#previewRegisterUserImage, #previeweditUserImage").attr(
      "src",
      e.target.result
    );
  };

  // Read the selected file as a Data URL (base64 encoding)
  reader.readAsDataURL(file);
});

// Register User/Edit User - Cancel Registration
$("#registerUserCancel, #editUserCancel").on("click", function (e) {
  if (confirm("Cancel registration? Details will not be saved")) {
    // Close registration modal
    $("#registerModal, #modifyAccountDetailsModal").modal("hide");
    // Reset the form to its initial state
    $("#registerForm")[0].reset();
    // Reset the image preview
    $("#previewRegisterUserImage").attr(
      "src",
      "./assets/images/default-profile-image.jpg"
    );
  }
});

// Register User - Toggle Password
$(document).ready(function () {
  $("#viewRegisterPassword, #viewRegisterConfirmPassword, #viewChangePasswordNewPassword, #viewChangePasswordConfirmNewPassword").click(function () {
    var inputType = $(this).prev("input").attr("type");

    if (inputType === "password") {
      $(this).prev("input").attr("type", "text");
      $(this)
        .find(".icon-eye")
        .removeClass("icon-eye")
        .addClass("icon-eye-slash");
    } else {
      $(this).prev("input").attr("type", "password");
      $(this)
        .find(".icon-eye-slash")
        .removeClass("icon-eye-slash")
        .addClass("icon-eye");
    }
  });
});

// Register User - Validate Password Length & Characters
$(document).ready(function () {
  $("#registerUserPassword").on("input", function () {
    var password = $(this).val();

    // Reset messages
    $("#passwwordErrorMessage").text("");
    $("#passwwordSuccessMessage").text("");

    // Check password length
    if (password.length < 7) {
      $("#passwwordErrorMessage").html(
        '<span class="icon-exclamation-circle me-1"></span>Must be at least 7 characters long'
      );
      // Show error message for 1 second and then hide
      setTimeout(function () {
        $("#passwwordErrorMessage").text("");
      }, 1000);
      return;
    }

    // Check for at least one special character, one capital letter, and one number
    var regex =
      /^(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-])(?=.*[A-Z])(?=.*[0-9]).*$/;
    if (!regex.test(password)) {
      $("#passwwordErrorMessage").html(
        '<span class="icon-exclamation-circle me-1"></span>Must include a special character, A-Z, 0-9'
      );
      // Show error message for 1 second and then hide
      setTimeout(function () {
        $("#passwwordErrorMessage").text("");
      }, 1000);
      return;
    }

    // If all conditions are met, show success message
    $("#passwwordSuccessMessage").html(
      '<span class="icon-check-circle me-1"></span>Valid'
    );
    // Show success message for 1 second and then hide
    setTimeout(function () {
      $("#passwwordSuccessMessage").text("");
    }, 1000);
  });
});

// Colleges - Filter College Departments Options (Faculty)
$(document).on("change", "#filterFacultyColleges", function () {
  // Get the selected value
  var selectedCollege = $(this).val();

  // Disable the filterFacultyDepartment select element initially
  $("#filterFacultyDepartment").prop("disabled", true);

  // Clear previous options in filterFacultyDepartment
  $("#filterFacultyDepartment").empty();

  // Enable filterFacultyDepartment based on selected College
  // Current colleges that has college departments as of November 2023 are (CCSIS, CBA)
  if (selectedCollege === "College of Accountancy and Finance (CAF)") {
    $("#filterFacultyDepartment").prop("disabled", false);
    // Set options for College A
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (
    selectedCollege ===
    "College of Architecture, Design and the Built Environment (CADBE)"
  ) {
    $("#filterFacultyDepartment").prop("disabled", false);
    // Set options for CADBE
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Arts and Letters (CAL)") {
    $("#filterFacultyDepartment").prop("disabled", false);
    // Set options for College CAL
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Business Administration (CBA)") {
    $("#filterFacultyDepartment").prop("disabled", false);
    // Set departments for CBA
    $("#filterFacultyDepartment").append('<option value="None">None</option>');
    $("#filterFacultyDepartment").append(
      '<option value="Department of Management">Department of Management</option>'
    );
    $("#filterFacultyDepartment").append(
      '<option value="Department of Marketing">Department of Marketing</option>'
    );
    $("#filterFacultyDepartment").append(
      '<option value="Department of Office Administration">Department of Office Administration</option>'
    );
    $("#filterFacultyDepartment").append(
      '<option value="Department of Entrepreneurship">Department of Entrepreneurship</option>'
    );
  } else if (selectedCollege === "College of Communication (COC)") {
    $("#filterFacultyDepartment").prop("disabled", false);
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (
    selectedCollege === "College of Computer and Information Sciences (CCIS)"
  ) {
    $("#filterFacultyDepartment").prop("disabled", false);
    $("#filterFacultyDepartment").append('<option value="None">None</option>');
    $("#filterFacultyDepartment").append(
      '<option value="Department of Computer Science">Department of Computer Science</option>'
    );
    $("#filterFacultyDepartment").append(
      '<option value="Department of Information Technology">Department of Information Technology</option>'
    );
    $("#filterFacultyDepartment").append(
      '<option value="Department of Information Systems and Sciences">Department of Information Systems and Sciences</option>'
    );
  } else if (selectedCollege === "College of Education (COED)") {
    $("#filterFacultyDepartment").prop("disabled", false);
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Engineering (CE)") {
    $("#filterFacultyDepartment").prop("disabled", false);
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Human Kinetics (CHK)") {
    $("#filterFacultyDepartment").prop("disabled", false);
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Law (CL)") {
    $("#filterFacultyDepartment").prop("disabled", false);
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (
    selectedCollege ===
    "College of Political Science and Public Administration (CPSPA)"
  ) {
    $("#filterFacultyDepartment").prop("disabled", false);
    // Set options for the CSPA
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (
    selectedCollege === "College of Social Sciences and Development (CSSD)"
  ) {
    $("#filterFacultyDepartment").prop("disabled", false);
    // Set options for the CSSD
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "College of Science (CS)") {
    $("#filterFacultyDepartment").prop("disabled", false);
    // Set options for the CS
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (
    selectedCollege ===
    "College of Tourism, Hospitality and Transportation Management (CTHTM)"
  ) {
    $("#filterFacultyDepartment").prop("disabled", false);
    // Set options for the CTHTM
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  } else if (selectedCollege === "Institute of Technology (ITech)") {
    $("#filterFacultyDepartment").prop("disabled", false);
    // Set options for the ITech
    $("#filterFacultyDepartment").append(
      '<option value="None">This college has no department yet.</option>'
    );
  }
});

// Colleges - Filter by College Departments (Faculty)
$("#filterFacultyCollegeDepartmentForm").on("submit", function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("filterFacultyCollegeDepartmentButton", true);
  $.ajax({
    type: "POST",
    url: "./functions/filterFacultyCollegeDepartment.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);
      $("#displayListOfFaculty").html(response);
    },
  });
});

// Colleges/Settings/NewsFeed - Filter College Departments Options (OfficialStaff/Settings/NewsFeed)
$(document).on(
  "change",
  "#filterOfficialStaffColleges, #editUserCollege, #filterNewsFeedColleges",
  function () {
    // Get the selected value
    var selectedCollege = $(this).val();

    // Disable the filterOfficialStaffDepartment select element initially
    $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
      "disabled",
      true
    );

    // Clear previous options in filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment
    $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").empty();

    // Enable filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment based on selected College
    // Current colleges that has college departments as of November 2023 are (CCSIS, CBA)
    if (selectedCollege === "College of Accountancy and Finance (CAF)") {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      // Set options for College A
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (
      selectedCollege ===
      "College of Architecture, Design and the Built Environment (CADBE)"
    ) {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      // Set options for CADBE
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (selectedCollege === "College of Arts and Letters (CAL)") {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      // Set options for College CAL
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (selectedCollege === "College of Business Administration (CBA)") {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      // Set departments for CBA
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">None</option>'
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="Department of Management">Department of Management</option>'
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="Department of Marketing">Department of Marketing</option>'
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="Department of Office Administration">Department of Office Administration</option>'
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="Department of Entrepreneurship">Department of Entrepreneurship</option>'
      );
    } else if (selectedCollege === "College of Communication (COC)") {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (
      selectedCollege === "College of Computer and Information Sciences (CCIS)"
    ) {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">None</option>'
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="Department of Computer Science">Department of Computer Science</option>'
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="Department of Information Technology">Department of Information Technology</option>'
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="Department of Information Systems and Sciences">Department of Information Systems and Sciences</option>'
      );
    } else if (selectedCollege === "College of Education (COED)") {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (selectedCollege === "College of Engineering (CE)") {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (selectedCollege === "College of Human Kinetics (CHK)") {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (selectedCollege === "College of Law (CL)") {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (
      selectedCollege ===
      "College of Political Science and Public Administration (CPSPA)"
    ) {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      // Set options for the CSPA
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (
      selectedCollege === "College of Social Sciences and Development (CSSD)"
    ) {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      // Set options for the CSSD
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (selectedCollege === "College of Science (CS)") {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      // Set options for the CS
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (
      selectedCollege ===
      "College of Tourism, Hospitality and Transportation Management (CTHTM)"
    ) {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      // Set options for the CTHTM
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    } else if (selectedCollege === "Institute of Technology (ITech)") {
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").prop(
        "disabled",
        false
      );
      // Set options for the ITech
      $("#filterOfficialStaffDepartment, #editUserDepartment, #filterNewsFeedDepartment").append(
        '<option value="None">This college has no department yet.</option>'
      );
    }
  }
);

// Colleges - Filter by College Departments (Official & Staff)
$("#filterOfficialStaffCollegeDepartmentForm").on("submit", function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("filterOfficialStaffCollegeDepartmentButton", true);
  $.ajax({
    type: "POST",
    url: "./functions/filterOfficialStaffCollegeDepartment.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);
      $("#displayListOfOfficialStaff").html(response);
    },
  });
});

// Colleges - Search Faculty or Officials & Staff
$("#searchFacultyOfficialStaff").keyup(function (e) {
  var input = $(this).val();
  if (input !== "") {
    $.ajax({
      type: "POST",
      url: "./functions/searchFacultyOfficialStaff.php",
      data: { input: input },
      success: function (data) {
        $("#searchResult").html(data).show(); // Show the dropdown
      },
    });
  } else {
    $("#searchResult").hide(); // Hide the dropdown when input is empty
  }
});

// Colleges - Increment Account Views
$(document).on("click", ".viewUserAccount", function () {
  var userAccountUserName = $(this).data("account-username");
  $.ajax({
    type: "POST",
    url: "./functions/incrementAccountViews.php",
    data: { userAccountUserName: userAccountUserName },
    success: function (response) {
      console.log(response);
      var res = jQuery.parseJSON(response);
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        window.location.href = res.redirect;
      } else {
        alert(res.message);
      }
    },
  });
});

// Settings - Edit User Details
$(document).on("click", "#editUserDetails", function () {
  var userID = $(this).val();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteTimelinePost");
    alert.find("#formAlertMessageDeleteTimelinePost").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }
  $.ajax({
    type: "POST",
    url: "./functions/editUserDetails.php?userID=" + userID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editUserID").val(res.data.user_id);
        $("#previeweditUserImage").attr(
          "src",
          "./images/profilePictures/" + res.data.user_image
        );
        $("#editUserName").val(res.data.user_name);
        $("#editUserImageValue").val(res.data.user_image);
        $("#editUserHonorifics").val(res.data.user_honorifics);
        $("#editUserCollege").val(res.data.user_college).change();
        $("#editUserDepartment").val(res.data.user_department).change();
        $("#editUserUniversityPosition").val(res.data.user_university_position);
        $("#editUserFacultyRank").val(res.data.user_faculty_rank);
        $("#editUserEmail").val(res.data.user_email);
        $("#editUserContactno").val(res.data.user_contactno);
        $("#modifyAccountDetailsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Settings - Update User Details
$("#editUserDetailsForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditUserDetails");
    alert.find("#formAlertMessageEditUserDetails").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateUserDetailsButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateUserDetails.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#accountDetails").load(" #accountDetails > *");
          $("#userNavbarDetails").load(" #userNavbarDetails > *");
          $("#modifyAccountDetailsModal").modal("hide");
        }, 1500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Settings - Change Password
$("#changePasswordForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertChangePassword");
    alert.find("#formAlertMessageChangePassword").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("changePasswordButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/changePassword.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      // console.log(response);
      var res = jQuery.parseJSON(response);
      if(res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#changePasswordForm")[0].reset();
          $("#changePasswordModal").modal("hide");
        }, 1500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    }
  });
});

// News Feed - Filter by College Departments
// Colleges - Filter by College Departments (Official & Staff)
$("#filterNewsFeedCollegeDepartmentForm").on("submit", function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("filterNewsFeedCollegeDepartmentButton", true);
  $.ajax({
    type: "POST",
    url: "./functions/filterNewsFeedCollegeDepartment.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);
      $("#displayListofNewsFeedPosts").html(response);
    },
  });
}); 

// Admin -Tables Initation
$(document).ready(function () {
  $("#academicAppointmentsTable, #honorAwardsTable, #administrativeAppointmentsTable, #otherAccountsTable, #researchInterestsTable, #pupAdviseesTable, #timelinePostsTable, #booksTable, #researchPaperReportsTable, #coursesTable, #accessCodesTable, #extensionsTable").DataTable({
    scrollX: true
  });
});




// BIOGRAPHY
// Create Biography
$("#createBiographyForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateBiography");
    alert.find("#formAlertMessageCreateBiography").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createBiographyButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createBiography.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createBioModal").modal("hide");
          $("#biographyCard").load(" #biographyCard > *");
        }, 2000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Biography
$(document).on("click", "#editBiographyButton", function () {
  var userID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editBiography.php?userID=" + userID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editBiographyID").val(res.data.user_id);
        $("#userEditBiography").text(res.data.user_biography);
        $("#editBioModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Edit Biography - Reset if changes where made but not saved
$("#editBioModal").on("hidden.bs.modal", function (e) {
  // Reset the form to its initial state
  $("#editBiographyForm")[0].reset();
});

// Update Biography
$("#editBiographyForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditBiography");
    alert.find("#formAlertMessageEditBiography").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateBiographyButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateBiography.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editBioModal").modal("hide");
        }, 2000);
        $("#biographyCard").load(" #biographyCard > *");
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// ACADEMIC APPOINTMENT
// Create Academic Appointment
$("#createAcademicAppointmentForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateAcademicAppointment");
    alert
      .find("#formAlertMessageCreateAcademicAppointment")
      .text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createAcademicAppointmentButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createAcademicAppointment.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createAcademicAppointmentsModal").modal("hide");
          $("#displayAcademicAppointment").load(
            " #displayAcademicAppointment > *"
          );
          $("#createAcademicAppointmentForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#academicAppointmentsCard").load(" #academicAppointmentsCard > *");
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Insert Academic Appointment
$("#insertAcademicAppointmentForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertInsertAcademicAppointment");
    alert
      .find("#formAlertMessageInsertAcademicAppointment")
      .text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("insertAcademicAppointmentButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/insertAcademicAppointment.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#insertAcademicAppointmentsModal").modal("hide");
          $("#displayAcademicAppointment").load(
            " #displayAcademicAppointment > *"
          );
          $("#insertAcademicAppointmentForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#academicAppointmentsCard").load(" #academicAppointmentsCard > *");
          $("#modifyAcademicAppointmentsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Academic Appointment
$(document).on("click", ".editAcademicAppointmentButton", function () {
  console.log("edit clicked");
  var academicAppointmentID = $(this).val();
  $.ajax({
    type: "GET",
    url:
      "./functions/editAcademicAppointment.php?academicAppointmentID=" +
      academicAppointmentID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editAcademicAppointmentID").val(res.data.academic_appointment_id);
        $("#editAcademicPosition").val(res.data.academic_position);
        $("#editAcademicField").val(res.data.academic_field);
        $("#modifyAcademicAppointmentsModal").modal("hide");
        $("#editAcademicAppointmentsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Update Academic Appointment
$("#editAcademicAppointmentForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditAcademicAppointment");
    alert.find("#formAlertMessageEditAcademicAppointment").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateAcademicAppointmentButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateAcademicAppointment.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editAcademicAppointmentsModal").modal("hide");
          $("#displayAcademicAppointment").load(
            " #displayAcademicAppointment > *"
          );
        }, 2000);
        setTimeout(() => {
          $("#academicAppointmentsCard").load(" #academicAppointmentsCard > *");
          $("#modifyAcademicAppointmentsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete Academic Appointment
$(document).on("click", ".deleteAcademicAppointmentButton", function () {
  var academicAppointmentID = $(this).val();
  $.ajax({
    type: "GET",
    url:
      "./functions/editAcademicAppointment.php?academicAppointmentID=" +
      academicAppointmentID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deleteAcademicAppointmentID").val(res.data.academic_appointment_id);
        $("#deleteAcademicPosition").text(res.data.academic_position);
        $("#deleteAcademicField").text(res.data.academic_field);
        $("#modifyAcademicAppointmentsModal").modal("hide");
        $("#deleteAcademicAppointmentsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Academic Appointment
$("#deleteAcademicAppointmentForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteAcademicAppointment");
    alert
      .find("#formAlertMessageDeleteAcademicAppointment")
      .text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deleteAcademicAppointmentButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deleteAcademicAppointment.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deleteAcademicAppointmentsModal").modal("hide");
          $("#displayAcademicAppointment").load(
            " #displayAcademicAppointment > *"
          );
        }, 2000);
        setTimeout(() => {
          $("#academicAppointmentsCard").load(" #academicAppointmentsCard > *");
          $("#modifyAcademicAppointmentsModal").modal("show");
        }, 2500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Save Academic Appointments
$("#saveAcademicAppointments").on("click", function () {
  $("#academicAppointmentsCard").load(" #academicAppointmentsCard > *");
  $("#modifyAcademicAppointmentsModal").modal("hide");
});

// HONORS & AWARDS
// Create Honors & Awards
$("#createHonorsAwardsForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateHonorsAwards");
    alert.find("#formAlertMessageCreateHonorsAwards").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createHonorsAwardsButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createHonorsAwards.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createHonorsAwardsModal").modal("hide");
          $("#displayHonorsAwards").load(" #displayHonorsAwards > *");
          $("#createHonorsAwardsForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#honorsAwardsCard").load(" #honorsAwardsCard > *");
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Insert Honors & Awards
$("#insertHonorAwardForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertInsertHonorAward");
    alert.find("#formAlertMessageInsertHonorAward").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("insertHonorAwardButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/insertHonorAward.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#insertHonorsAwardsModal").modal("hide");
          $("#displayHonorsAwards").load(" #displayHonorsAwards > *");
          $("#insertHonorAwardForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#honorsAwardsCard").load(" #honorsAwardsCard > *");
          $("#modifyHonorsAwardsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Honor & Awards
$(document).on("click", ".editHonorAwardButton", function () {
  var awardsID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editHonorAward.php?awardsID=" + awardsID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editAwardID").val(res.data.awards_id);
        $("#editAwardTitle").val(res.data.award_title);
        $("#editAwardDate").val(res.data.award_date);
        $("#modifyHonorsAwardsModal").modal("hide");
        $("#editHonorsAwardsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Update Honors & Awards
$("#editHonorAwardForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditHonorAward");
    alert.find("#formAlertMessageEditHonorAward").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateHonorAwardButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateHonorAward.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editHonorsAwardsModal").modal("hide");
          $("#displayHonorsAwards").load(" #displayHonorsAwards > *");
        }, 2000);
        setTimeout(() => {
          $("#honorsAwardsCard").load(" #honorsAwardsCard > *");
          $("#modifyHonorsAwardsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete Honor & Award
$(document).on("click", ".deleteHonorAwardButton", function () {
  var awardsID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editHonorAward.php?awardsID=" + awardsID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deleteAwardsID").val(res.data.awards_id);
        $("#deleteAwardTitle").text(res.data.award_title);
        $("#deleteAwardDate").text(res.data.award_date);
        $("#modifyHonorsAwardsModal").modal("hide");
        $("#deleteHonorsAwardsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Honors & Awards
$("#deleteHonorAwardForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteHonorAward");
    alert.find("#formAlertMessageDeleteHonorAward").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deleteHonorAwardButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deleteHonorAward.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deleteHonorsAwardsModal").modal("hide");
          $("#displayHonorsAwards").load(" #displayHonorsAwards > *");
        }, 2000);
        setTimeout(() => {
          $("#honorsAwardsCard").load(" #honorsAwardsCard > *");
          $("#modifyHonorsAwardsModal").modal("show");
        }, 2500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Save Honors & Awards
$("#saveHonorsAwards").on("click", function () {
  $("#honorsAwardsCard").load(" #honorsAwardsCard > *");
  $("#modifyHonorsAwardsModal").modal("hide");
});

// ADMINISTRATIVE APPOINTMENTS
// Create Administrative Appointment
$("#createAdministrativeAppointmentsForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateAdministrativeAppointments");
    alert
      .find("#formAlertMessageCreateAdministrativeAppointments")
      .text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createAdministrativeAppointmentButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createAdministrativeAppointment.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createAdministrativeAppointmentsModal").modal("hide");
          $("#displayAdministrativeAppointments").load(
            " #displayAdministrativeAppointments > *"
          );
          $("#createAdministrativeAppointmentsForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#administrativeAppointmentCard").load(
            " #administrativeAppointmentCard > *"
          );
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Insert Administrative Appointment
$("#insertAdministrativeAppointmentForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertInsertAdministrativeAppointment");
    alert
      .find("#formAlertMessageInsertAdministrativeAppointment")
      .text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("insertAdministrativeAppointmentButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/insertAdministrativeAppointment.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#insertAdministrativeAppointmentsModal").modal("hide");
          $("#displayAdministrativeAppointments").load(
            " #displayAdministrativeAppointments > *"
          );
          $("#insertAdministrativeAppointmentForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#administrativeAppointmentCard").load(
            " #administrativeAppointmentCard > *"
          );
          $("#modifyAdministrativeAppointmentsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Administratice Appointment
$(document).on("click", ".editAdministrativeAppointmentButton", function () {
  var administrativeAppointmentID = $(this).val();
  $.ajax({
    type: "GET",
    url:
      "./functions/editAdministrativeAppointment.php?administrativeAppointmentID=" +
      administrativeAppointmentID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editAdministrativeAppointmentID").val(
          res.data.administrative_appointment_id
        );
        $("#editAdministrativePosition").val(res.data.administrative_position);
        $("#editAdministrativeOrganization").val(
          res.data.administrative_organization
        );
        $("#editAdministrativeStartDate").val(
          res.data.administrative_start_date
        );
        $("#editAdministrativeEndDate").val(res.data.administrative_end_date);
        $("#modifyAdministrativeAppointmentsModal").modal("hide");
        $("#editAdministrativeAppointmentsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Update Administratice Appointment
$("#editAdministrativeAppointmentForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditAdministrativeAppointment");
    alert
      .find("#formAlertMessageEditAdministrativeAppointment")
      .text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateAdministrativeAppointmentButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateAdministrativeAppointment.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editAdministrativeAppointmentsModal").modal("hide");
          $("#displayAdministrativeAppointments").load(
            " #displayAdministrativeAppointments > *"
          );
        }, 2000);
        setTimeout(() => {
          $("#administrativeAppointmentCard").load(
            " #administrativeAppointmentCard > *"
          );
          $("#modifyAdministrativeAppointmentsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete Administrative Appointment
$(document).on("click", ".deleteAdministrativeAppointmentButton", function () {
  var administrativeAppointmentID = $(this).val();
  $.ajax({
    type: "GET",
    url:
      "./functions/editAdministrativeAppointment.php?administrativeAppointmentID=" +
      administrativeAppointmentID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deleteAdministrativeAppointmentID").val(
          res.data.administrative_appointment_id
        );
        $("#deleteAdministrativePosition").text(
          res.data.administrative_position
        );
        $("#deleteAdministrativeOrganization").text(
          res.data.administrative_organization
        );
        $("#deleteAdministrativeStartDate").text(
          res.data.administrative_start_date
        );
        $("#deleteAdministrativeEndDate").text(
          res.data.administrative_end_date
        );
        $("#modifyAdministrativeAppointmentsModal").modal("hide");
        $("#deleteAdministrativeAppointmentsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Administrative Appointment
$("#deleteAdministrativeAppointmentForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteAdministrativeAppointment");
    alert
      .find("#formAlertMessageDeleteAdministrativeAppointment")
      .text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deleteAdministrativeAppointmentButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deleteAdministrativeAppointment.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deleteAdministrativeAppointmentsModal").modal("hide");
          $("#displayAdministrativeAppointments").load(
            " #displayAdministrativeAppointments > *"
          );
        }, 2000);
        setTimeout(() => {
          $("#administrativeAppointmentCard").load(
            " #administrativeAppointmentCard > *"
          );
          $("#modifyAdministrativeAppointmentsModal").modal("show");
        }, 2500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Save Administrative Appointments
$("#saveAdministrativeAppointments").on("click", function () {
  $("#administrativeAppointmentCard").load(
    " #administrativeAppointmentCard > *"
  );
  $("#modifyAdministrativeAppointmentsModal").modal("hide");
});

// OTHER ACCOUNTS
// Create Other Account
$("#createOtherAccountForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateOtherAccount");
    alert.find("#formAlertMessageCreateOtherAccount").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createOtherAccountButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createOtherAccount.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createOtherAccountsModal").modal("hide");
          $("#displayOtherAccounts").load(" #displayOtherAccounts > *");
          $("#createOtherAccountsForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#otherAccountsCard").load(" #otherAccountsCard > *");
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Insert Other Account
$("#insertOtherAccountForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertInsertOtherAccount");
    alert.find("#formAlertMessageInsertOtherAccount").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("insertOtherAccountButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/insertOtherAccount.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#insertOtherAccountsModal").modal("hide");
          $("#displayOtherAccounts").load(" #displayOtherAccounts > *");
          $("#insertOtherAccountForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#otherAccountsCard").load(" #otherAccountsCard > *");
          $("#modifyOtherAccountsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Other Account
$(document).on("click", ".editOtherAccountButton", function () {
  var linkID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editOtherAccount.php?linkID=" + linkID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editOtherAccountID").val(res.data.link_id);
        $("#editLinkName").val(res.data.link_name).change();
        $("#editLinkUrl").val(res.data.link_url);
        $("#modifyOtherAccountsModal").modal("hide");
        $("#editOtherAccountsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Update Other Account
$("#editOtherAccountForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditOtherAccount");
    alert.find("#formAlertMessageEditOtherAccount").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateOtherAccountButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateOtherAccount.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editOtherAccountsModal").modal("hide");
          $("#displayOtherAccounts").load(" #displayOtherAccounts > *");
        }, 2000);
        setTimeout(() => {
          $("#otherAccountsCard").load(" #otherAccountsCard > *");
          $("#modifyOtherAccountsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete Other Account
$(document).on("click", ".deleteOtherAccountButton", function () {
  var linkID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editOtherAccount.php?linkID=" + linkID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deleteOtherAccountID").val(res.data.link_id);
        $("#modifyOtherAccountsModal").modal("hide");
        $("#deleteOtherAccountsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Other Account
$("#deleteOtherAccountForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteOtherAccount");
    alert.find("#formAlertMessageDeleteOtherAccount").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deleteOtherAccountButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deleteOtherAccount.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deleteOtherAccountsModal").modal("hide");
          $("#displayOtherAccounts").load(" #displayOtherAccounts > *");
        }, 2000);
        setTimeout(() => {
          $("#otherAccountsCard").load(" #otherAccountsCard > *");
          $("#modifyOtherAccountsModal").modal("show");
        }, 2500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Save Other Accounts
$("#saveOtherAccounts").on("click", function () {
  $("#otherAccountsCard").load(" #otherAccountsCard > *");
  $("#modifyOtherAccountsModal").modal("hide");
});

// RESEARCH INTERESTS
// Create Research Interest
$("#createResearchInterestForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateResearchInterest");
    alert.find("#formAlertMessageCreateResearchInterest").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createResearchInterestButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createResearchInterest.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createResearchInterestsModal").modal("hide");
          $("#displayResearchInterests").load(" #displayResearchInterests > *");
          $("#createResearchInterestsForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#researchInterestsCard").load(" #researchInterestsCard > *");
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Insert Research Interest
$("#insertResearchInterestForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertInsertResearchInterest");
    alert.find("#formAlertMessageInsertResearchInterest").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("insertResearchInterestButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/insertResearchInterest.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#insertResearchInterestsModal").modal("hide");
          $("#displayResearchInterests").load(" #displayResearchInterests > *");
          $("#insertResearchInterestForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#researchInterestsCard").load(" #researchInterestsCard > *");
          $("#modifyResearchInterestsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Research Interest
$(document).on("click", ".editResearchInterestButton", function () {
  var researchInterestID = $(this).val();
  $.ajax({
    type: "GET",
    url:
      "./functions/editResearchInterest.php?researchInterestID=" +
      researchInterestID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editResearchInterestID").val(res.data.research_interest_id);
        $("#editResearchInterestDescription").val(
          res.data.research_interest_description
        );
        $("#modifyResearchInterestsModal").modal("hide");
        $("#editResearchInterestsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Update Research Interest
$("#editResearchInterestForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditResearchInterest");
    alert.find("#formAlertMessageEditResearchInterest").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateResearchInterestButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateResearchInterest.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editResearchInterestsModal").modal("hide");
          $("#displayResearchInterests").load(" #displayResearchInterests > *");
        }, 2000);
        setTimeout(() => {
          $("#researchInterestsCard").load(" #researchInterestsCard > *");
          $("#modifyResearchInterestsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete Research Interest
$(document).on("click", ".deleteResearchInterestButton", function () {
  var researchInterestID = $(this).val();
  $.ajax({
    type: "GET",
    url:
      "./functions/editResearchInterest.php?researchInterestID=" +
      researchInterestID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deleteResearchInterestID").val(res.data.research_interest_id);
        $("#deleteResearchInterestDescription").text(
          res.data.research_interest_description
        );
        $("#modifyResearchInterestsModal").modal("hide");
        $("#deleteResearchInterestsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Research Interest
$("#deleteResearchInterestForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteResearchInterest");
    alert.find("#formAlertMessageDeleteResearchInterest").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deleteResearchInterestButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deleteResearchInterest.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deleteResearchInterestsModal").modal("hide");
          $("#displayResearchInterests").load(" #displayResearchInterests > *");
        }, 2000);
        setTimeout(() => {
          $("#researchInterestsCard").load(" #researchInterestsCard > *");
          $("#modifyResearchInterestsModal").modal("show");
        }, 2500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Save Research Interest
$("#saveResearchInterests").on("click", function () {
  $("#researchInterestsCard").load(" #researchInterestsCard > *");
  $("#modifyResearchInterestsModal").modal("hide");
});

// PUP ADVISEES
// Create PUP Advisee
$("#createPupAdviseeForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreatePupAdvisee");
    alert.find("#formAlertMessageCreatePupAdvisee").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createPupAdviseeButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createPupAdvisee.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createPupAdviseesModal").modal("hide");
          $("#displayPupAdvisees").load(" #displayPupAdvisees > *");
          $("#createPupAdviseesForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#pupAdviseesCard").load(" #pupAdviseesCard > *");
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Insert PUP Advisee
$("#insertPupAdviseeForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertInsertPupAdvisee");
    alert.find("#formAlertMessageInsertPupAdvisee").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("insertPupAdviseeButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/insertPupAdvisee.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#insertPupAdviseesModal").modal("hide");
          $("#displayPupAdvisees").load(" #displayPupAdvisees > *");
          $("#insertPupAdviseeForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#pupAdviseesCard").load(" #pupAdviseesCard > *");
          $("#modifyPupAdviseesModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit PUP Advisee
$(document).on("click", ".editPupAdviseeButton", function () {
  var adviseeID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editPupAdvisee.php?adviseeID=" + adviseeID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editAdviseeID").val(res.data.advisee_id);
        $("#editCourseName").val(res.data.advisee_course_name);
        $("#editCourseYear").val(res.data.advisee_course_year).change();
        $("#editCourseSection").val(res.data.advisee_course_section);
        $("#modifyPupAdviseesModal").modal("hide");
        $("#editPupAdviseesModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Update PUP Advisee
$("#editPupAdviseeForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditPupAdvisee");
    alert.find("#formAlertMessageEditPupAdvisee").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updatePupAdviseeButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updatePupAdvisee.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editPupAdviseesModal").modal("hide");
          $("#displayPupAdvisees").load(" #displayPupAdvisees > *");
        }, 2000);
        setTimeout(() => {
          $("#pupAdviseesCard").load(" #pupAdviseesCard > *");
          $("#modifyPupAdviseesModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete PUP Advisee
$(document).on("click", ".deletePupAdviseeButton", function () {
  var adviseeID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editPupAdvisee.php?adviseeID=" + adviseeID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deleteAdviseeID").val(res.data.advisee_id);
        $("#deleteCourseName").text(res.data.advisee_course_name);
        $("#deleteCourseYear").text(res.data.advisee_course_year);
        $("#deleteCourseSection").text(res.data.advisee_course_section);
        $("#modifyPupAdviseesModal").modal("hide");
        $("#deletePupAdviseesModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete PUP Advisee
$("#deletePupAdviseeForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeletePupAdvisee");
    alert.find("#formAlertMessageDeletePupAdvisee").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deletePupAdviseeButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deletePupAdvisee.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deletePupAdviseesModal").modal("hide");
          $("#displayPupAdvisees").load(" #displayPupAdvisees > *");
        }, 2000);
        setTimeout(() => {
          $("#pupAdviseesCard").load(" #pupAdviseesCard > *");
          $("#modifyPupAdviseesModal").modal("show");
        }, 2500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Save Pup Advisees
$("#savePupAdvisees").on("click", function () {
  $("#pupAdviseesCard").load(" #pupAdviseesCard > *");
  $("#modifyPupAdviseesModal").modal("hide");
});

// BOOKS
// Create Book
$("#createBookForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateBook");
    alert.find("#formAlertMessageCreateBook").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createBookButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createBook.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createBooksModal").modal("hide");
          $("#displayBooks").load(" #displayBooks > *");
          $("#createBooksForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#booksCard").load(" #booksCard > *");
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Insert Book
$("#insertBookForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertInsertBook");
    alert.find("#formAlertMessageInsertBook").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("insertBookButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/insertBook.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#insertBooksModal").modal("hide");
          $("#displayBooks").load(" #displayBooks > *");
          $("#insertBookForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#booksCard").load(" #booksCard > *");
          $("#modifyBooksModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Book
$(document).on("click", ".editBookButton", function () {
  var bookID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editBook.php?bookID=" + bookID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editBookID").val(res.data.book_id);
        $("#editBookTitle").val(res.data.book_title);
        $("#editBookAuthor").val(res.data.book_author);
        $("#editBookDescription").text(res.data.book_description);
        $("#editBookLink").val(res.data.book_url);
        $("#editBookPublishDate").val(res.data.book_publish_date);
        $("#modifyBooksModal").modal("hide");
        $("#editBooksModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Update Book
$("#editBookForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditBook");
    alert.find("#formAlertMessageEditBook").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateBookButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateBook.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editBooksModal").modal("hide");
          $("#displayBooks").load(" #displayBooks > *");
        }, 2000);
        setTimeout(() => {
          $("#booksCard").load(" #booksCard > *");
          $("#modifyBooksModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete Book
$(document).on("click", ".deleteBookButton", function () {
  var bookID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editBook.php?bookID=" + bookID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deleteBookID").val(res.data.book_id);
        $("#deleteBookTitle").text(res.data.book_title);
        $("#deleteBookPublishAuthor").text(res.data.book_author);
        $("#deleteBookPublishDate").text(res.data.book_publish_date);
        $("#modifyBooksModal").modal("hide");
        $("#deleteBooksModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Book
$("#deleteBookForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteBook");
    alert.find("#formAlertMessageDeleteBook").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deleteBookButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deleteBook.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deleteBooksModal").modal("hide");
          $("#displayBooks").load(" #displayBooks > *");
        }, 2000);
        setTimeout(() => {
          $("#booksCard").load(" #booksCard > *");
          $("#modifyBooksModal").modal("show");
        }, 2500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Save Book
$("#saveBooks").on("click", function () {
  $("#booksCard").load(" #booksCard > *");
  $("#modifyBooksModal").modal("hide");
});

// PUBLICATIONS
// Create Publication
$("#createPublicationForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreatePublication");
    alert.find("#formAlertMessageCreatePublication").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createPublicationButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createPublication.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createPublicationsModal").modal("hide");
          $("#displayPublications").load(" #displayPublications > *");
          $("#createPublicationsForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#publicationsCard").load(" #publicationsCard > *");
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Insert Publication
$("#insertPublicationForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertInsertPublication");
    alert.find("#formAlertMessageInsertPublication").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("insertPublicationButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/insertPublication.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#insertPublicationsModal").modal("hide");
          $("#displayPublications").load(" #displayPublications > *");
          $("#insertPublicationForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#publicationsCard").load(" #publicationsCard > *");
          $("#modifyPublicationsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Publication
$(document).on("click", ".editPublicationButton", function () {
  var publicationID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editPublication.php?publicationID=" + publicationID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editPublicationID").val(res.data.publication_id);
        $("#editPublicationTitle").val(res.data.publication_title);
        $("#editPublicationDescription").text(res.data.publication_description);
        $("#editPublicationAuthor").val(res.data.publication_author);
        $("#editPublicationDate").val(res.data.publication_date);
        $("#editPublicationLink").val(res.data.publication_link);
        $("#modifyPublicationsModal").modal("hide");
        $("#editPublicationsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Update Publication
$("#editPublicationForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditPublication");
    alert.find("#formAlertMessageEditPublication").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updatePublicationButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updatePublication.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editPublicationsModal").modal("hide");
          $("#displayPublications").load(" #displayPublications > *");
        }, 2000);
        setTimeout(() => {
          $("#publicationsCard").load(" #publicationsCard > *");
          $("#modifyPublicationsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete Publication
$(document).on("click", ".deletePublicationButton", function () {
  var publicationID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editPublication.php?publicationID=" + publicationID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deletePublicationID").val(res.data.publication_id);
        $("#deletePublicationTitle").text(res.data.publication_title);
        $("#deletePublicationAuthor").text(res.data.publication_author);
        $("#deletePublicationDate").text(res.data.publication_date);
        $("#modifyPublicationsModal").modal("hide");
        $("#deletePublicationsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Publication
$("#deletePublicationForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeletePublication");
    alert.find("#formAlertMessageDeletePublication").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deletePublicationButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deletePublication.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deletePublicationsModal").modal("hide");
          $("#displayPublications").load(" #displayPublications > *");
        }, 2000);
        setTimeout(() => {
          $("#publicationsCard").load(" #publicationsCard > *");
          $("#modifyPublicationsModal").modal("show");
        }, 2500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Save Publication
$("#savePublications").on("click", function () {
  $("#publicationsCard").load(" #publicationsCard > *");
  $("#modifyPublicationsModal").modal("hide");
});

// EXTENSIONS
// Create Extension
$("#createExtensionForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateExtension");
    alert.find("#formAlertMessageCreateExtension").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createExtensionButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createExtension.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createExtensionsModal").modal("hide");
          $("#displayExtensions").load(" #displayExtensions > *");
          $("#createExtensionsForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#extensionsCard").load(" #extensionsCard > *");
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Insert Extension
$("#insertExtensionForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertInsertExtension");
    alert.find("#formAlertMessageInsertExtension").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("insertExtensionButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/insertExtension.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#insertExtensionsModal").modal("hide");
          $("#displayExtensions").load(" #displayExtensions > *");
          $("#insertExtensionForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#extensionsCard").load(" #extensionsCard > *");
          $("#modifyExtensionsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Extension
$(document).on("click", ".editExtensionButton", function () {
  var extensionID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editExtension.php?extensionID=" + extensionID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editExtensionID").val(res.data.extension_id);
        $("#editExtensionName").val(res.data.extension_name);
        $("#editExtensionRelationship").val(res.data.extension_relationship);
        $("#editExtensionStartDate")
          .val(res.data.extension_start_date)
          .change();
        $("#editExtensionEndDate").val(res.data.extension_end_date).change();
        $("#modifyExtensionsModal").modal("hide");
        $("#editExtensionsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Update Extension
$("#editExtensionForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditExtension");
    alert.find("#formAlertMessageEditExtension").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateExtensionButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateExtension.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editExtensionsModal").modal("hide");
          $("#displayExtensions").load(" #displayExtensions > *");
        }, 2000);
        setTimeout(() => {
          $("#extensionsCard").load(" #extensionsCard > *");
          $("#modifyExtensionsModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete Extension
$(document).on("click", ".deleteExtensionButton", function () {
  var extensionID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editExtension.php?extensionID=" + extensionID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deleteExtensionID").val(res.data.extension_id);
        $("#deleteExtensionName").text(res.data.extension_name);
        $("#deleteExtensionRelationship").text(res.data.extension_relationship);
        $("#deleteExtensionStartDate").text(res.data.extension_start_date);
        $("#deleteExtensionEndDate").text(res.data.extension_end_date);
        $("#modifyExtensionsModal").modal("hide");
        $("#deleteExtensionsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Extension
$("#deleteExtensionForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteExtension");
    alert.find("#formAlertMessageDeleteExtension").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deleteExtensionButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deleteExtension.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deleteExtensionsModal").modal("hide");
          $("#displayExtensions").load(" #displayExtensions > *");
        }, 2000);
        setTimeout(() => {
          $("#extensionsCard").load(" #extensionsCard > *");
          $("#modifyExtensionsModal").modal("show");
        }, 2500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Save Extension
$("#saveExtensions").on("click", function () {
  $("#extensionsCard").load(" #extensionsCard > *");
  $("#modifyExtensionsModal").modal("hide");
});

// COURSES
// Create Course
$("#createCourseForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateCourse");
    alert.find("#formAlertMessageCreateCourse").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createCourseButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createCourse.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createCoursesModal").modal("hide");
          $("#displayCourses").load(" #displayCourses > *");
          $("#createCourseForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#lectureCourseID").val(res.courseID);
          $("#skipCreateLecture").attr(
            "href",
            "http://localhost/pup_profiles/pages/profileCourseDetails.php?courseID=" +
              res.courseID
          );
          $("#listOfCourses").load(" #listOfCourses > *");
          $("#createLectureMaterialsModal").modal("show");
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Course
$(document).on("click", ".editCourseButton", function () {
  var courseID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editCourse.php?courseID=" + courseID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#editCourseID").val(res.data.course_id);
        $("#editCourseTitle").val(res.data.course_title);
        $("#editCourseDescription").val(res.data.course_description);
        $("#editAccessCodes").val(res.accessCodes.numberOfAccessCodes);
        $("#editLectureMaterials").val(
          res.lectureMaterials.numberOfLectureMaterials
        );
        $("#modifyCoursesModal").modal("hide");
        $("#editCoursesModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Update Course
$("#editCourseForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditCourse");
    alert.find("#formAlertMessageEditCourse").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateCourseButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateCourse.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editCoursesModal").modal("hide");
          $("#displayCourses").load(" #displayCourses > *");
        }, 2000);
        setTimeout(() => {
          $("#listOfCourses").load(" #listOfCourses > *");
          $("#modifyCoursesModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete Course
$(document).on("click", ".deleteCourseButton", function () {
  var courseID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editCourse.php?courseID=" + courseID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deleteCourseID").val(res.data.course_id);
        $("#deleteCourseTitle").text(res.data.course_title);
        $("#modifyCoursesModal").modal("hide");
        $("#deleteCoursesModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Course
$("#deleteCourseForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteCourse");
    alert.find("#formAlertMessageDeleteCourse").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deleteCourseButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deleteCourse.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deleteCoursesModal").modal("hide");
          $("#displayCourses").load(" #displayCourses > *");
        }, 2000);
        setTimeout(() => {
          $("#listOfCourses").load(" #listOfCourses > *");
          $("#modifyCoursesModal").modal("show");
        }, 2500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Save Courses
$("#saveCourses").on("click", function () {
  $("#listOfCourses").load(" #listOfCourses > *");
  $("#modifyCoursesModal").modal("hide");
});

// LECTURE MATERIALS
// Create Lecture Material
$("#createLectureMaterialForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateLecture");
    alert.find("#formAlertMessageCreateLecture").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createLectureMaterialButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createLectureMaterial.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createLectureMaterialsModal").modal("hide");
          $("#createLecturesForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          window.location.href = res.redirect;
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Insert Lecture Material
$("#insertLectureMaterialForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertInsertLectureMaterial");
    alert.find("#formAlertMessageInsertLectureMaterial").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("insertLectureButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/insertLectureMaterial.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#displayListOfLectureMaterials").load(
            " #displayListOfLectureMaterials > *"
          );
          $("#insertLectureMaterialsModal").modal("hide");
          $("#insertLectureMaterialForm")[0].reset();
        }, 2000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Lecture Material
$(document).on("click", ".editLectureMaterialButton", function () {
  var lectureMaterialID = $(this).val();
  $.ajax({
    type: "GET",
    url:
      "./functions/editLectureMaterial.php?lectureMaterialID=" +
      lectureMaterialID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editLectureMaterialID").val(res.data.lecture_material_id);
        $("#editLectureTitle").val(res.data.lecture_title);
        $("#editLectureDescription").text(res.data.lecture_description);
        $("#editLectureLink").val(res.data.lecture_url);
        $("#editLectureMaterialsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Edit Lecture Material - Reset if changes where made but not saved
$("#editLectureMaterialsModal").on("hidden.bs.modal", function (e) {
  // Reset the form to its initial state
  $("#editLectureMaterialForm")[0].reset();
});

// Update Lecture Material
$("#editLectureMaterialForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditLectureMaterial");
    alert.find("#formAlertMessageEditLectureMaterial").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateLectureMaterialButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateLectureMaterial.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editLectureMaterialsModal").modal("hide");
          $("#displayListOfLectureMaterials").load(
            " #displayListOfLectureMaterials > *"
          );
        }, 2000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete Lecture Material
$(document).on("click", ".deleteLectureMaterialButton", function () {
  var lectureMaterialID = $(this).val();
  $.ajax({
    type: "GET",
    url:
      "./functions/editLectureMaterial.php?lectureMaterialID=" +
      lectureMaterialID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deleteLectureMaterialID").val(res.data.lecture_material_id);
        $("#deleteLectureMaterialTitle").text(res.data.lecture_title);
        $("#deleteLectureMaterialsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Lecture Material
$("#deleteLectureMaterialForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteLectureMaterial");
    alert.find("#formAlertMessageDeleteLectureMaterial").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deleteLectureMaterialButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deleteLectureMaterial.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deleteLectureMaterialsModal").modal("hide");
          $("#displayListOfLectureMaterials").load(
            " #displayListOfLectureMaterials > *"
          );
        }, 2000);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// ACCESS CODES
// Create Access Code
$("#createAccessCodeForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateAccessCode");
    alert.find("#formAlertMessageCreateAccessCode").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createAccessCodeButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createAccessCode.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createAccessCodesModal").modal("hide");
          $("#displayListOfAccessCodes").load(" #displayListOfAccessCodes > *");
          $("#createAccessCodeForm")[0].reset();
        }, 2000);
        setTimeout(() => {
          $("#newAccessCode").val(res.accessCode);
          $("#newAccessCodeStartDate").text(res.accessCodeStartDate);
          $("#newAccessCodeEndDate").text(res.accessCodeEndDate);
          $("#successAccessCodeModal").modal("show");
        }, 3000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Edit Access Code
$(document).on("click", ".editAccessCodeButton", function () {
  var accessCodeID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editAccessCode.php?accessCodeID=" + accessCodeID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editAccessCodeID").val(res.data.access_code_id);
        $("#editAccessCode").val(res.data.access_code);
        $("#editAccessCodeStartDate").val(res.data.access_code_start_date);
        $("#editAccessCodeEndDate").val(res.data.access_code_end_date);
        $("#modifyAccessCodesModal").modal("hide");
        $("#editAccessCodesModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Update Access Code
$("#editAccessCodeForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditAccessCode");
    alert.find("#formAlertMessageEditAccessCode").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateAccessCodeButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateAccessCode.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editAccessCodesModal").modal("hide");
          $("#displayAccessCodes").load(" #displayAccessCodes > *");
        }, 2000);
        setTimeout(() => {
          $("#displayListOfAccessCodes").load(" #displayListOfAccessCodes > *");
          $("#modifyAccessCodesModal").modal("show");
        }, 2500);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

//  Confirm Delete Access Code
$(document).on("click", ".deleteAccessCodeButton", function () {
  var accessCodeID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editAccessCode.php?accessCodeID=" + accessCodeID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        $("#deleteAccessCodeID").val(res.data.access_code_id);
        $("#deleteAccessCode").text(res.data.access_code);
        $("#modifyAccessCodesModal").modal("hide");
        $("#deleteAccessCodesModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Access Code
$("#deleteAccessCodeForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteAccessCode");
    alert.find("#formAlertMessageDeleteAccessCode").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deleteAccessCodeButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deleteAccessCode.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deleteAccessCodesModal").modal("hide");
          $("#displayAccessCodes").load(" #displayAccessCodes > *");
        }, 2000);
        setTimeout(() => {
          $("#displayListOfAccessCodes").load(" #displayListOfAccessCodes > *");
          $("#modifyAccessCodesModal").modal("show");
        }, 2500);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Save Courses
$("#saveAccessCodes").on("click", function () {
  $("#listOfAccessCodes").load(" #listOfAccessCodes > *");
  $("#modifyAccessCodesModal").modal("hide");
});

// TIMELINE POSTS
// Create Timeline Post
$("#createTimelinePostForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateTimelinePost");
    alert.find("#formAlertMessageCreateTimelinePost").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createTimelinePostButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createTimelinePost.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createTimelinePostsModal").modal("hide");
          $("#displayListofPosts").load(" #displayListofPosts > *");
          $("#displayListofNewsFeedPosts").load(
            " #displayListofNewsFeedPosts > *"
          );
          $("#createTimelinePostForm")[0].reset();
        }, 2000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Create Timeline Post - Preview Image Before Upload
$("#createTimelinePostMedia").on("change", function (e) {
  // Validate Image File Type Function
  function isValidImageType(file) {
    // Define the allowed file types
    var allowedTypes = ["image/jpeg", "image/jpg", "image/png"];

    // Check if the selected file type is in the allowed types
    return allowedTypes.includes(file.type);
  }

  // Get the selected file
  var file = e.target.files[0];

  // Check if the selected file is an image (jpg, jpeg, or png)
  if (!file || !isValidImageType(file)) {
    alert("Please select a valid image file (jpg, jpeg, or png).");
    // Clear the input field
    $(this).val("");
    return;
  }

  // Create a FileReader
  var reader = new FileReader();

  // Set a callback function to run when the file is loaded
  reader.onload = function (e) {
    // Update the src attribute of the image preview
    $("#createTimelinePostImagePreview").attr("src", e.target.result);
    $("#createTimelinePostImagePreview").attr(
      "style",
      "height: 300px; object-fit: contain;"
    );
    $("#createTimelinePostRemoveImage").show();
  };

  // Read the selected file as a Data URL (base64 encoding)
  reader.readAsDataURL(file);
});

// Create Timeline Post - Reset if changes where made but not saved
$("#createTimelinePostsModal").on("hidden.bs.modal", function (e) {
  // Reset the form to its initial state
  $("#createTimelinePostForm")[0].reset();

  // Reset the image preview
  $("#createTimelinePostImagePreview").attr("src", "");
  $("#createTimelinePostImagePreview").attr(
    "style",
    "height: 0; object-fit: contain;"
  );

  // Reset Remove Image
  $("#createTimelinePostRemoveImage").hide();
});

// Create Timeline Post - Remove Image
$("#createTimelinePostRemoveImage").on("click", function () {
  // Clear the file input and hide the "Remove Image" text
  $("#createTimelinePostMedia").val("");
  $("#createTimelinePostImagePreview").attr("src", "");
  $("#createTimelinePostImagePreview").removeAttr("style");
  $(this).hide();
});

// Edit Timeline Post
$(document).on("click", ".editTimelinePostButton", function () {
  var timelinePostID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editTimelinePost.php?timelinePostID=" + timelinePostID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editTimelinePostID").val(res.data.timeline_post_id);
        $("#editTimelinePostDescription").text(
          res.data.timeline_post_description
        );
        if (res.data.timeline_post_media !== null) {
          $("#editTimelinePostImageValue").val(res.data.timeline_post_media);
          $("#editTimelinePostImagePreview").attr(
            "src",
            "./images/posts/" + res.data.timeline_post_media
          );
          $("#editTimelinePostImagePreview").attr(
            "style",
            "height: 300px; object-fit: contain;"
          );
          $("#editTimelinePostRemoveImage").show();
        } else {
          $("#editTimelinePostImageValue").val(res.data.timeline_post_media);
          $("#editTimelinePostRemoveImage").hide();
        }
        $("#editTimelinePostsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Edit Timeline Post - Preview Image Before Upload
$("#editTimelinePostMedia").on("change", function (e) {
  // Validate Image File Type Function
  function isValidImageType(file) {
    // Define the allowed file types
    var allowedTypes = ["image/jpeg", "image/jpg", "image/png"];

    // Check if the selected file type is in the allowed types
    return allowedTypes.includes(file.type);
  }

  // Get the selected file
  var file = e.target.files[0];

  // Check if the selected file is an image (jpg, jpeg, or png)
  if (!file || !isValidImageType(file)) {
    alert("Please select a valid image file (jpg, jpeg, or png).");
    // Clear the input field
    $(this).val("");
    return;
  }

  // Create a FileReader
  var reader = new FileReader();

  // Set a callback function to run when the file is loaded
  reader.onload = function (e) {
    // Update the src attribute of the image preview
    $("#editTimelinePostImagePreview").attr("src", e.target.result);
    $("#editTimelinePostImagePreview").attr(
      "style",
      "height: 300px; object-fit: contain;"
    );
    $("#editTimelinePostRemoveImage").show();
  };

  // Read the selected file as a Data URL (base64 encoding)
  reader.readAsDataURL(file);
});

// Edit Timeline Post - Reset if changes where made but not saved
$("#editTimelinePostsModal").on("hidden.bs.modal", function (e) {
  // Reset the form to its initial state
  $("#editTimelinePostForm")[0].reset();

  // Reset the image preview
  $("#editTimelinePostImagePreview").attr("src", "");
  $("#editTimelinePostImagePreview").attr(
    "style",
    "height: 0; object-fit: contain;"
  );
});

// Edit Timeline Post - Remove Image
$("#editTimelinePostRemoveImage").on("click", function () {
  // Clear the file input and hide the "Remove Image" text
  $("#editTimelinePostMedia").val("");
  $("#editTimelinePostImageValue").val("");
  $("#editTimelinePostImagePreview").attr("src", "");
  $("#editTimelinePostImagePreview").removeAttr("style");
  $(this).hide();
});

// Update Timeline Post
$("#editTimelinePostForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditTimelinePost");
    alert.find("#formAlertMessageEditTimelinePost").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateTimelinePostButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateTimelinePost.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editTimelinePostsModal").modal("hide");
          $("#displayListofPosts").load(" #displayListofPosts > *");
          $("#displayListofNewsFeedPosts").load(
            " #displayListofNewsFeedPosts > *"
          );
          $("#editTimelinePostForm")[0].reset();
        }, 2000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// TIMELINE POSTS EVENTS
// Create Timeline Post Event
$("#createTimelinePostEventForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateTimelinePostEvent");
    alert.find("#formAlertMessageCreateTimelinePostEvent").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createTimelinePostEventButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createTimelinePostEvent.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createTimelinePostEventsModal").modal("hide");
          $("#displayListofPosts").load(" #displayListofPosts > *");
          $("#displayListofNewsFeedPosts").load(
            " #displayListofNewsFeedPosts > *"
          );
          $("#createTimelinePostEventForm")[0].reset();
        }, 2000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Create Timeline Post Event - Preview Image Before Upload
$("#createTimelinePostEventMedia").on("change", function (e) {
  // Validate Image File Type Function
  function isValidImageType(file) {
    // Define the allowed file types
    var allowedTypes = ["image/jpeg", "image/jpg", "image/png"];

    // Check if the selected file type is in the allowed types
    return allowedTypes.includes(file.type);
  }

  // Get the selected file
  var file = e.target.files[0];

  // Check if the selected file is an image (jpg, jpeg, or png)
  if (!file || !isValidImageType(file)) {
    alert("Please select a valid image file (jpg, jpeg, or png).");
    // Clear the input field
    $(this).val("");
    return;
  }

  // Create a FileReader
  var reader = new FileReader();

  // Set a callback function to run when the file is loaded
  reader.onload = function (e) {
    // Update the src attribute of the image preview
    $("#createTimelinePostEventImagePreview").attr("src", e.target.result);
    $("#createTimelinePostEventImagePreview").attr(
      "style",
      "height: 300px; object-fit: contain;"
    );
    $("#createTimelinePostEventRemoveImage").show();
  };

  // Read the selected file as a Data URL (base64 encoding)
  reader.readAsDataURL(file);
});

// Create Timeline Post Event - Reset if changes where made but not saved
$("#createTimelinePostEventsModal").on("hidden.bs.modal", function (e) {
  // Reset the form to its initial state
  $("#createTimelinePostEventForm")[0].reset();

  // Reset the image preview
  $("#createTimelinePostEventImagePreview").attr("src", "");
  $("#createTimelinePostEventImagePreview").attr(
    "style",
    "height: 0; object-fit: contain;"
  );

  // Reset Remove Image
  $("#createTimelinePostEventRemoveImage").hide();
});

// Create Timeline Post Event - Remove Image
$("#createTimelinePostEventRemoveImage").on("click", function () {
  // Clear the file input and hide the "Remove Image" text
  $("#createTimelinePostEventMedia").val("");
  $("#createTimelinePostEventImagePreview").attr("src", "");
  $("#createTimelinePostEventImagePreview").removeAttr("style");
  $(this).hide();
});

// Edit Timeline Post Event
$(document).on("click", ".editTimelinePostEventButton", function () {
  var timelinePostID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editTimelinePost.php?timelinePostID=" + timelinePostID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editTimelinePostEventID").val(res.data.timeline_post_id);
        $("#editTimelinePostEventTitle").val(res.data.timeline_post_title);
        $("#editTimelinePostEventDescription").text(
          res.data.timeline_post_description
        );
        $("#editTimelinePostEventStartDate").val(
          res.data.timeline_post_start_date
        );
        $("#editTimelinePostEventEndDate").val(res.data.timeline_post_end_date);
        $("#editTimelinePostEventLink").val(res.data.timeline_post_url);
        if (res.data.timeline_post_media !== null) {
          $("#editTimelinePostEventImageValue").val(
            res.data.timeline_post_media
          );
          $("#editTimelinePostEventImagePreview").attr(
            "src",
            "./images/posts/" + res.data.timeline_post_media
          );
          $("#editTimelinePostEventImagePreview").attr(
            "style",
            "height: 300px; object-fit: contain;"
          );
          $("#editTimelinePostEventRemoveImage").show();
        } else {
          $("#editTimelinePostEventImageValue").val(
            res.data.timeline_post_media
          );
          $("#editTimelinePostEventRemoveImage").hide();
        }
        $("#editTimelinePostEventsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Edit Timeline Post Event - Preview Image Before Upload
$("#editTimelinePostEventMedia").on("change", function (e) {
  // Validate Image File Type Function
  function isValidImageType(file) {
    // Define the allowed file types
    var allowedTypes = ["image/jpeg", "image/jpg", "image/png"];

    // Check if the selected file type is in the allowed types
    return allowedTypes.includes(file.type);
  }

  // Get the selected file
  var file = e.target.files[0];

  // Check if the selected file is an image (jpg, jpeg, or png)
  if (!file || !isValidImageType(file)) {
    alert("Please select a valid image file (jpg, jpeg, or png).");
    // Clear the input field
    $(this).val("");
    return;
  }

  // Create a FileReader
  var reader = new FileReader();

  // Set a callback function to run when the file is loaded
  reader.onload = function (e) {
    // Update the src attribute of the image preview
    $("#editTimelinePostEventImagePreview").attr("src", e.target.result);
    $("#editTimelinePostEventImagePreview").attr(
      "style",
      "height: 300px; object-fit: contain;"
    );
    $("#editTimelinePostEventRemoveImage").show();
  };

  // Read the selected file as a Data URL (base64 encoding)
  reader.readAsDataURL(file);
});

// Edit Timeline Post Event - Reset if changes where made but not saved
$("#editTimelinePostEventsModal").on("hidden.bs.modal", function (e) {
  // Reset the form to its initial state
  $("#editTimelinePostEventForm")[0].reset();

  // Reset the image preview
  $("#editTimelinePostEventImagePreview").attr("src", "");
  $("#editTimelinePostEventImagePreview").attr(
    "style",
    "height: 0; object-fit: contain;"
  );
});

// Edit Timeline Post Event - Remove Image
$("#editTimelinePostEventRemoveImage").on("click", function () {
  // Clear the file input and hide the "Remove Image" text
  $("#editTimelinePostEventMedia").val("");
  $("#editTimelinePostEventImageValue").val("");
  $("#editTimelinePostEventImagePreview").attr("src", "");
  $("#editTimelinePostEventImagePreview").removeAttr("style");
  $(this).hide();
});

// Update Timeline Post Event
$("#editTimelinePostEventForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditTimelinePostEvent");
    alert.find("#formAlertMessageEditTimelinePostEvent").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateTimelinePostEventButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateTimelinePostEvent.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editTimelinePostEventsModal").modal("hide");
          $("#displayListofPosts").load(" #displayListofPosts > *");
          $("#displayListofNewsFeedPosts").load(
            " #displayListofNewsFeedPosts > *"
          );
          $("#editTimelinePostEventForm")[0].reset();
        }, 2000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// TIMELINE POST ANNOUNCEMENT
// Create Timeline Post Announcement
$("#createTimelinePostAnnouncementForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertCreateTimelinePostAnnouncement");
    alert
      .find("#formAlertMessageCreateTimelinePostAnnouncement")
      .text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("createTimelinePostAnnouncementButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/createTimelinePostAnnouncement.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#createTimelinePostAnnouncementsModal").modal("hide");
          $("#displayListofPosts").load(" #displayListofPosts > *");
          $("#displayListofNewsFeedPosts").load(
            " #displayListofNewsFeedPosts > *"
          );
          $("#createTimelinePostAnnouncementForm")[0].reset();
        }, 2000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Create Timeline Post Announcement - Preview Image Before Upload
$("#createTimelinePostAnnouncementMedia").on("change", function (e) {
  // Validate Image File Type Function
  function isValidImageType(file) {
    // Define the allowed file types
    var allowedTypes = ["image/jpeg", "image/jpg", "image/png"];

    // Check if the selected file type is in the allowed types
    return allowedTypes.includes(file.type);
  }

  // Get the selected file
  var file = e.target.files[0];

  // Check if the selected file is an image (jpg, jpeg, or png)
  if (!file || !isValidImageType(file)) {
    alert("Please select a valid image file (jpg, jpeg, or png).");
    // Clear the input field
    $(this).val("");
    return;
  }

  // Create a FileReader
  var reader = new FileReader();

  // Set a callback function to run when the file is loaded
  reader.onload = function (e) {
    // Update the src attribute of the image preview
    $("#createTimelinePostAnnouncementImagePreview").attr(
      "src",
      e.target.result
    );
    $("#createTimelinePostAnnouncementImagePreview").attr(
      "style",
      "height: 300px; object-fit: contain;"
    );
    $("#createTimelinePostAnnouncementRemoveImage").show();
  };

  // Read the selected file as a Data URL (base64 encoding)
  reader.readAsDataURL(file);
});

// Create Timeline Post Announcement - Reset if changes where made but not saved
$("#createTimelinePostAnnouncementsModal").on("hidden.bs.modal", function (e) {
  // Reset the form to its initial state
  $("#createTimelinePostAnnouncementForm")[0].reset();

  // Reset the image preview
  $("#createTimelinePostAnnouncementImagePreview").attr("src", "");
  $("#createTimelinePostAnnouncementImagePreview").attr(
    "style",
    "height: 0; object-fit: contain;"
  );

  // Reset Remove Image
  $("#createTimelinePostAnnouncementRemoveImage").hide();
});

// Create Timeline Post Announcement - Remove Image
$("#createTimelinePostAnnouncementRemoveImage").on("click", function () {
  // Clear the file input and hide the "Remove Image" text
  $("#createTimelinePostAnnouncementMedia").val("");
  $("#createTimelinePostAnnouncementImagePreview").attr("src", "");
  $("#createTimelinePostAnnouncementImagePreview").removeAttr("style");
  $(this).hide();
});

// Edit Timeline Post Announcement
$(document).on("click", ".editTimelinePostAnnouncementButton", function () {
  var timelinePostID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editTimelinePost.php?timelinePostID=" + timelinePostID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#editTimelinePostAnnouncementID").val(res.data.timeline_post_id);
        $("#editTimelinePostAnnouncementTitle").val(
          res.data.timeline_post_title
        );
        $("#editTimelinePostAnnouncementDescription").text(
          res.data.timeline_post_description
        );
        $("#editTimelinePostAnnouncementLink").val(res.data.timeline_post_url);

        if (res.data.timeline_post_media !== null) {
          $("#editTimelinePostAnnouncementImageValue").val(
            res.data.timeline_post_media
          );
          $("#editTimelinePostAnnouncementImagePreview").attr(
            "src",
            "./images/posts/" + res.data.timeline_post_media
          );
          $("#editTimelinePostAnnouncementImagePreview").attr(
            "style",
            "height: 300px; object-fit: contain;"
          );
          $("#editTimelinePostAnnouncementRemoveImage").show();
        } else {
          $("#editTimelinePostAnnouncementImageValue").val(
            res.data.timeline_post_media
          );
          $("#editTimelinePostAnnouncementRemoveImage").hide();
        }

        $("#editTimelinePostAnnouncementsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Edit Timeline Post Announcement - Preview Image Before Upload
$("#editTimelinePostAnnouncementMedia").on("change", function (e) {
  // Validate Image File Type Function
  function isValidImageType(file) {
    // Define the allowed file types
    var allowedTypes = ["image/jpeg", "image/jpg", "image/png"];

    // Check if the selected file type is in the allowed types
    return allowedTypes.includes(file.type);
  }

  // Get the selected file
  var file = e.target.files[0];

  // Check if the selected file is an image (jpg, jpeg, or png)
  if (!file || !isValidImageType(file)) {
    alert("Please select a valid image file (jpg, jpeg, or png).");
    // Clear the input field
    $(this).val("");
    return;
  }

  // Create a FileReader
  var reader = new FileReader();

  // Set a callback function to run when the file is loaded
  reader.onload = function (e) {
    // Update the src attribute of the image preview
    $("#editTimelinePostAnnouncementImagePreview").attr("src", e.target.result);
    $("#editTimelinePostAnnouncementImagePreview").attr(
      "style",
      "height: 300px; object-fit: contain;"
    );
    $("#editTimelinePostAnnouncementRemoveImage").show();
  };

  // Read the selected file as a Data URL (base64 encoding)
  reader.readAsDataURL(file);
});

// Edit Timeline Post Announcement - Reset if changes where made but not saved
$("#editTimelinePostAnnouncementsModal").on("hidden.bs.modal", function (e) {
  // Reset the form to its initial state
  $("#editTimelinePostAnnouncementForm")[0].reset();

  // Reset the image preview
  $("#editTimelinePostAnnouncementImagePreview").attr("src", "");
  $("#editTimelinePostAnnouncementImagePreview").attr(
    "style",
    "height: 0; object-fit: contain;"
  );
});

// Edit Timeline Post Announcement - Remove Image
$("#editTimelinePostAnnouncementRemoveImage").on("click", function () {
  // Clear the file input and hide the "Remove Image" text
  $("#editTimelinePostAnnouncementMedia").val("");
  $("#editTimelinePostAnnouncementImageValue").val("");
  $("#editTimelinePostAnnouncementImagePreview").attr("src", "");
  $("#editTimelinePostAnnouncementImagePreview").removeAttr("style");
  $(this).hide();
});

// Update Timeline Post Announcement
$("#editTimelinePostAnnouncementForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertEditTimelinePostAnnouncement");
    alert
      .find("#formAlertMessageEditTimelinePostAnnouncement")
      .text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  var formData = new FormData(this);
  formData.append("updateTimelinePostAnnouncementButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateTimelinePostAnnouncement.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#editTimelinePostAnnouncementsModal").modal("hide");
          $("#displayListofPosts").load(" #displayListofPosts > *");
          $("#displayListofNewsFeedPosts").load(
            " #displayListofNewsFeedPosts > *"
          );
          $("#editTimelinePostAnnouncementForm")[0].reset();
        }, 2000);
      } else if (res.status == 101 || res.status == 102) {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// Confirm Delete Timeline Post/Event/Announcement
$(document).on("click", ".deleteTimelinePostButton", function () {
  var timelinePostID = $(this).val();
  $.ajax({
    type: "GET",
    url: "./functions/editTimelinePost.php?timelinePostID=" + timelinePostID,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 100) {
        // Convert timeline_post_date to a Date object
        var postDate = new Date(res.data.timeline_post_date);

        // Format the date to the desired format
        var formattedDate = postDate.toLocaleString("en-PH", {
          month: "long",
          day: "numeric",
          year: "numeric",
          hour: "numeric",
          minute: "numeric",
          hour12: true,
        });

        $("#deleteTimelinePostID").val(res.data.timeline_post_id);
        $("#deleteTimelinePostDate").text(formattedDate);
        $("#deleteTimelinePostsModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Delete Timeline Post/Event/Announcement
$("#deleteTimelinePostForm").on("submit", function (e) {
  e.preventDefault();

  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertDeleteTimelinePost");
    alert.find("#formAlertMessageDeleteTimelinePost").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("deleteTimelinePostButton", true);

  $.ajax({
    type: "POST",
    url: "./functions/deleteTimelinePost.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          $("#deleteTimelinePostsModal").modal("hide");
          $("#displayListofPosts").load(" #displayListofPosts > *");
          $("#displayListofNewsFeedPosts").load(
            " #displayListofNewsFeedPosts > *"
          );
        }, 2000);
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});

// View Image
$(document).on("click", ".viewImage", function () {
  var timelinePostID = $(this).data("post-id");
  $.ajax({
    type: "GET",
    url: "./functions/editTimelinePost.php?timelinePostID=" + timelinePostID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#viewFullImage").attr(
          "src",
          "./images/posts/" + res.data.timeline_post_media
        );
        $("#viewFullImage").attr(
          "style",
          "height: 400px; object-fit: contain;"
        );

        $("#viewImageModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// View Image From Gallery
$(document).on("click", ".viewImageGallery", function () {
  var timelinePostID = $(this).data("post-id");
  $.ajax({
    type: "GET",
    url: "./functions/editTimelinePost.php?timelinePostID=" + timelinePostID,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        $("#viewFullGalleryImage").attr(
          "src",
          "./images/posts/" + res.data.timeline_post_media
        );
        $("#viewFullGalleryImage").attr(
          "style",
          "height: 400px; object-fit: contain;"
        );

        $("#viewGalleryModal").modal("hide");
        $("#viewGalleryImageModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Courses - View Course Details (Fetch ID)
$(document).on("click", "#provideAccessCode", function () {
  var courseID = $(this).data("course-id");
  $.ajax({
    type: "GET",
    url: "./functions/accessCourse.php?courseID=" + courseID,
    success: function (response) {
      console.log(response);
      var res = jQuery.parseJSON(response);
      if (res.status == 102) {
        window.location.href = res.redirect;
      } else if (res.status == 100) {
        $("#validateCourseAccessCodeID").val(res.data.course_id);
        $("#validateCourseAccessCodeModal").modal("show");
      } else {
        alert(res.message);
      }
    },
  });
});

// Courses - Validate Provided Access Code to View Course
$("#validateCourseAccessCodeForm").on("submit", function (e) {
  e.preventDefault();
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertValidateCourseAccessCode");
    alert
      .find("#formAlertMessageValidateCourseAccessCode")
      .text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  formData = new FormData(this);
  formData.append("validateCourseAccessCodeButton", true);
  $.ajax({
    type: "POST",
    url: "./functions/validateCourseAccessCode.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 100) {
        displayFormMessage(successMessage, res.message);
        setTimeout(() => {
          window.location.href = res.redirect;
        }, 2000);
        $("#validateCourseAccessCodeForm")[0].reset();
      } else {
        displayFormMessage(failMessage, res.message);
      }
    },
  });
});
