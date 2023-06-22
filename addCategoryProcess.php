<?php

require "connection.php";
$category = ucwords($_POST["c"]);

if (empty($category)) {
    echo "Category name is empty!";
} else if(strlen($category) > 40){
    echo "Category name should not be greater than 40 characters!";
} else {

    $category_rs = Database::search("SELECT * FROM `category` WHERE `name` = '".$category."'");
    $category_num = $category_rs -> num_rows;

    if($category_num == 0){
    Database::push("INSERT INTO `category` (`name`) VALUES ('".$category."')");
    echo "success";
    } else{
        echo "error";
    }
}