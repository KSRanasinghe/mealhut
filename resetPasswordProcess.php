<?php

require "connection.php";

$email = $_POST["e"];
$newpswd = $_POST["np"];
$ncpswd = $_POST["ncp"];
$vc = $_POST["vc"];

if (empty($email)) {
    echo "Missing email address!";
} else if (empty($vc)) {
    echo "Verification code is empty!";
} else if (empty($newpswd)) {
    echo "New password is empty!";
} else if (strlen($newpswd) < 8 || strlen($newpswd) > 20) {
    echo "Password length should be between 08 and 20 characters!";
} else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@_])[A-Za-z\d$@_]{8,}$/", $newpswd)) {
    echo "Invalid password!";
} else if ($newpswd != $ncpswd) {
    echo "Please make sure your passwords match!";
} else {
    $member_rs = Database::search("SELECT
	member_account.member_id AS mid,
	member_account.verify_code AS vfc 
FROM
	member
	INNER JOIN member_account ON member.id = member_account.member_id 
WHERE
	member.email = '" . $email . "' 
	AND member_account.verify_code = '" . $vc . "'");

    $member_num = $member_rs->num_rows;

    if ($member_num == 1) {
        $member_data = $member_rs->fetch_assoc();
        $mid = $member_data["mid"];
        $vfc = $member_data["vfc"];

        Database::push("UPDATE `member_account` SET `password` = '" . $newpswd . "' WHERE `member_id` = '" . $mid . "' AND `verify_code` = '".$vfc."'");
        echo "success";
    } else {
        echo "error";
    }
}
