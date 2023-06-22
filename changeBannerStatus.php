<?php

require "connection.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $banner_rs = Database::search("SELECT * FROM `banner` WHERE `id` = '" . $id . "'");
    $banner_data = $banner_rs->fetch_assoc();
    $status = $banner_data["status_id"];

    if ($status == 1) {
        Database::push("UPDATE `banner` SET `status_id` = '2' WHERE `id` = '" . $id . "'");
        echo "success";
    } else if ($status == 2) {
        $active_banners_rs = Database::search("SELECT * FROM `banner` WHERE `status_id` = '1'");
        $active_banners_num = $active_banners_rs->num_rows;

        if ($active_banners_num < 4) {
            Database::push("UPDATE `banner` SET `status_id` = '1' WHERE `id` = '" . $id . "'");
            echo "success";
        } else {
            echo "max";
        }
    }
} else {
    echo "error";
}
