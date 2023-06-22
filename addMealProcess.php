<?php

require "connection.php";

$category = $_POST["c"];
$meal = $_POST["mn"];
$mealType = $_POST["mt"];
$price = $_POST["p"];
$desc = $_POST["d"];

if ($category == 0) {
    echo "Please select a category!";
} else if (empty($meal)) {
    echo "Meal name is empty!";
} else if ($mealType == 0) {
    echo "Please select a meal type!";
} else if ($price == 0 || $price == "e" || $price < 0 || !is_numeric($price)) {
    echo "Please enter a valid price!";
} else if (empty($desc)) {
    echo "Description is empty!";
} else if (strlen($desc) > 60) {
    echo "Description should not be greater than 60 characters!";
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

        $file_name = "meals//" . uniqid() . $new_img_extention;

        $product_rs = Database::search("SELECT * FROM `product` WHERE `name` = '" . ucwords($meal) . "'");
        $product_num = $product_rs->num_rows;
        $pid = 0;

        if ($product_num > 0) {
            $product_data = $product_rs->fetch_assoc();
            $pid = $product_data["id"];

            $meal_detail_rs = Database::search("SELECT * FROM `meal_details` 
            WHERE `meal_type_id` = '" . $mealType . "' AND `product_id` = '" . $pid . "'");
            $meal_detail_num = $meal_detail_rs->num_rows;

            if ($meal_detail_num > 0) {
                echo "have";
            } else {
                Database::push("INSERT INTO `meal_details` (`meal_type_id`,`price`,`product_id`,`status_id`) VALUES(
                '" . $mealType . "','" . $price . "','" . $pid . "','1')");

                $meal_details_rs = Database::search("SELECT * FROM `meal_details` 
                WHERE `meal_type_id` = '" . $mealType . "' AND `product_id` = '" . $pid . "'");
                $meal_details_data = $meal_details_rs->fetch_assoc();
                $meal_details_id = $meal_details_data["id"];


                Database::push("INSERT INTO `images` (`code`,`meal_details_id`) VALUES ('" . $file_name . "','" . $meal_details_id . "')");
                move_uploaded_file($imagefile["tmp_name"], $file_name);

                echo "success";
            }
        } else {
            Database::push("INSERT INTO `product` (`name`,`description`,`category_id`) VALUES(
                '" . ucwords($meal) . "','" . ucfirst($desc) . "','" . $category . "')");

            $meal_rs = Database::search("SELECT * FROM `product` WHERE `name` = '" . ucwords($meal) . "'");
            $meal_data = $meal_rs->fetch_assoc();
            $pid = $meal_data["id"];

            Database::push("INSERT INTO `meal_details` (`meal_type_id`,`price`,`product_id`,`status_id`) VALUES(
                '" . $mealType . "','" . $price . "','" . $pid . "','1')");

            $meal_details_rs = Database::search("SELECT * FROM `meal_details` 
            WHERE `meal_type_id` = '" . $mealType . "' AND `product_id` = '" . $pid . "'");
            $meal_details_data = $meal_details_rs->fetch_assoc();
            $meal_details_id = $meal_details_data["id"];


            Database::push("INSERT INTO `images` (`code`,`meal_details_id`) VALUES ('" . $file_name . "','" . $meal_details_id . "')");
            move_uploaded_file($imagefile["tmp_name"], $file_name);

            echo "success";
        }
    } else {
        echo "Invalid image type!";
    }
}
