<?php

session_start();

if (isset($_SESSION["p"])) {
    $pickup = $_SESSION["p"];
    if ($pickup == 1) {
        $_SESSION["p"] = 2;
        echo "success";
    } else if ($pickup == 2) {
        $_SESSION["p"] = 1;
        echo "success";
    }
} else {
    echo "error";
}
