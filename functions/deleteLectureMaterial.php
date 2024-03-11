<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['deleteLectureMaterialButton'])){
    $lecture_material_id = mysqli_real_escape_string($con, $_POST['deleteLectureMaterialID']);

    $sql = "DELETE FROM `lecture_materials` WHERE `lecture_material_id` = '$lecture_material_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Success Number
            'message' => 'Lecture material deleted successfully.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Success Number
            'message' => 'Lecture material could not be deleted at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
}