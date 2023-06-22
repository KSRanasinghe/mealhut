<?php

session_start();
require "connection.php";

if (isset($_SESSION["m"])) {

    $mid = $_SESSION["m"]["id"];
    $mobile = $_SESSION["m"]["mobile"];
    $exmobile = $_POST["em"];
    $newmobile = $_POST["nm"];
    $ncmobile = $_POST["ncm"];

    if (empty($exmobile)) {
        echo "Exsisting phone number is empty!";

    }else if (empty($newmobile)) {
        echo "New phone number is empty!";

    }else if (strlen($newmobile) != 10) {
        echo "Mobile Number should contain 10 characters!";

    } else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $newmobile)){
        echo "Invalid Mobile Number!";

    } else if ($newmobile != $ncmobile) {
        echo "Please make sure your new phone numbers match!";

    } else if ($mobile != $exmobile) {
        echo "Incorrect exsisting phone number!";
        
    } else {

        $mobile_rs = Database::search("SELECT * FROM `member` WHERE `id` = '" . $mid . "'");
        $mobile_num = $mobile_rs->num_rows;

        if ($mobile_num == 1) {
            $mobile_data = $mobile_rs->fetch_assoc();
            $uoption_id = $mobile_data["username_type_id"];

            if ($uoption_id == 1) {
                Database::push("UPDATE `member` SET `mobile` = '" . $newmobile . "' WHERE `id` = '" . $mid . "'");

                Database::push("UPDATE `member_account` SET `username` = '" . $newmobile . "' WHERE `member_id` = '" . $mid . "'");
                $_SESSION["m"] = null;
                setcookie("username", "", -1);
                setcookie("password", "", -1);
                session_destroy();

                echo "signin";

            } else {
                Database::push("UPDATE `member` SET `mobile` = '" . $newmobile . "' WHERE `id` = '" . $mid . "'");

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
