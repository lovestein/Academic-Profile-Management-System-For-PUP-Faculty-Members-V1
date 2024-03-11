<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['deleteTimelinePostButton'])){
    $timeline_post_id = mysqli_real_escape_string($con, $_POST['deleteTimelinePostID']);

    $sql = "DELETE FROM `timeline_posts` WHERE `timeline_post_id` = '$timeline_post_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Success Number
            'message' => 'Post deleted successfully.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
    else {
        // Respone Status and Message Response
        $res = [
            'status' => 101, // Success Number
            'message' => 'Post could not be deleted at this moment. Please try again later or contact us for further concerns.'
        ];
        // Display message
        echo json_encode($res);
        return false;
    }
}