<?php
require_once '../models/admin.php';
@session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ((!empty($_POST['username'])) && (!empty($_POST['password']))) {
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        if (Admin::admin_login($data)) {
            $admin = Admin::admin_login($data);
            if (password_verify($data['password'], $admin['password'])) {
                $_SESSION['admin_id'] = $admin['id'];
                $info['message'] = "You have been successfully logged in to your dashboard";
                header('location: ../views/dashboard.php');
                echo 'login successful';
            } else {
                $_SESSION['info'] = 'Invalid password, try again.';
                header('location: ../index.php');
            }
        } else {
            $_SESSION['info'] = 'Invalid username, try again.';
            header('location: ../index.php');
        }
    } else {
        $_SESSION['info'] = 'Username or password cannot be empty!';
        header('location: ../index.php');
    }
    die();
}
?>