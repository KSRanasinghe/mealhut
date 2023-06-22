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
        <title> Appreciations | MealHut - Delivery or Takeaway</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- /.DataTables -->
        <link rel="stylesheet" href="./css/bootstrap.css" />
        <link rel="stylesheet" href="./css/alertify.css" />
        <link rel="stylesheet" href="./css/adminStyle.css" />
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
                                <h1 class="m-0 font-weight-bold text-capitalize">appreciations</h1>
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
                                                    <th>Customer</th>
                                                    <th>Phone No.</th>
                                                    <th>Email</th>
                                                    <th>Feedback</th>
                                                    <th>Date / Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $appreciations_rs = Database::search("SELECT
                                                CONCAT( `title`.`name`, `feedback`.`fname`, ' ', `feedback`.`lname` ) AS `member`,
                                                `feedback`.`mobile`,
                                                `feedback`.`email`,
                                                `feedback`.`message`,
                                                `feedback`.`datetime` 
                                            FROM
                                                `feedback`
                                                INNER JOIN `title` ON `feedback`.`title_id` = `title`.`id` 
                                            WHERE
                                                `feedback`.`inquiry_type_id` = '2' 
                                            ORDER BY
                                                `feedback`.`datetime` DESC");
                                                $appreciations_num = $appreciations_rs->num_rows;
                                                if ($appreciations_num > 0) {
                                                    for ($i = 1; $i <= $appreciations_num; $i++) {
                                                        $appreciations_data = $appreciations_rs->fetch_assoc();
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $appreciations_data["member"]; ?></td>
                                                            <td><?php echo $appreciations_data["mobile"]; ?></td>
                                                            <td><?php echo $appreciations_data["email"]; ?></td>
                                                            <td><?php echo $appreciations_data["message"]; ?></td>
                                                            <td><?php echo $appreciations_data["datetime"]; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Customer</th>
                                                    <th>Phone No.</th>
                                                    <th>Email</th>
                                                    <th>Feedback</th>
                                                    <th>Date / Time</th>
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