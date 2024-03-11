<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['insertLectureButton'])){
    $lecture_course_id = mysqli_real_escape_string($con, $_POST['insertLectureCourseID']);
    $lecture_title = mysqli_real_escape_string($con, $_POST['insertLectureTitle']);
    $lecture_description = mysqli_real_escape_string($con, $_POST['insertLectureDescription']);
    $lecture_url = mysqli_real_escape_string($con, $_POST['insertLectureLink']);

    if ($lecture_title == NULL || $lecture_description == NULL || $lecture_url == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete inputs for lecture material to be inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `lecture_materials` (
                `lecture_course_id`, 
                `lecture_title`, 
                `lecture_description`, 
                `lecture_url`)
            VALUES (
                '$lecture_course_id', 
                '$lecture_title', 
                '$lecture_description', 
                '$lecture_url')";
    $result = mysqli_query($con, $sql);

    if($result) {
        $res = [
            'status' => 100, // Error Number
            'message' => 'New lecture material successfully inserted. Please wait.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;   
    }
    else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Lecture material could not be inserted at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}