<?php

session_start();
require "connection.php";
$mid = $_SESSION["m"]["id"];

if (isset($_GET["id"])) {
    $aid = $_GET["id"];

    if (isset($_GET["ch"])) {
        $ch = $_GET["ch"];

        if ($ch == 0) {

            $cart_rs = Database::search("SELECT * FROM `cart_product` 
            INNER JOIN `cart` ON `cart_product`.`cart_id` = `cart`.`id` 
            WHERE `cart`.`member_id` = '" . $mid . "'  AND `cart_product`.`status_id` = '1' AND `cart_product`.`confirmation_id` = '0'");

            $cart_num = $cart_rs->num_rows;

            if ($cart_num > 0) {
                echo "have";
            } else {

                $address_rs = Database::search("SELECT `id` AS `address_id` FROM `address` WHERE `id` = '" . $aid . "' AND `member_id` = '" . $mid . "'");
                $address_num = $address_rs->num_rows;

                if ($address_num == 1) {
                    $address_data = $address_rs->fetch_assoc();
                    $_SESSION["a"] = $address_data;
                    echo "success";
                } else {
                    echo "error";
                }
            }
        }else if($ch == 1){
            $cart = Database::search("SELECT * FROM `cart` WHERE `member_id` = '".$mid."'");
            $cart_data = $cart -> fetch_assoc();
            $cid = $cart_data["id"];

            Database::push("UPDATE `cart_product` SET `address_id` = '".$aid."' WHERE `cart_id` = '".$cid."' AND `status_id` = '1'");
            echo "updated";
        }

    } else {
        echo "error";
    }
} else {
    echo "error";
}
