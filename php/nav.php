<nav class="navbar navbar-expand-md navbar-light jnav">
    <div></div>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbar'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbar'>
        <div class='navbar-nav justify-content-end'>
            <a class='nav-item nav-link' href="index.php"><i class="fas fa-home"></i></a>
            <a class='nav-item nav-link' href="packages.php">Packages</a>
            <a class='nav-item nav-link' href="contact.php">Contact</a>
            <?php
            if (session_status() == PHP_SESSION_NONE) { session_start(); }
            // Get login session information
            if (isset($_SESSION['userid'])) {
                echo <<<DROPDOWN
                <div class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle cursor-pointer' role='button' data-toggle='dropdown'>
                        My Account
                    </a>

                    <div class='dropdown-menu dropdown-menu-right'>
                        <a class='dropdown-item' href='php/logout.php'>Sign Out</a>
                        <a class='dropdown-item' href='myaccount.php'>My Account</a>
                    </div>
                </div>
DROPDOWN;
            } else {
                echo "<a class='nav-link cursor-pointer' role='button' href='register.php'>
                    Sign In
                </a>";
            }
            ?>
        </div>
    </div>
</nav>
