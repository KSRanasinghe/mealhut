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
        <title> Orders | MealHut - Delivery or Takeaway</title>
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

                <!-- orders header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 font-weight-bold text-capitalize">orders</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- orders header -->

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
                                                    <th>Order Id</th>
                                                    <th>Ordered on</th>
                                                    <th>Recipient Address</th>
                                                    <th>Net Total(Rs.)</th>
                                                    <th>Order Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $invoice_rs = Database::search("SELECT
                                                `invoice`.`id`,
                                                `invoice`.`datetime`,
                                                `invoice`.`unique_id`,
                                                `invoice_payment`.`payment`,
                                                `payment_type`.`name` AS `ptype`,
                                                `address`.`house_no`,
                                                `address`.`street`,
                                                `address`.`city`,
                                                `district`.`name` AS `district`,
                                                CONCAT( `title`.`name`, `member`.`fname`, ' ', `member`.`lname` ) AS `orderedby`,
                                                `member`.`mobile` AS `m_mobile`,
                                                CONCAT( `address`.`fname`, ' ', `address`.`lname` ) AS `recipient`,
                                                `address`.`title_id` AS `ad_title_id`,
                                                `address`.`mobile` AS `r_mobile`,
                                                `confirmation`.`name` AS `confirm`,
                                                `pickup`.`name` AS `pickup`  
                                            FROM
                                                `invoice`
                                                INNER JOIN `invoice_payment` ON `invoice`.`id` = `invoice_payment`.`invoice_id`
                                                INNER JOIN `address` ON `invoice`.`address_id` = `address`.`id`
                                                INNER JOIN `district` ON `address`.`district_id` = `district`.`id`
                                                INNER JOIN `member` ON `invoice`.`member_id` = `member`.`id`
                                                INNER JOIN `title` ON `member`.`title_id` = `title`.`id`
                                                INNER JOIN `confirmation` ON `invoice`.`confirmation_id` = `confirmation`.`id` 
                                                INNER JOIN `payment_type` ON `invoice_payment`.`payment_type_id` = `payment_type`.`id` 
                                                INNER JOIN `pickup` ON `invoice`.`pickup_id` = `pickup`.`id` 
                                            WHERE
                                            `invoice`.`confirmation_id` != '0'");

                                                $invoice_num = $invoice_rs->num_rows;

                                                if ($invoice_num > 0) {
                                                    for ($i = 0; $i < $invoice_num; $i++) {
                                                        $invoice_data = $invoice_rs->fetch_assoc();
                                                ?>
                                                        <tr>
                                                            <td><?php echo $invoice_data["unique_id"]; ?></td>
                                                            <td><?php echo $invoice_data["datetime"]; ?></td>
                                                            <td>
                                                                <?php
                                                                if ($invoice_data["street"] != "") {
                                                                ?>
                                                                    <?php echo $invoice_data["house_no"] . "," . $invoice_data["street"] . ","
                                                                        . $invoice_data["city"] . "," . $invoice_data["district"] . ",Sri Lanka."; ?>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <?php echo $invoice_data["house_no"] . "," . $invoice_data["city"] . "," . $invoice_data["district"] . ",Sri Lanka."; ?>
                                                                <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo number_format($invoice_data["payment"], 2); ?></td>
                                                            <td><?php echo $invoice_data["confirm"]; ?></td>
                                                            <td>
                                                                <div class="row px-2">
                                                                    <button class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $invoice_data["id"]; ?>">
                                                                        <i class="bi bi-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- /.details modal -->
                                                        <div class="modal fade" id="exampleModal<?php echo $invoice_data["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                                                                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body" style="font-size: 14px;">
                                                                        <!-- /.order deatils table -->
                                                                        <div class="row my-2 mx-auto border border-1 border-secondary border-opacity-50 text-start">
                                                                            <div class="col-4 border-end border-1 border-secondary border-opacity-50 py-2 bg-light">
                                                                                <span class="text-dark text-capitalize fw-semibold">order id</span>
                                                                            </div>
                                                                            <div class="col-4 border-end border-1 border-secondary border-opacity-50 py-2 bg-light">
                                                                                <span class="text-dark text-capitalize fw-semibold">order type</span>
                                                                            </div>
                                                                            <div class="col-4 py-2 bg-light">
                                                                                <span class="text-dark text-capitalize fw-semibold">payment type</span>
                                                                            </div>
                                                                            <!-- /.order id -->
                                                                            <div class="col-4 border-end border-top border-1 border-secondary border-opacity-50 py-2">
                                                                                <span class="text-dark text-capitalize fw-semibold opacity-75">
                                                                                    <?php echo $invoice_data["unique_id"]; ?>
                                                                                </span>
                                                                            </div>
                                                                            <!-- /.order type -->
                                                                            <div class="col-4 border-end border-top border-1 border-secondary border-opacity-50 py-2">
                                                                                <span class="text-dark text-capitalize fw-semibold opacity-75">
                                                                                    <?php echo $invoice_data["pickup"]; ?>
                                                                                </span>
                                                                            </div>
                                                                            <!-- /.payment type -->
                                                                            <div class="col-4 border-top border-1 border-secondary border-opacity-50 py-2">
                                                                                <span class="text-dark text-capitalize fw-semibold opacity-75">
                                                                                    <?php echo $invoice_data["ptype"]; ?>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.sender & recipient tabe -->
                                                                        <div class="row my-4 mx-auto border border-1 border-secondary border-opacity-50 text-start">
                                                                            <div class="col-6 border-end border-1 border-secondary border-opacity-50 py-2 bg-light">
                                                                                <span class="text-dark text-capitalize fw-semibold">sender</span>
                                                                            </div>
                                                                            <div class="col-6 py-2 bg-light">
                                                                                <span class="text-dark text-capitalize fw-semibold">recipient</span>
                                                                            </div>
                                                                            <!-- /.sender -->
                                                                            <div class="col-6 border-end border-top border-1 border-secondary border-opacity-50 py-2">
                                                                                <span class="text-dark text-capitalize fw-semibold opacity-75">
                                                                                    <?php echo $invoice_data["orderedby"]; ?>
                                                                                </span>
                                                                            </div>
                                                                            <!-- /.recipient -->
                                                                            <div class="col-6 border-top border-1 border-secondary border-opacity-50 py-2">
                                                                                <span class="text-dark fw-semibold opacity-75">
                                                                                    <?php
                                                                                    $title_rs = Database::search("SELECT
                                                                                    * 
                                                                                FROM
                                                                                    `title`
                                                                                WHERE
                                                                                    `title`.`id` = '" . $invoice_data["ad_title_id"] . "'");
                                                                                    $title_data = $title_rs->fetch_assoc();
                                                                                    echo $title_data["name"] . $invoice_data["recipient"]; ?>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.items table -->
                                                                        <div class="row my-2 mx-auto border border-1 border-secondary border-opacity-50 text-start">
                                                                            <div class="col-8 border-end border-1 border-secondary border-opacity-50 py-2 bg-light">
                                                                                <span class="text-dark text-capitalize fw-semibold">items</span>
                                                                            </div>
                                                                            <div class="col-4 py-2 bg-light">
                                                                                <span class="text-dark text-capitalize fw-semibold">qty</span>
                                                                            </div>
                                                                            <?php
                                                                            $items_rs = Database::search("SELECT
                                                                            product.`name`,
                                                                            meal_type.`name` AS mlname,
                                                                            invoice_item.qty 
                                                                        FROM
                                                                            invoice_item
                                                                            INNER JOIN meal_details ON invoice_item.meal_details_id = meal_details.id
                                                                            INNER JOIN product ON meal_details.product_id = product.id
                                                                            INNER JOIN meal_type ON meal_details.meal_type_id = meal_type.id 
                                                                        WHERE
                                                                            invoice_item.invoice_id = '" . $invoice_data["id"] . "'");
                                                                            $items_num = $items_rs->num_rows;

                                                                            for ($x = 0; $x < $items_num; $x++) {
                                                                                $items_data = $items_rs->fetch_assoc();
                                                                                $pname = $items_data["name"];
                                                                                $mlname = $items_data["mlname"];
                                                                                $qty = $items_data["qty"];
                                                                            ?>
                                                                                <div class="col-8 border-end border-top border-1 border-secondary border-opacity-50 py-2">
                                                                                    <span class="text-dark text-capitalize fw-semibold opacity-75">
                                                                                        <?php echo $pname . " " . "($mlname[0])"; ?>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-4 py-2 border-top border-1 border-secondary border-opacity-50">
                                                                                    <span class="text-dark text-capitalize fw-semibold opacity-75">
                                                                                        <?php echo $qty; ?>
                                                                                    </span>
                                                                                </div>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer text-end">
                                                                        <span class="text-dark fw-semibold text-capitalize fs-5">net total(rs.) : </span>
                                                                        <span class="text-dark fw-semibold opacity-75 fs-5">
                                                                            <?php echo number_format($invoice_data["payment"], 2); ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Order Id</th>
                                                    <th>Ordered on</th>
                                                    <th>Recipient Address</th>
                                                    <th>Net Total(Rs.)</th>
                                                    <th>Order Status</th>
                                                    <th></th>
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
                    "autoWidth": false,
                    "buttons": ["pdf", "print"]
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