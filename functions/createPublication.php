<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['createPublicationButton'])){
    $publication_user_id = mysqli_real_escape_string($con, $_POST['publicationUserID']);
    $publication_title   = mysqli_real_escape_string($con, $_POST['createPublicationTitle']);
    $publication_description = mysqli_real_escape_string($con, $_POST['createPublicationDescription']);
    $publication_author = mysqli_real_escape_string($con, $_POST['createPublicationAuthor']);
    $publication_date = mysqli_real_escape_string($con, $_POST['createPublicationDate']);
    $publication_link = mysqli_real_escape_string($con, $_POST['createPublicationLink']);

    if ($publication_title   == NULL || $publication_description == NULL || $publication_author == NULL || $publication_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please  complete the input for publication to be created.'
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
        $res = [
            'status' => 100, // Error Number
            'message' => 'New publication successfully created.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;   
    }
    else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Publication could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}