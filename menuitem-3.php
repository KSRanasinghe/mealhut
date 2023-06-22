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
    <title>Menu | Order Meal Online - Delivery or Takeaway</title>
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

            <div class="col-12 offset-lg-1 col-lg-10 mt-2 mb-5 py-5">
                <div class="row">

                    <?php
                    $category_rs = Database::search("SELECT * FROM `category` WHERE `id` = '3'");
                    $category_num = $category_rs->num_rows;

                    $category_data = $category_rs->fetch_assoc();
                    $cid = $category_data["id"];
                    ?>

                    <!-- Card -->
                    <div class="card shadow custome-card-4">
                            <div class="card-body">
                                
                                <div class="col-12 mt-2 pb-1">
                                    <h4 class="card-title fs-3 text-uppercase fw-bold text-dark text-center"><?php echo $category_data["name"]; ?></h4>
                                    <hr class="col-12" />
                                </div>

                                <div class="col-12 justify-content-center">
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                                        <?php
                                        $meal_rs = Database::search("SELECT
                                        meal_details.id,
                                        product.`name`,
                                        meal_details.`meal_type_id` AS `mtid`,
                                        meal_type.`name` AS mtype,
                                        meal_details.price,
                                        images.`code` 
                                    FROM
                                        meal_details
                                        INNER JOIN product ON meal_details.product_id = product.id
                                        INNER JOIN images ON meal_details.id = images.meal_details_id
                                        INNER JOIN meal_type ON meal_details.meal_type_id = meal_type.id 
                                    WHERE
                                        product.category_id = '" . $cid . "' 
                                        AND meal_details.status_id = '1'");
                                        $meal_num = $meal_rs->num_rows;

                                        if ($meal_num > 0) {
                                            for ($x = 0; $x < $meal_num; $x++) {
                                                $meal_data = $meal_rs->fetch_assoc();
                                                $mid = $meal_data["id"];
                                        ?>

                                                <!-- /.item card -->
                                                <div class="col">
                                                    <div class="card h-100 shadow-lg border-success border-opacity-50">
                                                        <div class="effect">
                                                            <?php
                                                            if ($meal_data["mtid"] == 1) {
                                                            ?>
                                                                <img src='<?php echo $meal_data["code"]; ?>' class="card-img-top" alt="" />
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a href='<?php echo "customizemeal.php?id=" . $mid; ?>' class="link text-decoration-none" style="cursor: pointer;">
                                                                    <img src='<?php echo $meal_data["code"]; ?>' class="card-img-top" alt="" />
                                                                </a>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="card-body text-center bg-light">
                                                            <h5 class="card-title text-capitalize fw-bold"><?php echo $meal_data["name"]; ?></h5>
                                                            <?php
                                                            if ($meal_data["mtid"] != 1) {
                                                            ?>
                                                                <p class="card-text text-secondary fw-semibold opacity-75 text-capitalize">
                                                                    <?php echo $meal_data["mtype"]; ?>
                                                                </p>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="card-footer text-center border-success border-opacity-50">
                                                            <span class="text-success fw-bold mt-3">
                                                                Rs.<?php echo $meal_data["price"]; ?>.00
                                                            </span>
                                                            <?php
                                                            $open = "08:00:00";
                                                            $close = "22:00:00";
                                                            $now = date("H:i:s");

                                                            if ($now > $open && $now < $close) {
                                                            ?>
                                                                <div class="row px-3 my-2">
                                                                    <button class="btn btn-outline-success shadow-none" onclick="dirAddToCart('<?php echo $mid; ?>');">Add to Cart</button>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
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
                    <!-- Card -->

                    <div class="col-12 offset-lg-3 col-lg-6 mt-4 pt-3">
                        <div class="row">
                            <div class="alert alert-info fade show align-content-center">
                                <span style="font-size: 16px;">
                                    <i class="bi bi-info-circle me-2"></i>
                                    To view our all meal deals click the menu button.
                                </span>
                            </div>
                        </div>
                    </div>

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
</body>

</html>