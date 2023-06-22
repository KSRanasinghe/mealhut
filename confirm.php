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
    <title>Confirm Order | Order Meal Online - Delivery or Takeaway</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/alertify.css" />
    <link rel="icon" href="images/mealhut.png" />
</head>

<body class="banner-signin">

    <!-- banner -->
    <div class="container-fluid">
        <?php require "customizedheader.php"; ?>
        <div class="row mx-auto">

            <div class="col-12 mt-2 mb-5 py-5">
                <div class="row">

                    <!--Main Card -->
                    <div class="card shadow custome-card-4">
                        <div class="card-body">

                            <div class="row my-3 py-2">
                                <div class="col-12 offset-lg-2 col-lg-8">

                                    <!-- 1st card -->
                                    <div class="card mb-4">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <?php
                                                $mid = $_SESSION["m"]["id"];

                                                $cart_product_rs = Database::search("SELECT * FROM `cart_product` 
                                                    WHERE `cart_id` 
                                                    IN (SELECT `id` FROM `cart` WHERE `member_id` = '" . $mid . "') AND 
                                                    `status_id` = '1' AND `confirmation_id` = '0'");

                                                $cart_product_data = $cart_product_rs->fetch_assoc();
                                                $adrs_id = $cart_product_data["address_id"];

                                                $address_rs = Database::search("SELECT * FROM `address` WHERE `id` = '" . $adrs_id . "' AND `status_id` = '1'");
                                                $address_data = $address_rs->fetch_assoc();

                                                $district_rs = Database::search("SELECT * FROM `district` WHERE `id` = '" . $address_data["district_id"] . "'");
                                                $district_data = $district_rs->fetch_assoc();

                                                ?>
                                                <div class="col-12 pb-3 border-bottom border-1 border-secondary border-opacity-25">
                                                    <span class="text-secondary text-capitalize" style="font-size: 14px;">
                                                        <i class="bi bi-house text-secondary me-2"></i>
                                                        <?php
                                                        if ($address_data["street"] != "") {
                                                            echo $address_data["house_no"] . "," . $address_data["street"] . ","
                                                                . $address_data["city"] . "," . $district_data["name"] . ",sri lanka.";
                                                        } else {
                                                            echo $address_data["house_no"] . "," . $address_data["city"] . ","
                                                                . $district_data["name"] . ",sri lanka.";
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                                <div class="col-12 pt-3">
                                                    <span class="text-secondary text-capitalize" style="font-size: 14px;">
                                                        <i class="bi bi-clock me-2"></i>
                                                        order for : today, ASAP
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 1st card -->

                                    <!-- 2nd card -->
                                    <div class="card mb-4">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-12 pb-2 border-bottom border-1 border-secondary border-opacity-25 mb-4 text-center">
                                                    <span class="card-title fs-5 text-uppercase fw-semibold text-dark">recipient details</span>
                                                </div>
                                                <div class="col-4 col-lg-2">
                                                    <label class="form-label text-secondary fs-6 text-capitalize">
                                                        title *
                                                    </label>
                                                    <?php
                                                    $title_rs = Database::search("SELECT * FROM `title` WHERE `id` = '" . $address_data["title_id"] . "'");
                                                    $title_data = $title_rs->fetch_assoc();
                                                    ?>
                                                    <input type="text" class="form-control shadow-none" style="font-size: 14px;" value='<?php echo $title_data["name"]; ?>' readonly />
                                                </div>
                                                <div class="col-8 col-lg-5">
                                                    <label class="form-label text-secondary fs-6 text-capitalize">
                                                        first name *
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" style="font-size: 14px;" value='<?php echo $address_data["fname"]; ?>' readonly />
                                                </div>
                                                <div class="col-12 col-lg-5 mt-3 mt-lg-0">
                                                    <label class="form-label text-secondary fs-6 text-capitalize">
                                                        last name *
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" style="font-size: 14px;" value='<?php echo $address_data["lname"]; ?>' readonly />
                                                </div>
                                                <div class="col-4 col-lg-2 mt-3">
                                                    <label class="form-label text-secondary fs-6 text-capitalize">
                                                        code *
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" style="font-size: 14px;" value="+94" readonly />
                                                </div>
                                                <div class="col-8 col-lg-5 mt-3">
                                                    <label class="form-label text-secondary fs-6 text-capitalize">
                                                        phone number *
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" style="font-size: 14px;" value='<?php echo $address_data["mobile"]; ?>' readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 2nd card -->

                                    <!-- 3rd card -->
                                    <div class="card mb-4">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-12 pb-2 border-bottom border-1 border-secondary border-opacity-25 mb-4 text-center">
                                                    <span class="card-title fs-5 text-uppercase fw-semibold text-dark">sender details</span>
                                                </div>
                                                <div class="col-4 col-lg-2">
                                                    <label class="form-label text-secondary fs-6 text-capitalize">
                                                        title *
                                                    </label>
                                                    <?php
                                                    $title_rs = Database::search("SELECT * FROM `title` WHERE `id` = '" . $_SESSION["m"]["title_id"] . "'");
                                                    $title_data = $title_rs->fetch_assoc();
                                                    ?>
                                                    <input type="text" class="form-control shadow-none" style="font-size: 14px;" value='<?php echo $title_data["name"]; ?>' readonly />
                                                </div>
                                                <div class="col-8 col-lg-5">
                                                    <label class="form-label text-secondary fs-6 text-capitalize">
                                                        first name *
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" style="font-size: 14px;" value='<?php echo $_SESSION["m"]["fname"]; ?>' readonly />
                                                </div>
                                                <div class="col-12 col-lg-5 mt-3 mt-lg-0">
                                                    <label class="form-label text-secondary fs-6 text-capitalize">
                                                        last name *
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" style="font-size: 14px;" value='<?php echo $_SESSION["m"]["lname"]; ?>' readonly />
                                                </div>
                                                <div class="col-4 col-lg-2 mt-3">
                                                    <label class="form-label text-secondary fs-6 text-capitalize">
                                                        code *
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" style="font-size: 14px;" value="+94" readonly />
                                                </div>
                                                <div class="col-8 col-lg-5 mt-3">
                                                    <label class="form-label text-secondary fs-6 text-capitalize">
                                                        phone number *
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" style="font-size: 14px;" value='<?php echo substr($_SESSION["m"]["mobile"], 1); ?>' readonly />
                                                </div>
                                                <div class="col-12 col-lg-5 mt-3">
                                                    <label class="form-label text-secondary fs-6 text-capitalize">
                                                        email *
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" style="font-size: 14px;" value='<?php echo $_SESSION["m"]["email"]; ?>' readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 3rd card -->

                                    <!-- 4th card -->
                                    <div class="card mb-4">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-12 pb-2 border-bottom border-1 border-secondary border-opacity-25 mb-4 text-center">
                                                    <span class="card-title fs-5 text-uppercase fw-semibold text-dark">payment details</span>
                                                </div>
                                                <?php
                                                $summary_rs = Database::search("SELECT
                                                ( `meal_details`.`price` ) * ( `cart_product`.`qty` ) AS `subtotal` 
                                            FROM
                                                `cart_product`
                                                INNER JOIN `cart` ON `cart_product`.`cart_id` = `cart`.`id`
                                                INNER JOIN `meal_details` ON `cart_product`.`meal_details_id` = `meal_details`.`id`
                                                INNER JOIN `product` ON `meal_details`.`product_id` = `product`.`id`
                                                INNER JOIN `meal_type` ON `meal_details`.`meal_type_id` = `meal_type`.`id` 
                                            WHERE
                                                `cart`.`member_id` = '" . $mid . "' 
                                                AND `cart_product`.`status_id` = '1' 
                                                AND `cart_product`.`confirmation_id` = '0'");

                                                $summary_num = $summary_rs->num_rows;

                                                $subtotal = 0;
                                                for ($s = 0; $s < $summary_num; $s++) {
                                                    $summary_data = $summary_rs->fetch_assoc();
                                                    $subtotal += $summary_data["subtotal"];
                                                }

                                                $tip = round(($subtotal * 7) / 100);
                                                $nettotal = $subtotal + $tip;
                                                ?>
                                                <div class="col-12 col-lg-7 custom-border-left py-4 py-lg-0 px-lg-4">
                                                    <div class="row">
                                                        <span class="fs-6 col-6 text-start text-capitalize text-secondary">sub total</span>
                                                        <span class="fs-6 col-6 text-end"><?php echo number_format($subtotal, 2); ?></span>
                                                    </div>
                                                    <hr class="border border-secondary border-opacity-50" />
                                                    <div class="row">
                                                        <span class="fs-6 col-6 text-start text-capitalize text-secondary">dicount amount</span>
                                                        <span class="fs-6 col-6 text-end">0.00</span>
                                                    </div>
                                                    <hr class="border border-secondary border-opacity-50" />
                                                    <div class="row">
                                                        <span class="fs-6 col-6 text-start text-capitalize text-secondary">service charge(7.0%)</span>
                                                        <span class="fs-6 col-6 text-end"><?php echo number_format($tip, 2); ?></span>
                                                    </div>
                                                    <hr class="border border-secondary border-opacity-50" />
                                                    <div class="row">
                                                        <span class="fs-6 col-6 text-start text-capitalize text-secondary">net total</span>
                                                        <span class="fs-6 fw-bold col-6 text-end"><?php echo number_format($nettotal, 2); ?></span>
                                                    </div>
                                                    <div class="row mt-4 px-2">
                                                        <div class="alert alert-info fade show h-75">
                                                            <span style="font-size: 14px; text-align: justify;">
                                                                <i class="bi bi-shield-check me-2"></i>
                                                                All prices are mentioned in Sri Lankan Rupees (Rs.) and you will be charged based on the prevailing exchange rate.
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-5 mt-3 mt-lg-0">
                                                    <div class="row">
                                                        <span class="text-capitalize fw-semibold text-secondary text-center fs-6">
                                                            accepted online payment methods
                                                        </span>
                                                        <img src="images/visa.svg" class="col-6 col-lg-12 img-fluid" style="height: 140px;" />
                                                        <img src="images/mastercard.svg" class="col-6 col-lg-12 img-fluid" style="height: 140px;" />
                                                    </div>
                                                </div>
                                                <div class="col-12 d-block d-lg-none">
                                                    <hr />
                                                </div>
                                                <div class="col-12 mt-3 mt-lg-5 px-lg-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input shadow-none" type="radio" name="payment" id="online" checked>
                                                        <label class="form-check-label text-secondary" for="online">
                                                            Pay Online
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input shadow-none" type="radio" name="payment" id="onsite">
                                                        <label class="form-check-label text-secondary" for="onsite">
                                                            Pay on Delivery
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-4 px-lg-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input shadow-none" type="checkbox" value="1" id="tc">
                                                        <label class="form-check-label text-secondary" for="tc">
                                                            I have read and agreed to the <a href="terms.php" class="link link-secondary">
                                                                Terms and Conditions
                                                            </a>.
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-4 px-lg-4">
                                                    <div class="alert alert-warning alert-dismissible fade show h-75 align-content-center" role="alert">
                                                        <span style="font-size: 14px;">
                                                            <i class="bi bi-exclamation-circle"></i> Please agree to terms and conditions.</span>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 4th card -->

                                    <!-- pay button -->
                                    <?php
                                    $open = "08:00:00";
                                    $close = "22:00:00";
                                    $now = date("H:i:s");

                                    if ($now > $open && $now < $close) {
                                    ?>
                                        <div class="row">
                                            <button class="btn btn-success shadow-none" onclick="confirm('<?php echo $nettotal; ?>');">Confirm</button>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="row">
                                            <button class="btn btn-success shadow-none" disabled>Confirm</button>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <!-- pay button -->

                                </div>
                            </div>

                        </div>
                    </div>
                    <!--Main Card -->

                </div>
            </div>

        </div>
    </div>
    <!-- banner -->

    <script src="scripts/invoice.js"></script>
    <script src="scripts/bootstrap.bundle.js"></script>
    <script src="scripts/alertify.js"></script>
</body>

</html>