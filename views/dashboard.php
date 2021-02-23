<?php
require_once('layout/DashboardLayout.php');

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
                <h2>Dear <?php echo $admin['lastname'].', '.$admin['firstname']; ?></h2>
                <p>Welcome to your dashboard.</p>
            </section>
            <article class="mx-5">
                <h4 class="mt-2 mb-3">You can:</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Update your profile by clicking on the <strong>Admin Profile</strong> on the left navigation bar.</li>
                    <li class="list-group-item">Register new enquiries by clicking on <strong>Registration &gt; New Enquiry</strong>.</li>
                    <li class="list-group-item">Register prospective students by clicking on <strong>Registration &gt; Prospective Student</strong>.</li>
                    <li class="list-group-item">Logout by clicking on <strong>Logout</strong> link.</li>
                </ul>
            </article>
        </section>
        <?php echo $page->footer(); ?>
    </div>
    <?php echo $page->footScripts(); ?>
</body>
</html>