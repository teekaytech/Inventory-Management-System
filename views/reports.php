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
                  <form method="get" action="../controllers/processes.php" class="row">
                    <div class="col-md-2">
                        <input type="radio" name="category" id="enquiries" class="enquiries">
                        <label for="enquiries">Enquiries</label>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" name="category" id="students" class="students">
                        <label for="students">Students</label>
                    </div>
                    <div class="col-md-3 start-date">
                        <label for="start_date">Start Date</label>
                        <input type="datetime-local" class="form-control" name="start_date" id="start_date" />
                    </div>
                      <div class="col-md-3 end-date">
                          <label for="end_date">End Date</label>
                          <input type="datetime-local" class="form-control" name="end_date" id="end_date" />
                      </div>
                      <div class="col-md-2 fetch-data">
                          <button type="submit" class="btn btn-primary mb-2">Submit</button>
                      </div>
                </form>
            </section>
        </section>
    </section>
    <?php echo $page->footer(); ?>
</div>
<?php echo $page->footScripts(); ?>
</body>
</html>