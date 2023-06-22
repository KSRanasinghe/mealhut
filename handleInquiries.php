<?php

session_start();
require "connection.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];
    $email = $_SESSION["admin"]["email"];

    Database::push("UPDATE `feedback` SET `handled_by` = '" . $email . "' WHERE `id` = '" . $id . "'");
    echo "success";
} else {
    echo "Something went wrong!";
}
