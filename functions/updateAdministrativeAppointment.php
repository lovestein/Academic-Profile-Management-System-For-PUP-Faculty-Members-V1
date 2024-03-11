<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateAdministrativeAppointmentButton'])) {
    $administrative_appointment_id = mysqli_real_escape_string($con, $_POST['editAdministrativeAppointmentID']);
    $administrative_position = mysqli_real_escape_string($con, $_POST['editAdministrativePosition']);
    $administrative_organization = mysqli_real_escape_string($con, $_POST['editAdministrativeOrganization']);
    $administrative_start_date = mysqli_real_escape_string($con, $_POST['editAdministrativeStartDate']);
    $administrative_end_date = mysqli_real_escape_string($con, $_POST['editAdministrativeEndDate']);

    if ($administrative_position == NULL || $administrative_organization == NULL || $administrative_start_date == NULL || $administrative_end_date == NULL) {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the academic appointment details to be updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `administrative_appointments` 
            SET `administrative_position` = '$administrative_position', 
                `administrative_organization` = '$administrative_organization', 
                `administrative_start_date` = '$administrative_start_date',
                `administrative_end_date` = '$administrative_end_date'
            WHERE `administrative_appointment_id` = '$administrative_appointment_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Administrative appointment successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Administrative appointment could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}

