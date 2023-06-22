<?php

session_start();
require "connection.php";

$username = $_POST["u"];
$password = $_POST["p"];

if (empty($username)) {
    echo "Username is empty!";
} else if (empty($password)) {
    echo "Password is empty!";
} else {

    $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $username . "' AND `password` = '" . $password . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {

        $user_data = $user_rs->fetch_assoc();
        $_SESSION["admin"] = $user_data;
        echo "success";
    } else {
        echo "invalid";
    }
}
