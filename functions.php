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
		if($conn->query("SELECT CustEmail FROM $record WHERE CustEmail = '$check'")){
			$_SESSION['message'] = 'Email already registered, please go to login';
			fwrite($logfile, "Email already registered nothing was inserted\n"); // for upkeeping :)
		}
		else {
		
		// construct and execute SQL statements using the variables from keys and values above	
		$conn->exec("INSERT INTO $record ($keys) VALUES ($values)");
		
		//retrieve the last ID inserted so i can track my records
		$lastID = $conn->lastInsertId();
		fwrite($logfile, "New record to $record id: $lastID created successfully \n");
		header('Location: account.php');
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
	foreach($userData as $key => $value){
		echo $key;
		$$key = $value; //creates the variables for username and password
	}
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		
		echo "Connection Successful...<br> Validating $record user data...<br>";
		
		// set the PDO error mode to exception so it throws an exception when there is an error
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = "SELECT password FROM agents WHERE username = '$username'";
		$result = $conn->query($sql);
		
		//if result contains a value, the user was found.
		//we then pull the password row and compare it with the entered password
		if($result){
			if((in_array($password, $result->fetch()))){ //fetch() returns an assoc array of the form [password] => value
				echo 'user and pass correct';
			}
			else echo 'user correct, password incorrect';
		}
		else echo 'username not found';
	}
	catch(PDOException $e)
		{
		echo "Error!: " . $e->getMessage();
	}
	//kill the db connection
	$conn = null;
}
			
?>

