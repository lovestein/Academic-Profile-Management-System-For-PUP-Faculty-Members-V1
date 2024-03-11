<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['createOtherAccountButton'])){
    $link_user_id = mysqli_real_escape_string($con, $_POST['otherAccountUserID']);
    $link_name = mysqli_real_escape_string($con, $_POST['createLinkName']);
    $link_url = mysqli_real_escape_string($con, $_POST['createLinkUrl']);

    if ($link_name == NULL || $link_url == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the other account to create.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `other_accounts` (`link_user_id`, `link_name`, `link_url`)
            VALUES ('$link_user_id', '$link_name', '$link_url')";
    $result = mysqli_query($con, $sql);

    if($result) {
        $res = [
            'status' => 100, // Error Number
            'message' => 'New other account successfully created.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;   
    }
    else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Other account could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}