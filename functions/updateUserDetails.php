<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['updateUserDetailsButton'])){
    // Get form data
    $user_id = mysqli_real_escape_string($con, $_POST['editUserID']);
    $user_name = mysqli_real_escape_string($con, $_POST['editUserName']);
    $user_honorifics = mysqli_real_escape_string($con, $_POST['editUserHonorifics']);
    $user_college = mysqli_real_escape_string($con, $_POST['editUserCollege']);
    $user_department = mysqli_real_escape_string($con, $_POST['editUserDepartment']);
    $user_university_position = mysqli_real_escape_string($con, $_POST['editUserUniversityPosition']);
    $user_faculty_rank = mysqli_real_escape_string($con, $_POST['editUserFacultyRank']);
    $user_email = mysqli_real_escape_string($con, $_POST['editUserEmail']);
    $user_contactno = mysqli_real_escape_string($con, $_POST['editUserContactno']);
    $editImageValue = mysqli_real_escape_string($con, $_POST['editUserImageValue']);

   
    // Check if a new image is uploaded
    if ($_FILES['editUserImage']['name'] != '') {
        // Image Conversion
        $image = $_FILES['editUserImage']['name'];
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        // Generate a new unique filename
        $user_image = time() . '.' . $image_extension;
    } else {
        // Check if editImageValue has a value
        if (!empty($editImageValue)) {
            // Keep the existing image value
            $user_image = $editImageValue;
        } else {
            // Set user_image to null
            $user_image = null;
        }
    }

    if (
        empty($user_name) ||
        empty($user_college) ||
        empty($user_department) ||
        empty($user_university_position) ||
        empty($user_email) ||
        empty($user_contactno)
    ) {
        $res = [
            'status' => 101,
            'message' => 'Please complete the form to be updated.'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `user_profiles` 
            SET
                `user_name` = '$user_name',
                `user_honorifics` = '$user_honorifics',
                `user_college` = '$user_college',
                `user_department` = '$user_department',
                `user_university_position` = '$user_university_position',
                `user_faculty_rank` = '$user_faculty_rank',
                `user_email` = '$user_email',
                `user_contactno` = '$user_contactno',
                `user_image` = '$user_image'
            WHERE
                `user_id` = '$user_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Move uploaded file to folder if a new image is uploaded
        if ($_FILES['editUserImage']['name'] != '') {
            move_uploaded_file($_FILES['editUserImage']['tmp_name'], '../images/profilePictures/' . $user_image);
        }
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'User details successfully updated.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'User details could not be updated at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }


}