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
                                <select class="form-control" id="roles" name="role_id" required>
                                    <option value="">Please, select...</option>
                                    <?php foreach ($page->all_roles() as $role) { ?>
                                        <option value="<?php echo $role['id']-1; ?>"><?php echo $role['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" name="create_admin" class="btn btn-primary">Create New Admin</button>
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
                    <?php foreach ($page->all_admins() as $sn => $admin) {
                        if ($admin['id'] == $_SESSION['admin_id']) { continue; } ?>
                        <tr>
                            <th scope="row"><?php echo $sn; ?></th>
                            <td><?php echo $admin['username']; ?></td>
                            <td>
                                <?php
                                if ($admin['status'] ==  1) { ?>
                                    <form method="post" action="../controllers/processes.php">
                                       <input type="hidden" name="admin_id" value="<?php echo $admin['id']; ?>">
                                        <button type="submit" name="disable_admin" class="badge badge-success">
                                            <i class="fa fa-power-off"></i> Is active
                                        </button>
                                    </form>
                                <?php } else { ?>
                                    <form method="post" action="../controllers/processes.php">
                                        <input type="hidden" name="admin_id" value="<?php echo $admin['id']; ?>">
                                        <button type="submit" name="enable_admin" class="badge badge-warning">
                                            <i class="fa fa-power-off"></i> Not active
                                        </button>
                                    </form>
                                <?php } ?>
                            </td>
                            <td>
                                <form method="post" action="../controllers/processes.php">
                                    <input type="hidden" name="admin_id" value="<?php echo $admin['id']; ?>">
                                    <button type="submit" name="delete_admin" class="badge badge-danger">
                                        <i class="fa fa-user-times"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
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