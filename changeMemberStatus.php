<?php

require "connection.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $member_rs = Database::search("SELECT * FROM `member` WHERE `id` = '" . $id . "'");
    $member_data = $member_rs->fetch_assoc();
    $status = $member_data["status_id"];

    if ($status == 1) {
        Database::push("UPDATE `member` SET `status_id` = '2' WHERE `id` = '" . $id . "'");
        echo "success";
    } else if($status == 2) {
        Database::push("UPDATE `member` SET `status_id` = '1' WHERE `id` = '" . $id . "'");
        echo "success";
    }
    
} else {
    echo "Something went wrong!";
}
