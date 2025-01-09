<?php
require "./bts/common.php";
if($_SESSION["username"] != null){
    header("Location: ./profile.php", true, 302);
    exit();
};
?>