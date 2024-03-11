<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateAccessCodeButton'])) {
    $access_code_id = mysqli_real_escape_string($con, $_POST['editAccessCodeID']);
    $access_code_start_date = mysqli_real_escape_string($con, $_POST['editAccessCodeStartDate']);
    $access_code_end_date = mysqli_real_escape_string($con, $_POST['editAccessCodeEndDate']);

    if ($access_code_start_date == NULL || $access_code_end_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete input for access code validity dates to be edited.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `access_codes` 
            SET 
                `access_code_start_date` = '$access_code_start_date', 
                `access_code_end_date` = '$access_code_end_date'
            WHERE `access_code_id` = '$access_code_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Access code validity dates successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Access code validity dates could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

