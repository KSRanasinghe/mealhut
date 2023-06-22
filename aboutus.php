<?php require "connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Order Meal Online - Delivery or Takeaway</title>
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

                    <!-- Card -->
                    <div class="card shadow custome-card-2">
                        <div class="card-body">

                            <div class="col-12 mt-3 pb-1">
                                <h4 class="card-title text-uppercase fw-semibold text-dark text-center">about us</h4>
                                <hr class="col-12" />
                            </div>

                            <div class="col-12 justify-content-center">
                                <div class="row">

                                    <p class="form-text about">Welcome to MealHut Lanka (PVT).Ltd, your number one source for all delighted meals. We're dedicated to giving you the very best of meals, with a focus on superior taste, convenient and affordable prices, and on-demand supply.</p>
                                    <p class="form-text about">Founded in 2005 by R.L.K.S.Ranasinghe, MealHut Lanka (PVT).Ltd has been on a very successful journey from where our Gampaha branch is today. Accordingly, our company currently has 4 branches and you can see those outlets in the cities of Gampaha, Kadawatha, Kiribathgoda, and Colombo.</p>
                                    <p class="form-text about">When R.L.K.S.Ranasinghe first started out, his passion for make meals drove him to do lots of research on new tasting food, so that MealHut Lanka (PVT).Ltd can offer you meals with a taste unique to us. We now serve customers at all over above mentioned places, and are thrilled that we're able to turn our passion into our own website.</p>
                                    <p class="form-text about">We hope you enjoy our meals as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to
                                        <a href="feedback.php" style="text-decoration: none;">contact us</a>.
                                    </p>

                                    <span class="form-text about">Sincerely,</span>
                                    <p class="form-text about">Group of MealHut Lanka (PVT).Ltd</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Card -->

                    <!-- founder & chef -->
                    <div class="col-12">
                        <div class="row">

                            <div class="col-lg-6 ">
                                <div class="card shadow custome-card-3">
                                    <img src="images/founder.jpg" class="card-img-top img-thumbnail" />
                                    <div class="card-body">
                                        <span class="text-dark fs-5">Founder of MealHut Lanka (PVT).Ltd</span>
                                        <br/>
                                        <span class="form-text text-capitalize">mr.r.l.k.s.ranasinghe</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div class="card shadow custome-card-3">
                                    <img src="images/cheef.jpg" class="card-img-top img-thumbnail" />
                                    <div class="card-body">
                                        <span class="text-dark fs-5">Cheef chef of MealHut Lanka (PVT).Ltd</span>
                                        <br/>
                                        <span class="form-text text-capitalize">mr.s.d.jayasooriya</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- founder & chef -->

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