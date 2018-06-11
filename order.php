<?php
/*********************************************************
    Created on 2018/06/06 by Joel Barr and Jonah Aubin
    for Travel Experts Threaded Project
    PROJ-207-B  OOSD Spring 2018, SAIT
    Called by: clicking the 'order now' button
                in packages.php
    Function:   Adds necessary data to the
                session and redirects to register.php
***********************************************************/
    if (isset($_GET['orderpackageid']))
    {
        if (session_status() == PHP_SESSION_NONE) { session_start(); }
        $_SESSION['orderpackageid'] = $_GET['orderpackageid'];
		$_SESSION['packagename'] = $_GET['packagename'];
    }

    header ('location: register.php');
?>
