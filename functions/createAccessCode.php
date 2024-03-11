<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['createAccessCodeButton'])) {
    // Course Details
    $access_course_id = mysqli_real_escape_string($con, $_POST['createAccessCourseID']);
    // Access Code Validity Date
    $access_code_start_date = mysqli_real_escape_string($con, $_POST['createAccessCodeStartDate']);
    $access_code_end_date = mysqli_real_escape_string($con, $_POST['createAccessCodeEndDate']);

    if ($access_code_start_date == NULL || $access_code_end_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete inputs for the access code to be created.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    // Generate key for access code
    function generateAccessCode()
    {
        $access_code = '';

        for ($i = 0; $i < 3; $i++) {
            // Generate 5 random uppercase letters and numbers
            $random_chars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);

            // Append the random characters to the access code
            $access_code .= $random_chars;

            // Add a dash after each group except the last one
            if ($i < 2) {
                $access_code .= '-';
            }
        }

        return $access_code;
    }
    
    // Access Code
    $access_code = generateAccessCode();

    // Set access code to Active
    $access_code_status = "Active";

    // Create New Course
    $sql = "INSERT INTO `access_codes` (
                `access_course_id`, 
                `access_code`,
                `access_code_start_date`, 
                `access_code_end_date`,
                `access_code_status`)
            VALUES (
                '$access_course_id', 
                '$access_code', 
                '$access_code_start_date', 
                '$access_code_end_date', 
                '$access_code_status')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $res = [
            'status' => 100, // Error Number
            'message' => 'New access code successfully created.',
            'accessCode' => $access_code,
            'accessCodeStartDate' => $access_code_start_date,
            'accessCodeEndDate' => $access_code_end_date
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Access code could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}
