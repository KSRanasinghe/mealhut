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
    <title>Your Basket & Summary | Order Meal Online - Delivery or Takeaway</title>
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

            <div class="col-12 my-5 py-5">
                <div class="row">

                    <!-- main card -->
                    <div class="card shadow">
                        <div class="card-body">

                            <div class="row">
                                <!-- basket card -->
                                <div class="col-12 col-lg-8 mb-3">
                                    <div class="row">

                                        <div class="card border-0">
                                            <div class="card-body">
                                                <span class="card-title fs-5 text-uppercase fw-semibold text-dark text-start">your basket</span>
                                                <hr />
                                                <?php
                                                $open = "08:00:00";
                                                $close = "22:00:00";
                                                $now = date("H:i:s");

                                                if (!isset($_SESSION["m"]) || ($now < $open || $now > $close)) {
                                                ?>
                                                    <!-- no item -->
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <span class="text-secondary text-start fs-6 fw-bold">
                                                                No items in your basket.
                                                            </span>
                                                            <br />
                                                            <small class="text-black-50">
                                                                Your Basket looks a little empty. Why not check out some of our delighted meals.
                                                            </small>
                                                            <div class="row mt-4">
                                                                <div class="col-12 col-lg-4">
                                                                    <a href="menu.php" class="btn btn-success shadow-none text-capitalize">
                                                                        <i class="bi bi-basket2 me-2"></i> continue shopping
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- no item -->
                                                    <?php
                                                } else {
                                                    $member_id = $_SESSION["m"]["id"];

                                                    $cart_rs = Database::search("SELECT
                                                    `cart_product`.`id`,
                                                    `product`.`name` AS `product`,
                                                    `meal_type`.`name` AS `mtype`,
                                                    `meal_details`.`price`,
                                                    `cart_product`.`qty`,
                                                    ( `meal_details`.`price` ) * ( `cart_product`.`qty` ) AS `subtotal` 
                                                FROM
                                                    `cart_product`
                                                    INNER JOIN `cart` ON `cart_product`.`cart_id` = `cart`.`id`
                                                    INNER JOIN `meal_details` ON `cart_product`.`meal_details_id` = `meal_details`.`id`
                                                    INNER JOIN `product` ON `meal_details`.`product_id` = `product`.`id`
                                                    INNER JOIN `meal_type` ON `meal_details`.`meal_type_id` = `meal_type`.`id` 
                                                WHERE
                                                    `cart`.`member_id` = '" . $member_id . "' 
                                                    AND `cart_product`.`status_id` = '1' 
                                                    AND `cart_product`.`confirmation_id` = '0'");

                                                    $cart_num = $cart_rs->num_rows;

                                                    if ($cart_num == 0) {
                                                    ?>
                                                        <!-- no item -->
                                                        <div class="col-12 mt-2">
                                                            <div class="row">
                                                                <span class="text-secondary text-start fs-6 fw-bold">
                                                                    No items in your basket.
                                                                </span>
                                                                <br />
                                                                <small class="text-black-50">
                                                                    Your Basket looks a little empty. Why not check out some of our delighted meals.
                                                                </small>
                                                                <div class="row mt-4">
                                                                    <div class="col-12 col-lg-4">
                                                                        <a href="menu.php" class="btn btn-success shadow-none text-capitalize">
                                                                            <i class="bi bi-basket2 me-2"></i> continue shopping
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- no item -->
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <!-- with item -->
                                                        <div class="col-12 mt-2">
                                                            <div class="row">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered">
                                                                        <thead class="table-secondary bg-opacity-50 text-dark">
                                                                            <tr>
                                                                                <th scope="col" class="text-capitalize">item</th>
                                                                                <th scope="col" class="text-capitalize">price(rs.)</th>
                                                                                <th scope="col" class="text-capitalize">quantity</th>
                                                                                <th scope="col" class="text-capitalize">subtotal(rs.)</th>
                                                                                <th scope="col" class="text-capitalize"></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            for ($i = 0; $i < $cart_num; $i++) {
                                                                                $cart_data = $cart_rs->fetch_assoc();
                                                                                $cid = $cart_data["id"];
                                                                                $mtype = $cart_data["mtype"];
                                                                            ?>
                                                                                <tr>
                                                                                    <!-- /.product -->
                                                                                    <td class="text-capitalize">
                                                                                        <div class="row px-2 text-start">
                                                                                            <span><?php echo $cart_data["product"] . " " . "($mtype[0])"; ?></span>
                                                                                        </div>
                                                                                    </td>
                                                                                    <!-- /.price -->
                                                                                    <td class="text-capitalize">
                                                                                        <div class="row px-2 text-center">
                                                                                            <span><?php echo number_format($cart_data["price"]); ?></span>
                                                                                        </div>
                                                                                    </td>
                                                                                    <!-- /.qty -->
                                                                                    <td class="text-capitalize">
                                                                                        <div class="row px-2 text-center g-2">
                                                                                            <div class="col-12 col-md-3" onclick="qty_dec_cart('<?php echo $cid; ?>');" style="cursor: pointer;">
                                                                                                <i class="bi bi-dash-circle text-danger"></i>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6">
                                                                                                <span id="qty<?php echo $cid; ?>">
                                                                                                    <?php echo $cart_data["qty"]; ?>
                                                                                                </span>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-3" onclick="qty_inc_cart('<?php echo $cid; ?>');" style="cursor: pointer;">
                                                                                                <i class="bi bi-plus-circle text-success"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <!-- /.subtotal -->
                                                                                    <td class="text-capitalize">
                                                                                        <div class="row px-2 text-center">
                                                                                            <span><?php echo number_format($cart_data["subtotal"]); ?></span>
                                                                                        </div>
                                                                                    </td>
                                                                                    <!-- /.remove -->
                                                                                    <td class="text-capitalize">
                                                                                        <div class="row px-2 text-center mt-4 mt-md-0" onclick="removeCart('<?php echo $cid; ?>');" style="cursor: pointer;">
                                                                                            <i class="bi bi-trash3"></i>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- with item -->
                                                        <!-- /.continue shopping -->
                                                        <div class="row mt-4">
                                                            <div class="col-12 col-lg-5">
                                                                <a href="menu.php" class="btn btn-success shadow-none text-capitalize">
                                                                    <i class="bi bi-basket2 me-2"></i> continue shopping
                                                                </a>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- basket card -->
                                <!-- summary card -->
                                <div class="col-12 col-lg-4 mb-3">
                                    <div class="row  text-center">
                                        <div class="card border-0">
                                            <div class="card-body">
                                                <span class="card-title fs-5 text-uppercase fw-semibold text-dark">summary</span>
                                                <hr />
                                                <?php
                                                $open = "08:00:00";
                                                $close = "22:00:00";
                                                $now = date("H:i:s");

                                                if (!isset($_SESSION["m"]) || ($now < $open || $now > $close)) {
                                                ?>
                                                    <!-- default view -->
                                                    <div class="row">
                                                        <span class="fs-6 col-6 text-start text-capitalize">sub total</span>
                                                        <span class="fs-6 col-6 text-end">.00</span>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <span class="fs-6 col-6 text-start text-capitalize">dicount amount</span>
                                                        <span class="fs-6 col-6 text-end">.00</span>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <span class="fs-6 col-6 text-start text-capitalize">service charge(7.0%)</span>
                                                        <span class="fs-6 col-6 text-end">.00</span>
                                                    </div>
                                                    <hr>
                                                    <div class="row py-1">
                                                        <span class="small text-end text-capitalize">net total</span>
                                                        <span class="fs-4 fw-bold text-end">Rs. .00</span>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="alert alert-warning fade show align-content-center">
                                                            <span class="small">
                                                                <i class="bi bi-exclamation-triangle me-2"></i>
                                                                Minimum order value should be Rs.400.0
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="btn btn-danger text-capitalize shadow-none" disabled>
                                                            continue<i class="bi bi-arrow-right-circle ms-2"></i>
                                                        </button>
                                                    </div>
                                                    <!-- default view -->
                                                    <?php
                                                } else {
                                                    $member_id = $_SESSION["m"]["id"];

                                                    $summary_rs = Database::search("SELECT
                                                    ( `meal_details`.`price` ) * ( `cart_product`.`qty` ) AS `subtotal` 
                                                FROM
                                                    `cart_product`
                                                    INNER JOIN `cart` ON `cart_product`.`cart_id` = `cart`.`id`
                                                    INNER JOIN `meal_details` ON `cart_product`.`meal_details_id` = `meal_details`.`id`
                                                    INNER JOIN `product` ON `meal_details`.`product_id` = `product`.`id`
                                                    INNER JOIN `meal_type` ON `meal_details`.`meal_type_id` = `meal_type`.`id` 
                                                WHERE
                                                    `cart`.`member_id` = '" . $member_id . "' 
                                                    AND `cart_product`.`status_id` = '1' 
                                                    AND `cart_product`.`confirmation_id` = '0'");

                                                    $summary_num = $summary_rs->num_rows;

                                                    if ($summary_num == 0) {
                                                    ?>
                                                        <!-- default view -->
                                                        <div class="row">
                                                            <span class="fs-6 col-6 text-start text-capitalize">sub total</span>
                                                            <span class="fs-6 col-6 text-end">.00</span>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <span class="fs-6 col-6 text-start text-capitalize">dicount amount</span>
                                                            <span class="fs-6 col-6 text-end">.00</span>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <span class="fs-6 col-6 text-start text-capitalize">service charge(7.0%)</span>
                                                            <span class="fs-6 col-6 text-end">.00</span>
                                                        </div>
                                                        <hr>
                                                        <div class="row py-1">
                                                            <span class="small text-end text-capitalize">net total</span>
                                                            <span class="fs-4 fw-bold text-end">Rs. .00</span>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="alert alert-warning fade show align-content-center">
                                                                <span class="small">
                                                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                                                    Minimum order value should be Rs.400.0
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <button class="btn btn-danger text-capitalize shadow-none" disabled>
                                                                continue<i class="bi bi-arrow-right-circle ms-2"></i>
                                                            </button>
                                                        </div>
                                                        <!-- default view -->
                                                    <?php
                                                    } else {
                                                        $subtotal = 0;
                                                        for ($s = 0; $s < $summary_num; $s++) {
                                                            $summary_data = $summary_rs->fetch_assoc();
                                                            $subtotal += $summary_data["subtotal"];
                                                        }

                                                        $tip = round(($subtotal * 7) / 100);
                                                        $nettotal = $subtotal + $tip;
                                                    ?>
                                                        <!-- dynamic view -->
                                                        <div class="row">
                                                            <span class="fs-6 col-6 text-start text-capitalize">sub total</span>
                                                            <span class="fs-6 col-6 text-end"><?php echo number_format($subtotal,2); ?></span>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <span class="fs-6 col-6 text-start text-capitalize">dicount amount</span>
                                                            <span class="fs-6 col-6 text-end">0.00</span>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <span class="fs-6 col-6 text-start text-capitalize">service charge(7.0%)</span>
                                                            <span class="fs-6 col-6 text-end"><?php echo number_format($tip,2); ?></span>
                                                        </div>
                                                        <hr>
                                                        <div class="row py-1">
                                                            <span class="small text-end text-capitalize">net total</span>
                                                            <span class="fs-4 fw-bold text-end">Rs.<?php echo number_format($nettotal,2); ?></span>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="alert alert-warning fade show align-content-center">
                                                                <span class="small">
                                                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                                                    Minimum order value should be Rs.400.0
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <?php
                                                            if ($nettotal < 400) {
                                                            ?>
                                                                <button class="btn btn-danger text-capitalize shadow-none" disabled>
                                                                    continue<i class="bi bi-arrow-right-circle ms-2"></i>
                                                                </button>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a href="confirm.php" class="btn btn-danger text-capitalize shadow-none">
                                                                    continue<i class="bi bi-arrow-right-circle ms-2"></i>
                                                                </a>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <!-- dynamic view -->
                                                    <?php
                                                    }
                                                    ?>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- summary card -->

                            </div>

                        </div>
                    </div>
                    <!-- main card -->

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

    <script src="scripts/script.js"></script>
    <script src="scripts/menu.js"></script>
    <script src="scripts/bootstrap.bundle.js"></script>
    <script src="scripts/alertify.js"></script>
    <!-- tooltip -->
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>