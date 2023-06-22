<?php
require "connection.php";
?>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/245dfc8b55.js" crossorigin="anonymous"></script>
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <span class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></span>
        </li>
        <li class="nav-item g-underline d-none d-sm-inline-block">
            <a href="dashboard.php" class="nav-link g-underline">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- admin name -->
        <li class="nav-item">
            <span class="nav-link text-uppercase active d-none d-md-flex fw-semibold" role="text" style="cursor: default;">
                hello <?php echo $_SESSION["admin"]["fname"]; ?>!
            </span>
        </li>
        <!-- admin name -->

        <!-- Profile Menu -->
        <li class="nav-item dropdown">
            <span class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa-solid fa-circle-user" style="font-size: 25px;"></i>
            </span>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <a class="dropdown-item text-capitalize" style="font-size: 14px; cursor: default;">
                    <i class="fa-solid fa-circle text-success me-2"></i>
                    online
                </a>
                <div class="dropdown-divider"></div>
                <span role="button" class="dropdown-item text-capitalize" style="font-size: 14px;" onclick="logout();">
                    log out
                </span>
            </div>
        </li>
        <!-- Profile Menu -->

    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-success elevation-4">
    <!-- Brand Logo -->
    <span href="dashboard.php" class="brand-link">
        <img src="images/mealhut.svg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bolder fs-5">
            <span class=" text-success fs-5">M</span>eal<span class="text-success fs-5">H</span>ut<span class="text-success fs-5">.</span>
        </span>
    </span>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-5 pt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-gauge-high"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="category.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-list-ul"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="meal-items.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-utensils"></i>
                        <p>
                            Items
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="banners.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-bullhorn"></i>
                        <p>
                            Promotion Banners
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="orders.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-cart-arrow-down"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="members.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>
                            MealHut Members
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="delivery-locations.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-map-location-dot"></i>
                        <p>
                            Delivery Locations
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="appreciations.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-star"></i>
                        <p>
                            Appreciations
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="inquiries.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-circle-question"></i>
                        <p>
                            Inquiries
                        </p>
                    </a>
                </li>
                <?php
                $utype = $_SESSION["admin"]["user_type_id"];

                if ($utype == 1) {
                ?>
                    <li class="nav-item">
                        <a href="admin-signup.php" class="nav-link">
                            <i class="nav-icon fa-solid fa-user-gear"></i>
                            <p>
                                Admin Registration
                            </p>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>



<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<script src="scripts/adminEntrance.js"></script>
<!-- link active -->
<script>
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll('a');
    const menuLength = menuItem.length;
    for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
            menuItem[i].className = "nav-link active";
        }

    }
</script>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>