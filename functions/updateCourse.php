<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateCourseButton'])) {
    $course_id = mysqli_real_escape_string($con, $_POST['editCourseID']);
    $course_title = mysqli_real_escape_string($con, $_POST['editCourseTitle']);
    $course_description = mysqli_real_escape_string($con, $_POST['editCourseDescription']);

    if ($course_title == NULL || $course_description == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete input for course details to be edited.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `courses` 
            SET 
                `course_title` = '$course_title', 
                `course_description` = '$course_description'
            WHERE `course_id` = '$course_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Course details successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Course details could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

