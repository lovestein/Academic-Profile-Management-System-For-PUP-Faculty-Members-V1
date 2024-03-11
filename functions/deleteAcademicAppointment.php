<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['deleteAcademicAppointmentButton'])){
    $academic_appointment_id = mysqli_real_escape_string($con, $_POST['deleteAcademicAppointmentID']);

    $sql = "DELETE FROM `academic_appointments` WHERE `academic_appointment_id` = '$academic_appointment_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Success Number
            'message' => 'Academic appointment deleted successfully.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Success Number
            'message' => 'Academic appointment could not be deleted at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
}