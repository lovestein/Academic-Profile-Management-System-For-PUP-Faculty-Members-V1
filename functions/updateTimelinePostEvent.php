<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateTimelinePostEventButton'])) {
    $timeline_post_id = mysqli_real_escape_string($con, $_POST['editTimelinePostEventID']);
    $timeline_post_title = mysqli_real_escape_string($con, $_POST['editTimelinePostEventTitle']);
    $timeline_post_description = mysqli_real_escape_string($con, $_POST['editTimelinePostEventDescription']);
    $timeline_post_start_date = mysqli_real_escape_string($con, $_POST['editTimelinePostEventStartDate']);
    $timeline_post_end_date = mysqli_real_escape_string($con, $_POST['editTimelinePostEventEndDate']);
    $timeline_post_url = mysqli_real_escape_string($con, $_POST['editTimelinePostEventLink']);
    $editImageValue = mysqli_real_escape_string($con, $_POST['editTimelinePostEventImageValue']);

    // Check if a new image is uploaded
    if ($_FILES['editTimelinePostEventMedia']['name'] != '') {
        // Image Conversion
        $image = $_FILES['editTimelinePostEventMedia']['name'];
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        // Generate a new unique filename
        $timeline_post_media = time() . '.' . $image_extension;
    } else {
        // Check if editImageValue has a value
        if (!empty($editImageValue)) {
            // Keep the existing image value
            $timeline_post_media = $editImageValue;
        } else {
            // Set timeline_post_media to null
            $timeline_post_media = null;
        }
    }

    if ($timeline_post_title == NULL || $timeline_post_description == NULL || $timeline_post_start_date == NULL || $timeline_post_url == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please fill in all required fields.',
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `timeline_posts` SET 
            `timeline_post_title` = ?, 
            `timeline_post_description` = ?, 
            `timeline_post_start_date` = ?, 
            `timeline_post_end_date` = ?, 
            `timeline_post_url` = ?, 
            `timeline_post_media` = ?
            WHERE `timeline_post_id` = ?";

    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_bind_param($stmt, "ssssssi", $timeline_post_title, $timeline_post_description, $timeline_post_start_date, $timeline_post_end_date, $timeline_post_url, $timeline_post_media, $timeline_post_id);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Move uploaded file to folder if a new image is uploaded
        if ($_FILES['editTimelinePostEventMedia']['name'] != '') {
            move_uploaded_file($_FILES['editTimelinePostEventMedia']['tmp_name'], '../images/posts/' . $timeline_post_media);
        }

        $res = [
            'status' => 100, // Success status
            'message' => 'Post event successfully updated.',
        ];
        echo json_encode($res);
    } else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Post event could not be updated. Please try again later or contact support.',
        ];
        echo json_encode($res);
    }

    mysqli_stmt_close($stmt);
}
