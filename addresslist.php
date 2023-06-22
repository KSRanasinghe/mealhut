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
    <title>Address List | Order Meal Online - Delivery or Takeaway</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/alertify.css" />
    <link rel="icon" href="images/mealhut.png" />
</head>

<body class="banner-signin">

    <!-- banner -->
    <div class="container-fluid">
        <?php
        require "header.php";

        if (isset($_SESSION["m"])) {
        ?>
            <div class="row mx-auto">

                <div class="col-12 offset-lg-2 col-lg-8">
                    <div class="row">

                        <!-- Card -->
                        <div class="card shadow custome-card">
                            <div class="card-body">

                                <div class="col-12 offset-lg-1 col-lg-10 mt-3 pb-1">
                                    <div class="row">
                                        <div class="col-12 col-lg-9">
                                            <h4 class="card-title text-uppercase fw-semibold text-dark text-center">my addresses</h4>
                                            <hr class="col-12" />
                                        </div>
                                        <div class="col-12 col-lg-3 pt-lg-2">
                                            <button class="btn btn-success shadow-none col-12" onclick="add();">
                                                <i class="bi bi-plus-circle me-2"></i>Add</button>
                                        </div>
                                    </div>

                                </div>

                                <!-- have address -->

                                <?php

                                $open = "08:00:00";
                                $close = "22:00:00";
                                $now = date("H:i:s");

                                if ($now > $open && $now < $close) {

                                    $mid = $_SESSION["m"]["id"];

                                    $address_rs = Database::search("SELECT * FROM `address` WHERE `member_id` = '" . $mid . "' AND `status_id` = '1'");
                                    $address_num = $address_rs->num_rows;

                                    if ($address_num > 0) {

                                        for ($i = 0; $i < $address_num; $i++) {
                                            $address_data = $address_rs->fetch_assoc();

                                            $district_rs = Database::search("SELECT * FROM `district` WHERE `id` = '" . $address_data["district_id"] . "'");
                                            $district_data = $district_rs->fetch_assoc();
                                ?>
                                            <div class="col-12 offset-lg-1 col-lg-10 mt-3 pb-1 justify-content-center" style="margin-bottom: 4%;">
                                                <div class="row">
                                                    <div class="card shadow">
                                                        <div class="card-body">

                                                            <div class="col-12">
                                                                <div class="row">

                                                                    <div class="col-12 col-lg-7">
                                                                        <h5 class="card-title text-uppercase fw-bold"><?php echo $address_data["name"]; ?></h5>
                                                                        <span class="text-black-50 text-capitalize" style="font-size: 14px;">
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

                                                                    <div class="col-12 col-lg-5 g-2 g-lg-0">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <?php
                                                                                if (isset($_GET["ch"])) {
                                                                                    $ch = $_GET["ch"];
                                                                                ?>
                                                                                    <button class="btn btn-success shadow-none col-12" onclick="selectAddress('<?php echo $address_data['id']; ?>','<?php echo $ch;  ?>');">
                                                                                        Select
                                                                                    </button>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <button class="btn btn-success shadow-none col-12" onclick="selectAddress('<?php echo $address_data['id']; ?>','<?php echo '0';  ?>');">
                                                                                        Select
                                                                                    </button>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                            <div class="col-3">
                                                                                <button class="btn btn-light border border-1 shadow-none col-12" onclick='sendId(<?php echo $address_data["id"]; ?>);'>
                                                                                    <i class="bi bi-pen"></i></button>
                                                                            </div>
                                                                            <div class="col-3">
                                                                                <button class="btn btn-danger shadow-none col-12" onclick="remove(<?php echo $address_data['id']; ?>);">
                                                                                    <i class="bi bi-trash3"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <div class="col-12 offset-lg-1 col-lg-10 mt-2">
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

                                <!-- have address -->

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

    <script src="scripts/script.js"></script>
    <script src="scripts/address.js"></script>
    <script src="scripts/bootstrap.bundle.js"></script>
    <script src="scripts/alertify.js"></script>
</body>

</html>

<?php
        } else {
?>
    <script>
        window.location = "signIn.php";
    </script>
<?php
        }
?>