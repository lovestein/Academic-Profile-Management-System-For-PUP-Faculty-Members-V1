<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['deleteAdministrativeAppointmentButton'])){
    $administrative_appointment_id = mysqli_real_escape_string($con, $_POST['deleteAdministrativeAppointmentID']);

    $sql = "DELETE FROM `administrative_appointments` WHERE `administrative_appointment_id` = '$administrative_appointment_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Success Number
            'message' => 'Administrative appointment deleted successfully.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Success Number
            'message' => 'Administrative appointment could not be deleted at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
}