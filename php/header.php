<header>
    <a href="index.php">
        <img class='headerlogo' id="headlogo" src="img/logo.png" />
        <p class='headertitle' id="headtitle">Travel Experts</p>
    </a>
</header>
<?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "invalid access")
        {
            echo "<div class='alert alert-danger' role='alert'>You must be signed in to see that page</div>";
        }
    }
?>
