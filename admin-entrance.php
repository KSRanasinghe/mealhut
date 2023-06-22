<?php require "connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Entrance | MealHut - Delivery or Takeaway</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/alertify.css" />
    <link rel="icon" href="images/mealhut.png" />
</head>

<body class="bg-light">

    <div class="container-fluid">
        <div class="row">

            <!-- title -->

            <div class="col-12 text-center mt-5 pt-3">
                <div class="row">
                    <span style="font-weight: 700; font-size: 2.5rem;" class="mb-2">
                        <span class=" text-success">M</span>eal<span class="text-success">H</span>ut<span class="text-success">.</span>
                    </span>
                </div>
            </div>

            <!-- title -->


            <div class="col-12 offset-lg-3 col-lg-6 my-4">

                <!-- login card -->

                <div class="card shadow" id="loginCard">
                    <div class="card-body p-3">
                        <div class="col-12 offset-lg-2 col-lg-8">

                            <div class="text-center">
                                <h4 class="text-center pt-1">Log into Admin Panel</h4>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark text-capitalize" style="font-size: 14px;">
                                    username<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control shadow-none mb-2" required style="font-size: 14px;" placeholder="example@gmail.com" id="uname" />

                                <label class="form-label text-dark text-capitalize" style="font-size: 14px;">
                                    password<span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control shadow-none mb-3" required style="font-size: 14px;" placeholder="Password" id="lgpswd" />

                                <button class="btn btn-success shadow-none mt-1 mb-3 col-12" onclick="login();">Log In</button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- login card -->

            </div>

            <!-- footer -->

            <div class="col-12 d-none d-lg-block justify-content-center" style="margin-top: 8%;">
                <p class="text-center text-dark" style="font-size: 14px;">
                    Copyright &copy; MealHut &trade;. All rights reserved. The MealHut name, logos, and related marks are trademarks of MealHut, Inc.
                </p>
            </div>
            <div class="col-12 d-block d-lg-none justify-content-center" style="margin-top: 9%;">
                <p class="text-center text-dark" style="font-size: 14px;">
                    Copyright &copy; MealHut Sri Lanka.
                </p>
            </div>

            <!-- footer -->
        </div>
    </div>

    <script src="scripts/adminEntrance.js"></script>
    <script src="scripts/bootstrap.bundle.js"></script>
    <script src="scripts/alertify.js"></script>
</body>

</html>