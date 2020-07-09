<?php
require_once '../models/admin.php';
@session_start();

class DashboardLayout {

    public $admin;

    public function __construct(){
        if (!isset($_SESSION['admin_id'])) {
            $_SESSION['info'] = "Please, login to continue...";
            header('location: ../index.php');
        }
        $this->admin = Admin::fetch_admin($_SESSION['admin_id']);
    }

    public function pageHeader() {
        ?>
        <head>
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">

           <title>PARACH IVMS :: Dashboard</title>

           <!-- Bootstrap CSS CDN -->
           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
           <!-- Our Custom CSS -->
           <link rel="stylesheet" href="../assets/css/style.css">
           <!-- Scrollbar Custom CSS -->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

           <!-- Font Awesome JS -->
           <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
           <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

        </head>
        <?php
    }

    public function sideBar() {
        ?>
        <div class="wrapper">
          <!-- Sidebar  -->
          <nav id="sidebar">
             <div class="sidebar-header text-center">
                <a href="https://parachictacademy.com.ng/" target="_blank">
                   <img src="../assets/img/parach_logo.png" alt="parach-logo" class="w-50">
                </a>
             </div>

             <ul class="list-unstyled components py-4">
                <li><a href="#">Admin Profile</a></li>
                <li>
                   <a href="#RegSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Registration</a>
                   <ul class="collapse list-unstyled" id="RegSubmenu">
                      <li class="sub-list"><a href="#">New Enquiry</a></li>
                      <li class="sub-list"><a href="#">Prospective Student</a></li>
                   </ul>
                </li>
                <li><a href="../controllers/LogoutController.php">Logout</a></li>
             </ul>
          </nav>
        </div>
    <?php
    }

    public function mainContentHeader() {
        ?>
        <div class="content-header p-2 d-flex flex-row justify-content-between text-white">
            <div class="w-75">
                <a type="button" id="sidebarCollapse" class="btn p-0">
                    <span class="h1">Parach IVMS</span>
                </a>
            </div>
            <div class="w-25 ">
                <div class="d-flex justify-content-end">
                    <div class="text-right px-2 pt-2">
                        <span class="d-block"> <?php echo $this->admin['firstname'].' '.strtoupper($this->admin['lastname']); ?></span>
                        <a href="../controllers/LogoutController.php" class="text-white">Logout</a>
                    </div>
                    <div class="">
                        <img src="../assets/img/avatar.png" alt="user-image" class="img-fluid img-thumbnail user-img">
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function footer() {
        ?>
        <footer class="footer">
            <p class="m-0">Copyright &copy; Parach Computers, 2020.</p>
        </footer>
        <?php
    }

    public function footScripts() {
        ?>
        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar, #content').toggleClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>
        <?php
    }

    public function notification_messages() {
        if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></strong>
            </div> <?php
        }
        if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger alert-block" id="message-alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></strong>
            </div> <?php
        }
        if (isset($_SESSION['warning'])) { ?>
            <div class="alert alert-warning alert-block" id="message-alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $_SESSION['warning']; unset($_SESSION['warning']); ?></strong>
            </div> <?php
        }
        if (isset($_SESSION['info'])) { ?>
            <div class="alert alert-info alert-block" id="message-alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $_SESSION['info']; unset($_SESSION['info']); ?></strong>
            </div> <?php
        }
    }
}

?>