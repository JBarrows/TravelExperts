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
        // Default to Gerard Biers #143
        $user = 143;

        // TODO: Redirect to registration page instead
        // header("location: login.php?error=invalid+access");
    }

    // Check if a new package has been ordered
    if (isset($_SESSION['orderpackageid']))
    {
        $packageid = $_SESSION['orderpackageid'];
        // SELECT * FROM `packages_products_suppliers` WHERE `PackageId`=$packageid
        // while ($prodSupId = FETCH_ASSOC(^^))
            // SELECT * FROM `products_suppliers` WHERE `ProductSupplierId`=$prodSupId;
            // $prodid = FETCH_ASSOC(^^)['ProductId']
            // SELECT * FROM `products` WHERE `ProductId`=$prodid;
    }

    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "travelexperts";

	try {
        /* Connect to Database */
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

		//create a logfile to track errors in database insert
		$logfile = fopen("logfile.txt", "w");
		fwrite($logfile, "Connection Successful.. Reading data for CustomerId=$user...\n");

		// set the PDO error mode to exception so it throws an exception when there is an error
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Fetch Customer Information */
        $attributes = "`CustomerId`, `CustFirstName`, `CustLastName`, `CustAddress`, `CustCity`, `CustProv`, `CustPostal`, `CustCountry`, `CustHomePhone`, `CustBusPhone`, `CustEmail`";
        $result = $conn->query("SELECT $attributes FROM `customers` WHERE `CustomerId`=$user;");
        $custInfo = $result->fetch(PDO::FETCH_ASSOC);

        /* Fetch booking information */
        $bookingStmt = $conn->query("SELECT * FROM `bookings` WHERE `CustomerId`=$user;");

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
    <?php include "php/nav.php" ?>

<div class="container">
    <section>
        <h2>My Information</h2>
        <!-- TODO: This information should be read from the database -->
        <!-- <tr id='namerow' class='hover-border'> -->
        <div id='accordion'>
            <div class='row'>
                <button class='btn btn-link' data-toggle='collapse' data-target='#nameform'>
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <b>Name: </b>
                <?php echo $custInfo['CustFirstName'] . ' ' . $custInfo['CustLastName']; ?>
            </div>
            <form class='collapse' data-parent='#accordion' id='nameform' name='nameform' action="">
                <div class='form-row'>
                    <div class="form-group col-sm-4 col-md-3">
                        <label for='fname'>First Name</label>
                        <?php
                            echo "<input type='text' class='form-control' id='fname' name='fname' value='".$custInfo['CustFirstName']."' />";
                        ?>
                    </div>
                    <div class="form-group col-sm-4 col-md-3">
                        <label for='lname'>Last Name</label>
                        <?php echo "<input type='text' class='form-control' id='fname' name='lname' value='".$custInfo['CustLastName']."' />"; ?>
                    </div>
                </div>
                <div class='form-group'>
                    <input type="submit" class='btn btn-default' name="namesubmit" value="Submit" />
                </div>
            </form>
            <div class='row'>
                <button class='btn btn-link' data-toggle='collapse' data-target='#phoneform'>
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <strong>Phone: </strong>
                <?php
                    echo $custInfo['CustHomePhone'] . ' (Home)<br>' .
                        $custInfo['CustBusPhone'] . ' (Business)';
                ?>
            </div>
            <form class='collapse' data-parent='#accordion' id='phoneform' name='phoneform'>
                <div class='form-row'>
                    <div class='form-group col-sm-4 col-md-3'>
                        <label for='hphone'>Home</label>
                        <?php echo "<input type='text' class='form-control' id='hphone' name='hphone' value='".$custInfo['CustHomePhone']."' />"; ?>
                    </div>
                    <div class=' form-group col-sm-4 col-md-3'>
                        <label for='bphone'>Business</label>
                        <?php echo "<input type='text' class='form-control' id='bphone' name='bphone' value='".$custInfo['CustBusPhone']."' />"; ?>
                    </div>
                </div>
                <div class='form-group'>
                    <input type="submit" class='btn btn-default' name="phonesubmit" value="Submit" />
                </div>
            </form>
            <div class='row'>
                <button class='btn btn-link' data-toggle='collapse' data-target='#addrform'>
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <strong>Address:</strong>
                <?php
                    echo $custInfo['CustAddress'] . '<br>' .
                        $custInfo['CustCity'] . ', ' . $custInfo['CustProv'] . '<br>' .
                        $custInfo['CustPostal'];
                ?>
            </div>
            <form class='collapse' data-parent='#accordion' id='addrform' name='addrform'>
                <div class='form-row'>
                    <div class='form-group col-sm-8 col-md-6'>
                        <label for='streetaddr'>Street</label>
                        <?php echo "<input type='text' class='form-control' id='streetaddr' name='streetaddr' value='".$custInfo['CustAddress']."'/>"; ?>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group col-sm-4 col-md-3'>
                        <label for='city'>City</label>
                        <?php echo "<input type='text' class='form-control' id='city' name='city' value='".$custInfo['CustCity']."'/>"; ?>
                    </div>
                    <div class='form-group col-sm-4 col-md-3'>
                        <label for='prov'>Province</label>
                        <?php echo "<input type='text' class='form-control' id='prov' name='prov' value='".$custInfo['CustProv']."'/>"; ?>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group col-sm-4 col-md-3'>
                        <label for='postcode'>Postal Code</label>
                        <?php echo "<input type='text' class='form-control' id='postcode' name='postcode' value='".$custInfo['CustPostal']."' />"; ?>
                    </div>
                </div>
                <div class='form-group'>
                    <input type="submit" class='btn btn-default' name="addrsubmit" value="Submit" />
                </div>
            </form>
        </div> <!-- </accordion> -->
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
                <div class='row'>
                    <p class='col-3 col-md-2 col-xl-2'>Booking ID</p>
                    <p class='col-9 col-md-10 col-lg-7'>Information</p>
                </div>
EOT;
            $nthRow = "";
            while ($booking = $bookingStmt->fetch(PDO::FETCH_ASSOC)) {
                $detailStmt = $conn->query("SELECT * FROM `bookingdetails` WHERE `BookingId`={$booking['BookingId']};");
                $nthRow = ($nthRow == "") ? "bg-2" : ""; //Set the background color for odd numbered rows
                echo <<<OPENBOOKING
                    <div class='row {$nthRow}'>
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

        <!-- TODO: Sign in button can be removed once php is active -->
        <button onclick="window.location.href = 'signin.html'">Sign In</button>
    </section>
</div>

    <!-- <footer> -->
    <?php include "php/footer.php" ?>
</body>
</html>
