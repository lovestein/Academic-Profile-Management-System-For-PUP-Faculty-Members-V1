<?php
session_start();
include '../includes/connection.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

if (isset($_POST)) {
    $user_email = $_POST['userEmail'];

    // Check if all fields are filled
    if ($user_email == NULL) {
        // Respone Status and Message Response
        $res = [
            'status' => 103, // Error Number
            'message' => 'Please complete the login form to sign in.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $mail = new PHPMailer(true);

    // Check if Email Already Exists
    $check_email_query = "SELECT `user_email` FROM `user_profiles` WHERE `user_email` = '$user_email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    // Send email with link for changing forgotten password
    if (mysqli_num_rows($check_email_query_run) > 0) {
        try {

            //Enable verbose debug output
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
    
            //Send using SMTP
            $mail->isSMTP();
    
            //Set the SMTP server to send through
            $mail->Host       = 'smtp.gmail.com';
    
            //Enable SMTP authentication
            $mail->SMTPAuth   = true;
    
            //SMTP username
            // Gmail account created that will send the email verification code to registering user
            $mail->Username   = 'profilespup@gmail.com';
    
            //SMTP password
            // Gmail password app key password used because of the 2-factor authentication of the gmail account
            // Actual password used to login - PUP!Profiles1904 
            $mail->Password   = 'hbnn wuwy embo bbeg'; //'PUP!Profiles1904';
    
            //Enable implicit TLS encryption
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    
            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->Port       = 587;
    
            //Recipients
            $mail->setFrom('profilespup@gmail.com', 'pupprofiles.com'); // To be updated with the actual published website address
    
            //Add a recipient
            $name ='PUP | Profiles';
            $mail->addAddress($user_email, $name);
    
            //Content
            //Set email format to HTML
            $mail->isHTML(true);
            $mail->Subject = 'PUP | Profiles - Forgot Password';
            $mail->Body    = '<p>We have received notice of activity to change your password. Click <a href="http://localhost/pup_profiles/pages/updatePassword.php?user_email='.$user_email.'">here</a> to your password. Otherwis, please disregard this email.</p>';
    
            $sent = $mail->send();
            // echo 'Message has been sent';

            $res = [
                'status' => 100, // Error Number
                'message' => 'Email sent successfully. Please check your inbox messages to update your new password.'
            ];
            // Display the error message
            echo json_encode($res);
            return false;
    
        } catch (Exception $e) {
            $res = [
                'status' => 101, // Error Number
                'message' => 'Email to update password could not be sent. Please try again later or try to contact us at <a href="mailto:profilespup@gmail.com">profilespup@gmail.com</a> for more details.'
            ];
            // Display the error message
            echo json_encode($res);
            return false;
        }

    }
    else{
        $res = [
            'status' => 102, // Error Number
            'message' => 'This email does not exist or not registered yet. Please try a different information.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

}