<!doctype="html" />
<html>
<head>
    <title>Travel Experts</title>
    <?php include "php/stdhead.php"; ?>
</head>
<!-- test -->
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
    <?php include "php/nav.php" ?>

    <section>
		<article>
			<img src="img/beach.jpeg" />
			<div class="artcontent">
				<h2>Breathtaking Packages</h2>
				<p>
					We offer over 3(!) travel packages to suit your needs.
                    From urban conference visits to tropical all-inclusives, we've got you covered.
                    Trips range from weekend stays to extended getaways to fit your busy schedule.
                    See our full listing to see where Travel Experts can take <i>you</i>.
				</p>
				<br>
				<button onclick="window.location.href='packages.php'">View All Travel Packages</button>
			</div>
		</article>
		<article class="oddart">
			<img src="img/agents.jpg" />
			<div class="artcontent">
				<h2>Top Agents</h2>
				<p>
					Our experienced team of travel agents is ready to help.
                    Each of our staff is a specialized master of travel knowledge ready to answer any questions you might have.
                    Get in touch with one of our offices and we will set you up with one of our best, or contact our agents directly.
				</p>
				<br>
				<button onclick="window.location.href='contact.php'">Call Now</button>
			</div>
		</article>
		<article>
			<img src="img/Sunrise_view_from_a_plane.jpg" />
			<div class="artcontent">
				<h2>Track Your Bookings</h2>
				<p>
                    Our fancy-schmancy web app lets you track your itineraries and bookings online.
                    Android and iOS apps are coming soon, so you can take your bookings with you on the go!
				</p>
				<br>
				<button onclick="window.location.href='register.php'">Register Today</button>
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
