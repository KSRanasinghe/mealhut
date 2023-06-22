<?php

session_start();
require "connection.php";

if (isset($_SESSION["m"])) {

    $mid = $_SESSION["m"]["id"];
    $email = $_SESSION["m"]["email"];
    $exemail = $_POST["ex"];
    $newemail = $_POST["ne"];
    $cnemail = $_POST["nce"];

    if (empty($exemail)) {
        echo "Exsisting email address is empty!";

    }else if (empty($newemail)) {
        echo "New email address is empty!";

    }else if (strlen($newemail) >= 75) {
        echo "Email address must be less than 75 characters!";

    } else if (!filter_var($newemail,FILTER_VALIDATE_EMAIL)){
        echo "Invalid email address!";

    } else if ($newemail != $cnemail) {
        echo "Please make sure your email addresses match!";

    } else if ($email != $exemail) {
        echo "Incorrect exsisting email address!";
        
    } else {

        $email_rs = Database::search("SELECT * FROM `member` WHERE `id` = '" . $mid . "'");
        $email_num = $email_rs->num_rows;

        if ($email_num == 1) {
            $email_data = $email_rs->fetch_assoc();
            $uoption_id = $email_data["username_type_id"];

            if ($uoption_id == 2) {
                Database::push("UPDATE `member` SET `email` = '" . $newemail . "' WHERE `id` = '" . $mid . "'");

                Database::push("UPDATE `member_account` SET `username` = '" . $newemail . "' WHERE `member_id` = '" . $mid . "'");
                $_SESSION["m"] = null;
                setcookie("username", "", -1);
                setcookie("password", "", -1);
                session_destroy();

                echo "signin";

            } else {
                Database::push("UPDATE `member` SET `email` = '" . $newemail . "' WHERE `id` = '" . $mid . "'");

                $username_rs = Database::search("SELECT 
                * 
                FROM `member` 
                INNER JOIN `member_account` ON `member`.`id` = `member_account`.`member_id`
                WHERE
                `member`.`id` = '" . $mid . "'");
                $member_data = $username_rs->fetch_assoc();
                $_SESSION["m"] = $member_data;

                echo "success";
            }
        } else {
            echo "error";
        }
    }
} else {
?>
    <script>
        window.location = "signIn.php";
    </script>
<?php
}
