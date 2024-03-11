<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['insertAdministrativeAppointmentButton'])){
    $administrative_appointment_user_id = mysqli_real_escape_string($con, $_POST['insertAdministrativeAppointmentUserID']);
    $administrative_position = mysqli_real_escape_string($con, $_POST['insertAdministrativePosition']);
    $administrative_organization = mysqli_real_escape_string($con, $_POST['insertAdministrativeOrganization']);
    $administrative_start_date = mysqli_real_escape_string($con, $_POST['insertAdministrativeStartDate']);
    $administrative_end_date = mysqli_real_escape_string($con, $_POST['insertAdministrativeEndDate']);

    if ($administrative_position == NULL || $administrative_organization == NULL || $administrative_start_date == NULL || $administrative_end_date == NULL){
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the administrative appointment to be inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `administrative_appointments` (`administrative_appointment_user_id`, `administrative_position`, `administrative_organization`, `administrative_start_date`, `administrative_end_date`) 
            VALUES ('$administrative_appointment_user_id', '$administrative_position', '$administrative_organization', '$administrative_start_date', '$administrative_end_date')";
    $result = mysqli_query($con, $sql);

    if($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'New administrative apppointment has been inserted.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Administrative appointment could not be inserted at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}