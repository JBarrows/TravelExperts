<!doctype="html" />
<html>
<head>
    <title>Travel Experts</title>
    <?php include "php/stdhead.php"; ?>
</head>

<body>
    <!-- Landing Page -->
    <div class="titlebg">
        <div class="titlebox">
                <img src="img/logo.png">
	            <h1>Travel Experts</h1>
                <p class="subtitle">we get you where you want to be</p>
		   </div>
	</div>

    <!-- <header> -->
    <?php include "php/header.php" ?>

    <!-- <nav> -->
    <?php $active="index"; include "php/nav.php"; ?>

    <section class='container-fluid no-gutters px-0'>
		<article class='row no-gutters'>
			<img class='col-md-4' style='object-fit:cover;' src="img/beach.jpeg" />
			<div class="col-md-8 artcontent">
				<h2>Breathtaking Packages</h2>
				<p>
					We offer a variety travel packages to suit your needs.
                    From urban conference visits to tropical all-inclusives, we've got you covered.
                    Trips range from weekend stays to extended getaways to fit your busy schedule.
                    See our full listing to see where Travel Experts can take <i>you</i>.
				</p>
				<br>
				<button class='btn btn-info' onclick="window.location.href='packages.php'">View All Travel Packages</button>
			</div>
		</article>
		<article class="row no-gutters bg-2">
			<img class='col-md-4 order-last' style='object-fit:cover;' src="img/agents.jpg" />
			<div class="col-md-8 order-first artcontent">
				<h2>Top Agents</h2>
				<p>
					Our experienced team of travel agents is ready to help.
                    Each of our staff is a specialized master of travel knowledge ready to answer any questions you might have.
                    Get in touch with one of our offices and we will set you up with one of our best, or contact our agents directly.
				</p>
				<br>
				<button class='btn btn-info' onclick="window.location.href='contact.php'">Call Now</button>
			</div>
		</article>
		<article class='row no-gutters'>
			<img class='col-md-4' style='object-fit:cover;' src="img/Sunrise_view_from_a_plane.jpg" />
			<div class="col-md-8 artcontent">
				<h2>Track Your Bookings</h2>
				<p>
                    Our fancy-schmancy web app lets you track your itineraries and bookings online.
                    Android and iOS apps are coming soon, so you can take your bookings with you on the go!
				</p>
				<br>
				<button class='btn btn-info' onclick="window.location.href='register.php'">Register Today</button>
			</div>
		</article>
    </section>

    <!-- <footer> -->
    <?php include "php/footer.php"; ?>

	<script type="application/javascript">

		/* Set the header image to fill the viewport */
		function setLandingSize()
		{
			var landingbg = document.getElementsByClassName("titlebg")[0];
			landingbg.style.height = window.innerHeight;
			console.log("set");
		}

		setLandingSize();
		window.addEventListener("resize", setLandingSize);
	</script>
  </body>
</html>
