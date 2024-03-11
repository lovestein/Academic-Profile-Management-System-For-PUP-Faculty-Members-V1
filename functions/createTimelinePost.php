<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['createTimelinePostButton'])) {
    $timeline_post_user_id = mysqli_real_escape_string($con, $_POST['createTimelinePostUserID']);
    $timeline_post_type = mysqli_real_escape_string($con, $_POST['createTimelinePostTypePost']);
    $timeline_post_description = mysqli_real_escape_string($con, $_POST['createTimelinePostDescription']);

    // If no media has been uploaded 
    if ($_FILES['createTimelinePostMedia']['name'] == NULL) {
        // Insert NULL
        $timeline_post_media = NULL;
    } else {
        // Image Conversion
        $image = $_FILES['createTimelinePostMedia']['name'];
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        // Insert Image
        $timeline_post_media = time() . '.' . $image_extension;
    }

    if ($timeline_post_description == NULL) {
        // Response Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please input a description to your post.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    // Use prepared statement
    $sql = "INSERT INTO `timeline_posts` (
                `timeline_post_user_id`, 
                `timeline_post_type`, 
                `timeline_post_description`, 
                `timeline_post_media`
            ) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "isss", $timeline_post_user_id, $timeline_post_type, $timeline_post_description, $timeline_post_media);

    // Execute statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Move upload file to folder
        if ($timeline_post_media !== NULL) {
            move_uploaded_file($_FILES['createTimelinePostMedia']['tmp_name'], '../images/posts/' . $timeline_post_media);
        }

        // Response Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'New post successfully uploaded to your timeline.'
        ];
        // Display the error message
        echo json_encode($res);
    } else {
        // Response Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Your post could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}


