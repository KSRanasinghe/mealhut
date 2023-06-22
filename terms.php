<?php require "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditons | Order Meal Online - Delivery or Takeaway</title>
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
                    <div class="card shadow custome-card">
                        <div class="card-body">

                            <div class="col-12 mt-3 pb-1">
                                <h4 class="card-title text-uppercase fw-semibold text-dark text-center">Terms & Conditons</h4>
                                <hr class="col-12" />
                            </div>

                            <div class="col-12 justify-content-center">
                                <div class="row">

                                    <span class="text-dark fw-bold fs-5">Terms and Conditions</span>

                                    <p class="form-text about">Welcome to mealhut!</p>

                                    <p class="form-text about">These terms and conditions outline the rules and regulations for the use of MealHut's Website, located at <a href="index.php" class="link-primary">www.mealhut.lk</a></p>

                                    <p class="form-text about">By accessing this website we assume you accept these terms and conditions. Do not continue to use mealhut if you do not agree to take all of the terms and conditions stated on this page.</p>

                                    <p class="form-text about">The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements:</p>
                                    <div class="offset-1 col-10">
                                        <div class="row">
                                            <ul class="form-text about">
                                                <li class="pb-1">'Client', 'You' and 'Your' refers to you, the person log on this website;</li>
                                                <li class="pb-1">'The Company', 'Ourselves', 'We', 'Our' and 'Us', refers to our Company;</li>
                                                <li class="pb-1">'Party', 'Parties', or 'Us', refers to both the Client and ourselves;</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="form-text about">All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>

                                    <span class="text-dark fw-bold fs-5">Cookies</span>

                                    <p class="form-text about">We employ the use of cookies. By accessing mealhut, you agreed to use cookies in agreement with the MealHut's Privacy Policy. </p>

                                    <p class="form-text about">Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website.</p>

                                    <span class="text-dark fw-bold fs-5">Your Privacy</span>

                                    <p class="form-text about">Please read <a href="privacy.php" class="link-primary">Privacy Policy</a></p>

                                    <span class="text-dark fw-bold fs-5">Contact details of the Company</span>
                                    <span class="form-text about">MealHut Lanka (PVT).Ltd</span>
                                    <span class="form-text about">60/10,</span>
                                    <span class="form-text about">Maligawatte Road,</span>
                                    <span class="form-text about">Colombo 10.</span>
                                    <span class="form-text about">Head Office Tel. No: +94 11 2334 500</span>
                                    <p class="form-text about">Delivery Hotline: +94 11 2334 587</p>

                                    <span class="text-dark fw-bold fs-5">Refund Policy</span>
                                    <p class="form-text about">Refund will <span class="text-uppercase">only be granted for the refund of payment on orders placed outside the delivery area of the company</span> and will be processed within 14 working days. </p>
                                    
                                    <span class="text-dark fw-bold fs-5">Transaction Currency</span>
                                    <p class="form-text about">All prices are mentioned in Sri Lankan Rupees (Rs.) and you will be charged based on the prevailing exchange rate.</p>
                                    
                                    <span class="text-dark fw-bold fs-5">Transaction Security</span>
                                    <p class="form-text about">Your payments are going through a secure payment site operated by The Haton National Banking Corporation Limited (HNB). Your card details will be securely transmitted to the Bank for transaction authorization using SSL 128bit encryption.</p>
                                    
                                    <span class="text-dark fw-bold fs-5">Discount Policy</span>
                                    <p class="form-text about">Discounts cannot be combined on MealHut deals.</p>

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