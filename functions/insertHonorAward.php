<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['insertHonorAwardButton'])){
    $awards_user_id = mysqli_real_escape_string($con, $_POST['insertAwardUserID']);
    $award_title = mysqli_real_escape_string($con, $_POST['insertAwardTitle']);
    $award_date = mysqli_real_escape_string($con, $_POST['insertAwardDate']);

    if ($award_title == NULL || $award_date == NULL){
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the honor and award to be inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `honors_awards` (`awards_user_id`, `award_title`, `award_date`) 
            VALUES ('$awards_user_id', '$award_title', '$award_date')";
    $result = mysqli_query($con, $sql);

    if($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'New honor award inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Honor award could not be inserted at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}