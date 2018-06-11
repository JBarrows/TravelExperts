<!--Olaoluwa Adesanya-->

<?php
	//start or check for a session
	session_start();
	if(isset($_SESSION['userid'])) {
				//redirect to myaccount page if user is logged
				header('Location: myaccount.php');
	}

	include 'registration_login_functions.php';
	$processed_array = array(); //new array to store registration processed_array
	
	//the next couple of blocks process the registration/login forms
	//test to see if request is sent using POST
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		//since were processing both the registration and login on the same page,
		//test for a unique name to the regiter form i.e CustFirstName to process registration module
		if (in_array('CustFirstName',array_keys($_POST))){

			//function to test and validate registration input on the server
			//strip slashes, unnecessary whitespace and html special characters to prevent script injection
			function test_input($data) {
			($data == '')? $data = NULL: $data = $data;
			 $data = trim($data);
			 $data = stripslashes($data);
			 $data = htmlspecialchars($data);
			 return $data;
			}

			foreach($_POST as $key => $value){
				$processed_array[$key] = test_input($value);
			}

			//only store an hash value of the password with salt for better security
			$processed_array['CustPass'] = password_hash(trim($processed_array['CustPass']), PASSWORD_DEFAULT);

			//populate agentID to empty string as our infrastucture doest allow for agentIDs to be inputted yet
			array_merge($processed_array, array('AgentId'=>''));

			//finally insert the data to DB
			insertData($record = 'customers', $processed_array);
		}
		else{ //for login module
		loginValidate($record = 'customers', $_POST);
		}
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

	<!-- display a message if user is booking a package-->
	<div class='container'>
	<?php
    if (isset($_SESSION['packagename'])) {
        {
			$booking = $_SESSION['packagename'];
            echo "<div class='alert alert-success' text-align='center' role='alert'>You are currently booking the $booking </div>";
			unset($_SESSION['packagename']);
        }
    }
	?>
	</div>
    <!-- <nav> -->
    <?php $active = 'register'; include "php/nav.php" ?>
	<!-- the next couple of blocks are javascript for the dynamic page-->
		<script>
		function confirmReset(){
				//reset forms to default value by removing required and other added attributes

				if(confirm("Are you sure you want to reset?")){										//only reset if confirm returns true

					$("#register input").removeAttr("required", "required");					//remove required attribute to reset
					return true;
				}
				else return false;
		}
		function confirmRegister(){
			//enforce a check if user clicks register without filling form

			//add required attribute to compulsory fields in registration form
			$("#register input.req").attr("required", "required");	
		}
		function confirmLogin(){
		//enforce a check if user clicks login without filling form
			//add required attribute to login
			$("#login input").attr("required", "required");					

		}
		function showHidePassword(){
			
			$("#eye").toggleClass("fa-eye-slash fa-eye", "addOrRemove");
			
			//fancy tenary operator to switch between password and text
			$("#eye").hasClass("fa-eye-slash") ? $("#password").attr("type", "password") : $("#password").attr("type", "text");


		}
		
		</script>


		<!--Begin forms-->
		<div class= "container-fluid" style = "padding-top: 30px">
			<div class= "row">
				<div class= "col-sm order-sm-last">
					<div class= "row">
						<div class= "col"></div>
						<div class= "col-10 jumbotron py-4">
							<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id ="login" method = "post">
							<legend>Sign In!</legend>
							  <div class="form-row">
								<div class="form-group col">
								  <label for="inputEmail4">Email</label>
								  <input type = "email" name = "CustEmail"
													   minlength = "1"
													   class="form-control req"
													   placeholder = "name@example.com">
								</div>
							  </div>
							   <div class="form-row">
								<div class="form-group col">
								  <label for="inputPassword4">Password</label>
								  <input type = "password" name = "CustPass"
													   minlength = "1"
													   class="form-control req"
													   placeholder = "">
								</div>
							   </div>
							   <?php
							   //display error message form login validation
									if(isset($_SESSION['loginMessage'])){
														echo "<p style ='color : red; text-align:center;'>";
														echo $_SESSION['loginMessage'];
														echo "</p>";
														unset($_SESSION['loginMessage']);
													}
								?>
							   <div class= "form-row">
											<div class="form-group col">
												<input type = "submit" class = "btn btn-primary btn-block" value = "Login" onclick = "return confirmLogin()">
											</div>
							   </div>
							</form>
						</div>
						<div class= "col"></div>
					</div>
				</div>

				<!--registration form begins-->
				<div class= "col-sm-8 order-sm-first">
					<div class= "row">
						<div class= "col"></div>
						<div class= "col-10 jumbotron py-4">
						<?php
						//display error message form registration
						if(isset($_SESSION['registrationMessage'])){
											echo "<p style ='color : red; text-align:center;'>";
											echo $_SESSION['registrationMessage'];
											echo "</p>";
											unset($_SESSION['registrationMessage']);
										}
						?>
							<!--send form elements to the same page-->
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


							 <div class="form-row">
								<div class="form-group col-md-6">
								  <label for="inputAddress">Email</label>
									<input type = "email" name = "CustEmail"
													   minlength = "1"
													   title = "Please enter your address"
													   class="form-control req"
													   placeholder = "name@example.com">
								</div>
								<div class="form-group col-md-6">
								  <label for="inputPassword">Password</label>
								  <div class="input-group mb-3">
									  <input class="form-control" type="password" id = "password" name = "CustPass"
													   title = "Must be at least 6 characters"
													   minlength = "6" aria-describedby="basic-addon2">
									  <div class="input-group-append">
										 <button class="btn btn-primary" type="button" onclick = "return showHidePassword()"><i class="fa fa-eye-slash"  id="eye" aria-hidden="true"></i></button>
									  </div>
								  </div>
								</div>
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
						<div class= "col"></div>
					</div>
				</div>


			</div>
		</div>


		<!-- <footer> -->
		<?php include "php/footer.php" ?>

</body>
</html>
