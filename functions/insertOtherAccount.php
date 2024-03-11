<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['insertOtherAccountButton'])){
    $link_user_id = mysqli_real_escape_string($con, $_POST['insertOtherAccountUserID']);
    $link_name = mysqli_real_escape_string($con, $_POST['insertLinkName']);
    $link_url = mysqli_real_escape_string($con, $_POST['insertLinkUrl']);

    if ($link_name == NULL || $link_url == NULL){
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the other account to be inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `other_accounts` (`link_user_id`, `link_name`, `link_url`) 
            VALUES ('$link_user_id', '$link_name', '$link_url')";
    $result = mysqli_query($con, $sql);

    if($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'New other account inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Other account could not be inserted at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}