<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updatePasswordButton'])) {
    $user_email = $_POST['userEmail'];
    $user_password = $_POST['userPassword'];
    $user_confirm_password = $_POST['userConfirmPassword'];

    if ($user_password == NULL || $user_confirm_password == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please fill up the form to proceed.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    if ($user_password == $user_confirm_password) {

        // Encrypted Password
        $user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);

        $sql = "UPDATE `user_profiles` 
        SET `user_password` = '$user_encrypted_password'    
        WHERE `user_email` = '$user_email'"; 

        $result = mysqli_query($con, $sql);
        $res = [
            'status' => 100, // Error Number
            'message' => 'Successfully updated password. You may now login using your new password. Please wait while we redirect you to the login page.',
            'redirect' => '../pages/index.php'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Passwords do not match. Please try again.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}