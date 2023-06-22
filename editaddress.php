<?php require "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Address | Order Meal Online - Delivery or Takeaway</title>
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
                        <?php
                        if (isset($_SESSION["ad"])) {
                            $address = $_SESSION["ad"];
                        ?>

                            <!-- Card -->
                            <div class="card shadow custome-card">
                                <div class="card-body">

                                    <div class="col-12 mt-3 pb-1">
                                        <h4 class="card-title text-uppercase fw-semibold text-dark text-center">edit address</h4>
                                        <hr class="col-12 offset-lg-1 col-lg-10" />
                                    </div>

                                    <div class="col-12 justify-content-center">
                                        <div class="row">

                                            <div class="col-12 offset-lg-1 col-lg-10">
                                                <div class="row">

                                                    <div class="col-12 pb-3">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-4">
                                                                <label class="form-label fw-light text-black fs-6">
                                                                    Title <span class="text-danger">*</span></label>
                                                                <select class="form-select shadow-none" style="height: 35px; font-size: 14px;" required id="title">
                                                                    <option value="0" disabled></option>
                                                                    <?php
                                                                    $title_id_rs = Database::search("SELECT * FROM `title` 
                                                            WHERE `id` = '" . $address["title_id"] . "'");
                                                                    $title_id_data = $title_id_rs->fetch_assoc();
                                                                    ?>
                                                                    <option value="<?php echo $title_id_data["id"]; ?>" selected>
                                                                        <?php echo $title_id_data["name"]; ?></option>

                                                                    <?php
                                                                    $title_rs = Database::search("SELECT * FROM `title` 
                                                            WHERE `id` != '" . $title_id_data["id"] . "'");
                                                                    $title_num = $title_rs->num_rows;

                                                                    for ($i = 0; $i < $title_num; $i++) {
                                                                        $title_data = $title_rs->fetch_assoc();
                                                                    ?>
                                                                        <option value='<?php echo $title_data["id"]; ?>'><?php echo $title_data["name"]; ?></option>

                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-lg-8 mt-3 mt-lg-0">
                                                                <label class="form-label fw-light text-black fs-6">
                                                                    First Name <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control shadow-none" required style="font-size: 14px;" id="fname" value="<?php echo $address["fname"]; ?>" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 pb-3">
                                                        <label class="form-label fw-light text-black fs-6">
                                                            Last Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control shadow-none" required style="font-size: 14px;" id="lname" value="<?php echo $address["lname"]; ?>" />
                                                    </div>

                                                    <div class="col-12 mb-4">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-4">
                                                                <label class="form-label fw-light text-black fs-6">
                                                                    Code <span class="text-danger">*</span></label>
                                                                <input type="text" value="+94" class="form-control shadow-none" readonly style="font-size: 14px;" />
                                                            </div>
                                                            <div class="col-12 col-lg-8 mt-3 mt-lg-0">
                                                                <label class="form-label fw-light text-black fs-6">
                                                                    Phone No <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control shadow-none" required style="font-size: 14px;" pattern="[1-9]" placeholder="Mobile (Ex: 777123456)" id="mobile" value="<?php echo $address["mobile"]; ?>" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mt-3 mb-2">
                                                        <span class="form-label fs-5 fw-light text-black text-capitalize text-start">location details</span>
                                                        <hr />
                                                    </div>

                                                    <div class="col-12 pb-3">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-4">
                                                                <label class="form-label fw-light text-black fs-6">
                                                                    House No. <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control shadow-none" placeholder="Ex: 44/20A" style="font-size: 14px;" id="hno" value="<?php echo $address["house_no"]; ?>" />
                                                            </div>
                                                            <div class="col-12 col-lg-8 mt-3 mt-lg-0">
                                                                <label class="form-label fw-light text-black fs-6">Street Name (optional)</label>
                                                                <input type="text" class="form-control shadow-none" style="font-size: 14px;" placeholder="Street Name" id="street" value="<?php echo $address["street"]; ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 pb-3">
                                                        <label class="form-label fw-light text-black fs-6">
                                                            Province <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control shadow-none" value="Western Province" readonly style="font-size: 14px;" />
                                                    </div>
                                                    <div class="col-12 pb-3">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6">
                                                                <label class="form-label fw-light text-black fs-6">
                                                                    District <span class="text-danger">*</span></label>
                                                                <select class="form-select shadow-none" style="height: 35px; font-size: 14px;" required id="dis">
                                                                    <option value="0" disabled></option>
                                                                    <?php
                                                                    $district_id_rs = Database::search("SELECT * FROM `district` 
                                                            WHERE `id` = '" . $address["district_id"] . "'");
                                                                    $district_id_data = $district_id_rs->fetch_assoc();
                                                                    ?>
                                                                    <option value='<?php echo $district_id_data["id"]; ?>' selected>
                                                                        <?php echo $district_id_data["name"]; ?>
                                                                    </option>

                                                                    <?php
                                                                    $district_rs = Database::search("SELECT * FROM `district`
                                                                     WHERE `id` != '" . $district_id_data["id"] . "'");
                                                                    $district_num = $district_rs->num_rows;

                                                                    for ($i = 0; $i < $district_num; $i++) {
                                                                        $district_data = $district_rs->fetch_assoc();
                                                                    ?>
                                                                        <option value='<?php echo $district_data["id"]; ?>'>
                                                                            <?php echo $district_data["name"]; ?>
                                                                        </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                                                                <label class="form-label fw-light text-black fs-6">
                                                                    Nearest City <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control shadow-none" required style="font-size: 14px;" id="city" value="<?php echo $address["city"]; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 pb-2k mb-4">
                                                        <label class="form-label fw-light text-black fs-6">
                                                            Address Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control shadow-none" placeholder="Ex: John's Home" required style="font-size: 14px;" id="aname" value="<?php echo $address["name"]; ?>"/>
                                                    </div>

                                                    <button class="col-12 mb-3 btn btn-success shadow-none" 
                                                    onclick="update(<?php echo $address['id']; ?>);">Save</button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Card -->
                        <?php
                        } else {
                        ?>
                            <script>
                                window.location = "addresslist.php";
                            </script>
                        <?php
                        }
                        ?>

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