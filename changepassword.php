<?php require "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | Order Meal Online - Delivery or Takeaway</title>
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

                <div class="col-12 offset-lg-3 col-lg-6">
                    <div class="row">

                        <!-- Card -->
                        <div class="card shadow custome-card">
                            <div class="card-body">

                                <div class="col-12 mt-3 pb-1">
                                    <h4 class="card-title text-uppercase fw-semibold text-dark text-center">change your password</h4>
                                    <hr class="col-12 offset-lg-2 col-lg-8" />
                                </div>

                                <div class="col-12 justify-content-center">
                                    <div class="row">

                                        <div class="col-12 offset-lg-2 col-lg-8">
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="row">
                                                        <label for="expswd" class="form-label text-capitalize">
                                                            old Password <span class="text-danger">*</span></label>

                                                        <input type="password" class="form-control shadow-none mb-3" required id="expswd" style="font-size: 14px;" />

                                                        <label for="newpswd" class="form-label text-capitalize">
                                                            new Password <span class="text-danger">*</span></label>

                                                        <input type="password" class="form-control shadow-none" aria-describedby="passwordHelpBlock" required id="newpswd" style="font-size: 14px;" />

                                                        <div id="passwordHelpBlock" class="form-text mb-3" style="font-size: 13px;">
                                                            Your password must be 8-20 characters long, contain at least one uppercase,one lowercase, one number and one symbol (like $@_), and must not contain spaces or emoji.
                                                        </div>
                                                        <label for="ncpswd" class="form-label text-capitalize">
                                                            confirm new Password <span class="text-danger">*</span></label>

                                                        <input type="password" class="form-control shadow-none mb-4" required id="ncpswd" style="font-size: 14px;" />

                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="alert alert-warning alert-dismissible fade show h-75 align-content-center">
                                                                    <span style="font-size: 14px;">
                                                                    <i class="bi bi-exclamation-triangle me-2"></i> 
                                                                    You have to Sign In agian after change your password.</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button class="btn btn-success shadow-none mt-1 mb-3" onclick="changePassword();">Save</button>
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