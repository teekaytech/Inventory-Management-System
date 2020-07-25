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
        <section class="mx-4 my-4">
            <h3>All Administrators Page</h3>(create new, enable/disable existing, see existing)
        </section>
        <section class="row mx-5 mt-5">
            <div class="col-md-6">
                <h5>Create New Admin</h5>
                <article class="mr-5 pr-5">
                    <p class="text-danger"><em>All fields marked with (*) are compulsory</em></p>
                    <form method="post" action="../controllers/processes.php">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="username">* Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="password">* Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="password">* Role</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <button type="submit" name="submit_enquiry" class="btn btn-primary">Create New Admin</button>
                    </form>
                </article>
            </div>
            <div class="col-md-6">
                <h5 class="mb-4">Existing Admins</h5>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Account Status</th>
                        <th scope="col">Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </section>
    <?php echo $page->footer(); ?>
</div>
<?php echo $page->footScripts(); ?>
</body>
</html>