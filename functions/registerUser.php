<?php
session_start();
include '../includes/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if (isset($_POST["registerButton"])) {
    // Get form data
    $user_name = mysqli_real_escape_string($con, $_POST['registerUserName']);
    $user_honorifics = mysqli_real_escape_string($con, $_POST['registerUserHonorifics']);
    $user_college = mysqli_real_escape_string($con, $_POST['registerUserCollege']);
    $user_department = mysqli_real_escape_string($con, $_POST['registerUserDepartment']);
    $user_university_position = mysqli_real_escape_string($con, $_POST['registerUserUniversityPosition']);
    $user_account_username = mysqli_real_escape_string($con, $_POST['registerUserAccountUsername']);
    $user_faculty_rank = mysqli_real_escape_string($con, $_POST['registerUserFacultyRank']);
    $user_email = mysqli_real_escape_string($con, $_POST['registerUserEmail']);
    $user_contactno = mysqli_real_escape_string($con, $_POST['registerUserContactno']);
    $user_password = mysqli_real_escape_string($con, $_POST['registerUserPassword']);
    $user_confirm_password = mysqli_real_escape_string($con, $_POST['registerUserConfirmPassword']);
    $user_type = mysqli_real_escape_string($con, $_POST['registerUserType']);

    // Profile picuture image conversion
    $image = $_FILES['registerUserImage']['name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    // To be inserted
    $user_image = time() . '.' . $image_extension;

    // Check if all selected required fields are complete
    if (
        empty($user_name) ||
        empty($user_college) ||
        empty($user_department) ||
        empty($user_university_position) ||
        empty($user_account_username) ||
        empty($user_email) ||
        empty($user_contactno) ||
        empty($user_password) ||
        empty($user_confirm_password) ||
        empty($image)
    ) {
        $res = [
            'status' => 101,
            'message' => 'Please complete the form to be able to proceed.'
        ];
        echo json_encode($res);
        return false;
    }

    // Initialize PHP Mailer
    $mail = new PHPMailer(true);

    // Check if passwords match
    if ($user_password == $user_confirm_password) {
        // Check if Email Already Exists
        $check_email_query = "SELECT `user_email` FROM `user_profiles` WHERE `user_email` = '$user_email' LIMIT 1";
        $check_email_query_run = mysqli_query($con, $check_email_query);
        // Check if Account Username Already Exists
        $check_account_username = "SELECT `user_account_username` FROM `user_profiles` WHERE `user_account_username` = '$user_account_username' LIMIT 1";
        $check_account_username_run = mysqli_query($con, $check_account_username);

        // If email already exists
        if (mysqli_num_rows($check_email_query_run) > 0) {
            $res = [
                'status' => 102, // Error Number
                'message' => 'This email already exists. You may use it to login now or use a different email.'
            ];
            // Display the error message
            echo json_encode($res);
            return false;
        }
        // If account username already exists 
        else if (mysqli_num_rows($check_account_username_run) > 0) {
            $res = [
                'status' => 105, // Error Number
                'message' => 'This account username already exists. You may use it to login now or use a different email.'
            ];
            // Display the error message
            echo json_encode($res);
            return false;
        }
        // If email and account username is validated to be new, proceed to create a new account
        try {
            // Prepare email to be sent for verication
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'profilespup@gmail.com';
            $mail->Password = 'hbnn wuwy embo bbeg';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('profilespup@gmail.com', 'pupprofiles.com');
            $mail->addAddress($user_email, $user_name);

            $user_verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

            $mail->isHTML(true);
            $mail->Subject = 'PUP | Profiles - Email Verification';
            $mail->Body = '<p>Your verification code is: <b style="font-size: 30px;">' . $user_verification_code . '</b></p>';

            // Encrypt password
            $user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
            
            // Insert new user into database
            $sql = "INSERT INTO `user_profiles`(
                `user_name`, 
                `user_email`, 
                `user_password`, 
                `user_account_username`,
                `user_honorifics`, 
                `user_college`, 
                `user_department`, 
                `user_university_position`, 
                `user_faculty_rank`,
                `user_contactno`, 
                `user_image`,  
                `user_type`, 
                `user_verification_code`, 
                `user_verification_date`
                ) 
                VALUES (
                    '$user_name', 
                    '$user_email', 
                    '$user_encrypted_password', 
                    '$user_account_username', 
                    '$user_honorifics', 
                    '$user_college', 
                    '$user_department', 
                    '$user_university_position', 
                    '$user_faculty_rank', 
                    '$user_contactno', 
                    '$user_image',
                    '$user_type', 
                    '$user_verification_code', 
                    NULL)";
            $result = mysqli_query($con, $sql);
            // Registration Successful - Send Email then Show Success Message 
            if ($result) {
                // Send email verification code
                $mail->send();
                // Upload profile picture to profilePictures folder
                move_uploaded_file($_FILES['registerUserImage']['tmp_name'], '../images/profilePictures/' . $user_image);
                // Return response
                $res = [
                    'status' => 100,
                    'message' => "Registration successful. Please proceed to verify your email.",
                    'email' => $user_email
                ];
                echo json_encode($res);
                return false;
            }
            // Validate query
            else {
                $res = [
                    'status' => 110,
                    'message' => 'Database query failed: ' . mysqli_error($con)
                ];
                echo json_encode($res);
                return false;
            }
        } 
        // PHP Mailer Validation
        catch (Exception $e) {
            $res = [
                'status' => 104,
                'message' => 'Email to verify account could not be sent. Please try again later or try to contact us at <a href="mailto:profilespup@gmail.com">profilespup@gmail.com</a> for more details.'
            ];
            echo json_encode($res);
            return false;
        }
    }
    // Passwords mismatch 
    else {
        $res = [
            'status' => 103,
            'message' => "Passwords don't match. Please try again."
        ];
        echo json_encode($res);
        return false;
    }
}

