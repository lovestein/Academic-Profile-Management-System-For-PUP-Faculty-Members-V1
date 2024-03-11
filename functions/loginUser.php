<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['signInButton'])) {
    $user_email = $_POST['userEmail'];
    $user_password = $_POST['userPassword'];
    // Check if all fields are filled
    if ($user_email == NULL || $user_password == NULL) {
        // Respone Status and Message Response
        $res = [
            'status' => 100, // Error Number
            'message' => 'Please complete the login form to sign in.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
    $sql = "SELECT * FROM `user_profiles` WHERE `user_email` = '$user_email'";
    $result = mysqli_query($con, $sql);

    // Check if email exists in the database
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $hashed_password = $data['user_password'];
        $user_verification_date = $data['user_verification_date'];

        // Verify Password
        if (password_verify($user_password, $hashed_password)) {
            // Check if email is verified yet, if not provide verification code first
            if ($user_verification_date == NULL) {
                $res = [
                    'status' => 101, // Error Number
                    'message' => 'Please Verify your account first to continue.',
                    'email' => $user_email
                ];
                // Display the error message
                echo json_encode($res);
                return false;
            } else {
                // Acquire user data details and store in auth_user array
                // This will be used as the index reference to be displayed once a user is authorized and logged in
                $user_id = $data['user_id'];
                $user_name = $data['user_name'];
                $user_email = $data['user_email'];
                $user_password = $data['user_password'];
                $user_account_username = $data['user_account_username'];
                $user_honorifics = $data['user_honorifics'];
                $user_college = $data['user_college'];
                $user_department = $data['user_department'];
                $user_university_position = $data['user_university_position'];
                $user_faculty_rank = $data['user_faculty_rank'];
                $user_contactno = $data['user_contactno'];
                $user_image = $data['user_image'];
                $user_type = $data['user_type'];
                $user_biography = $data['user_biography'];

                $_SESSION['auth'] = true;
                $_SESSION['auth_user_type'] = $user_type; // User | Admin
                $_SESSION['auth_user'] = [
                    'user_id' => $user_id,
                    'user_name' => $user_name,
                    'user_email' => $user_email,
                    'user_password' => $user_password,
                    'user_account_username' => $user_account_username,
                    'user_honorifics' => $user_honorifics,
                    'user_college' => $user_college,
                    'user_department' => $user_department,
                    'user_university_position' => $user_university_position,
                    'user_faculty_rank' => $user_faculty_rank,
                    'user_contactno' => $user_contactno,
                    'user_image' => $user_image,
                    'user_type' => $user_type,
                    'user_biography' => $user_biography
                ];

                // Handling landing page based on user types (User | Admin)
                if ($user_type == 'Admin') {
                    $res = [
                        'status' => 102, // Error Number
                        'message' => 'Successfully logged in. Welcome Admin. Please Wait...',
                        'redirect' => './admin.php'
                    ];
                    // Display the error message
                    echo json_encode($res);
                    return false;
                } else if ($user_type == 'User') {
                    $res = [
                        'status' => 103, // Error Number
                        'message' => 'Successfuly logged in! Welcome '. $user_name .'. Please Wait...',
                        'redirect' => './profile.php'
                    ];
                    // Display the error message
                    echo json_encode($res);
                    return false;
                }
            }
        } else {
            $res = [
                'status' => 104, // Error Number
                'message' => 'Invalid Password. Please try again.'
            ];
            // Display the error message
            echo json_encode($res);
            return false;
        }
    }
    // Invalid Email
    else {
        $res = [
            'status' => 105, // Error Number
            'message' => 'Invalid email. Please try again.'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}