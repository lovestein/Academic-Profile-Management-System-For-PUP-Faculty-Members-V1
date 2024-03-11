<?php
session_start();
include '../includes/connection.php';


if(isset($_GET['administrativeAppointmentID'])){
    $administrative_appointment_id = mysqli_real_escape_string($con, $_GET['administrativeAppointmentID']);

    $sql = "SELECT * FROM `administrative_appointments` WHERE `administrative_appointment_id` = '$administrative_appointment_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Fetching data of honors awards into array
        $data = mysqli_fetch_array($result);

        // Respone Status and Message Response
        $res = [
            'status' => 100, 
            'message' => 'Administrative appointment fetched successfully by id.',
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
            'message' => 'Administrative appointment not found.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}