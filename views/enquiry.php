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
            <h3>New Enquiry Page</h3>
        </section>
        <article class="mx-5">
            <p class="text-danger"><em>All fields marked with (*) are compulsory</em></p>
            <form method="post" action="../controllers/processes.php">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date">* Date:</label>
                        <input type="date" class="form-control" id="date" name="date" autofocus required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">* Fullname</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="address">* Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">* Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">* Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone_no" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="course">* Course Request</label>
                        <select class="form-control" name="course" id="course" required>
                            <option value="">Please, select...</option>
                            <?php foreach ($page->all_courses() as $course) { ?>
                                <option value="<?php echo $course['id']; ?>"><?php echo $course['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="details">How did you hear about us?</label>
                        <select class="form-control" id="details" name="channel" required>
                            <option value="">Please, select...</option>
                            <?php foreach ($page->all_channels() as $channel) { ?>
                                <option value="<?php echo $channel['id']; ?>"><?php echo $channel['channel']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <button type="submit" name="submit_enquiry" class="btn btn-primary">Submit Enquiry</button>
            </form>
        </article>
    </section>
    <?php echo $page->footer(); ?>
</div>
<?php echo $page->footScripts(); ?>
</body>
</html>