<?php
@session_start();
require_once '../models/admin.php';
require_once '../models/course.php';
require_once '../models/inquiry.php';
require_once '../models/student.php';

class DashboardController {

    public $admin;

    public function __construct(){
        if (!isset($_SESSION['admin_id'])) {
            header('location: ../index.php');
        }
        $this->admin = Admin::fetch_admin($_SESSION['admin_id']);
    }

    public function check_login($data) {
        return Admin::admin_login($data);
    }

    public function getAdmin() {
        return $this->admin;
    }


    public function validate_data($request, $field) {
        if (!empty($request)) {
            $request = $this->test_input($request);
            return $request;
        } else {
            $_SESSION['error'] = $field.' field cannot be blank.';
            return false;
        }
    }

    public function validate_pswd($new, $confirm, $current) {
        if (password_verify($current, $this->getAdmin()['password'])) {
            if (($new == $confirm) && !empty($new) && !empty($confirm)) {
                if (strlen($new) >= 6) {
                    return password_hash($new, PASSWORD_DEFAULT);
                } else {
                    $_SESSION['error'] = 'New password should be minimum of 6 characters.';
                    return false;
                }
            }  else {
                $_SESSION['error'] = 'New password and confirm password not the same.';
                return false;
            }
        } else {
            $_SESSION['error'] = 'Current Password is invalid.';
            return false;
        }
    }

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function admin_update($data) {
        return Admin::update_profile($data, $_SESSION['admin_id']);
    }

    public function fetch_courses() {
        return Course::all_courses();
    }

    public function create_new_inquiry($data) {
        return Inquiry::create_enquiry($data, $_SESSION['admin_id']);
    }

    public function find_existing_inquiry($email) {
        if (Inquiry::find_inquiry($email) > 0){
            return true;
        } return false;
    }

    public function create_new_student($data) {
        return Student::create_student($data, $_SESSION['admin_id']);
    }

    public function find_existing_student($email) {
        Student::find_student($email);
        if (Student::find_student($email) > 0){
            return true;
        } return false;
    }

}