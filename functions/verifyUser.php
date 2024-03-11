<?php
session_start();
include '../includes/connection.php';


if (isset($_POST)) {
    $user_email = $_POST["userEmail"];
    $user_verification_code = $_POST["userVerificationCode"];

    if ($user_verification_code == NULL) {
        $res = [
            'status' => 201, // Error Number
            'message' => 'Please input the verification code we sent to your email.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `user_profiles` 
            SET `user_verification_date` = NOW()    
            WHERE `user_email` = '$user_email' 
            AND `user_verification_code` = '$user_verification_code'";

    $result = mysqli_query($con, $sql);

    if(mysqli_affected_rows($con) == 0 ) {
        $res = [
            'status' => 202, // Error Number
            'message' => 'Verification code incorrect. Please try again.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        $res = [
            'status' => 203, // Error Number
            'message' => 'Verification successful! Login now to access your account.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}
