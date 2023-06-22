<?php
require "connection.php";

$title = $_POST["t"];
$fname = ucwords($_POST["f"]);
$lname = ucwords($_POST["l"]);
$mobile = $_POST["m"];
$email = $_POST["e"];
$pswd = $_POST["p"];
$repswd = $_POST["r"];
$usernameOp = $_POST["u"];

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
    echo "Invalid email address!";
} else if (empty($pswd)) {
    echo "Password is empty!";
} else if (strlen($pswd) < 8 || strlen($pswd) > 20) {
    echo "Password length should be between 08 and 20 characters!";
} else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@_])[A-Za-z\d$@_]{8,}$/", $pswd)) {
    echo "Invalid password!";
} else if ($pswd != $repswd) {
    echo "Please make sure your passwords match!";
} else if (empty($mobile)) {
    echo "Phone number is empty!";
} else if (strlen($mobile) != 9) {
    echo "Phone number should contain 9 characters!";
} else if (!preg_match("/7[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo "Invalid phone number!";
} else if ($usernameOp == 0) {
    echo "Please select one username option!";
} else {

    $makedMobile = "0" . $mobile;
    $member_rs = Database::search("SELECT * FROM `member` 
    WHERE `mobile` = '" . $makedMobile . "' OR `email` = '" . $email . "'");

    $member_num = $member_rs->num_rows;

    if ($member_num > 0) {
        echo "exists";
    } else {
        date_default_timezone_set('Asia/Colombo');
        $date = date("Y-m-d H:i:s");

        Database::push("INSERT INTO `member` (`fname`,`lname`,`mobile`,`email`,`title_id`,`username_type_id`,`datetime`) 
        VALUES ('" . $fname . "','" . $lname . "','" . $makedMobile . "','" . $email . "','" . $title . "','" . $usernameOp . "','".$date."')");

        $member_id_rs = Database::search("SELECT * FROM `member` WHERE `email` = '" . $email . "'");
        $member_id_data = $member_id_rs->fetch_assoc();
        $id = $member_id_data["id"];

        $username;

        if ($usernameOp == 1) {
            $username = $makedMobile;
        } else if ($usernameOp == 2) {
            $username = $email;
        }

        Database::push("INSERT INTO `member_account` (`username`,`password`,`member_id`) 
        VALUES('" . $username . "','" . $pswd . "','" . $id . "')");

        echo "success";
    }
}
