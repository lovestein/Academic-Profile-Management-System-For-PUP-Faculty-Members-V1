<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['deleteExtensionButton'])){
    $extension_id = mysqli_real_escape_string($con, $_POST['deleteExtensionID']);

    $sql = "DELETE FROM `extensions` WHERE `extension_id` = '$extension_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Success Number
            'message' => 'Extension deleted successfully.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Success Number
            'message' => 'Extension could not be deleted at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
}