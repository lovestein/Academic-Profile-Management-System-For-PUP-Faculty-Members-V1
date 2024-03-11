<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['createHonorsAwardsButton'])){
    $awards_user_id = mysqli_real_escape_string($con, $_POST['awardsUserID']);
    $awards_title = mysqli_real_escape_string($con, $_POST['createAwardTitle']);
    $awards_date = mysqli_real_escape_string($con, $_POST['createAwardDate']);

    if ($awards_title == NULL || $awards_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the honors & awards to create.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `honors_awards` (`awards_user_id`, `award_title`, `award_date`)
            VALUES ('$awards_user_id', '$awards_title', '$awards_date')";
    $result = mysqli_query($con, $sql);

    if($result) {
        $res = [
            'status' => 100, // Error Number
            'message' => 'New honor & award successfully created.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;   
    }
    else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Honor and award could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}