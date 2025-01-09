<?php
require "./bts/config.php";
session_start();
if(!isset($_SESSION["username"])){
    $_SESSION["username"] = null;
}

$active1 = null;
$active2 = null;
$active3 = null;
$active4 = null;
$active5 = null;
?>