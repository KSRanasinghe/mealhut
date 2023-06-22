<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/W3.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/bootstrap.css" />
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top bg-light py-0 border-0 border-bottom border-1 border-secondary border-opacity-50">
        <div class="container-fluid">

            <span class="logo navbar-brand" style="cursor: default;">
                <span class="text-success">M</span>eal<span class="text-success">H</span>ut<span class="text-success">.</span>
            </span>

            <?php
            if (isset($_SESSION["m"])) {
                $ch = 1;

                $cart_rs = Database::search("SELECT * FROM `cart_product` 
                    INNER JOIN `cart` ON `cart_product`.`cart_id` = `cart`.`id` 
                    WHERE `cart`.`member_id` = '" . $_SESSION["m"]["id"] . "' AND `cart_product`.`status_id` = '1'");

                $cart_num = $cart_rs->num_rows;

                if ($cart_num > 0) {
            ?>
                    <a href='<?php echo "addresslist.php?ch=" . $ch; ?>' class="btn btn-outline-secondary d-flex d-lg-none shadow-none rounded-pill">
                        <i class="bi bi-pin-map"></i>
                    </a>
                <?php
                }
                ?>
                <button class="btn btn-outline-success d-flex d-lg-none shadow-none rounded-pill" type="button" onclick="openRightMenu();">
                    <i class="bi bi-person"></i>
                </button>
            <?php
            } else {
            ?>
                <button class="btn btn-outline-success d-flex d-lg-none shadow-none rounded-pill" type="button" onclick="signIn();">
                    <i class="bi bi-person"></i></button>
            <?php
            }
            ?>
            <button class="btn btn-outline-success d-flex d-lg-none shadow-none rounded-pill" type="button" onclick="goToCart();">
                <i class="bi bi-cart3"></i>
            </button>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" onclick="closeRightMenu()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="feedback.php">Contact Us</a>
                    </li>
                </ul>
            </div>
            <form class="d-none d-lg-flex" role="search">
                <?php
                if (isset($_SESSION["m"])) {
                    $ch = 1;

                    $cart_rs = Database::search("SELECT * FROM `cart_product` 
                    INNER JOIN `cart` ON `cart_product`.`cart_id` = `cart`.`id` 
                    WHERE `cart`.`member_id` = '" . $_SESSION["m"]["id"] . "' AND `cart_product`.`status_id` = '1'");

                    $cart_num = $cart_rs->num_rows;

                    if ($cart_num > 0) {
                ?>
                        <a href='<?php echo "addresslist.php?ch=" . $ch; ?>' class="btn btn-outline-secondary me-2 shadow-none rounded-pill">
                            <i class="bi bi-pin-map"></i>
                            <span class="ps-2 text-uppercase" style="font-size: 14px;">
                                change delivary details
                            </span>
                        </a>
                    <?php
                    }
                    ?>
                    <button class="btn btn-outline-success me-2 shadow-none rounded-pill" type="button" onclick="openRightMenu();">
                        <i class="bi bi-person-check"></i>
                        <span class="ps-2" style="font-size: 14px;">
                            <?php echo strtoupper("hello " . $_SESSION["m"]["fname"] . "!"); ?></span>
                    </button>
                <?php
                } else {
                ?>
                    <button class="btn btn-outline-success me-2 shadow-none rounded-pill" type="button" onclick="signIn();">
                        <i class="bi bi-person-x"></i>
                        <span class="ps-2" style="font-size: 14px;">Sign In/Register</span>
                    </button>
                <?php
                }
                ?>
                <button class="btn btn-outline-success shadow-none rounded-pill" type="button" onclick="goToCart();">
                    <i class="bi bi-cart3"></i>
                </button>
            </form>

        </div>
    </nav>
    <!-- sidebar -->
    <div class="col-12">
        <div class="w3-sidebar bg-light w3-bar-block w3-card w3-animate-right" style="display:none;right:0;" id="rightMenu">
            <div class="mt-5 pt-3">
                <button onclick="closeRightMenu()" class="w3-bar-item btn btn-sm pt-2 pb-0 pe-1 ps-0 w3-margin-bottom">
                    <i class="bi bi-x-circle float-end fs-3 mb-0 me-3 text-black-50"></i>
                </button>
                <a class="w3-bar-item text-center text-capitalize text-black-50 fw-bold fs-4" style="text-decoration: none; cursor: default;">welcome !</a>
                <hr class="text-black-50 offset-1 col-10" />
                <button onclick="myacc();" class="w3-bar-item w3-button text-center mb-2 text-capitalize">my account</button>
                <button onclick="history();" class="w3-bar-item w3-button text-center mb-2 text-capitalize">order history</button>
                <button onclick="address();" class="w3-bar-item w3-button text-center mb-2 text-capitalize">address</button>
                <button onclick="mobile();" class="w3-bar-item w3-button text-center mb-2 text-capitalize">change number</button>
                <button onclick="email();" class="w3-bar-item w3-button text-center mb-2 text-capitalize">change email</button>
                <button onclick="password();" class="w3-bar-item w3-button text-center mb-2 text-capitalize">change password</button>
                <hr class="text-black-50 offset-1 col-10 mt-3" />
                <button onclick="signOut();" class="w3-bar-item w3-button text-center mb-2 text-capitalize">logout</button>
            </div>
        </div>
    </div>
    <!-- sidebar -->


    <script>
        const currentLocation = location.href;
        const menuItem = document.querySelectorAll('a');
        const menuLength = menuItem.length;
        for (let i = 0; i < menuLength; i++) {
            if (menuItem[i].href === currentLocation) {
                menuItem[i].className = "nav-link active";
            }

        }
    </script>
    <script>
        function openRightMenu() {
            document.getElementById("rightMenu").style.display = "block";
        }

        function closeRightMenu() {
            document.getElementById("rightMenu").style.display = "none";
        }
    </script>
    <script src="scripts/script.js"></script>
</body>

</html>