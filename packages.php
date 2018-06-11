<!--Programmer: Jonah Aubin Date: June 7/2018
This page will display all available packages being stored inside of the Travel Experts database
and present them an organized view of all vacation packages being offered. Bootstrap and W3schools packages have been implented
to allow for easier navigation through the image sliders
-->
<html>
<head>
    <title>Travel Experts - Travel Packages</title>
    <?php include "php/stdhead.php"; ?>
    <?php include "php/packagesPHP.php";?>

</head>
<body>
    <!-- <header> -->
    <?php include "php/header.php" ?>

    <!-- <nav> -->
    <?php $active='packages'; include "php/nav.php" ?>

    <section>
        <h2 class='text-center'>Packages</h2>
        <br>
        <div class='container-fluid'>
        <!--These containers will contain the images provided from the /img folder and display them with the slider buttons attached to either side -->
        <!--First Package-->
    <div class="jumbotron mx-sm-2 py-4 row">
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
     <!-- Second Package-->
     <div class="jumbotron mx-sm-2 py-4 row">
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
    <!--Third Package-->
    <div class="jumbotron mx-sm-2 py-4 row">
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
   <!--Final package-->
   <div class="jumbotron mx-sm-2 py-4 row">
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
    <?php include "php/footer.php" ?>
</body>
</html>
