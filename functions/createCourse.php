<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['createCourseButton'])) {
    // Course Details
    $course_user_id = mysqli_real_escape_string($con, $_POST['createCourseUserID']);
    $course_title = mysqli_real_escape_string($con, $_POST['createCourseTitle']);
    $course_description = mysqli_real_escape_string($con, $_POST['createCourseDescription']);
    // Access Code Validity Date
    $access_code_start_date = mysqli_real_escape_string($con, $_POST['accessCodeStartDate']);
    $access_code_end_date = mysqli_real_escape_string($con, $_POST['accessCodeEndDate']);

    if ($course_title == NULL || $course_description == NULL || $access_code_start_date == NULL || $access_code_end_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete inputs for the course to be created.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    // Create New Course
    $sql = "INSERT INTO `courses` (
                `course_user_id`, 
                `course_title`, 
                `course_description`)
            VALUES (
                '$course_user_id', 
                '$course_title', 
                '$course_description')";
    $create_course_query = mysqli_query($con, $sql);

    if ($create_course_query) {
        // Get last inserted course_id
        $course_id = mysqli_insert_id($con);

        // Generate key for access code
        $access_code = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 5);

        // Set access code to Active
        $access_code_status = "Active";

        // Insert access code and validity date
        $sql = "INSERT INTO `access_codes` (
            `access_course_id`, 
            `access_code`, 
            `access_code_start_date`, 
            `access_code_end_date`,
            `access_code_status`)
        VALUES (
            '$course_id', 
            '$access_code', 
            '$access_code_start_date', 
            '$access_code_end_date',
            '$access_code_status')";
        $result = mysqli_query($con, $sql);

        if($result){     
            $res = [
                'status' => 100, // Error Number
                'message' => 'New course and access code successfully created.',
                'courseID' => $course_id
            ];
            // Display the error message
            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 103, // Error Number
            'message' => 'Access code could not be created at the moment. Please try again later or contact us for further concerns.'

            ];
            // Display the error message
            echo json_encode($res);
            return false;
        }

    } else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Course and access code could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}
