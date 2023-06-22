<?php

session_start();
require "connection.php";

$username = $_POST["u"];
$password = $_POST["p"];
$remember = $_POST["r"];

if (empty($username)) {
    echo "Username is empty.";
} else if (empty($password)) {
    echo "Password is empty.";
} else {

    $username_rs = Database::search("SELECT 
    * 
    FROM `member` 
    INNER JOIN `member_account` ON `member`.`id` = `member_account`.`member_id`
    WHERE
    `member_account`.`username` = '" . $username . "'
    AND
    `member_account`.`password` = '" . $password . "'");

    $username_num = $username_rs->num_rows;

    if ($username_num == 1) {

        $member_data = $username_rs->fetch_assoc();
        if ($member_data["status_id"] == 2) {
            echo "block";
        } else {
            $_SESSION["m"] = $member_data;
            $_SESSION["p"] = 1;

            #search cart data
            $cart_rs = Database::search("SELECT * FROM `cart` WHERE member_id = '" . $member_data["id"] . "'");
            $cart_num = $cart_rs->num_rows;
            if ($cart_num == 1) {

                $cart_data = $cart_rs->fetch_assoc();
                $cart_id = $cart_data["id"];
                
                #search card_product data
                $cart_product_rs = Database::search("SELECT `address_id` FROM `cart_product` WHERE `cart_id` = '" . $cart_id . "'  AND `status_id` = '1' AND `confirmation_id` = '0'");
                $cart_product_num = $cart_product_rs->num_rows;
                if ($cart_product_num > 0) {
                    $cart_product_data = $cart_product_rs->fetch_assoc();
                    $_SESSION["a"] = $cart_product_data;
                }
            }

            if ($remember == "true") {
                setcookie("username", $username, time() + (60 * 60 * 24 * 365));
                setcookie("password", $password, time() + (60 * 60 * 24 * 365));
            } else {
                setcookie("username", "", -1);
                setcookie("password", "", -1);
            }
            echo "success";
        }
    } else {
        echo "invalid";
    }
}
