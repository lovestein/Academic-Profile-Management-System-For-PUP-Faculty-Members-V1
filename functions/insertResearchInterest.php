<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['insertResearchInterestButton'])){
    $research_interest_user_id = mysqli_real_escape_string($con, $_POST['insertResearchInterestUserID']);
    $research_interest_description = mysqli_real_escape_string($con, $_POST['insertResearchInterestDescription']);

    if ($research_interest_description == NULL){
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the research interest to be inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `research_interests` (`research_interest_user_id`, `research_interest_description`) 
            VALUES ('$research_interest_user_id', '$research_interest_description')";
    $result = mysqli_query($con, $sql);

    if($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'New research interest inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Research interest could not be inserted at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}