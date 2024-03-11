<?php
session_start();

if (isset($_POST)) {
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user_type']);
    unset($_SESSION['auth_user']);

    $res = [
        'status' => 400, 
        'redirect' => './index.php'
    ];
    echo json_encode($res);
    return false;
}