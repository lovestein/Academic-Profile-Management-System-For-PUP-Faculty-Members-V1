<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['createLectureMaterialButton'])){
    $lecture_course_id = mysqli_real_escape_string($con, $_POST['lectureCourseID']);
    $lecture_title = mysqli_real_escape_string($con, $_POST['createLectureTitle']);
    $lecture_description = mysqli_real_escape_string($con, $_POST['createLectureDescription']);
    $lecture_url = mysqli_real_escape_string($con, $_POST['createLectureLink']);

    if ($lecture_title == NULL || $lecture_description == NULL || $lecture_url == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete inputs for lecture material to be created.'
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
            'message' => 'New lecture material successfully created. Please wait.',
            'redirect' => '../pages/profileCourseDetails.php?courseID='. $lecture_course_id .''
        ];
        // Display the error message
        echo json_encode($res);
        return false;   
    }
    else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Lecture material could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}