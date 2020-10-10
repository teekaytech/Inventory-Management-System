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
            <p>Enquiries, Students</p>
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
                <tr>
                    <?php if (isset($_SESSION['inquiries'])) {
                        echo 'Data is set';
                    } ?>
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
                </thead>
                <tbody>
                <?php if (!isset($_SESSION['inquiries'])) {
                    echo '<tr><td colspan="8" align="center">Please use the options above to query reports</td></tr>';
                } else {
                    $counter = 1;
                    foreach ($_SESSION['inquiries'] as $enquiry) { ?>
                        <tr>
                            <th scope="row"><?php echo $counter; ?></th>
                            <td><?php echo date_format(date_create($enquiry['date']),"D/M/Y "); ?></td>
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