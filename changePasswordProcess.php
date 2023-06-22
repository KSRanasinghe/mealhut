<?php

session_start();
require "connection.php";

if (isset($_SESSION["m"])) {

    $mid = $_SESSION["m"]["id"];
    $pswd = $_SESSION["m"]["password"];
    $expswd = $_POST["ex"];
    $newpswd = $_POST["np"];
    $ncpswd = $_POST["ncp"];

    if (empty($expswd)) {
        echo "Old password is empty!";
    } else if (empty($newpswd)) {
        echo "New password is empty!";
    } else if (strlen($newpswd) < 8 || strlen($newpswd) > 20) {
        echo "Password length should be between 08 and 20 characters!";
    } else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@_])[A-Za-z\d$@_]{8,}$/", $newpswd)) {
        echo "Invalid password!";
    } else if ($newpswd != $ncpswd) {
        echo "Please make sure your passwords match!";
    } else if ($pswd != $expswd) {
        echo "Incorrect old password!";
    } else {


        Database::push("UPDATE `member_account` SET `password` = '" . $newpswd . "' WHERE `id` = '" . $mid . "'");
        $_SESSION["m"] = null;
        setcookie("username", "", -1);
        setcookie("password", "", -1);
        session_destroy();

        echo "signin";
    }
} else {
?>
    <script>
        window.location = "signIn.php";
    </script>
<?php
}
