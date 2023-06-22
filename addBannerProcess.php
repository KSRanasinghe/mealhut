<?php

session_start();
require "connection.php";

$title = $_POST["t"];
$desc = $_POST["d"];
$uid = $_SESSION["admin"]["id"];

if (empty($title)) {
    echo "Title is empty!";
} else if (strlen($title) > 40) {
    echo "Title should not be greater than 40 characters!";
} else if (empty($desc)) {
    echo "Description is empty!";
} else if (strlen($desc) > 100) {
    echo "Description should not be greater than 100 characters!";
} else if (!isset($_FILES["i"])) {
    echo "Please add an image!";
} else {

    $imagefile = $_FILES["i"];
    $file_extention = $imagefile["type"];
    $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    $new_img_extention = null;

    if (in_array($file_extention, $allowed_image_extentions)) {

        if ($file_extention == "image/jpg") {
            $new_img_extention = ".jpg";
        } else if ($file_extention == "image/jpeg") {
            $new_img_extention = ".jpeg";
        } else if ($file_extention == "image/png") {
            $new_img_extention = ".png";
        } else if ($file_extention == "image/svg+xml") {
            $new_img_extention = ".svg";
        }

        $file_name = "banners//" . uniqid() . $new_img_extention;

        $banner_rs = Database::search("SELECT * FROM `banner` WHERE `title` LIKE '%" . $title . "%'");
        $banner_num = $banner_rs->num_rows;

        if ($banner_num > 0) {
            echo "have";
        } else {
            date_default_timezone_set('Asia/Colombo');
            $date = date("Y-m-d H:i:s");

            Database::push("INSERT INTO `banner` (`title`,`description`,`img`,`datetime`,`user_id`,`status_id`) VALUES(
                '" . ucwords($title) . "','" . ucfirst($desc) . "','" . $file_name . "','" . $date . "','".$uid."','1')");
            move_uploaded_file($imagefile["tmp_name"], $file_name);

            echo "success";
        }
    }
}
