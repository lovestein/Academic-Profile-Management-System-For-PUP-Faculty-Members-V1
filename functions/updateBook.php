<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateBookButton'])) {
    $book_id = mysqli_real_escape_string($con, $_POST['editBookID']);
    $book_title = mysqli_real_escape_string($con, $_POST['editBookTitle']);
    $book_author = mysqli_real_escape_string($con, $_POST['editBookAuthor']);
    $book_description = mysqli_real_escape_string($con, $_POST['editBookDescription']);
    $book_url = mysqli_real_escape_string($con, $_POST['editBookLink']);
    $book_publish_date = mysqli_real_escape_string($con, $_POST['editBookPublishDate']);

    if ($book_title == NULL || $book_author == NULL || $book_description == NULL || $book_publish_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete input for book to be edited.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `books` 
            SET 
                `book_title` = '$book_title', 
                `book_author` = '$book_author', 
                `book_description` = '$book_description', 
                `book_url` = '$book_url', 
                `book_publish_date` = '$book_publish_date'
            WHERE `book_id` = '$book_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Book successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Book could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

