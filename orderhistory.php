<?php require "connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History | Order Meal Online - Delivery or Takeaway</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="alertify.css" />
    <link rel="icon" href="images/mealhut.png" />
</head>

<body class="banner-signin">

    <!-- banner -->
    <div class="container-fluid">
        <?php require "header.php"; ?>
        <div class="row">

            <div class="col-12 offset-lg-1 col-lg-10 mt-2 mb-5 py-5">
                <div class="row  mx-auto">

                    <!-- Card -->
                    <div class="card shadow custome-card-4">
                        <div class="card-body">

                            <div class="col-12 mt-3 pb-1">
                                <h4 class="card-title text-uppercase fw-semibold text-dark text-center">your previous orders</h4>
                                <hr class="col-12" />
                            </div>

                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-secondary bg-opacity-50 text-dark">
                                                <tr>
                                                    <th scope="col" class="text-capitalize">order id</th>
                                                    <th scope="col" class="text-capitalize">ordered on</th>
                                                    <th scope="col" class="text-capitalize">recipient address</th>
                                                    <th scope="col" class="text-capitalize">net total(rs.)</th>
                                                    <th scope="col" class="text-capitalize">order status</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $mid = $_SESSION["m"]["id"];
                                            $invoice_rs = Database::search("SELECT
                                            `invoice`.`datetime`,
                                            `invoice`.`unique_id`,
                                            `invoice_payment`.`payment`,
                                            `address`.`house_no`,
                                            `address`.`street`,
                                            `address`.`city`,
                                            `district`.`name` AS `district`,
                                            `invoice`.`confirmation_id` 
                                        FROM
                                            `invoice`
                                            INNER JOIN `invoice_payment` ON `invoice`.`id` = `invoice_payment`.`invoice_id`
                                            INNER JOIN `address` ON `invoice`.`address_id` = `address`.`id`
                                            INNER JOIN `district` ON `address`.`district_id` = `district`.`id` 
                                        WHERE
                                            `invoice`.`member_id` = '" . $mid . "' 
                                        ORDER BY
                                            `invoice`.`datetime` DESC 
                                            LIMIT 10");

                                            $invoice_num = $invoice_rs->num_rows;

                                            if ($invoice_num > 0) {
                                            ?>
                                                <tbody>
                                                    <?php
                                                    for ($i = 0; $i < $invoice_num; $i++) {
                                                        $invoice_data = $invoice_rs->fetch_assoc();
                                                    ?>
                                                        <tr>
                                                            <!-- /.order id -->
                                                            <td>
                                                                <div class="row px-2 text-start">
                                                                    <span><?php echo $invoice_data["unique_id"]; ?></span>
                                                                </div>
                                                            </td>
                                                            <!-- /.datetime -->
                                                            <td>
                                                                <div class="row px-2 text-start">
                                                                    <span><?php echo $invoice_data["datetime"]; ?></span>
                                                                </div>
                                                            </td>
                                                            <!-- /.address -->
                                                            <td class="text-capitalize">
                                                                <div class="row px-2 text-start">
                                                                    <?php
                                                                    if ($invoice_data["street"] != "") {
                                                                    ?>
                                                                        <span>
                                                                            <?php echo $invoice_data["house_no"] . "," . $invoice_data["street"] . ","
                                                                                . $invoice_data["city"] . "," . $invoice_data["district"] . ",sri lanka."; ?>
                                                                        </span>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <span>
                                                                            <?php echo $invoice_data["house_no"] . "," . $invoice_data["city"] . "," . $invoice_data["district"] . ",sri lanka."; ?>
                                                                        </span>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </td>
                                                            <!-- /.nettotal -->
                                                            <td>
                                                            <div class="row px-2 text-start">
                                                                    <span><?php echo number_format($invoice_data["payment"],2); ?></span>
                                                                </div>
                                                            </td>
                                                            <!-- /.confirmation -->
                                                            <td class="text-capitalize">
                                                                <div class="row px-2 text-start">
                                                                    <?php
                                                                    if ($invoice_data["confirmation_id"] == 0) {
                                                                    ?>
                                                                        <span>pending</span>
                                                                    <?php
                                                                    } else if ($invoice_data["confirmation_id"] == 1) {
                                                                    ?>
                                                                        <span>confirmed</span>
                                                                    <?php
                                                                    } else if ($invoice_data["confirmation_id"] == 2) {
                                                                    ?>
                                                                        <span>canceled</span>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Card -->

                </div>
            </div>

            <!-- footer -->
            <?php
            require "footer.php";
            ?>
            <!-- footer -->
        </div>
    </div>
    <!-- banner -->

    <script src="scripts/script.js"></script>
    <script src="scripts/bootstrap.bundle.js"></script>
    <script src="scripts/alertify.js"></script>
</body>

</html>