<?php

session_start();
require "connection.php";

if (isset($_SESSION["m"])) {
    $mid = $_SESSION["m"]["id"];

    if ($_GET["id"]) {

        $cpid = $_GET["id"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `member_id` = '".$mid."'");
        $cart_data = $cart_rs -> fetch_assoc();
        $cid = $cart_data["id"];

        Database::push("UPDATE `cart_product` SET `status_id` = '2' WHERE `id` = '".$cpid."' AND `cart_id` = '".$cid."'");
        echo "success";
    } else {
        echo "error";
    }
    
} else {
    echo "error";
}
