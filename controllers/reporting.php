<?php
@session_start();
require_once ('DashboardController.php');

$activities = new DashboardController();
$data = [];

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['fetch_reports']))) {
    $data['category'] = $activities->validate_data($_POST['category'], 'Category');
    $data['start_date'] = $activities->validate_data($_POST['start_date'], 'Start Date');
    $data['end_date'] = $activities->validate_data($_POST['end_date'], 'End Date');

    if (!in_array(false, $data)) {
        if ($data['category'] == 'enquiries') {
            $inquiries = $activities->fetch_inquiries($data['start_date'], $data['end_date']);
            if (count($inquiries) != 0) { $_SESSION['inquiries'] = $inquiries; }
            else { $_SESSION['warning'] = 'No record found'; }
        } elseif ($data['category'] == 'students') {
            $students = $activities->fetch_all_students($data['start_date'], $data['end_date']);
            if (count($students) != 0) { $_SESSION['students'] = $students; }
            else { $_SESSION['warning'] = 'No record found'; }
        }
    }

    header('location: ../views/reports.php');
}
?>