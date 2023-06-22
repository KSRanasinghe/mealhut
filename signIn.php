<?php require "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Start | Order Meal Online - Delivery or Takeaway</title>
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

                    <!-- loginCard -->
                    <div class="card shadow custome-card" id="loginCard">
                        <div class="card-body">

                            <div class="col-12 mt-3 pb-1">
                                <h4 class="card-title text-uppercase fw-semibold text-dark text-center">let's make your order</h4>
                                <hr class="col-10 offset-1 offset-lg-2 col-lg-8" />
                            </div>

                            <div class="col-12 offset-lg-1 col-lg-10">
                                <div class="row">

                                    <div class="col-12 col-md-6 pe-3 custom-border-left custom-border-bottom">
                                        <div class="row">
                                            <?php
                                            $username = "";
                                            $password = "";

                                            if (isset($_COOKIE["username"])) {
                                                $username = $_COOKIE["username"];
                                            }

                                            if (isset($_COOKIE["password"])) {
                                                $password = $_COOKIE["password"];
                                            }
                                            ?>
                                            <div class="offset-0 col-12 pb-2">
                                                <label class="form-label fw-light text-black fs-6">Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow-none" placeholder="Mobile (Ex: 777123456) / Email *" style="font-size: 14px;" id="uname" value="<?php echo $username; ?>" />
                                            </div>
                                            <div class="offset-0 col-12 mb-4">
                                                <label class="form-label fw-light text-black fs-6">Password <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control shadow-none" placeholder="Password *" style="font-size: 14px;" id="spswd" value="<?php echo $password; ?>" />
                                            </div>
                                            <div class="offset-0 col-12 pb-2 pt-2">
                                                <div class="form-check">
                                                    <input class="form-check-input shadow-none" type="checkbox" value="1" id="rm">
                                                    <label class="form-check-label fw-light text-black fs-6" for="rm">
                                                        Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="offset-0 col-12 pb-2 pt-2">
                                                <button class="btn btn-success btn-sm shadow-none col-12" onclick="signin();">
                                                    <i class="bi bi-person-check fs-5"></i>
                                                    <span class="ps-3">Log in with MealHut</span>
                                                </button>
                                            </div>
                                            <div class="offset-0 col-12 pb-4">
                                                <a href="resetpassword.php" class="text-success" style="text-decoration: none;">
                                                <i class="bi bi-arrow-repeat fs-5"></i> Reset Password</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ps-3">
                                        <div class="row">
                                            <div class="offset-0 col-12 mt-4 pt-1 pb-2">
                                                <button class="btn btn-secondary btn-sm shadow-none col-12 text-white">
                                                    <i class="bi bi-people fs-5"></i>
                                                    <span class="ps-3" onclick="backHome();">Continue as a guest</span>
                                                </button>
                                            </div>
                                            <div class="offset-0 col-12 mt-2 pb-1">
                                                <button class="btn btn-danger btn-sm shadow-none col-12" onclick="changeView();">
                                                    <i class="bi bi-person-plus fs-5"></i>
                                                    <span class="ps-3">Create an account</span>
                                                </button>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- loginCard -->

                    <!-- registerCard -->
                    <div class="card shadow custome-card d-none" id="registerCard">
                        <div class="card-body">

                            <div class="col-12 mt-3 pb-1">
                                <h4 class="card-title text-uppercase fw-semibold text-dark text-center">
                                    Become a mealhut friend</h4>
                                <hr class="col-10 offset-1 offset-lg-2 col-lg-8" />
                            </div>

                            <div class="col-12 offset-lg-1 col-lg-10">
                                <div class="row">

                                    <div class="col-12 col-md-6">
                                        <div class="row">

                                            <div class=" col-12 pb-3">
                                                <div class="row">
                                                    <div class="offset-0 col-4">
                                                        <label class="form-label fw-light text-black fs-6">
                                                            Title <span class="text-danger">*</span></label>
                                                        <select class="form-select shadow-none" style="height: 35px; font-size: 14px;" required id="title">
                                                            <option value="0" selected disabled></option>
                                                            <?php
                                                            $title_rs = Database::search("SELECT * FROM `title`");
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
                                                    <div class="offset-0 col-8">
                                                        <label class="form-label fw-light text-black fs-6">
                                                            First Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control shadow-none" placeholder="First Name" required style="font-size: 14px;" id="fname" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="offset-0 col-12 pb-3">
                                                <label class="form-label fw-light text-black fs-6">
                                                    Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow-none" placeholder="Last Name" required style="font-size: 14px;" id="lname" />
                                            </div>
                                            <div class=" col-12 mb-4">
                                                <div class="row">
                                                    <div class="offset-0 col-3">
                                                        <label class="form-label fw-light text-black fs-6">
                                                            Code <span class="text-danger">*</span></label>
                                                        <input type="text" value="+94" class="form-control shadow-none" readonly style="font-size: 14px;" />
                                                    </div>
                                                    <div class="offset-0 col-9">
                                                        <label class="form-label fw-light text-black fs-6">
                                                            Phone No <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control shadow-none" required style="font-size: 14px;" pattern="[1-9]" placeholder="Mobile (Ex: 777123456)" id="mobile" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="row">

                                            <div class=" col-12 pb-3">
                                                <label class="form-label fw-light text-black fs-6">
                                                    Email <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow-none" placeholder="example@gmail.com" required style="font-size: 14px;" id="email" />
                                            </div>
                                            <div class="offset-0 col-12 mb-2 pb-2">

                                                <label for="pswd" class="form-label">
                                                    Password <span class="text-danger">*</span></label>

                                                <input type="password" class="form-control shadow-none" aria-describedby="passwordHelpBlock" required id="pswd" style="font-size: 14px;" />

                                                <div id="passwordHelpBlock" class="form-text" style="font-size: 13px;">
                                                Your password must be 8-20 characters long, contain at least one uppercase,one lowercase, one number and one symbol (like $@_), and must not contain spaces or emoji.
                                                </div>
                                            </div>
                                            <div class="offset-0 col-12 pb-3">
                                                <label class="form-label fw-light text-black fs-6">
                                                    Confirm Password <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control shadow-none" style="font-size: 14px;" required id="repswd" />
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 mt-3 mb-4">
                                        <div class="row">

                                            <div class="col-12 col-lg-6">
                                                <div class="form-check">
                                                    <input class="form-check-input shadow-none" type="radio" name="flexRadioDefault" id="phone">
                                                    <label class="form-check-label fw-light text-black fs-6" for="phone">
                                                        Use phone number as username
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-check">
                                                    <input class="form-check-input shadow-none" type="radio" name="flexRadioDefault" id="mail">
                                                    <label class="form-check-label fw-light text-black fs-6" for="mail">
                                                        Use email as username
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="alert alert-warning alert-dismissible fade show h-75 align-content-center" role="alert">
                                                <span style="font-size: 14px;">
                                                    <i class="bi bi-exclamation-circle"></i> Please select one username option.</span>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 pt-3 mb-3">
                                        <div class="row">
                                            <button class="btn btn-success shadow-none" onclick="register();">Register</button>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <div class="row">
                                            <button class="btn btn-danger shadow-none" onclick="changeView();">Already have an account</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- registerCard -->

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