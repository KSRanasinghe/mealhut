<?php

require "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$utype = $_POST["u"];
$pswd = $_POST["p"];
$repswd = $_POST["r"];
$otp = $_POST["o"];
$email = $_POST["e"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
$user_num = $user_rs->num_rows;

if ($user_num == 0) {
    echo "no";
} else {
    $user_data = $user_rs -> fetch_assoc();
    $db_otp = $user_data["otp"];

    if(empty($fname)){
        echo "First name is empty!";
    }else if(strlen($fname) > 50){
        echo "First name must be less than 50 characters!";
    }else if(empty($lname)){
        echo "Last name is empty!";
    }else if(strlen($lname) > 50){
        echo "Last name must be less than 50 characters!";
    }else if($utype == 0){
        echo "Please select an user type!";
    }else if(empty($pswd)){
        echo "Password is empty!";
    }else if(strlen($pswd) < 8 || strlen($pswd) > 20){
        echo "Password length should be between 08 and 20 characters!";
    }else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@_])[A-Za-z\d$@_]{8,}$/", $pswd)) {
        echo "Invalid password!";
    }else if($pswd != $repswd){
        echo "Please make sure your passwords match!";
    }else if(empty($otp)){
        echo "OTP is empty!";
    }else if($db_otp != $otp){
        echo "Invalid OTP!";
    }else{
        Database::push("UPDATE `user` SET `password` = '".$pswd."',`user_type_id` = '".$utype."' WHERE `email` = '".$email."'");
        echo "success";
    }
}

