<?php
session_start();
include '../includes/connection.php';


if(isset($_GET['courseID'])){
    $course_id = mysqli_real_escape_string($con, $_GET['courseID']);

    $sql = "SELECT * FROM `courses` WHERE `course_id` = '$course_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Fetching data of honors awards into array
        $data = mysqli_fetch_array($result);

        $access_codes_count_query = "SELECT COUNT(`access_code_id`) AS 'numberOfAccessCodes' FROM `access_codes` WHERE `access_course_id` = '$course_id'";
        $access_codes_count_query_run = mysqli_query($con, $access_codes_count_query);

        $number_of_access_codes = mysqli_fetch_array($access_codes_count_query_run);

        $lecture_materials_count_query = "SELECT COUNT(`lecture_material_id`) AS 'numberOfLectureMaterials' FROM `lecture_materials` WHERE `lecture_course_id` = '$course_id'";
        $lecture_materials_count_query_run = mysqli_query($con, $lecture_materials_count_query);

        $number_of_lecture_materials = mysqli_fetch_array($lecture_materials_count_query_run);

        $res = [
            'status' => 100, 
            'message' => 'Course fetched successfully by id.',
            'data' => $data,
            'accessCodes' => $number_of_access_codes,
            'lectureMaterials' => $number_of_lecture_materials
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
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