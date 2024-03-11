<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updatePublicationButton'])) {
    $publication_id = mysqli_real_escape_string($con, $_POST['editPublicationID']);
    $publication_title = mysqli_real_escape_string($con, $_POST['editPublicationTitle']);
    $publication_description = mysqli_real_escape_string($con, $_POST['editPublicationDescription']);
    $publication_author = mysqli_real_escape_string($con, $_POST['editPublicationAuthor']);
    $publication_date = mysqli_real_escape_string($con, $_POST['editPublicationDate']);
    $publication_link = mysqli_real_escape_string($con, $_POST['editPublicationLink']);

    if ($publication_title   == NULL || $publication_description == NULL || $publication_author == NULL || $publication_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please  complete the input for publication to be edited.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `selected_publications` 
            SET `publication_title` = '$publication_title', 
                `publication_description` = '$publication_description', 
                `publication_author` = '$publication_author',
                `publication_date` = '$publication_date',
                `publication_link` = '$publication_link'
            WHERE `publication_id` = '$publication_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Publication successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Publication could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

