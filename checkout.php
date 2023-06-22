<?php
session_start();
require "connection.php";

if (isset($_SESSION["m"])) {
    $member = $_SESSION["m"];
    if (isset($_GET["payment-option"])) {
        $po = $_GET["payment-option"];
        if ($po == 1) {
            $pk = "pk_test_51LYRebF5x8xnEkwPgOCbyhFKWHVPar6HJOznVhnLBSbii5hBFeDrmlQd39ZevVXVg1jLMKCiXCapJX2rkliFzbmA00Gb0drbQe";
            $summary_rs = Database::search("SELECT
        ( `meal_details`.`price` ) * ( `cart_product`.`qty` ) AS `subtotal` 
    FROM
        `cart_product`
        INNER JOIN `cart` ON `cart_product`.`cart_id` = `cart`.`id`
        INNER JOIN `meal_details` ON `cart_product`.`meal_details_id` = `meal_details`.`id`
        INNER JOIN `product` ON `meal_details`.`product_id` = `product`.`id`
        INNER JOIN `meal_type` ON `meal_details`.`meal_type_id` = `meal_type`.`id` 
    WHERE
        `cart`.`member_id` = '" . $member["id"] . "' 
        AND `cart_product`.`status_id` = '1' 
        AND `cart_product`.`confirmation_id` = '0'");

            $summary_num = $summary_rs->num_rows;

            $subtotal = 0;
            for ($s = 0; $s < $summary_num; $s++) {
                $summary_data = $summary_rs->fetch_assoc();
                $subtotal += $summary_data["subtotal"];
            }

            $tip = round(($subtotal * 7) / 100);
            $nettotal = $subtotal + $tip;
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Checkout | Order Meal Online - Delivery or Takeaway</title>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
                <link rel="stylesheet" href="./css/style.css" />
                <link rel="stylesheet" href="./css/bootstrap.css" />
                <link rel="stylesheet" href="./css/alertify.css" />
                <link rel="icon" href="images/mealhut.png" />
            </head>

            <body>
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12">
                            <div class="row mx-auto">
                                <div class="col-12 offset-md-2 col-md-8" style="margin-top: 10%;margin-bottom: 5%;">
                                    <div class="row">
                                        <div class="card shadow-lg">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <!-- /.stripe area -->
                                                    <div class="col-12 col-lg-7 custom-border-left-lg custom-border-bottom-md">
                                                        <div class="row">
                                                            <span class="text-muted text-capitalize fw-semibold opacity-75">your grand total</span><br />
                                                            <span class="text-dark fs-1 ms-3" style="font-weight: 700;">Rs.<?php echo number_format($nettotal, 2); ?></span>
                                                            <div class="col-12">
                                                                <div class="row justify-content-center">
                                                                    <img src="images/stripe.svg" class="img-fluid" style="width: 250px;" />
                                                                </div>
                                                            </div>
                                                            <div class="text-end pe-lg-5 mb-3">
                                                                <span class="text-secondary fw-semibold fs-6 opacity-50 text-end"><i>powered by Stripe.com</i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.form area -->
                                                    <div class="col-12 col-lg-5">
                                                        <div class="row my-4">
                                                            <form action="checkout-charge.php" method="POST">
                                                                <div class="mb-3">
                                                                    <label class="form-label text-capitalize text-secondary" style="font-size: 14px;">Card holder name</label>
                                                                    <input type="text" class="form-control shadow-none" required name="hname" style="font-size: 14px;" value="<?php echo $member["fname"] . " " . $member["lname"]; ?>" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label text-capitalize text-secondary" style="font-size: 14px;">Email</label>
                                                                    <input type="text" class="form-control shadow-none" value="<?php echo $member["email"]; ?>" readonly style="font-size: 14px;" id="email" />
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col-4">
                                                                        <label class="form-label text-capitalize text-secondary" style="font-size: 14px;">Code</label>
                                                                        <input type="text" class="form-control shadow-none" value="+94" readonly style="font-size: 14px;" />
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <label class="form-label text-capitalize text-secondary" style="font-size: 14px;">Phone Number</label>
                                                                        <input type="text" class="form-control shadow-none" value="<?php echo substr($member["mobile"], 1); ?>" readonly style="font-size: 14px;" />
                                                                    </div>
                                                                </div>
                                                                <!-- /.amount & description hidden -->
                                                                <input type="hidden" value="<?php echo $nettotal; ?>" name="amount" />
                                                                <!-- amount & description hidden./ -->
                                                                <div class="row justify-content-center px-4">
                                                                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $pk; ?>" data-image="images/mealhut.svg" data-amount="<?php echo str_replace(",", "", $nettotal) * 100 ?>" data-name="MealHut Online Payment" data-description="powered by Stripe.com" data-email="<?php echo $member["email"]; ?>" data-currency="lkr">
                                                                    </script>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- footer -->
                        <footer class="main-footer bg-lights pt-3 border-0 border-top border-bottom border-1 border-secondary border-opacity-50">
                            <p class="text-center text-dark d-none d-lg-block" style="font-size: 14px;">
                                Copyright &copy; MealHut &trade;. All rights reserved. The MealHut name, logos, and related marks are trademarks of MealHut, Inc.
                            </p>
                            <p class="text-center text-dark d-block d-lg-none" style="font-size: 14px;">
                                Copyright &copy; MealHut Sri Lanka.
                            </p>
                        </footer>
                        <!-- footer -->
                    </div>
                </div>
            </body>

            </html>
<?php
        } else {
            echo "Something went wrong.";
        }
    } else {
        echo "Something went wrong.";
    }
} else {
    header("Location:signIn.php");
}
?>