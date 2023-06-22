<?php

require "connection.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $meal_details_rs = Database::search("SELECT * FROM `meal_details` WHERE `id` = '" . $id . "'");
    $meal_details_data = $meal_details_rs->fetch_assoc();
    $status = $meal_details_data["status_id"];

    if ($status == 1) {
        Database::push("UPDATE `meal_details` SET `status_id` = '2' WHERE `id` = '" . $id . "'");
        echo "success";
    } else if($status == 2) {
        Database::push("UPDATE `meal_details` SET `status_id` = '1' WHERE `id` = '" . $id . "'");
        echo "success";
    }
    
} else {
    echo "error";
}
