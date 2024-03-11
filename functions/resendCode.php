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
    $user_email = $_POST["userEmail"];

    $mail = new PHPMailer(true);

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

        // Verification Code
        $user_verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        //Content
        //Set email format to HTML
        $mail->isHTML(true);
        $mail->Subject = 'PUP | Profiles - Email Verification New Verification Code';
        $mail->Body    = '<p>Your new verification code is: <b style="font-size: 30px;">' . $user_verification_code . '</b></p>';

        $mail->send();
        // echo 'Message has been sent';

        if ($mail->send()){
            // Update the user_verification code with new sent code
            $sql = "UPDATE `user_profiles` 
            SET `user_verification_code` = '$user_verification_code'    
            WHERE `user_email` = '$user_email'";
            $result = mysqli_query($con, $sql);
    
            if (mysqli_affected_rows($con) > 0 ) {
                $result = [
                    'status' => 301, // Error Number
                    'message' => 'New verification code has been sent. Please check your emails and try again.'
                ];
                // Display the error message
                echo json_encode($result);
                return false;
            }
        }
        

    } catch (Exception $e) {
        $res = [
            'status' => 302, // Error Number
            'message' => 'Email for new verification code could not be sent. Please try again later or try to contact us at <a href="mailto:profilespup@gmail.com">profilespup@gmail.com</a> for more details.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}
