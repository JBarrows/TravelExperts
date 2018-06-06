
	
<?php
	session_start();
	/*if(isset($_SESSION['userid'])) {
				header('Location: register_agent.php');
	}*/	
	
	$processed_array = array(); //new array to store processed_array
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		function test_input($data) {
		($data == '')? $data = NULL: $data = $data;
		 $data = trim($data);
		 $data = stripslashes($data);
		 $data = htmlspecialchars($data);
		 return $data;
		}
		
		$processed_array = array(); //new array to store processed_array
		
		foreach($_POST as $key => $value){
			$processed_array[$key] = test_input($value);
		}
	
		include 'registration_login_functions.php';
		
		//populate agentID to empty string as our infrastucture doest allow for agentIDs to be inputted yet
		array_merge($processed_array, array('AgentId'=>''));
		//print_r($processed_array);
		insertData($record = 'customers', $processed_array);
	}
?>
<!doctype="html">
<html>
<head>
    <title>Travel Experts - Register</title>
    <!-- <?php include "php/stdhead.php"; ?> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/solid.css" integrity="sha384-Rw5qeepMFvJVEZdSo1nDQD5B6wX0m7c5Z/pLNvjkB14W6Yki1hKbSEQaX9ffUbWe" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" integrity="sha384-GVa9GOgVQgOk+TNYXu7S/InPTfSDTtBalSgkgqQ7sCik56N9ztlkoTr2f/T44oKV" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css">
	<link rel="icon" href="img/favicon.png" />
</head>

<body>
		<!--<header>-->
		<?php include "php/header.php" ?>
		<!-- <nav> -->
		<?php include "php/nav.php" ?>
		
		<script>
		function confirmReset(){
				//reset forms to default value by removing required and other added attributes
				
				if(confirm("Are you sure you want to reset?")){										//only reset if confirm returns true
				
					$("form input").removeAttr("required", "required");					//remove required attribute to reset
					return true;
				}
				else return false;
		}
		function confirmRegister(){
			//enforce a check if user clicks register without filling form
			//only true if user clicks true on checkbox and required attribute has been set to input forms
			
			if(confirm("Are you sure you want to register?")){
				
				$("form input.req").attr("required", "required");					//add required attribute to register
				return true;
			}
			else return false;
		}
		</script>
		
		

		<section style = "padding-top: 20px">
		 
			<div class= "row">
				<div class= "col-sm col"></div>
				<div class= "col-sm-6 col-10">
				<p style ="color : red; text-align:center;">
				<?php
				if(isset($_SESSION['message'])){
									echo $_SESSION['message'];
								}
				?>
				</p>
					<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id ="register" method = "post">
					<legend>Sign Up!</legend>
					  <div class="form-row">
						<div class="form-group col-md-6">
						  <label for="inputEmail4">First Name</label>
						  <input type = "text" name = "CustFirstName"  
											   minlength = "1"
											   class="form-control req"
											   title = "What is your name? "
											   placeholder = "First Name"> 
						</div>
						<div class="form-group col-md-6">
						  <label for="inputPassword4">Last Name</label>
						  <input type = "text" name = "CustLastName" 
											   minlength = "1"
											   class="form-control req"
											   title = "What is your name?" 
											   placeholder = "Last Name">
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputAddress">Address</label>
						<input type = "text" name = "CustAddress" 
											   minlength = "1"
											   title = "Please enter your address"
											   class="form-control req"
											   placeholder = "1234 Main St">
					  </div>
					  
					  <div class="form-row">
						<div class="form-group col-md-3">
						  <label for="inputCity">City</label>
						  <input type="text" name= "CustCity"
											 class="form-control req" id="inputCity">
						</div>
						
						<div class="form-group col-md-4">
						  <label for="inputState">State</label>
						  <select id="inputState" class="form-control req" name ="CustProv">
											<option selected="selected">Select a province</option>
											<option value="AB">AB</option>
											<option value="BC">BC</option>
											<option value="MB">MB</option>
											<option value="NB">NB</option>
											<option value="NL">NL</option>
											<option value="NS">NS</option>
											<option value="ON">ON</option>
											<option value="PE">PE</option>
											<option value="QC">QC</option>
											<option value="SK">SK</option>
											<option value="NT">NT</option>
											<option value="NU">NU</option>
											<option value="YT">YT</option>
						  </select>
						</div>
						
						<div class="form-group col-md-2">
						  <label for="inputZip">Zip</label>
						  <input type = "text" name = "CustPostal" 
											   pattern ="[AaBbCcEeGgHhJjKkLlMmNnPpRrSsTtVvXxYy][0-9][AaBbCcEeGgHhJjKkLlMmNnPpRrSsTtVvXxYyZz] ?[0-9][AaBbCcEeGgHhJjKkLlMmNnPpRrSsTtVvXxYyZz][0-9] ?"
											   maxlength = "7"
											   class="form-control req"
											   title = "Enter a valid Canadian post code, eg: T2X 1V2">
						</div>
						
						<div class="form-group col-md-3">
						  <label for="inputCountry">Country</label>
						  <select class="form-control" name ="CustCountry">
										<option value="Canada" selected="selected">Canada</option>
										<option value="other">Other</option>
										</select>
						</div>
					  </div>
					 <div class="form-row">
						<div class="form-group col-md-6">
						  <label for="inputCity">Home Phone</label>
						  <input type = "text" name = "CustHomePhone" 
											   title = "Enter office phone"
											   class="form-control req"
											   pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}">
						</div>
						<div class="form-group col-md-6">
						  <label for="inputCity">Business Phone</label>
						   <input type = "text" name = "CustBusPhone" 
											   title = "Enter office phone"
											   class="form-control"
											   pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}">
						</div>
					 </div>
					 
					 <div class="form-group">
						<label for="inputAddress">Email</label>
						<input type = "email" name = "CustEmail" 
											   minlength = "1"
											   title = "Please enter your address"
											   class="form-control req"
											   placeholder = "name@example.com">
					 </div>
					 <div class= "form-row">
									<div class="form-group col-md-6">
										<input type = "submit" class = "btn btn-primary btn-block" value = "Register" onclick = "return confirmRegister()">
									</div>
									<div class= "col">
										<input type = "reset" class = "btn btn-danger btn-block" value = "Reset" onclick = "return confirmReset()">
									</div>
					 </div>
					 
					</form>														
				</div>
				<div class= "col-sm col"></div>
			</div>
		</section>
	</div>
		
		<!-- <footer> -->
		<?php include "php/footer.php" ?>
	
</body>
</html>
<?php
unset($_SESSION['message']);
?>