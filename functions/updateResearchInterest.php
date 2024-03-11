<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateResearchInterestButton'])) {
    $research_interest_id = mysqli_real_escape_string($con, $_POST['editResearchInterestID']);
    $research_interest_description = mysqli_real_escape_string($con, $_POST['editResearchInterestDescription']);

    if ($research_interest_description == NULL) {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the research interest details to be updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `research_interests` 
            SET `research_interest_description` = '$research_interest_description'
            WHERE `research_interest_id` = '$research_interest_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Research interest successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Research interest could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

