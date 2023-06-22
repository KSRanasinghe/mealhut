<?php
require "connection.php";
date_default_timezone_set('Asia/Colombo');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details | Order Meal Online - Delivery or Takeaway</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/alertify.css" />
    <link rel="icon" href="images/mealhut.png" />
</head>

<body class="banner-signin">

    <!-- banner -->
    <div class="container-fluid">
        <?php require "header.php"; ?>
        <div class="row mx-auto">

            <div class="col-12 offset-lg-2 col-lg-8">
                <div class="row">

                    <!-- Card -->
                    <div class="card shadow custome-card-2">
                        <div class="card-body">

                            <div class="col-12 offset-lg-2 col-lg-8">
                                <div class="row">

                                    <div class="col-12 mt-3 pb-1">
                                        <h4 class="card-title text-uppercase fw-semibold text-dark text-center">Order Details</h4>
                                        <hr class="col-12" />
                                    </div>

                                    <div class="col-12 justify-content-center">
                                        <div class="row">

                                            <p class="text-danger fw-semibold" style="text-align: justify;">
                                            Please note that any meal order you place will be completed within a maximum preparation time of 50 minutes from the time the checkout process is completed. Furthermore, this time calculation may vary depending on the size of your order.
                                            </p>
                                            <p class="text-danger fw-semibold" style="text-align: justify;">
                                                If you need to change the time when the order should be completed, please contact our staff through this number.
                                            </p>
                                            <span class="fs-6 fw-semibold text-secondary text-start">
                                                <i class="bi bi-telephone-forward me-2"></i>
                                                011 2334 587
                                            </span>

                                            <span class="fs-6 text-secondary fw-semibold  text-start mt-2 pt-1">
                                                <i class="bi bi-clock me-2"></i>
                                                Operating Hours - 09:00AM to 10:00PM
                                            </span>
                                            
                                            <span class="fs-6 text-secondary fw-semibold  text-start mt-2 pt-1">
                                                <i class="bi bi-hourglass-split me-2"></i>
                                                Current time Sri Lanka<br />
                                                <span class="ms-4">( <?php echo date("m/d/Y h:i:s A"); ?> )</span>
                                            </span>

                                            <div class="col-12 my-2 pb-1">
                                                <hr class="col-12" />
                                            </div>

                                            <?php

                                            $open = "08:00:00";
                                            $close = "22:00:00";
                                            $now = date("H:i:s");

                                            if ($now > $open && $now < $close) {
                                            ?>
                                                <span class="text-dark fw-semibold fs-6">
                                                    Where would you like your order be delivered to?
                                                </span>
                                                <div class="mt-3">
                                                    <a href="addresslist.php" class="col-12 btn btn-success shadow-none text-uppercase">
                                                        <i class="bi bi-pin-map me-2"></i>select address
                                                    </a>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="menu.php" class="col-12 btn btn-light border border-1 border-secondary shadow-none text-secondary fw-semibold">
                                                        Continue to menu
                                                    </a>
                                                </div>
                                                <div class="mt-3">
                                                    <?php
                                                    if (isset($_SESSION["p"])) {
                                                        if ($_SESSION["p"] == 1) {
                                                    ?>
                                                            <button class="col-12 btn btn-light border border-1 border-secondary shadow-none text-secondary fw-semibold" onclick="changePickup();">
                                                                Change pickup type to takeaway
                                                            </button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button class="col-12 btn btn-light border border-1 border-secondary shadow-none text-secondary fw-semibold" onclick="changePickup();">
                                                                Change pickup type to delivery
                                                            </button>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <button class="col-12 btn btn-light border border-1 border-secondary shadow-none text-secondary fw-semibold" onclick="changePickup();">
                                                            Change pickup type to takeaway
                                                        </button>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="mt-2 mb-4">
                                                    <span class="small text-secondary">
                                                        <span class="text-danger">*</span> Delivery time can be changed according to your delivery location.
                                                    </span>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12 mt-2">
                                                    <div class="row">
                                                        <div class="alert alert-warning alert-dismissible fade show h-75 text-center">
                                                            <span class="text-uppercase fw-semibold" style="font-size: 14px;">
                                                                <i class="bi bi-exclamation-circle me-2"></i>
                                                                sorry! we're close at the moment.
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Card -->

                </div>
            </div>

        </div>
    </div>
    <!-- banner -->

    <!-- footer -->
    <?php
    require "footer.php";
    ?>
    <!-- footer -->

    <script src="scripts/signin.js"></script>
    <script src="scripts/bootstrap.bundle.js"></script>
    <script src="scripts/alertify.js"></script>
</body>

</html>