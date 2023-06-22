<?php
session_start();
require "connection.php";
$mid = $_SESSION["m"]["id"];

if (isset($_GET["id"])) {
    $aid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart_product` WHERE `address_id` = '" . $aid . "' AND `status_id` = '1' AND `confirmation_id` = '0'");
    $cart_num = $cart_rs->num_rows;

    if ($cart_num > 0) {
        echo "error";
    } else {

        Database::push("UPDATE `address` SET `status_id` = '2' WHERE `id` = '" . $aid . "' AND `member_id` = '" . $mid . "'");

        echo "success";
    }
} else {
    echo "Something went wrong!";
}
