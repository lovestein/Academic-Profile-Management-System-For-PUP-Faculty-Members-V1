<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['updateTimelinePostButton'])) {
    $timeline_post_id = mysqli_real_escape_string($con, $_POST['editTimelinePostID']);
    $timeline_post_description = mysqli_real_escape_string($con, $_POST['editTimelinePostDescription']);
    $editImageValue = mysqli_real_escape_string($con, $_POST['editTimelinePostImageValue']);

    // Check if a new image is uploaded
    if ($_FILES['editTimelinePostMedia']['name'] != '') {
        // Image Conversion
        $image = $_FILES['editTimelinePostMedia']['name'];
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

    if ($timeline_post_description == NULL) {
        $res = [
            'status' => 101, // Error Number
            'message' => 'Please input a description for your post.',
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE `timeline_posts` SET 
            `timeline_post_description` = ?, 
            `timeline_post_media` = ?
            WHERE `timeline_post_id` = ?";

    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_bind_param($stmt, "ssi", $timeline_post_description, $timeline_post_media, $timeline_post_id);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Move uploaded file to folder if a new image is uploaded
        if ($_FILES['editTimelinePostMedia']['name'] != '') {
            move_uploaded_file($_FILES['editTimelinePostMedia']['tmp_name'], '../images/posts/' . $timeline_post_media);
        }

        $res = [
            'status' => 100, // Success status
            'message' => 'Post successfully updated.',
        ];
        echo json_encode($res);
    } else {
        $res = [
            'status' => 102, // Error Number
            'message' => 'Post could not be updated. Please try again later or contact support.',
        ];
        echo json_encode($res);
    }

    mysqli_stmt_close($stmt);
}
?>
