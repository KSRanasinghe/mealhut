<?php

session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $suid = $_SESSION["admin"]["id"];

    if ($id == $suid) {
        echo "sorry";
    } else {
        $user_rs = Database::search("SELECT * FROM `user` WHERE `id` = '" . $id . "'");
        $user_data = $user_rs->fetch_assoc();
        $status = $user_data["status_id"];

        if ($status == 1) {
            Database::push("UPDATE `user` SET `status_id` = '2' WHERE `id` = '" . $id . "'");
            echo "success";
        } else if ($status == 2) {
            Database::push("UPDATE `user` SET `status_id` = '1' WHERE `id` = '" . $id . "'");
            echo "success";
        }
    }
} else {
    echo "error";
}
