<?php require "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | Order Meal Online - Delivery or Takeaway</title>
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
            $mid = $_SESSION['m']['id'];
        ?>
            <div class="row mx-auto">

                <div class="col-12 offset-lg-2 col-lg-8">
                    <div class="row">

                        <!-- Card -->
                        <div class="card shadow custome-card">
                            <div class="card-body">

                                <div class="col-12 mt-3 pb-1">
                                    <h4 class="card-title text-uppercase fw-semibold text-dark text-center">my account</h4>
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
                                                            WHERE `id` = '" . $_SESSION["m"]["title_id"] . "'");
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
                                                        <div class="col-12 col-lg-8 pt-3 pt-lg-0">
                                                            <label class="form-label fw-light text-black fs-6">
                                                                First Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control shadow-none" value="<?php echo $_SESSION["m"]["fname"]; ?>" required style="font-size: 14px;" id="fname" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 pb-3">
                                                    <label class="form-label fw-light text-black fs-6">
                                                        Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control shadow-none" value="<?php echo $_SESSION["m"]["lname"]; ?>" required style="font-size: 14px;" id="lname" />
                                                </div>
                                                <div class="col-12 pb-3">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-4">
                                                            <label class="form-label fw-light text-black fs-6">
                                                                Code <span class="text-danger">*</span></label>
                                                            <input type="text" value="+94" class="form-control shadow-none" readonly style="font-size: 14px;" />
                                                        </div>
                                                        <div class="col-12 col-lg-8 pt-3 pt-lg-0">
                                                            <label class="form-label fw-light text-black fs-6">
                                                                Phone No <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control shadow-none" 
                                                            value="<?php echo substr($_SESSION["m"]["mobile"],1); ?>" 
                                                            style="font-size: 14px;" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-3 pb-2">
                                                    <label class="form-label fw-light text-black fs-6">
                                                        Email <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control shadow-none" value="<?php echo $_SESSION["m"]["email"]; ?>" readonly style="font-size: 14px;" />
                                                </div>
                                                <div class="col-12 pb-3 mb-3">
                                                    <div class="row">
                                                        <?php
                                                        $usernameOP = $_SESSION["m"]["username_type_id"];

                                                        if ($usernameOP == 1) {
                                                        ?>
                                                            <div class="col-12 col-lg-6 mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input shadow-none" type="radio" name="flexRadioDefault" id="phone" checked>
                                                                    <label class="form-check-label fw-light text-black fs-6" for="phone">
                                                                        Use phone number as username
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6 mb-2">
                                                                <label class="form-label fw-light text-black fs-6">
                                                                    (verified)
                                                                </label>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input shadow-none" type="radio" name="flexRadioDefault" id="mail">
                                                                    <label class="form-check-label fw-light text-black fs-6" for="mail">
                                                                        Use email as username
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        } else if ($usernameOP == 2) {
                                                        ?>
                                                            <div class="col-12 mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input shadow-none" type="radio" name="flexRadioDefault" id="phone">
                                                                    <label class="form-check-label fw-light text-black fs-6" for="phone">
                                                                        Use phone number as username
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input shadow-none" type="radio" name="flexRadioDefault" id="mail" checked>
                                                                    <label class="form-check-label fw-light text-black fs-6" for="mail">
                                                                        Use email as username
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <label class="form-label fw-light text-black fs-6">
                                                                    (verified)
                                                                </label>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-3">
                                                            <div class="row">
                                                                <div class="alert alert-warning alert-dismissible fade show h-75 align-content-center">
                                                                    <span style="font-size: 14px;">
                                                                    <i class="bi bi-exclamation-triangle me-2"></i> If you change your username option, you have to Sign In agian after edit your account.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <div class="col-12 pb-3">
                                                    <div class="row">
                                                        <button class="btn btn-success shadow-none" 
                                                        onclick="save(<?php echo $mid; ?>);">Save</button>
                                                    </div>
                                                </div>

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

    <script src="scripts/script.js"></script>
    <script src="scripts/signin.js"></script>
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