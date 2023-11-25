<?php
session_start();
unset($_SESSION["cherchercart"]);
header("location:../views/home.php");
?>