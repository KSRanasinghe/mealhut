<?php
require "connection.php";
date_default_timezone_set('Asia/Colombo');

if (isset($_GET["id"])) {
    $mid = $_GET["id"];

    $meal_rs = Database::search("SELECT
    product.`name`,
    product.description,
    category.`id` AS `cid`,
    category.`name` AS `cname`,
    meal_type.`name` AS mtype,
    meal_details.price,
    images.`code` 
FROM
    meal_details
    INNER JOIN product ON meal_details.product_id = product.id
    INNER JOIN category ON product.category_id = category.id
    INNER JOIN images ON meal_details.id = images.meal_details_id
    INNER JOIN meal_type ON meal_details.meal_type_id = meal_type.id 
WHERE
    meal_details.id = '" . $mid . "'");
    $meal_num = $meal_rs->num_rows;

    if ($meal_num == 1) {
        $meal_data = $meal_rs->fetch_assoc();
        $cid = $meal_data["cid"];
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Menu | Order Meal Online - Delivery or Takeaway</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
            <link rel="icon" href="images/mealhut.png" />
            <link rel="stylesheet" href="./css/style.css" />
            <link rel="stylesheet" href="./css/bootstrap.css" />
            <link rel="stylesheet" href="./css/alertify.css" />
        </head>

        <body class="banner-signin">

            <!-- banner -->
            <div class="container-fluid me-lg-0 pe-lg-0">
                <?php require "customheader.php"; ?>
                <div class="row mx-auto">

                    <div class="col-12 mt-5">
                        <!-- /.single product view -->
                        <div class="row mt-5">
                            <!-- /.image -->
                            <div class="col-12 col-md-5">
                                <div class="card border-success border-opacity-50 shadow effect">
                                    <img src='<?php echo $meal_data["code"]; ?>' class="card-img" />
                                </div>
                            </div>
                            <!-- /.details -->
                            <div class="col-12 col-md-7 mt-3 mt-md-0">
                                <div class="card shadow">
                                    <div class="card-body py-4 px-5">
                                        <h1 class="text-capitalize text-success fw-bold"><?php echo $meal_data["name"]; ?></h1>
                                        <div class="mt-4">
                                            <span class="text-capitalize fw-semibold">
                                                <span class="text-dark">category : </span>
                                                <span class="text-secondary opacity-75"><?php echo $meal_data["cname"]; ?></span>
                                            </span>
                                        </div>
                                        <div class="mt-3">
                                            <span class="text-capitalize fw-semibold">
                                                <span class="text-dark">meal type : </span>
                                                <span class="text-secondary opacity-75"><?php echo $meal_data["mtype"]; ?></span>
                                            </span>
                                        </div>
                                        <div class="mt-3">
                                            <span class="fw-semibold">
                                                <span class="text-capitalize text-dark">descripton : </span>
                                                <span class="text-secondary opacity-75"><?php echo $meal_data["description"]; ?></span>
                                            </span>
                                        </div>
                                        <div class="mt-5">
                                            <span class="text-capitalize fw-semibold">
                                                <span class="fs-2 text-dark opacity-75">rs.<?php echo $meal_data["price"]; ?>.00</span>
                                            </span>
                                        </div>
                                        <div class="mt-3">
                                            <span class="text-capitalize fw-semibold">
                                                <span class="text-dark">maximum preparation time : </span>
                                                <span class="text-secondary opacity-75">50 minutes</span>
                                            </span>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-md-8 col-lg-6">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <button class="btn btn-outline-success col-12 shadow-none" onclick="qty_dec();">
                                                            <i class="bi bi-dash-lg"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control border-1 border-success border-opacity-75 
                                                        shadow-none text-center fw-semibold" value="1" readonly id="qty" />
                                                    </div>
                                                    <div class="col-3">
                                                        <button class="btn btn-outline-success col-12 shadow-none" onclick="qty_inc();">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-8 col-lg-6 mt-3 mt-lg-0">
                                                <?php
                                                $open = "08:00:00";
                                                $close = "22:00:00";
                                                $now = date("H:i:s");

                                                if ($now < $open || $now > $close) {
                                                ?>
                                                    <button class="col-12 btn btn-success shadow-none text-capitalize" disabled>
                                                        add to cart
                                                    </button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class="col-12 btn btn-success shadow-none text-capitalize" onclick="addToCart('<?php echo $mid; ?>');">
                                                        add to cart
                                                    </button>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.related products -->
                        <div class="row my-5">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header text-capitalize pt-3">
                                        <h3>related items</h3>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4">
                                            <!-- /.card -->
                                            <?php
                                            $related_meal_rs = Database::search("SELECT
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
                                        AND meal_details.id != '" . $mid . "' 
                                        AND meal_details.status_id = '1'");
                                            $related_meal_num = $related_meal_rs->num_rows;

                                            if ($related_meal_num > 0) {
                                                for ($x = 0; $x < $related_meal_num; $x++) {
                                                    $related_meal_data = $related_meal_rs->fetch_assoc();
                                                    $rmid = $related_meal_data["id"];
                                            ?>

                                                    <!-- /.item card -->
                                                    <div class="col">
                                                        <div class="card h-100 shadow-lg border-success border-opacity-50">
                                                            <div class="effect">
                                                                <?php
                                                                if ($related_meal_data["mtid"] == 1) {
                                                                ?>
                                                                    <img src='<?php echo $related_meal_data["code"]; ?>' class="card-img-top" alt="" />
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <a href='<?php echo "customizemeal.php?id=" . $rmid; ?>' class="link text-decoration-none" style="cursor: pointer;">
                                                                        <img src='<?php echo $related_meal_data["code"]; ?>' class="card-img-top" alt="" />
                                                                    </a>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="card-body text-center bg-light">
                                                                <h5 class="card-title text-capitalize fw-bold"><?php echo $related_meal_data["name"]; ?></h5>
                                                                <?php
                                                                if ($related_meal_data["mtid"] != 1) {
                                                                ?>
                                                                    <p class="card-text text-secondary fw-semibold opacity-75 text-capitalize">
                                                                        <?php echo $related_meal_data["mtype"]; ?>
                                                                    </p>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="card-footer text-center border-success border-opacity-50">
                                                                <span class="text-success fw-bold mt-3">
                                                                    Rs.<?php echo $related_meal_data["price"]; ?>.00
                                                                </span>
                                                                <?php
                                                                $open = "9";
                                                                $close = "22";
                                                                $now = date("H");

                                                                if ($now > $open && $now < $close) {
                                                                ?>
                                                                    <div class="row px-3 my-2">
                                                                        <button class="btn btn-outline-success shadow-none" onclick="dirAddToCart('<?php echo $rmid; ?>');">Add to Cart</button>
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
                        </div>
                    </div>

                </div>
            </div>
            <!-- banner -->

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

<?php
    } else {
        echo "Server error";
    }
} else {
    echo "Something went wrong";
}
?>