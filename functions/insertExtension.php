<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['insertExtensionButton'])){
    $extension_user_id = mysqli_real_escape_string($con, $_POST['insertExtensionUserID']);
    $extension_name = mysqli_real_escape_string($con, $_POST['insertExtensionName']);
    $extension_relationship = mysqli_real_escape_string($con, $_POST['insertExtensionRelationship']);
    $extension_start_date = mysqli_real_escape_string($con, $_POST['insertExtensionStartDate']);
    $extension_end_date = mysqli_real_escape_string($con, $_POST['insertExtensionEndDate']);

    if ($extension_name == NULL || $extension_relationship == NULL || $extension_start_date == NULL || $extension_end_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete inputs for the extension to be inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `extensions` (
                `extension_user_id`, 
                `extension_name`, 
                `extension_relationship`, 
                `extension_start_date`, 
                `extension_end_date`)
            VALUES (
                '$extension_user_id', 
                '$extension_name', 
                '$extension_relationship', 
                '$extension_start_date', 
                '$extension_end_date')";
    $result = mysqli_query($con, $sql);

    if($result) {
        $res = [
            'status' => 100, // Error Number
            'message' => 'New extension successfully inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;   
    }
    else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Extension could not be inserted at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}