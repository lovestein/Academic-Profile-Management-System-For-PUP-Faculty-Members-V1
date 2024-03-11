<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['insertBookButton'])){
    $book_user_id = mysqli_real_escape_string($con, $_POST['insertBookUserID']);
    $book_title = mysqli_real_escape_string($con, $_POST['insertBookTitle']);
    $book_author = mysqli_real_escape_string($con, $_POST['insertBookAuthor']);
    $book_description = mysqli_real_escape_string($con, $_POST['insertBookDescription']);
    $book_url = mysqli_real_escape_string($con, $_POST['insertBookLink']);
    $book_publish_date = mysqli_real_escape_string($con, $_POST['insertBookPublishDate']);

    if ($book_title == NULL || $book_author == NULL || $book_description == NULL || $book_publish_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please input book title to be inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `books` (
                `book_user_id`, 
                `book_title`, 
                `book_author`, 
                `book_description`,  
                `book_url`, 
                `book_publish_date`)
            VALUES (
                '$book_user_id', 
                '$book_title', 
                '$book_author', 
                '$book_description', 
                '$book_url', 
                '$book_publish_date')";
    $result = mysqli_query($con, $sql);

    if($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'New book inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Book could not be inserted at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}