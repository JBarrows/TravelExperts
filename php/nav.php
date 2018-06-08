<?php
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
    if (!isset($active)) { $active = ''; }
    // Get login session information
    if (isset($_SESSION['userid'])) {
        $myacctActive = $active == 'myaccount' ? 'active' : '';
        $acctItm = "<div class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle cursor-pointer $myacctActive' role='button' data-toggle='dropdown'>
                            My Account
                        </a>

                        <div class='dropdown-menu dropdown-menu-right'>
                            <a class='dropdown-item' href='php/logout.php'>Sign Out</a>
                            <a class='dropdown-item $myacctActive' href='myaccount.php'>My Account</a>
                        </div>
                    </div>";
    } else {
        $acctItm = "<a class='nav-link cursor-pointer ".($active == 'register' ? 'active' : '')."' role='button' href='register.php'>
                        Sign In
                    </a>";
    }
?>

<nav class="navbar navbar-expand-md navbar-light jnav">
    <div></div>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbar'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbar'>
        <div class='navbar-nav justify-content-end'>
            <?php
            echo "<a class='nav-item nav-link ".($active == 'index' ? 'active' : '')."' href='index.php'><i class='fas fa-home'></i></a>
                <a class='nav-item nav-link ".($active == 'packages' ? 'active' : '')."' href='packages.php'>Packages</a>
                <a class='nav-item nav-link ".($active == 'contact' ? 'active' : '')."' href='contact.php'>Contact Us</a>";
                echo $acctItm;
            ?>
        </div>
    </div>
</nav>
