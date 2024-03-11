<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['createResearchInterestButton'])){
    $research_interest_user_id = mysqli_real_escape_string($con, $_POST['researchInterestUserID']);
    $research_interest_description = mysqli_real_escape_string($con, $_POST['createResearchInterestDescription']);

    if ($research_interest_description == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the research interest description to create.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `research_interests` (`research_interest_user_id`, `research_interest_description`)
            VALUES ('$research_interest_user_id', '$research_interest_description')";
    $result = mysqli_query($con, $sql);

    if($result) {
        $res = [
            'status' => 100, // Error Number
            'message' => 'New research interest description successfully created.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;   
    }
    else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Research interest description could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}