<?php require "connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME | Order Meal Online - Delivery or Takeaway</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/alertify.css" />
    <link rel="icon" href="images/mealhut.png" />
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">

            <span class="logo navbar-brand" style="cursor: default;"><span class="text-success">M</span>eal<span class="text-success">H</span>ut<span class="text-success">.</span></span>
            <?php
            session_start();
            if (isset($_SESSION["m"])) {
            ?>
                <form class="ps-3">
                    <button class="btn btn-success shadow-none" type="button" onclick="myacc();">My Account</button>
                </form>
            <?php
            } else {
            ?>
                <form class="ps-3">
                    <button class="btn btn-success shadow-none" type="button" onclick="signIn();">Sign In / Register</button>
                </form>
            <?php
            }
            ?>
        </div>
    </nav>
    <!-- navbar -->

    <!-- banner -->
    <div class="col-12">
        <div id="carouselExampleDark" class="carousel carousel-fade slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="images/bg.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block banner-title">
                        <h1 class="fw-bold text-light display-1 text-center">Always Choose Good</h1>
                        <p class="text-light text-center banner-para">Are you looking for a refreshing taste? Want to get your meal fast? A clean diet? A meal that fits your wallet? A memorable meal full of flavor and quality? Or friendly service? Then with MealHut enjoy our memorable delicacies at home with ease. No matter what your cravings are, we are now ready to deliver food to your home to satisfy your needs with our wide variety of food.</p>
                    </div>
                    <div class="carousel-caption d-block d-md-none mb-4">
                        <h1 class="fw-bold text-light display-1 text-center">Welcome!</h1>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="images/bg1.jpeg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block banner-title">
                        <h1 class="fw-bold text-light display-1 text-center">Always Choose Good</h1>
                        <p class="text-light text-center banner-para">Are you looking for a refreshing taste? Want to get your meal fast? A clean diet? A meal that fits your wallet? A memorable meal full of flavor and quality? Or friendly service? Then with MealHut enjoy our memorable delicacies at home with ease. No matter what your cravings are, we are now ready to deliver food to your home to satisfy your needs with our wide variety of food.</p>
                    </div>
                    <div class="carousel-caption d-block d-md-none mb-4">
                        <h1 class="fw-bold text-light display-1 text-center">Welcome!</h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/bg2.jpeg" class="d-block w-100 dark-img" alt="...">
                    <div class="carousel-caption d-none d-md-block banner-title">
                        <h1 class="fw-bold text-light display-1 text-center">Always Choose Good</h1>
                        <p class="text-light text-center banner-para">Are you looking for a refreshing taste? Want to get your meal fast? A clean diet? A meal that fits your wallet? A memorable meal full of flavor and quality? Or friendly service? Then with MealHut enjoy our memorable delicacies at home with ease. No matter what your cravings are, we are now ready to deliver food to your home to satisfy your needs with our wide variety of food.</p>
                    </div>
                    <div class="carousel-caption d-block d-md-none mb-4">
                        <h1 class="fw-bold text-light display-1 text-center">Welcome!</h1>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- banner -->

    <!-- popular meals -->
    <div class="container">
        <div class="row text-center mt-3 mb-1 mx-auto pt-5">
            <h2>Popular <span class="text-success fw-bolder display-5">M</span>eals</h2>
            <p>Indulge your cravings with our most popular dishes.</p>
        </div>
        <div class="row mx-auto my-3 py-4">
            <div class="col-12">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <!-- /.card -->
                    <?php
                    $banner_rs = Database::search("SELECT
                    banner.title,
                    banner.description,
                    banner.img
                FROM
                    banner
                    WHERE `banner`.`status_id` = '1'");

                    $banner_num = $banner_rs->num_rows;

                    if ($banner_num > 0) {
                        for ($i = 0; $i < $banner_num; $i++) {
                            $banner_data = $banner_rs->fetch_assoc();
                    ?>
                            <div class="col">
                                <div class="card h-100 shadow my-card border-success border-opacity-50">
                                    <img src='<?php echo $banner_data["img"]; ?>' class="card-img-top" alt="..." />
                                    <div class="card-body">
                                        <h5 class="card-title text-capitalize fw-bold"><?php echo $banner_data["title"]; ?></h5>
                                        <p class="card-text" style="font-size: 14px;"><?php echo $banner_data["description"]; ?></p>
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

        <div class="row col-10 offset-1 col-lg-4 offset-lg-4 py-4">
            <a href="menu.php" class="btn btn-success shadow-none">View All Our Meals</a>
        </div>
    </div>
    <!-- popular meals -->


    <!-- footer -->
    <?php
    require "footer.php";
    ?>
    <!-- footer -->

    <script src="scripts/script.js"></script>
    <script src="scripts/bootstrap.bundle.js"></script>
</body>

</html>