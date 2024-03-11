<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['createAdministrativeAppointmentButton'])){
    $administrative_appointment_user_id = mysqli_real_escape_string($con, $_POST['administrativeAppointmentUserID']);
    $administrative_position = mysqli_real_escape_string($con, $_POST['createAdministrativePosition']);
    $administrative_organization = mysqli_real_escape_string($con, $_POST['createAdministrativeOrganization']);
    $administrative_start_date = mysqli_real_escape_string($con, $_POST['createAdministrativeStartDate']);
    $administrative_end_date = mysqli_real_escape_string($con, $_POST['createAdministrativeEndDate']);
    

    if ($administrative_position == NULL || $administrative_organization == NULL || $administrative_start_date == NULL || $administrative_end_date == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete the honors & awards to create.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO `administrative_appointments` (`administrative_appointment_user_id`, `administrative_position`, `administrative_organization`, `administrative_start_date`, `administrative_end_date`)
            VALUES ('$administrative_appointment_user_id', '$administrative_position', '$administrative_organization', '$administrative_start_date', '$administrative_end_date')";
    $result = mysqli_query($con, $sql);

    if($result) {
        $res = [
            'status' => 100, // Error Number
            'message' => 'New administrative appointment successfully created.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;   
    }
    else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Administrative appointment could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}