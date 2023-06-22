<?php

session_start();
require "connection.php";

$title = $_POST["t"];
$fname = ucwords($_POST["f"]);
$lname = ucwords($_POST["l"]);
$email = $_POST["e"];
$cemail = $_POST["ce"];
$inq = $_POST["i"];
$mobile = $_POST["m"];
$msg = $_POST["msg"];

if ($title == 0) {
    echo "Please select a title!";
} else if (empty($fname)) {
    echo "First Name is empty!";
} else if (strlen($fname) > 50) {
    echo "First Name must be less than 50 characters!";
} else if (empty($lname)) {
    echo "Last Name is empty!";
} else if (strlen($lname) > 50) {
    echo "Last Name must be less than 50 characters!";
} else if (empty($email)) {
    echo "Email address is empty!";
} else if (strlen($email) >= 75) {
    echo "Email address must be less than 75 characters!";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email address!";
} else if ($email != $cemail) {
    echo "Please make sure your email addresses match!";
} else if ($inq == 0) {
    echo "Please select a inquirt type!";
} else if (empty($mobile)) {
    echo "Phone number is empty!";
} else if (strlen($mobile) != 9) {
    echo "Phone number should contain 9 characters!";
} else if (!preg_match("/7[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo "Invalid phone number!";
} else if (empty($msg)) {
    echo "Message is empty!";
} else {

    date_default_timezone_set('Asia/Colombo');
    $date = date("Y-m-d H:i:s");
    $makedMobile = "0" . $mobile;


    $message = str_replace("'","\'",$msg);

    Database::push("INSERT INTO `feedback` (`inquiry_type_id`,`title_id`,`fname`,`lname`,`mobile`,`email`,`message`,`datetime`) VALUES 
    ('" . $inq . "','" . $title . "','" . $fname . "','" . $lname . "','" . $makedMobile . "','" . $email . "','" . $message . "','" . $date. "')");

    $success = "success";
    if ($inq == 1) {
        echo $success . $inq;
    } else if ($inq == 2) {
        echo $success . $inq;
    } else if ($inq == 3) {
        echo $success . $inq;
    }
}
