<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['createBookButton'])){
    $book_user_id = mysqli_real_escape_string($con, $_POST['bookUserID']);
    $book_title = mysqli_real_escape_string($con, $_POST['createBookTitle']);
    $book_author = mysqli_real_escape_string($con, $_POST['createBookAuthor']);
    $book_description = mysqli_real_escape_string($con, $_POST['createBookDescription']);
    $book_url = mysqli_real_escape_string($con, $_POST['createBookLink']);
    $book_publish_date = mysqli_real_escape_string($con, $_POST['createBookPublishDate']);

    if ($book_title == NULL || $book_author == NULL || $book_description == NULL || $book_publish_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please input book title to be created.'
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
        $res = [
            'status' => 100, // Error Number
            'message' => 'New book successfully created.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;   
    }
    else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Book could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}