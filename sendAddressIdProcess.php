<?php

session_start();
require "connection.php";
$mid = $_SESSION["m"]["id"];
$aid = $_GET["id"];

$address_rs = Database::search("SELECT * FROM `address` WHERE `id` = '".$aid."' AND `member_id` = '".$mid."'");
$address_num = $address_rs -> num_rows;

if ($address_num == 1) {
    $address_data = $address_rs -> fetch_assoc();
    $_SESSION["ad"] = $address_data;
    echo "success";
} else {
    echo "Something went wrong!";
}