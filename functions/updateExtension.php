<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateExtensionButton'])) {
    $extension_id = mysqli_real_escape_string($con, $_POST['editExtensionID']);
    $extension_name = mysqli_real_escape_string($con, $_POST['editExtensionName']);
    $extension_relationship = mysqli_real_escape_string($con, $_POST['editExtensionRelationship']);
    $extension_start_date = mysqli_real_escape_string($con, $_POST['editExtensionStartDate']);
    $extension_end_date = mysqli_real_escape_string($con, $_POST['editExtensionEndDate']);

    if ($extension_name == NULL || $extension_relationship == NULL || $extension_start_date == NULL || $extension_end_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete inputs for the extension to be edited.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }


    $sql = "UPDATE `extensions` 
            SET 
                `extension_name`='$extension_name',
                `extension_relationship`='$extension_relationship',
                `extension_start_date`='$extension_start_date',
                `extension_end_date`='$extension_end_date'
            WHERE `extension_id`= '$extension_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Extension successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Extension could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

