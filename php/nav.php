<nav class="navbar navbar-expand-md navbar-light jnav">
    <!-- <button class="menubtn" onclick="toggleMenu()"><i class="fas fa-bars"></i></button> -->
    <!-- <div id="menu"> -->
    <div></div>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbar'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbar'>
        <div class='navbar-nav justify-content-end'>
            <a class='nav-item nav-link' href="index.php"><i class="fas fa-home"></i></a>
            <a class='nav-item nav-link' href="packages.php">Packages</a>
            <a class='nav-item nav-link' href="contact.php">Contact</a>
            <div class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle cursor-pointer' role='button' data-toggle='dropdown'>
                    Account
                </a>
                <div class='dropdown-menu dropdown-menu-right'>
                    <a class='dropdown-item' href='signin.php'>Sign In</a>
                    <a class='dropdown-item' href='register.php'>Register</a>
                    <div class="dropdown-divider"></div>
                    <a class='dropdown-item' href='php/logout.php'>Sign Out</a>
                    <a class='dropdown-item' href='register.php'>My Account</a>
                </div>
            </div>
        </div>
    </div>
        <!-- <a href="register.php" class="action"><i class="fas fa-caret-down"></i>Account</a>
        <a href="signin.php" class="action" style="background:navy;">Sign in</a> -->
        <!-- <a href="signin.php" class="action">Sign out</a> -->
    <!-- </div> -->

    <!-- <script>  /// Opens/Closes menu in narrow views
        var menuOpen = false;

        function toggleMenu() {
            var menu = document.getElementById("menu");
            if (!menu) {return;}

            if (menuOpen) {
                //Close menu
                menu.style.display = null;
            } else {
                //Open menu
                menu.style.display = "block";
            }
            menuOpen = !menuOpen;
        }
    </script> -->
</nav>
