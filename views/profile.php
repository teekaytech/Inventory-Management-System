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
            <h3>Profile update page</h3>
            <p><?php echo $admin['lastname'].', '.$admin['firstname']; ?></p>
        </section>
        <article class="mx-5">
            <p class="text-danger"><em>All fields marked with (*) are compulsory</em></p>
            <form method="post" action="../controllers/UpdateProfile.php">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="firstname">* Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname"
                               value="<?php echo $admin['firstname']; ?>" autofocus required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="middlename">* Middlename</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" required
                               value="<?php echo $admin['middlename']; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="lastname">* Lastname</label>
                        <input type="text" class="form-control" value="<?php echo $admin['lastname']; ?>" id="lastname"
                               name="lastname" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?php echo $admin['username']; ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" class="new_password"
                               placeholder="leave blank if you do not want to change the password" name="password">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">* Email</label>
                        <input type="email" class="form-control" id="email" name="email" required
                            value="<?php echo $admin['email']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirm">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm" name="confirm"
                               placeholder="leave blank if you do not want to change the password">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone">* Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone_no" required
                        value="<?php echo $admin['phone_no']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="current">Current Password</label>
                        <input type="password" class="form-control" id="current" name="password"
                               placeholder="leave blank if you do not want to change the password">
                    </div>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
            </form>
        </article>
    </section>
    <?php echo $page->footer(); ?>
</div>
<?php echo $page->footScripts(); ?>
</body>
</html>