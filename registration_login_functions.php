<?php
function insertData($record, $dataArray){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "travelexperts";
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		
		//create a logfile to track errors in database insert
		$logfile = fopen("logfile.txt", "w");
		fwrite($logfile, "Connection Successful.. Inserting data to $record...\n");
		
		// set the PDO error mode to exception so it throws an exception when there is an error
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//intrinsically loop throught the associative array with implode and create SQL style inputs 
		$keys = implode(', ', array_keys($dataArray));
		$values = "'".implode("', '", $dataArray)."'"; 
		
		//first check if an email is already registered
		$check = $dataArray['CustEmail'];
		if($conn->query("SELECT CustEmail FROM $record WHERE CustEmail = '$check'")->fetch()){
			$_SESSION['registrationMessage'] = 'Email ' .$check. ' is already registered, please login';
			fwrite($logfile, "Email already registered nothing was inserted\n"); // for upkeeping :)
		}
		else {
		
		// construct and execute SQL statements using the variables from keys and values above	
		$conn->exec("INSERT INTO $record ($keys) VALUES ($values)");
		
		//retrieve the last ID inserted so i can track my records
		$lastID = $conn->lastInsertId();
		fwrite($logfile, "New record to $record id: $lastID created successfully \n");
		$_SESSION['userid'] = $lastID;
		header('Location: myaccount.php');
		}
		
		
		}
	catch(PDOException $e)
		{
			$errorString = $e->getMessage();
			fwrite($logfile, "Error!: " .$errorString);
		}
	$conn = null;
	fclose($logfile);
}
	
function loginValidate($record, $userData){
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "travelexperts";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		
		//create a logfile to track errors in database insert
		$logfile = fopen("logfile.txt", "w");
		fwrite($logfile, "Connection Successful...<br> Validating $record user data...<br>\n");
		
		// set the PDO error mode to exception so it throws an exception when there is an error
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$email =  $userData['CustEmail'];
		$sql = "SELECT CustPass, CustomerID FROM customers WHERE CustEmail = '$email'";
		$result = $conn->query($sql)->fetch(); //returns an array of the hashed password  and customer ID if CustEmail exists in db

		if($result){
			// now test the user entered password using password_verify()
			if(password_verify($userData['CustPass'] , $result['CustPass'])){
				//if true, then write successful login to log file
				fwrite($logfile, "$email logged in successfully...<br>\n");
				//initiate a session with the user id
				$_SESSION['userid'] = $result['CustomerID'];
				header('Location: myaccount.php');
				
			}
			else $_SESSION['loginMessage'] = 'Invalid Password, please try again!';
		}
		else $_SESSION['loginMessage'] = 'Email does not seem to be registered';
	}
	catch(PDOException $e)
		{
		echo "Error!: " . $e->getMessage();
	}
	//kill the db connection
	$conn = null;
}
			
?>

