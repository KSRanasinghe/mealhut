<?php

require "connection.php";

$id = $_POST["id"];
$price = $_POST["p"];
$desc = $_POST["d"];

if ($price == 0 || $price == "e" || $price < 0 || !is_numeric($price)) {
    echo "Please enter a valid price!";
} else if (empty($desc)) {
    echo "Description is empty!";
} else if (strlen($desc) > 60) {
    echo "Description should not be greater than 60 characters!";
} else {

    if (isset($_FILES["i"])) {

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

            $file_name = "meals//" . uniqid() . $new_img_extention;
            Database::push("UPDATE `images` SET `code` = '" . $file_name . "' WHERE `meal_details_id` = '" . $id . "'");
            move_uploaded_file($imagefile["tmp_name"], $file_name);
        } else {
            echo "Invalid image type!";
        }
    }
    $meal_details_rs = Database::search("SELECT * FROM `meal_details` WHERE `id` = '" . $id . "'");
    $meal_details_data = $meal_details_rs->fetch_assoc();
    $pid = $meal_details_data["product_id"];

    Database::push("UPDATE `product` SET `description` = '" . $desc . "' WHERE `id` = '" . $pid . "'");
    Database::push("UPDATE `meal_details` SET `price` = '" . $price . "' WHERE `id` = '" . $id . "'");

    echo "success";
}
