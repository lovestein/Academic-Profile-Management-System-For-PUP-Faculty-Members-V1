<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['createBiographyButton'])){
    $user_id = mysqli_real_escape_string($con, $_POST['createBiographyID']);
    $user_biography = mysqli_real_escape_string($con, $_POST['userCreateBiography']);

    if ($user_biography == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please provide a biography detail.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `user_profiles` SET `user_biography` = '$user_biography' WHERE `user_id` = '$user_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $res = [
            'status' => 100, // Error Number
            'message' => 'Biography has been updated successfully.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else{
        $res = [
            'status' => 102, // Error Number
            'message' => 'This has been an error updating your biography. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}