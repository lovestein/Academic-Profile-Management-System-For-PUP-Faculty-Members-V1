<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['insertPublicationButton'])){
    $publication_user_id = mysqli_real_escape_string($con, $_POST['insertPublicationUserID']);
    $publication_title = mysqli_real_escape_string($con, $_POST['insertPublicationTitle']);
    $publication_description = mysqli_real_escape_string($con, $_POST['insertPublicationDescription']);
    $publication_author = mysqli_real_escape_string($con, $_POST['insertPublicationAuthor']);
    $publication_date = mysqli_real_escape_string($con, $_POST['insertPublicationDate']);
    $publication_link = mysqli_real_escape_string($con, $_POST['insertPublicationLink']);

    if ($publication_title   == NULL || $publication_description == NULL || $publication_author == NULL || $publication_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please  complete the input for publication to be inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `selected_publications`( 
        `publication_user_id`, 
        `publication_title`, 
        `publication_description`, 
        `publication_author`, 
        `publication_date`, 
        `publication_link`) 
        VALUES (
            '$publication_user_id',
            '$publication_title',
            '$publication_description',
            '$publication_author',
            '$publication_date',
            '$publication_link')";
    $result = mysqli_query($con, $sql);

    if($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'New publication inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Publication could not be inserted at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}