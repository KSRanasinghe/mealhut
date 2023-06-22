<?php
session_start();
if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Members | MealHut - Delivery or Takeaway</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- /.DataTables -->
        <link rel="stylesheet" href="./css/adminStyle.css" />
        <link rel="stylesheet" href="./css/bootstrap.css" />
        <link rel="stylesheet" href="./css/alertify.css" />
        <link rel="icon" href="images/mealhut.png" />
    </head>

    <body class="hold-transition sidebar-mini sidebar-collapse bg-light">
        <div class="wrapper">
            <!-- header -->
            <?php require "adminheader.php"; ?>
            <!-- header -->

            <div class="content-wrapper">

                <!-- promotion banner header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 font-weight-bold text-capitalize">MealHut members</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- promotion banner header -->

                <!-- table card -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Phone No.</th>
                                                    <th>Email</th>
                                                    <th>Address Count</th>
                                                    <th>Joined At</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $member_rs = Database::search("SELECT
                                                member.id,
                                                member.fname,
                                                member.lname,
                                                member.mobile,
                                                member.email,
                                                member.datetime,
                                                member.status_id AS `sid`,
                                                title.`name` AS title,
                                                `status`.`name` AS `status` 
                                            FROM
                                                member
                                                INNER JOIN title ON member.title_id = title.id
                                                INNER JOIN `status` ON member.status_id = `status`.id");

                                                $member_num = $member_rs->num_rows;

                                                if ($member_num > 0) {
                                                    for ($i = 0; $i < $member_num; $i++) {
                                                        $member_data = $member_rs->fetch_assoc();
                                                        $id = $member_data["id"];

                                                        $address_rs = Database::search("SELECT COUNT(`id`) AS `count` FROM `address` WHERE `member_id` = '" . $id . "' AND `status_id` = '1'");
                                                        $address_data = $address_rs->fetch_assoc();
                                                        $count = $address_data["count"];
                                                ?>
                                                        <tr>
                                                            <td><?php echo $id; ?></td>
                                                            <td><?php echo $member_data["title"]; ?></td>
                                                            <td><?php echo $member_data["fname"]; ?></td>
                                                            <td><?php echo $member_data["lname"]; ?></td>
                                                            <td><?php echo $member_data["mobile"]; ?></td>
                                                            <td><?php echo $member_data["email"]; ?></td>
                                                            <td><?php echo $count; ?></td>
                                                            <td><?php echo $member_data["datetime"]; ?></td>
                                                            <td><?php echo $member_data["status"]; ?></td>
                                                            <td>
                                                                <?php
                                                                if ($member_data["sid"] == 1) {
                                                                ?>
                                                                    <div class="row px-3">
                                                                        <button class="btn btn-danger shadow-none" onclick="status('<?php echo $id; ?>');">Block</button>
                                                                    </div>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <div class="row px-3">
                                                                        <button class="btn btn-success shadow-none" onclick="status('<?php echo $id; ?>');">Unblock</button>
                                                                    </div>
                                                                <?php
                                                                }

                                                                ?>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Phone No.</th>
                                                    <th>Email</th>
                                                    <th>Address Count</th>
                                                    <th>Joined At</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- table card -->

            </div>

            <!-- footer -->
            <footer class="main-footer">
                <p class="text-center text-dark d-none d-lg-block" style="font-size: 14px; margin-bottom: -0.5%;">
                    Copyright &copy; MealHut &trade;. All rights reserved. The MealHut name, logos, and related marks are trademarks of MealHut, Inc.
                </p>
                <p class="text-center text-dark d-block d-lg-none" style="font-size: 14px;margin-bottom: -0.5%;">
                    Copyright &copy; MealHut Sri Lanka.
                </p>
            </footer>
            <!-- footer -->
        </div>

        <!-- status -->
        <script>
            function status(id) {
                var r = new XMLHttpRequest();
                r.onreadystatechange = function() {
                    if (r.readyState == 4) {
                        var t = r.responseText;
                        if (t == "success") {
                            window.location.reload();
                        } else {
                            alertify.set("notifier", "position", "bottom-left");
                            alertify.warning(t);
                        }
                    }
                }

                r.open("GET", "changeMemberStatus.php?id=" + id, true);
                r.send();
            }
        </script>
        <script src="scripts/bootstrap.bundle.js"></script>
        <script src="scripts/alertify.js"></script>
        <!-- tooltip -->
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="plugins/jszip/jszip.min.js"></script>
        <script src="plugins/pdfmake/pdfmake.min.js"></script>
        <script src="plugins/pdfmake/vfs_fonts.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- Page specific script -->
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
        </script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        window.location = "admin-entrance.php";
    </script>
<?php
}
?>