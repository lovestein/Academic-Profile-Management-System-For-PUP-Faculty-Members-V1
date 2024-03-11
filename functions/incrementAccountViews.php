<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['userAccountUserName'])){
    // Sanitize user input
    $user_account_username = mysqli_real_escape_string($con, $_POST['userAccountUserName']);

    // Update account views
    $sql = "UPDATE `user_profiles` SET `user_account_views` = `user_account_views` + 1 WHERE `user_account_username` = ?";
    
    // Use prepared statement
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user_account_username);
    $result = mysqli_stmt_execute($stmt);

    if($result){
        $res = [
            'status' => 100,
            'message' => 'Account views updated.',
            'redirect' => './teacher.php?username='.$user_account_username.''
        ];
        // Display success message
        echo json_encode($res);
    } else {
        $res = [
            'status' => 101,
            'message' => 'Something went wrong.'
        ];
        // Display error message
        echo json_encode($res);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    // Close the connection
    mysqli_close($con);
}
?>
