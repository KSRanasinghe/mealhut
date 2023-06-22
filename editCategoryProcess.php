<?php

require "connection.php";
$id = $_POST["i"];
$category = ucwords($_POST["c"]);

if (empty($category)) {
    echo "Category name is empty!";
} else if(strlen($category) > 40){
    echo "Category name must be less than 40 characters!";
} else {

    Database::push("UPDATE `category` SET `name` = '".$category."' WHERE `id` = '".$id."'");
    echo "success";
}