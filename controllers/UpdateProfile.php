<?php
@session_start();
require_once ('DashboardController.php');


if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['update']))) {
    $activities = new DashboardController();
    $data = [];
    if (isset($_POST['current_password']) && !empty($_POST['current_password'])) {
        $data['password'] = $activities->validate_pswd($_POST['password'], $_POST['confirm'], $_POST['current_password']);
    }
    $data['firstname'] = $activities->validate_data($_POST['firstname'], 'Firstname');
    $data['middlename'] = $activities->validate_data($_POST['middlename'], 'Middlename');
    $data['lastname'] = $activities->validate_data($_POST['lastname'], 'Lastname');
    $data['phone_no'] = $activities->validate_data($_POST['phone_no'], 'Phone Number');
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty($_POST['email'])) {
        $_SESSION['error'] = 'Invalid email. Please try again';
        $data['email'] = false;
    } else {
        $data['email'] = $activities->test_input($_POST['email']);
    }

    if (!in_array(false, $data)) {
        if ($activities->admin_update($data)) { $_SESSION['success'] = 'Profile Updated Successfully.'; }
        else { $_SESSION['warning'] = 'Unable to update profile.'; }
    }
    header('location: ../views/profile.php');

}