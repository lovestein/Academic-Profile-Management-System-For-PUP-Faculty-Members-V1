<?php
session_start();
include '../includes/connection.php';


if(isset($_GET['lectureMaterialID'])){
    $lecture_material_id = mysqli_real_escape_string($con, $_GET['lectureMaterialID']);

    $sql = "SELECT * FROM `lecture_materials` WHERE `lecture_material_id` = '$lecture_material_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Fetching data of honors awards into array
        $data = mysqli_fetch_array($result);

        // Respone Status and Message Response
        $res = [
            'status' => 100, 
            'message' => 'Lecture material fetched successfully by id.',
            'data' => $data 
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 101, 
            'message' => 'Lecture material not found.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}