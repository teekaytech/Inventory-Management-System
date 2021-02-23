<?php
require_once 'DashboardController.php';
@session_start();

$access = new DashboardController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ((!empty($_POST['username'])) && (!empty($_POST['password']))) {
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        if ($access->check_login($data)) {
            $admin = $access->check_login($data);
            if ($admin['delete_status'] == 1) {
                $_SESSION['info'] = 'This account has been deleted. Contact the admin to re-enroll.';
                header('location: ../index.php'); return;
            }
            if ($admin['status'] == 0) {
                $_SESSION['info'] = 'Your account has been deactivated. Contact the manager for complaint.';
                header('location: ../index.php'); return;
            }
            if (password_verify($data['password'], $admin['password'])) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['success'] = "You have successfully logged in to your dashboard";
                header('location: ../views/dashboard.php'); return;
            } else {
                $_SESSION['info'] = 'Invalid password, try again.';
                header('location: ../index.php'); return;
            }
        } else {
            $_SESSION['info'] = 'Invalid username, try again.';
            header('location: ../index.php'); return;
        }
    } else {
        $_SESSION['info'] = 'Username or password cannot be empty!';
        header('location: ../index.php'); return;
    }
}
?>