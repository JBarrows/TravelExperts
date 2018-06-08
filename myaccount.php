<!------------------------------------------------
    Created on 2018/05/31 by Joel Barr
    for Travel Experts Threaded Project
    PROJ-207-B  OOSD Spring 2018, SAIT
------------------------------------------------->
<?php
	session_start();

    // Get login session information
    if (isset($_SESSION['userid'])) {
        $user = $_SESSION['userid'];
    } else {
		// Redirects to login page
		header("location: register.php?error=invalid+access");
    }

    // Check if a new package has been ordered
    if (isset($_SESSION['orderpackageid']))
    {
        $packageid = $_SESSION['orderpackageid'];
		unset($_SESSION['orderpackageid']);
    }

    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "travelexperts";


    /* Connect to Database */
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

		//create a logfile to track errors in database insert
		$logfile = fopen("logfile.txt", "w");
		fwrite($logfile, "Connection Successful.. Reading data for CustomerId=$user...\n");

		// set the PDO error mode to exception so it throws an exception when there is an error
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
		$errorString = $e->getMessage();
		fwrite($logfile, "Error!: " .$errorString);
        echo $errorString;
	}

    // Check if a new package is being ordered
    if (isset($packageid))
    {
		fwrite($logfile, "Packageorder found! Reading from packageID=1...\n");
        try {
            $selectPackage = $conn->query("SELECT * FROM `packages` WHERE `PackageId`=$packageid");
            $package = $selectPackage->fetch(PDO::FETCH_ASSOC);

            // Create Booking values
            $values = array();
            $values['BookingDate'] = "'".strftime('%F')."'";
            $values['BookingNo'] = "'".strval(mt_rand(1235,254123)."'");
            $values['TravelerCount'] = 1;
            $values['CustomerId'] = $user;
            $values['TripTypeId'] = "'L'";
            $values['PackageId'] = $packageid;

            // Insert Booking
            $attrStr = '`' . implode('`, `', array_keys($values)) . '`';
            $valStr = implode(', ', $values);
            $sql = "INSERT INTO `bookings`($attrStr) VALUES ($valStr);";
			fwrite($logfile, "Writing to 'Bookings' :\n $sql \n");
            $conn->exec($sql);


            // Make sure to get the booking ID!
            $bookId = $conn->lastInsertId();

            // Create BookingDetail values
            $values = array();
            $values['TripStart'] = "'".$package['PkgStartDate']."'";
            $values['TripEnd'] = "'".$package['PkgEndDate']."'";
            $values['Description'] = "'".$package['PkgDesc']."'";
            $values['Destination'] = "'".$package['PkgName']."'";
            $values['BasePrice'] = $package['PkgBasePrice'];
            $values['AgencyCommission'] = $package['PkgAgencyCommission'];
            $values['BookingId'] = $bookId;

            // Insert BookingDetail
            $attrStr = '`' . implode('`, `', array_keys($values)) . '`';
            $valStr = implode(', ', $values);
            $sql = "INSERT INTO `bookingdetails`({$attrStr}) VALUES ({$valStr});";
			fwrite($logfile, "Writing to 'Bookingdetails' :\n $sql \n");
            $conn->exec($sql);

            // Display Message
            $message = "Congratulations! {$package['PkgName']} booked!";

        } catch(PDOException $e) {
            $errorString = $e->getMessage();
            fwrite($logfile, "Error!: " .$errorString);
            echo $errorString;
        }
    } else {fwrite($logfile, "Packageorder not found. ignoring...\n");}

    /* Fetch Customer Information */
    try {
        $attributes = "`CustomerId`, `CustFirstName`, `CustLastName`, `CustAddress`, `CustCity`, `CustProv`, `CustPostal`, `CustCountry`, `CustHomePhone`, `CustBusPhone`, `CustEmail`";
        $result = $conn->query("SELECT $attributes FROM `customers` WHERE `CustomerId`=$user;");
        $custInfo = $result->fetch(PDO::FETCH_ASSOC);

        /* Fetch booking information */
        $bookingStmt = $conn->query("SELECT * FROM `bookings` WHERE `CustomerId`=$user ORDER BY `BookingDate` DESC;");

    } catch(PDOException $e) {
		$errorString = $e->getMessage();
		fwrite($logfile, "Error!: " .$errorString);
        echo $errorString;
	}
?>

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
    <?php $active="myaccount"; include "php/nav.php"; ?>


<section>
	<div class="container">
        <?php
            if (isset($message)) {
                echo "<div class='alert alert-success'>$message</div>";
            }
        ?>

		<div class='jumbotron py-4'>
        <h2>My Information</h2>
        <!-- TODO: This information should be read from the database -->
        <!-- <tr id='namerow' class='hover-border'> -->
        <div id='accordion' class='col-sm-10 col-md-7 col-lg-6'>
            <div class='row hover-border'>
                <button class='btn btn-link col-1' data-toggle='collapse' data-target='#nameform'>
                    <i class="fas fa-pencil-alt"></i>
                </button>
				<div class='col-3 col-lg-2 text-right'>
                	<b>Name: </b>
				</div>
				<div class='col'>
                	<?php echo $custInfo['CustFirstName'] . ' ' . $custInfo['CustLastName']; ?>
				</div>
            </div>

            <form class='collapse' data-parent='#accordion' id='nameform' name='nameform' action="">
                <div class='form-row'>
                    <div class="form-group col-md-6">
                        <label for='fname'>First Name</label>
                        <?php
                            echo "<input type='text' class='form-control' id='fname' name='fname' value='".$custInfo['CustFirstName']."' />";
                        ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for='lname'>Last Name</label>
                        <?php echo "<input type='text' class='form-control' id='fname' name='lname' value='".$custInfo['CustLastName']."' />"; ?>
                    </div>
                </div>
                <div class='form-group'>
                    <input type="submit" class='btn btn-default' name="namesubmit" value="Submit" />
                </div>
            </form>

            <div class='row mt-2 hover-border'>
                <button class='btn btn-link col-1' data-toggle='collapse' data-target='#phoneform'>
                    <i class="fas fa-pencil-alt"></i>
                </button>
				<div class='col-3 col-lg-2 text-right'>
                	<strong>Phone: </strong>
				</div>
				<div class='col'>
	                <?php
	                    echo $custInfo['CustHomePhone'] . ' (Home)<br>';
	                    if ($custInfo['CustBusPhone'] != "") {
							echo $custInfo['CustBusPhone'] . ' (Business)';
						}
	                ?>
				</div>
            </div>

			<form class='collapse' data-parent='#accordion' id='phoneform' name='phoneform'>
                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <label for='hphone'>Home</label>
                        <?php echo "<input type='text' class='form-control' id='hphone' name='hphone' value='".$custInfo['CustHomePhone']."' />"; ?>
                    </div>

                    <div class=' form-group col-md-6'>
                        <label for='bphone'>Business</label>
                        <?php echo "<input type='text' class='form-control' id='bphone' name='bphone' value='".$custInfo['CustBusPhone']."' />"; ?>
                    </div>
                </div>
                <div class='form-group'>
                    <input type="submit" class='btn btn-default' name="phonesubmit" value="Submit" />
                </div>
            </form>

            <div class='row  mt-2 hover-border'>
                <button class='btn btn-link col-1' data-toggle='collapse' data-target='#addrform'>
                    <i class="fas fa-pencil-alt"></i>
                </button>
				<div class='col-3 col-lg-2 text-right'>
	                <strong>Address:</strong>
				</div>
				<div class='col'>
	                <?php
	                    echo $custInfo['CustAddress'] . '<br>' .
	                        $custInfo['CustCity'] . ', ' . $custInfo['CustProv'] . '<br>' .
	                        $custInfo['CustPostal'];
	                ?>
				</div>
            </div>

            <form class='collapse' data-parent='#accordion' id='addrform' name='addrform'>
                <div class='form-row'>
                    <div class='form-group col'>
                        <label for='streetaddr'>Street</label>
                        <?php echo "<input type='text' class='form-control' id='streetaddr' name='streetaddr' value='".$custInfo['CustAddress']."'/>"; ?>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <label for='city'>City</label>
                        <?php echo "<input type='text' class='form-control' id='city' name='city' value='".$custInfo['CustCity']."'/>"; ?>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='prov'>Province</label>
                        <?php echo "<input type='text' class='form-control' id='prov' name='prov' value='".$custInfo['CustProv']."'/>"; ?>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <label for='postcode'>Postal Code</label>
                        <?php echo "<input type='text' class='form-control' id='postcode' name='postcode' value='".$custInfo['CustPostal']."' />"; ?>
                    </div>
                </div>
                <div class='form-group'>
                    <input type="submit" class='btn btn-default' name="addrsubmit" value="Submit" />
                </div>
            </form>
        </div> <!-- </accordion> -->
		</div> <!-- </Jumbotron> -->
		<br />
        <!-----------------------
            My Orders
        ------------------------->
        <h2>My Orders</h2>

        <?php
            if ($bookingStmt == false) {
                echo "<p>(No orders Found)</p>";
            }
            echo <<<EOT
                <div class='row font-weight-bold'>
                    <p class='col-3 col-md-2 col-xl-2 text-right'>Booking ID</p>
                    <p class='col-9 col-md-10 col-lg-7'>Information</p>
                </div>
EOT;
            $nthRow = "";
            while ($booking = $bookingStmt->fetch(PDO::FETCH_ASSOC)) {
                $detailStmt = $conn->query("SELECT * FROM `bookingdetails` WHERE `BookingId`={$booking['BookingId']};");
                $nthRow = ($nthRow == "") ? "bg-2" : ""; //Set the background color for odd numbered rows
                echo <<<OPENBOOKING
                    <div class='row {$nthRow} py-2'>
                        <div class='text-right col-3 col-md-2 col-lg-2'>{$booking['BookingNo']}</div>
                        <div class='col-9 col-md-10 col-lg-7'>
OPENBOOKING;
                while ($details = $detailStmt->fetch(PDO::FETCH_ASSOC)) {
                    echo <<<TRIPDETAILS
                                <div class='row'>
                                <p class='col-md-4 col-lg-3'><strong>{$details['Destination']}</strong></p>
                                <p class='col-md-8 col-lg-9'>{$details['TripStart']} until {$details['TripEnd']}</p>
                            </div>
                            <div class='row'>
                                <p class='col'>{$details['Description']}</p>
                            </div>
TRIPDETAILS;
                }

                echo <<<CLOSEBOOKING
                            <div class='row'>
                                <div class='col-4 col-lg-3'>
                                    <b>Date Placed</b><br>{$booking['BookingDate']}
                                </div>
                                <div class='col-4 col-lg-3'>
                                    <b>Travelers</b><br>{$booking['TravelerCount']}
                                </div>
                                <div class='col-4 col-lg-3'>
                                    <b>Type</b><br>{$booking['TripTypeId']}
                                </div>
                            </div>
                        </div>
                    </div>
CLOSEBOOKING;
            }
        ?>

	</div> <!-- </container-fluid> -->
</section>

    <!-- <footer> -->
    <?php include "php/footer.php" ?>
</body>
</html>
