<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['deleteBookButton'])){
    $book_id = mysqli_real_escape_string($con, $_POST['deleteBookID']);

    $sql = "DELETE FROM `books` WHERE `book_id` = '$book_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Success Number
            'message' => 'Book deleted successfully.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Success Number
            'message' => 'Book could not be deleted at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
}