<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['createTimelinePostAnnouncementButton'])) {
    $timeline_post_user_id = mysqli_real_escape_string($con, $_POST['createTimelinePostAnnouncementUserID']);
    $timeline_post_type = mysqli_real_escape_string($con, $_POST['createTimelinePostTypeAnnouncement']);
    $timeline_post_title = mysqli_real_escape_string($con, $_POST['createTimelinePostAnnouncementTitle']);
    $timeline_post_description = mysqli_real_escape_string($con, $_POST['createTimelinePostAnnouncementDescription']);
    $timeline_post_url = mysqli_real_escape_string($con, $_POST['createTimelinePostAnnouncementLink']);

    // If no media has been uploaded 
    if ($_FILES['createTimelinePostAnnouncementMedia']['name'] == NULL) {
        // Insert NULL
        $timeline_post_media = NULL;
    } else {
        // Image Conversion
        $image = $_FILES['createTimelinePostAnnouncementMedia']['name'];
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        // Insert Image
        $timeline_post_media = time() . '.' . $image_extension;
    }

    if ($timeline_post_title == NULL || $timeline_post_description == NULL || $timeline_post_url == NULL) {
        // Response Status and Message Response
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please complete inputs for the announcement to be created.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    // Use a prepared statement
    $sql = "INSERT INTO `timeline_posts` (
                `timeline_post_user_id`, 
                `timeline_post_type`, 
                `timeline_post_title`, 
                `timeline_post_description`, 
                `timeline_post_url`, 
                `timeline_post_media`
            ) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "isssss", $timeline_post_user_id, $timeline_post_type, $timeline_post_title, $timeline_post_description, $timeline_post_url, $timeline_post_media);

    // Execute statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Move uploaded file to folder
        if ($timeline_post_media !== NULL) {
            move_uploaded_file($_FILES['createTimelinePostAnnouncementMedia']['tmp_name'], '../images/posts/' . $timeline_post_media);
        }

        // Response Status and Message Response
        $res = [
            'status' => 100, // Success Number
            'message' => 'New announcement successfully uploaded to your timeline.'
        ];
        // Display the success message
        echo json_encode($res);
    } else {
        // Response Status and Message Response
        $res = [
            'status' => 102, // Error Number
            'message' => 'Your announcement could not be created at the moment. Please try again later or contact us for further concerns.'
        ];
        // Display the error message
        echo json_encode($res);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}



