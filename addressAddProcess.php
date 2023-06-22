<?php

session_start();
require "connection.php";

if (isset($_SESSION["m"])) {
    $mid = $_SESSION["m"]["id"];

    $title = $_POST["t"];
    $fname = ucwords($_POST["f"]);
    $lname = ucwords($_POST["l"]);
    $mobile = $_POST["m"];
    $hno = $_POST["h"];
    $street = ucwords($_POST["s"]);
    $dis = $_POST["d"];
    $city = ucwords($_POST["c"]);
    $aname = strtoupper($_POST["n"]);

    if($title == 0){
        echo "Please select a title!";
    }else if(empty($fname)){
        echo "First Name is empty!";
    }else if(strlen($fname) > 50){
        echo "First Name must be less than 50 characters!";
    }else if(empty($lname)){
        echo "Last Name is empty!";
    }else if(strlen($lname) > 50){
        echo "Last Name must be less than 50 characters!";
    }else if(empty($mobile)){
        echo "Mobile Number is empty!";
    }else if(strlen($mobile) != 9){
        echo "Mobile Number should contain 9 characters!";
    }else if(!preg_match("/7[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
        echo "Invalid Mobile Number!";
    }else if(empty($hno)){
        echo "House Number is empty!";
    }else if(strlen($hno) > 10){
        echo "House number must be less than 10 characters!";
    }else if($dis == 0){
        echo "Please select a district!";
    }else if(empty($city)){
        echo "City is empty!";
    }else if(strlen($city) > 50){
        echo "City must be less than 50 characters!";
    }else if(empty($aname)){
        echo "Address Name is empty!";
    }else if(strlen($aname) > 50){
        echo "Address Name must be less than 50 characters!";
    }else{

        $name = str_replace("'","\'",$aname);

        Database::push("INSERT INTO `address` (`name`,`title_id`,`fname`,`lname`,`mobile`,`house_no`,`street`,`district_id`,`city`,`member_id`)
        VALUES('".$name."','".$title."','".$fname."','".$lname."','".$mobile."','".$hno."','".$street."','".$dis."','".$city."','".$mid."')");

        echo "success";
    }

} else {
    echo "signin";
}
