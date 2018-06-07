<!--Programmer: Jonah Aubin Date: June 7/2018
This page will display all available packages being stored inside of the Travel Experts database
and present them an organized view of all vacation packages being offered. Bootstrap and W3schools packages have been implented
to allow for easier navigation through the image sliders
-->
<html>
<head>
    <title>Travel Experts - Travel Packages</title>
    <!-- <?php include "php/stdhead.php"; ?> -->
    <meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="img/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/solid.css" integrity="sha384-Rw5qeepMFvJVEZdSo1nDQD5B6wX0m7c5Z/pLNvjkB14W6Yki1hKbSEQaX9ffUbWe" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" integrity="sha384-GVa9GOgVQgOk+TNYXu7S/InPTfSDTtBalSgkgqQ7sCik56N9ztlkoTr2f/T44oKV" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <?php include "php/packagesPHP.php";?>

</head>
<body>
    <!-- <header> -->
    <!-- <?php //include "php/header.php" ?> -->
    <header>
        <a href="index.php">
            <img id="headlogo" src="img/logo.png" />
            <p id="headtitle">Travel Experts</p>
        </a>
    </header>
    <!-- <nav> -->
    <!-- <?php// include "php/nav.php" ?> -->
    <nav>
        <button class="menubtn" onclick="toggleMenu()"><i class="fas fa-bars"></i></button>
        <div id="menu">
            <a href="index.html">Home</a>
            <a href="packages.html">Packages</a>
            <a href="contact.html">Contact</a>
            <a href="register.html" class="action">Register</a>
            <a href="signin.html" class="action" style="background:navy;">Sign in</a>
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
    <section>
        <h2>Packages</h2>
        <br>
        <!--These containers will contain the images provided from the /img folder and display them with the slider buttons attached to either side -->
        <!--First Package-->
    <div class="row">
      <div class="w3-content w3-display-container col-lg-7">
        <div class="w3-display-container mySlides">
				      <img class="Slides1" src="img/proj img/carib1.jpg" style="width:100%;height:30%;object-fit:cover;">
        </div>
        <div class="w3-display-container mySlides">
				      <img class="Slides1" src="img/proj img/Carib2.jpg" style="width:100%;height:30%;object-fit:cover;">
        </div>
        <div class="w3-display-container mySlides">
				      <img class="Slides1" src="img/proj img/carib3.jpg" style="width:100%;height:30%;object-fit:cover;">
        </div>
      <button class="w3-button w3-display-left w3-black" onclick="addDivs(-1,0)">&#10094;</button>
      <button class="w3-button w3-display-right w3-black" onclick="addDivs(1,0)">&#10095;</button>
     </div>
     <div class="col-lg-4">
     <?php getPackageDetails(1); ?>
   </div>
   </div>

<br><br>
     <!-- Second Package-->
     <div class="row">
     <div class="w3-content w3-display-container col-lg-7">
       <div class="w3-display-container mySlides1">
             <img class="Slides2" src="img/proj img/asia1.jpg" style="width:100%;height:30%;object-fit:cover;">
       </div>
       <div class="w3-display-container mySlides1">
             <img class="Slides2" src="img/proj img/asia2.jpg" style="width:100%;height:30%;object-fit:cover;">

       </div>
       <div class="w3-display-container mySlides1">
             <img class="Slides2" src="img/proj img/asia3.jpg" style="width:100%;height:30%;object-fit:cover;">
       </div>
     <button class="w3-button w3-display-left w3-black" onclick="addDivs(-1,1)">&#10094;</button>
     <button class="w3-button w3-display-right w3-black" onclick="addDivs(1,1)">&#10095;</button>
    </div>
    <div class="col-lg-4">
    <?php getPackageDetails(3); ?>
  </div>
  </div>
<br><br>
    <!--Third Package-->
    <div class="row">
    <div class="w3-content w3-display-container col-lg-7">
      <div class="w3-display-container mySlides2">
            <img class="Slides3" src="img/proj img/euro1.jpg" style="width:100%;height:30%;object-fit:cover;">
      </div>
      <div class="w3-display-container mySlides2">
            <img class="Slides3" src="img/proj img/euro2.jpg" style="width:100%;height:30%;object-fit:cover;">
      </div>
      <div class="w3-display-container mySlides2">
            <img class="Slides3" src="img/proj img/euro3.jpg" style="width:100%;height:30%;object-fit:cover;">
      </div>
    <button class="w3-button w3-display-left w3-black" onclick="addDivs(-1,2)">&#10094;</button>
    <button class="w3-button w3-display-right w3-black" onclick="addDivs(1,2)">&#10095;</button>
   </div>
   <div class="col-lg-4">
   <?php getPackageDetails(4); ?>
 </div>
 </div>
<br><br>
   <!--Final package-->
   <div class="row">
   <div class="w3-content w3-display-container col-lg-7">
     <div class="w3-display-container mySlides3">
           <img class="Slides4" src="img/proj img/poly1.jpg" style="width:100%;height:30%;object-fit:cover;">
     </div>
     <div class="w3-display-container mySlides3">
           <img class="Slides4" src="img/proj img/poly2.jpg" style="width:100%;height:30%;object-fit:cover;">
     </div>
     <div class="w3-display-container mySlides3">
           <img class="Slides4" src="img/proj img/poly3.jpg" style="width:100%;height:30%;object-fit:cover;">
     </div>
   <button class="w3-button w3-display-left w3-black" onclick="addDivs(-1,3)">&#10094;</button>
   <button class="w3-button w3-display-right w3-black" onclick="addDivs(1,3)">&#10095;</button>
  </div>
<div class="col-lg-4">
  <?php getPackageDetails(2); ?>
</div>
</div>
  <!--This inline script is just to populate the sliders for each package. In order to add to the list that shows
ensure you add a class identifier (SlidesN) to the slideId array and add a new showDivs(index,content number)-->
<script>
  var slideIndex = [1,1];
  var slideId = ["Slides1", "Slides2", "Slides3", "Slides4"]
  showDivs(1, 0);
  showDivs(1, 1);
  showDivs(0, 2);
  showDivs(0, 3);
//this will populate the page with all current slideshows provided
  function addDivs(n, no)
  {
    showDivs(slideIndex[no] += n, no);
  }
//populates each slider with the respected containers holding the images corresponding to the packages
  function showDivs(n, no)
  {
    var i;
    var x = document.getElementsByClassName(slideId[no]);
    if (n > x.length) {slideIndex[no] = 1}
    if (n < 1) {slideIndex[no] = x.length}
    for (i = 0; i < x.length; i++)
    {
       x[i].style.display = "none";
    }
    x[slideIndex[no]-1].style.display = "block";
  }
</script>
</section>
    <br><br>

    <!-- <footer> -->
    <!-- <?php include "php/footer.php" ?> -->
    <footer>
      <p>&copy;SAIT, Joel Barr, and Travel Agents</p>
      <p>
          "<a href="https://flic.kr/p/cTsU15" target="_blank">Sunrise view from a plane</a>"
          by <a href="https://www.flickr.com/photos/frankfarm/" target="_blank">Frank Farm</a>
          is used under the <a href="https://creativecommons.org/licenses/by-nc-nd/2.0/legalcode" target="_blank">cc by-nc-nd 2.0 license</a>.
       </p>
    </footer>
</body>
</html>
