<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['createPupAdviseeButton'])){
    $advisee_user_id = mysqli_real_escape_string($con, $_POST['PupAdviseeUserID']);
    $advisee_course_name = mysqli_real_escape_string($con, $_POST['createCourseName']);
    $advisee_course_year = mysqli_real_escape_string($con, $_POST['createCourseYear']);
    $advisee_course_section = mysqli_real_escape_string($con, $_POST['createCourseSection']);

    if ($advisee_course_name == NULL || $advisee_course_year == NULL || $advisee_course_year == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the advisee details to create.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `pup_advisees` (`advisee_user_id`, `advisee_course_name`, `advisee_course_year`, `advisee_course_section`)
            VALUES ('$advisee_user_id', '$advisee_course_name', '$advisee_course_year', '$advisee_course_section')";
    $result = mysqli_query($con, $sql);

    if($result) {
        $res = [
            'status' => 100, // Error Number
            'message' => 'New PUP advisee successfully created.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;   
    }
    else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'PUP advisee could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}