<?php
session_start();
$_SESSION['userid'] = 100;
$_SESSION['orderpackageid'] = 2;



header("location: myaccount.php");
?>
