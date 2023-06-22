<?php

session_start();
require "connection.php";

if (isset($_SESSION["m"])) {

    if (isset($_SESSION["a"])) {

        $member_id = $_SESSION["m"]["id"];
        $mid = $_POST["mid"];
        $qty = $_POST["q"];
        $aid = $_SESSION["a"]["address_id"];

        // search cart
        $cart_id = 0;

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `member_id` = '" . $member_id . "'");
        $cart_num = $cart_rs->num_rows;
        if ($cart_num == 1) {
            $cart_data = $cart_rs->fetch_assoc();
            $cart_id = $cart_data["id"];
        } else {
            Database::push("INSERT INTO `cart` (`member_id`) VALUES ('" . $member_id . "')");
            $new_cart_rs = Database::search("SELECT * FROM `cart` WHERE `member_id` = '" . $member_id . "'");
            $new_cart_data = $new_cart_rs->fetch_assoc();
            $cart_id = $new_cart_data["id"];
        }
        // search cart

        // search cart product
        $cart_product_rs = Database::search("SELECT 
            * 
        FROM 
            `cart_product` 
        WHERE 
            `meal_details_id` = '" . $mid . "' AND 
            `cart_id` = '" . $cart_id . "'  AND 
            `cart_product`.`status_id` = '1' AND 
            `cart_product`.`confirmation_id` = '0'");

        $cart_product_num = $cart_product_rs->num_rows;
        // search cart product

        // insert or update cart product
        if ($cart_product_num > 0) {
            $cart_product_data = $cart_product_rs->fetch_assoc();
            $dbqty = $cart_product_data["qty"];
            $newQty = $dbqty + $qty;
            Database::push("UPDATE `cart_product` SET `qty` = '" . $newQty . "' 
                WHERE `meal_details_id` = '" . $mid . "' AND `cart_id` = '" . $cart_id . "'");
            echo "success";
        } else {
            Database::push("INSERT INTO `cart_product` (`meal_details_id`,`qty`,`cart_id`,`address_id`) 
                VALUES ('" . $mid . "','" . $qty . "','" . $cart_id . "','" . $aid . "')");
            echo "success";
        }
        // insert or update cart product
    } else {
        echo "address";
    }
} else {
    echo "signin";
}
