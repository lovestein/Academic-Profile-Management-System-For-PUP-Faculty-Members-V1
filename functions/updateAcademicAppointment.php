<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateAcademicAppointmentButton'])) {
    $academic_appointment_id = mysqli_real_escape_string($con, $_POST['editAcademicAppointmentID']);
    $academic_position = mysqli_real_escape_string($con, $_POST['editAcademicPosition']);
    $academic_field = mysqli_real_escape_string($con, $_POST['editAcademicField']);

    if ($academic_position == NULL || $academic_field == NULL) {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the academic appointment details to be updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `academic_appointments` 
            SET `academic_position` = '$academic_position', `academic_field` = '$academic_field'
            WHERE `academic_appointment_id` = '$academic_appointment_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Academic appointment successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Academic appointment could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

