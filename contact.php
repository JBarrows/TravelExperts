<!-- Created by Luke Ce Yao-->
<!doctype="html">
<html>
<head>
    <title>Travel Experts - Account</title>
    <?php include "php/stdhead.php"; ?>
</head>

<body>
    <!-- <header> -->
    <?php include "php/header.php" ?>

    <!-- <nav> -->
    <?php $active = 'contact'; include "php/nav.php" ?>

	<div class = 'container-fluid'>
		<section>

			<h2 align="center">Contact Us</h2>

		<?php
			$con = mysqli_connect("localhost","root","");//connect server
			if (!$con){
			die('Could not connect: ' . mysqli_error());
			}

			mysqli_select_db($con, "travelexperts");//select data from travelexperts
		?>

		<?php
		$result = mysqli_query($con, "SELECT * FROM agencies");
			while($row = mysqli_fetch_array($result)){
			echo "<div class='jumbotron py-4'>";
			echo "<div class='row' style='margin:auto'>";
			echo "<div class='col'>";
			echo "<h2 style='color:blue'>{$row['AgncyCity']}</h2>

				  <b>Phone:  </b>  {$row['AgncyPhone']}</br>
				  <b>Fax:  </b>{$row['AgncyFax']}</br>

				  <b>Address:  </b>{$row['AgncyAddress']} {$row['AgncyCity']} {$row['AgncyProv']}, {$row['AgncyPostal']}</br>";
				 // map
			echo "</div>";
				$agencyID = $row['AgencyId'];
			echo "<div class='col-10' style='margin:auto'>";
				  $resultAgents = mysqli_query($con, "SELECT * FROM agents where AgencyID=$agencyID");
				echo "<div class='row' style='margin:auto'>";
						while($rowAgents = mysqli_fetch_array($resultAgents)){
						//echo "<div class='col-4'>";
						echo "<div class='card text-right' style='width: 21rem; margin: 0.5%;'>";
						echo  "<div class='card-body'>";
						echo "<h5 class='card-title'>{$rowAgents['AgtFirstName']} {$rowAgents['AgtMiddleInitial']} 		   	{$rowAgents['AgtLastName']}</h5>";
						echo "<h6 class='card-subtitle mb-2 text-muted'> {$rowAgents['AgtPosition']}</h6>";
						echo "<div class='card-text'>{$rowAgents['AgtBusPhone']}</div>";
						echo "<div class='card-text'>{$rowAgents['AgtEmail']}</div>";
						echo "</div>";
						echo "</div>";
						//echo "</div>";
						}
				echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}

		?>

		</table>
		</div>
		</section>
	</div>



    <!-- <footer> -->
		<?php include "php/footer.php" ?>
</body>
</html>
