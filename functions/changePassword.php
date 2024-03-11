<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['changePasswordButton'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['changePasswordUserID']);
    $user_password = mysqli_real_escape_string($con, $_POST['changePasswordCurrentPassword']);
    $user_new_password = mysqli_real_escape_string($con, $_POST['changePasswordNewPassword']);
    $user_confirm_new_password = mysqli_real_escape_string($con, $_POST['changePasswordConfirmNewPassword']);

    if ($user_password == NULL || $user_new_password == NULL || $user_confirm_new_password == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the fields to proceed.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    if ($user_new_password == $user_confirm_new_password) {
        // Retrieved current password
        $sql = "SELECT `user_password` FROM `user_profiles` WHERE `user_id` = '$user_id'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $data = mysqli_fetch_array($result);
            $hashed_password = $data['user_password'];

            // Verify provided password with current password
            if (password_verify($user_password, $hashed_password)) {
                // Encrypt password
                $user_encrypted_password = password_hash($user_new_password, PASSWORD_DEFAULT);
                // Update passord
                $sql = "UPDATE `user_profiles` SET `user_password` = '$user_encrypted_password' WHERE `user_id` = '$user_id'";
                $result = mysqli_query($con, $sql);
                if($result){
                    $res = [
                        'status' => 100, // Error Number
                        'message' => 'Password has been successfully updated.'
                    ];
                    // Display the error message
                    echo json_encode($res);
                    return false;
                } else {
                    $res = [
                        'status' => 102, // Error Number
                        'message' => 'Password could not be updated at the moment. Please try again later or contact us for further concerns.'
                    ];
                    // Display the error message
                    echo json_encode($res);
                    return false;
                    
                }
            }
            // Current password provided is incorrect
            else {
                $res = [
                    'status' => 103, // Error Number
                    'message' => 'Current password provided is incorrect. Please try again.'
                ];
                // Display the error message
                echo json_encode($res);
                return false;
            }
        } else {
            $res = [
                'status' => 104, // Error Number
                'message' => 'Passwords could not be retrieved.'
            ];
            // Display the error message
            echo json_encode($res);
            return false;
        }
        
    } else {
        $res = [
            'status' => 105, // Error Number
            'message' => 'Passwords do not match. Please try again.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}
