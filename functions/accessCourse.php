<?php
session_start();
include '../includes/connection.php';

if(isset($_GET['courseID'])){
    $course_id = mysqli_real_escape_string($con, $_GET['courseID']);

  

    $sql = "SELECT * FROM `courses` WHERE `course_id` = '$course_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_array($result);

        $res = [
            'status' => 100, 
            'message' => 'Course fetched successfully by id.',
            'data' => $data
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    } else {
        // Respone Status and Message Response
        $res = [
            'status' => 101, 
            'message' => 'Course not found.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}