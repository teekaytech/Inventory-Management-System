<?php
@session_start();
require_once ('DashboardController.php');


if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['update']))) {
    $activities = new DashboardController();
    $request = $_POST;

    var_dump($_SESSION['admin_id']);
    die();
//    var_dump($request);
//    die();
}