<?php

require "connection.php";

if (isset($_GET["c"])) {
    $count = $_GET["c"];

    $banner_rs = Database::search("SELECT * FROM `banner` WHERE `status_id` = '1'" );
    $banner_num = $banner_rs -> num_rows;
    
    if ($banner_num >= $count) {
        echo "max";
    } else {
        echo "show";
    }
    
} else {
    echo "Something went wrong!";
}
