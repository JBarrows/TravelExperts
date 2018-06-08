<?php
    if (isset($_GET['orderpackageid']))
    {
        if (session_status() == PHP_SESSION_NONE) { session_start(); }
        $_SESSION['orderpackageid'] = $_GET['orderpackageid'];
		$_SESSION['packagename'] = $_GET['packagename'];
    }

    header ('location: register.php');
?>
