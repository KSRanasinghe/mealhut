<?php

session_start();
require "connection.php";

if (isset($_POST["id"])) {

    $mid = $_POST["id"];
    $title = $_POST["t"];
    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $usernameOp = $_POST["u"];

    $mobile = $_SESSION["m"]["mobile"];
    $email = $_SESSION["m"]["email"];

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
    } else {

        $uoption = $_SESSION["m"]["username_type_id"];

        if ($usernameOp != $uoption) {

            $username;
            if ($usernameOp == 1) {
                $username = $mobile;
            } else if ($usernameOp == 2) {
                $username = $email;
            }

            Database::push("UPDATE 
            `member` SET 
            `title_id` = '" . $title . "',
            `fname` = '" . $fname . "',
            `lname` = '" . $lname . "',
            `username_type_id` = '" . $usernameOp . "'
            WHERE `id` = '" . $mid . "'");

            Database::push("UPDATE `member_account` SET `username` = '" . $username . "' WHERE `member_id` = '" . $mid . "'");
            $_SESSION["m"] = null;
            setcookie("username", "", -1);
            setcookie("password", "", -1);
            session_destroy();

            echo "signin";
        } else {

            Database::push("UPDATE 
            `member` SET 
            `title_id` = '" . $title . "',
            `fname` = '" . $fname . "',
            `lname` = '" . $lname . "',
            `username_type_id` = '" . $usernameOp . "'
            WHERE `id` = '" . $mid . "'");

            $username_rs = Database::search("SELECT 
            * 
            FROM `member` 
            INNER JOIN `member_account` ON `member`.`id` = `member_account`.`member_id`
            WHERE
            `member`.`id` = '".$mid."'");
            $member_data = $username_rs->fetch_assoc();
            $_SESSION["m"] = $member_data;

            echo "success";
        }
    }
} else {
    echo "error";
}
