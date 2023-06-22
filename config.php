<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51LYRebF5x8xnEkwPsFaWhP2YCJxW538WTKXRzXQowUtWpHaOxpoBpyZyRGVvxtTqBCB0orAjxNCvQtDhnokCKqoB002IkBKocl",
        "publishableKey" => "pk_test_51LYRebF5x8xnEkwPgOCbyhFKWHVPar6HJOznVhnLBSbii5hBFeDrmlQd39ZevVXVg1jLMKCiXCapJX2rkliFzbmA00Gb0drbQe"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>