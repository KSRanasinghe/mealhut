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
        <title> Delivery Locations | MealHut - Delivery or Takeaway</title>
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
                                <h1 class="m-0 font-weight-bold text-capitalize">delivery locations</h1>
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
                                                    <th>Address Name</th>
                                                    <th>Address Owner</th>
                                                    <th>Phone No.</th>
                                                    <th>House No.</th>
                                                    <th>Street</th>
                                                    <th>District</th>
                                                    <th>Nearest City</th>
                                                    <th>Email(Added By)</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $address_rs = Database::search("SELECT
                                                `address`.id,
                                                `address`.`name`,
                                                CONCAT( title.`name`, `address`.fname,' ', `address`.`lname` ) AS `owner`,
                                                `address`.`mobile`,
                                                `address`.`house_no`,
                                                `address`.`street`,
                                                `address`.`city`,
                                                `district`.`name` AS district,
                                                `member`.`email`,
                                                `status`.`name` AS `status` 
                                            FROM
                                                `address`
                                                INNER JOIN `district` ON `address`.`district_id` = `district`.`id`
                                                INNER JOIN `member` ON `address`.`member_id` = `member`.`id`
                                                INNER JOIN `status` ON `address`.`status_id` = `status`.`id`
                                                INNER JOIN `title` ON `address`.`title_id` = `title`.`id` 
                                                AND `member`.`title_id` = `title`.`id`");

                                                $address_num = $address_rs->num_rows;

                                                if ($address_num > 0) {
                                                    for ($i = 0; $i < $address_num; $i++) {
                                                        $address_data = $address_rs->fetch_assoc();
                                                        $id = $address_data["id"];
                                                ?>
                                                        <tr>
                                                            <td><?php echo $id; ?></td>
                                                            <td><?php echo $address_data["name"]; ?></td>
                                                            <td><?php echo $address_data["owner"]; ?></td>
                                                            <td><?php echo $address_data["mobile"]; ?></td>
                                                            <td><?php echo $address_data["house_no"]; ?></td>
                                                            <td><?php echo $address_data["street"]; ?></td>
                                                            <td><?php echo $address_data["district"]; ?></td>
                                                            <td><?php echo $address_data["city"]; ?></td>
                                                            <td><?php echo $address_data["email"]; ?></td>
                                                            <td><?php echo $address_data["status"]; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Address Name</th>
                                                    <th>Address Owner</th>
                                                    <th>Phone No.</th>
                                                    <th>House No.</th>
                                                    <th>Street</th>
                                                    <th>District</th>
                                                    <th>Nearest City</th>
                                                    <th>Email(Added By)</th>
                                                    <th>Status</th>
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