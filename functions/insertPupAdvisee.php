<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['insertPupAdviseeButton'])){
    $advisee_user_id = mysqli_real_escape_string($con, $_POST['insertPupAdviseeUserID']);
    $advisee_course_name = mysqli_real_escape_string($con, $_POST['insertCourseName']);
    $advisee_course_year = mysqli_real_escape_string($con, $_POST['insertCourseYear']);
    $advisee_course_section = mysqli_real_escape_string($con, $_POST['insertCourseSection']);

    if ($advisee_course_name == NULL || $advisee_course_year == NULL || $advisee_course_section == NULL){
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the advisee to be inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `pup_advisees` (`advisee_user_id`, `advisee_course_name`, `advisee_course_year`, `advisee_course_section`) 
            VALUES ('$advisee_user_id', '$advisee_course_name', '$advisee_course_year', '$advisee_course_section')";
    $result = mysqli_query($con, $sql);

    if($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'New PUP advisee inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'PUP advisee could not be inserted at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}