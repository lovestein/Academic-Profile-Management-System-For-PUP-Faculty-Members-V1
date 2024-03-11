<?php
session_start();
include '../includes/connection.php';


if(isset($_GET['publicationID'])){
    $publication_id = mysqli_real_escape_string($con, $_GET['publicationID']);

    $sql = "SELECT * FROM `selected_publications` WHERE `publication_id` = '$publication_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Fetching data of honors awards into array
        $data = mysqli_fetch_array($result);

        // Respone Status and Message Response
        $res = [
            'status' => 100, 
            'message' => 'Publication fetched successfully by id.',
            'data' => $data 
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 101, 
            'message' => 'Publication not found.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}