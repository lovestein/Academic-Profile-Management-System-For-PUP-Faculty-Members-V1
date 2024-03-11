<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateLectureMaterialButton'])) {
    $lecture_material_id = mysqli_real_escape_string($con, $_POST['editLectureMaterialID']);
    $lecture_title = mysqli_real_escape_string($con, $_POST['editLectureTitle']);
    $lecture_description = mysqli_real_escape_string($con, $_POST['editLectureDescription']);
    $lecture_url = mysqli_real_escape_string($con, $_POST['editLectureLink']);

    if ($lecture_title == NULL || $lecture_description == NULL || $lecture_url == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete inputs for lecture material to be edited.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `lecture_materials` 
            SET 
                `lecture_title` = '$lecture_title', 
                `lecture_description` = '$lecture_description', 
                `lecture_url` = '$lecture_url'
            WHERE `lecture_material_id` = '$lecture_material_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Lecture material details successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Lecture material details could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

