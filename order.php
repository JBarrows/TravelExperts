<?php
    if (isset($_GET['orderpackageid']))
    {
        if (session_status() == PHP_SESSION_NONE) { session_start(); }
        $_SESSION['orderpackageid'] = $_GET['orderpackageid'];
    }

    header ('location: register.php');
?>
