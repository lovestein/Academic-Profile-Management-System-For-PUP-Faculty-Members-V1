<?php
session_start();
include '../includes/connection.php';


if(isset($_GET['academicAppointmentID'])){
    $academic_appointment_id = mysqli_real_escape_string($con, $_GET['academicAppointmentID']);

    $sql = "SELECT * FROM `academic_appointments` WHERE `academic_appointment_id` = '$academic_appointment_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Fetching data of academic appointment into array
        $data = mysqli_fetch_array($result);

        // Respone Status and Message Response
        $res = [
            'status' => 100, 
            'message' => 'Academic appointment fetched successfully by id.',
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
            'message' => 'Academic appointment not found.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}