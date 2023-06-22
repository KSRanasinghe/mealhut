<?php

require "connection.php";

if(isset($_GET["id"]) && isset($_GET["c"])){

    $id = $_GET["id"];
    $c = $_GET["c"];

    Database::push("UPDATE `invoice` SET `confirmation_id` = '".$c."' WHERE `id` = '".$id."'");
    echo "success";

}else{
    echo "error";
}