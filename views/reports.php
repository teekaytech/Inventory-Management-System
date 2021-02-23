<?php
require_once('layout/DashboardLayout.php');
@session_start();

$page = new DashboardLayout();
?>

<!DOCTYPE html>
<html>
<?php echo $page->pageHeader(); ?>
<body>
<?php echo $page->sideBar(); ?>

<!-- Page Content  -->
<div id="content" class="content">

    <?php echo $page->mainContentHeader();

    echo $page->notification_messages(); ?>
    <section>
        <?php $admin = $page->admin; ?>
        <section class="m-5">
            <h3>Reports Page</h3>
            <p>Kindly select category to continue</p>
            <section class="reports">
                  <form method="post" action="../controllers/reporting.php" class="row">
                    <div class="col-md-2">
                        <input type="radio" name="category" id="enquiries" class="enquiries" value="enquiries">
                        <label for="enquiries">Enquiries</label>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" name="category" id="students" class="students" value="students">
                        <label for="students">Students</label>
                    </div>
                    <div class="col-md-3 start-date">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" />
                    </div>
                      <div class="col-md-3 end-date">
                          <label for="end_date">End Date</label>
                          <input type="date" class="form-control" name="end_date" id="end_date" />
                      </div>
                      <div class="col-md-2 fetch-data">
                          <button type="submit" name="fetch_reports" class="btn btn-primary mb-2">Submit</button>
                      </div>
                </form>
            </section>
            <table class="table mt-5">
                <thead>
                <tr class="table-success">
                <?php
                if (isset($_SESSION['inquiries'])) {?>
                    <td colspan="8" align="center"><strong>Showing Reports for ENQUIRIES</strong></td>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone No</th>
                    <th scope="col">Course</th>
                    <th scope="col">Channel</th>
                </tr>
                <?php }

                if (isset($_SESSION['students'])) { ?>
                    <tr class="table-success">
                        <td colspan="10" align="center"><strong>Showing Reports for STUDENTS</strong></td>
                    </tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date Registered</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone No</th>
                        <th scope="col">Course</th>
                        <th scope="col">Channel</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                    </tr>
                <?php } ?>
                </thead>
                <tbody>
                <?php if (!isset($_SESSION['inquiries']) && !isset($_SESSION['students'])) {
                    echo '<tr><td colspan="8" align="center">Please use the options above to query reports</td></tr>';
                } else {
                    $counter = 1;
                    if (isset($_SESSION['inquiries'])) {
                        foreach ($_SESSION['inquiries'] as $enquiry) { ?>
                            <tr>
                                <th scope="row"><?php echo $counter; ?></th>
                                <td><?php echo date_format(date_create($enquiry['date']),"d/M/Y "); ?></td>
                                <td><?php echo $enquiry['name']; ?></td>
                                <td><?php echo $enquiry['address']; ?></td>
                                <td><?php echo $enquiry['email']; ?></td>
                                <td><?php echo $enquiry['phone_no']; ?></td>
                                <td><?php echo $enquiry['course']; ?></td>
                                <td><?php echo $enquiry['channel']; ?></td>
                            </tr>
                            <?php
                            $counter += 1;
                        }
                        unset($_SESSION['inquiries']);
                    }

                    if (isset($_SESSION['students'])) {
                        foreach ($_SESSION['students'] as $student) { ?>
                            <tr>
                                <th scope="row"><?php echo $counter; ?></th>
                                <td><?php echo date_format(date_create($student['created_at']),"d/M/Y"); ?></td>
                                <td><?php echo $student['lastname'].' '.$student['firstname'].' '.$student['middlename']; ?></td>
                                <td><?php echo $student['address']; ?></td>
                                <td><?php echo $student['email']; ?></td>
                                <td><?php echo $student['phone_no']; ?></td>
                                <td><?php echo $student['course']; ?></td>
                                <td><?php echo $student['channel']; ?></td>
                                <td><?php echo date_format(date_create($student['start_date']), 'd/M/Y'); ?></td>
                                <td><?php echo date_format(date_create($student['end_date']), 'd/M/Y'); ?></td>
                            </tr>
                            <?php
                            $counter += 1;
                        }
                        unset($_SESSION['students']);
                    }
                    $counter = 1;
                } ?>
                </tbody>
            </table>
        </section>
    </section>
    <?php echo $page->footer(); ?>
</div>
<script src="../scripts/enquiry.js" type="text/javascript"></script>
<?php echo $page->footScripts(); ?>
</body>
</html>