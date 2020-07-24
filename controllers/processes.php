<?php
@session_start();
require_once ('DashboardController.php');

$activities = new DashboardController();
if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['update']))) {
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

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['submit_enquiry']))) {
    $data = [];
    $data['date'] = $activities->validate_data($_POST['date'], 'Date');
    $data['name'] = $activities->validate_data($_POST['name'], 'Name');
    $data['address'] = $activities->validate_data($_POST['address'], 'Address');
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty($_POST['email'])) {
        $_SESSION['error'] = 'Invalid email. Please try again';
        $data['email'] = false;
    } else {
        $data['email'] = $activities->test_input($_POST['email']);
    }
    $data['phone_no'] = $activities->validate_data($_POST['phone_no'], 'Phone Number');
    $data['course_id'] = $activities->validate_data($_POST['course'], 'Course');
    $data['channel_id'] = $activities->validate_data($_POST['channel'], 'How you hear about us');

    if (!in_array(false, $data)) {
        if($activities->find_existing_inquiry($data['email'])) {
            $_SESSION['warning'] = 'NOT CREATED :: Another Inquiry with '.$data['email'].' already exists!';
        } else {
            if ($activities->create_new_inquiry($data))
            { $_SESSION['success'] = 'Inquiry submitted successfully. Thank you.'; }
            else { $_SESSION['warning'] = 'Unable to create inquiry. Please, try again.'; }
        }
    }
    header('location: ../views/enquiry.php');
}