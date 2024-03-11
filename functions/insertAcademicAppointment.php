<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['insertAcademicAppointmentButton'])){
    $academic_appointment_user_id = mysqli_real_escape_string($con, $_POST['insertAcademicAppointmentUserID']);
    $academic_position = mysqli_real_escape_string($con, $_POST['insertAcademicPosition']);
    $academic_field = mysqli_real_escape_string($con, $_POST['insertAcademicField']);

    if ($academic_position == NULL || $academic_field == NULL){
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the academic appointment to be inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `academic_appointments` (`academic_appointment_user_id`, `academic_position`, `academic_field`) 
            VALUES ('$academic_appointment_user_id', '$academic_position', '$academic_field')";
    $result = mysqli_query($con, $sql);

    if($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'New academic appointment inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Academic appointment could not be inserted at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}