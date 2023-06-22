<?php require "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request | Order Meal Online - Delivery or Takeaway</title>
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
        ?>
        <div class="row mx-auto">

            <div class="col-12 offset-lg-3 col-lg-6">
                <div class="row">

                    <!-- Card -->
                    <div class="card shadow custome-card" id="emailcard">
                        <div class="card-body">

                            <div class="col-12 mt-3 pb-1">
                                <h4 class="card-title text-uppercase fw-semibold text-dark text-center">Password Reset Request</h4>
                                <hr class="col-12 offset-lg-2 col-lg-8" />
                            </div>

                            <div class="col-12 justify-content-center">
                                <div class="row">

                                    <div class="col-12 offset-lg-2 col-lg-8">
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="form-text mb-3" style="font-size: 14px; text-align: justify;">
                                                        The verification code will be sent to your email address provided below. After submiting this request if you don't recieve an email please check your <span class="text-uppercase">spam/junk</span> folders or contact us.
                                                    </div>

                                                    <label class="form-label fw-light text-black fs-6 text-capitalize mt-2">
                                                        email<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control shadow-none mb-3" placeholder="MealHut Registered Email" required style="font-size: 14px;" id="email" />

                                                    <button class="btn btn-success shadow-none mt-1 mb-3" onclick="submit();">Submit</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Card -->

                     <!-- Card reset -->
                     <div class="card shadow custome-card d-none" id="resetcard">
                            <div class="card-body">

                                <div class="col-12 mt-3 pb-1">
                                    <h4 class="card-title text-uppercase fw-semibold text-dark text-center">reset your password</h4>
                                    <hr class="col-12 offset-lg-2 col-lg-8" />
                                </div>

                                <div class="col-12 justify-content-center">
                                    <div class="row">

                                        <div class="col-12 offset-lg-2 col-lg-8">
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="row">
                                                        <label for="expswd" class="form-label text-capitalize">
                                                            verification code <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control shadow-none mb-3" required id="vc" style="font-size: 14px;" />

                                                        <label for="newpswd" class="form-label text-capitalize">
                                                            new Password <span class="text-danger">*</span></label>

                                                        <input type="password" class="form-control shadow-none" aria-describedby="passwordHelpBlock" required id="newpswd" style="font-size: 14px;" />

                                                        <div id="passwordHelpBlock" class="form-text mb-3" style="font-size: 13px;">
                                                            Your password must be 8-20 characters long, contain at least one uppercase,one lowercase, one number and one symbol (like $@_), and must not contain spaces or emoji.
                                                        </div>
                                                        
                                                        <label for="ncpswd" class="form-label text-capitalize">
                                                            confirm new Password <span class="text-danger">*</span></label>

                                                        <input type="password" class="form-control shadow-none mb-4" required id="ncpswd" style="font-size: 14px;" />

                                                        <button class="btn btn-success shadow-none mt-1 mb-3" 
                                                        onclick="resetPassword();">Reset Password</button>

                                                        <button class="btn btn-light border border-1 border-secondary shadow-none mt-1 mb-3" 
                                                        onclick="backToEmail();">Back</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Card reset-->

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