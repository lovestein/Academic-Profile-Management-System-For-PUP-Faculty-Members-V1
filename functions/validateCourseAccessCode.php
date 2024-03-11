<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['validateCourseAccessCodeButton'])){
    $course_id = mysqli_real_escape_string($con, $_POST['validateCourseAccessCodeID']);
    $access_code = mysqli_real_escape_string($con, $_POST['validateCourseAccessCode']);
    
    if(empty($access_code)){
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please provide an access code to validate.',
        ];
        echo json_encode($res);
        return false;
    }

    // Use BINARY to make the comparison case-sensitive
    $sql = "SELECT * FROM `access_codes` WHERE `access_course_id` = '$course_id' AND BINARY `access_code` = '$access_code' LIMIT 1";
    $result = mysqli_query($con, $sql);
    $check_result = mysqli_num_rows($result) == 1;

    if($check_result){
        $_SESSION['validated'] = true;
        $res = [
            'status' => 100, // Error Number
            'message' => 'Access code is validated. Please wait.',
            'redirect' => './teacherCourseDetails.php?courseID='.$course_id.''
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Access code incorrect. Note: Access code is case-sensitive.',
        ];
        echo json_encode($res);
        return false;
    }
}
