<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['deletePublicationButton'])){
    $publication_id = mysqli_real_escape_string($con, $_POST['deletePublicationID']);

    $sql = "DELETE FROM `selected_publications` WHERE `publication_id` = '$publication_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Success Number
            'message' => 'Publication deleted successfully.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Success Number
            'message' => 'Publication could not be deleted at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
}