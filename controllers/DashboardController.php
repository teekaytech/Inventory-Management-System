<?php
@session_start();
require_once '../models/admin.php';

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
            $_SESSION['error'] = $field.' cannot be blank.';
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
}