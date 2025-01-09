<?php
require "./bts/common.php";
if($_SESSION["username"] == null){
    header("Location: ./login.php", true, 302);
    exit();
};
?>