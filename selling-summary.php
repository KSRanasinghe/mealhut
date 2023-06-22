<?php
session_start();
if (isset($_SESSION["admin"])) {
    date_default_timezone_set("Asia/Colombo");
    $today = date("M d, Y");
    $month = date("F, Y");
    $tday = date("Y-m-d");
    $tmonth = date("m");
    $tyear = date("Y");

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Selling Summary | MealHut - Delivery or Takeaway</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
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
                                <h1 class="m-0 font-weight-bold text-capitalize">selling summary</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- orders header -->

                <!-- table card -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row mx-auto">
                            <div class="col-12">
                                <?php
                                $invoice_rs = Database::search("SELECT
                                * 
                                FROM
                                `invoice`
                                INNER JOIN `invoice_payment` ON `invoice`.`id` = `invoice_payment`.`invoice_id` 
                                WHERE
                                        `invoice`.`confirmation_id` = '1'");
                                $invoice_num = $invoice_rs->num_rows;

                                $t_payment = 0;
                                $m_payment = 0;

                                for ($i = 0; $i < $invoice_num; $i++) {
                                    $invoice_data = $invoice_rs->fetch_assoc();

                                    $date = $invoice_data["datetime"];
                                    $split_date = explode(" ", $date);
                                    $pdate = $split_date[0];

                                    if ($pdate == $tday) {
                                        $t_payment = $t_payment + $invoice_data["payment"];
                                    }

                                    $split_result = explode("-", $pdate);
                                    $pyear = $split_result[0];
                                    $pmonth = $split_result[1];

                                    if ($pyear == $tyear) {
                                        if ($pmonth == $tmonth) {
                                            $m_payment = $m_payment + $invoice_data["payment"];
                                        }
                                    }
                                }
                                ?>
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                                    <!-- /.1 -->
                                    <div class="col">
                                        <div class="card shadow">
                                            <div class="card-header text-center bg-light text-capitalize">
                                                <span class="text-dark fs-4 fw-semibold">daily earnings</span>
                                            </div>
                                            <div class="p-4 image border-bottom border-1 border-opacity-75 text-center">
                                                <img src="images/money.svg" class="img-fluid" style="width: 250px;" />
                                            </div>
                                            <div class="card-body">
                                                <div class="card-subtitle text-center">
                                                    <?php echo $today; ?>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center border-top">
                                                <span class="text-dark fs-5 fw-semibold">Rs.<?php echo number_format($t_payment, 2); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $item_rs = Database::search("SELECT
                                * 
                                FROM
                                `invoice`
                                INNER JOIN `invoice_item` ON `invoice`.`id` = `invoice_item`.`invoice_id` 
                                WHERE
                                        `invoice`.`confirmation_id` = '1'");
                                    $item_num = $item_rs->num_rows;

                                    $t_qty = 0;
                                    $m_qty = 0;

                                    for ($i = 0; $i < $item_num; $i++) {
                                        $item_data = $item_rs->fetch_assoc();

                                        $date = $item_data["datetime"];
                                        $split_date = explode(" ", $date);
                                        $pdate = $split_date[0];

                                        if ($pdate == $tday) {
                                            $t_qty = $t_qty + $item_data["qty"];
                                        }

                                        $split_result = explode("-", $pdate);
                                        $pyear = $split_result[0];
                                        $pmonth = $split_result[1];

                                        if ($pyear == $tyear) {
                                            if ($pmonth == $tmonth) {
                                                $m_qty = $m_qty + $item_data["qty"];
                                            }
                                        }
                                    }
                                    ?>
                                    <!-- /.2 -->
                                    <div class="col">
                                        <div class="card shadow">
                                            <div class="card-header text-center bg-light text-capitalize">
                                                <span class="text-dark fs-4 fw-semibold">daily sellings</span>
                                            </div>
                                            <div class="p-4 image border-bottom border-1 border-opacity-75 text-center">
                                                <img src="images/food.svg" class="img-fluid" style="width: 250px;" />
                                            </div>
                                            <div class="card-body">
                                                <div class="card-subtitle text-center">
                                                    <?php echo $today; ?>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center border-top">
                                                <span class="text-dark fs-5 fw-semibold"><?php echo $t_qty; ?> Items</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.3 -->
                                    <div class="col">
                                        <div class="card shadow">
                                            <div class="card-header text-center bg-light text-capitalize">
                                                <span class="text-dark fs-4 fw-semibold">monthly earnings</span>
                                            </div>
                                            <div class="p-4 image border-bottom border-1 border-opacity-75 text-center">
                                                <img src="images/money.svg" class="img-fluid" style="width: 250px;" />
                                            </div>
                                            <div class="card-body">
                                                <div class="card-subtitle text-center">
                                                    <?php echo $month; ?>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center border-top">
                                                <span class="text-dark fs-5 fw-semibold">Rs.<?php echo number_format($m_payment, 2); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.4 -->
                                    <div class="col">
                                        <div class="card shadow">
                                            <div class="card-header text-center bg-light text-capitalize">
                                                <span class="text-dark fs-4 fw-semibold">monthly sellings</span>
                                            </div>
                                            <div class="p-4 image border-bottom border-1 border-opacity-75 text-center">
                                                <img src="images/food.svg" class="img-fluid" style="width: 250px;" />
                                            </div>
                                            <div class="card-body">
                                                <div class="card-subtitle text-center">
                                                    <?php echo $month; ?>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center border-top">
                                                <span class="text-dark fs-5 fw-semibold"><?php echo $m_qty; ?> Items</span>
                                            </div>
                                        </div>
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