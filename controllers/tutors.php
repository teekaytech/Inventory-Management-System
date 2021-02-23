<?php
@session_start();
require_once ('DashboardController.php');

$activities = new DashboardController();
$data = [];

?>