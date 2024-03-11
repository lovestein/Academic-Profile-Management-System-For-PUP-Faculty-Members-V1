<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['deleteOtherAccountButton'])){
    $link_id = mysqli_real_escape_string($con, $_POST['deleteOtherAccountID']);

    $sql = "DELETE FROM `other_accounts` WHERE `link_id` = '$link_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Success Number
            'message' => 'Other account deleted successfully.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Success Number
            'message' => 'Other account could not be deleted at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
}