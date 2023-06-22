<?php

session_start();

if (isset($_SESSION["m"])) {
    session_destroy();
    unset($_SESSION["m"]);
    unset($_SESSION["p"]);
    unset($_SESSION["a"]);
    unset($_SESSION["ad"]);
    unset($_SESSION["ch"]);

    echo "success";
}
