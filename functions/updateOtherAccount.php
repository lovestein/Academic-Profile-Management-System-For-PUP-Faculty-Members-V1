<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateOtherAccountButton'])) {
    // print_r($_POST);
    $link_id = mysqli_real_escape_string($con, $_POST['editOtherAccountID']);
    $link_name = mysqli_real_escape_string($con, $_POST['editLinkName']);
    $link_url = mysqli_real_escape_string($con, $_POST['editLinkUrl']);

    if ($link_name == NULL || $link_url == NULL) {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the other account details to be updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `other_accounts` 
            SET `link_name` = '$link_name', `link_url` = '$link_url'
            WHERE `link_id` = '$link_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Other account successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Other account could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

