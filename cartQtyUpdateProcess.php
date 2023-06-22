<?php

session_start();
require "connection.php";

if (isset($_SESSION["m"])) {
    $mid = $_SESSION["m"]["id"];

    if ($_GET["id"] && $_GET["q"]) {

        $cpid = $_GET["id"];
        $qty = $_GET["q"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `member_id` = '".$mid."'");
        $cart_data = $cart_rs -> fetch_assoc();
        $cid = $cart_data["id"];

        Database::push("UPDATE `cart_product` SET `qty` = '".$qty."' WHERE `id` = '".$cpid."' AND `cart_id` = '".$cid."'");
        echo "success";
    } else {
        echo "error";
    }
    
} else {
    echo "error";
}
