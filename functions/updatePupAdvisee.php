<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updatePupAdviseeButton'])) {
    $advisee_id = mysqli_real_escape_string($con, $_POST['editAdviseeID']);
    $advisee_course_name = mysqli_real_escape_string($con, $_POST['editCourseName']);
    $advisee_course_year = mysqli_real_escape_string($con, $_POST['editCourseYear']);
    $advisee_course_section = mysqli_real_escape_string($con, $_POST['editCourseSection']);

    if ($advisee_course_name == NULL || $advisee_course_year == NULL || $advisee_course_section == NULL) {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the advisee details to be updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `pup_advisees` 
            SET `advisee_course_name` = '$advisee_course_name', `advisee_course_year` = '$advisee_course_year', `advisee_course_section` = '$advisee_course_section'
            WHERE `advisee_id` = '$advisee_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'PUP Advisee successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'PUP Advisee could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

