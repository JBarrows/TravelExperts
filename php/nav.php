<nav>
    <button class="menubtn" onclick="toggleMenu()"><i class="fas fa-bars"></i></button>
    <div id="menu">
        <a href="index.php"><i class="fas fa-home"></i></a>
        <a href="packages.php">Packages</a>
        <a href="contact.php">Contact</a>
        <a href="register.php" class="action"><i class="fas fa-caret-down"></i>Account</a>
        <a href="signin.php" class="action" style="background:navy;">Sign in</a>
        <!-- <a href="signin.php" class="action">Sign out</a> -->
    </div>

    <script>  /// Opens/Closes menu in narrow views
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
    </script>
</nav>
