<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateHonorAwardButton'])) {
    $awards_id = mysqli_real_escape_string($con, $_POST['editAwardID']);
    $award_title = mysqli_real_escape_string($con, $_POST['editAwardTitle']);
    $award_date = mysqli_real_escape_string($con, $_POST['editAwardDate']);

    if ($award_title == NULL || $award_date == NULL) {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the honor award details to be updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `honors_awards` 
            SET `award_title` = '$award_title', `award_date` = '$award_date'
            WHERE `awards_id` = '$awards_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Honor award successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Honor award could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

