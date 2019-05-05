<!DOCTYPE HTML>
<html>
	<head>

	<!-- Stylesheet -->
	<link rel="stylesheet" href="../css/emp_reg_css.css">
	</head>

	<body>

	<?php

	/* START THE SESSION */
	session_start();

	// Connects to the database
	$con = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");

	if (isset($_POST)) {
		// Used to grab posted username/pw
		$empid = mysqli_real_escape_string($con, $_POST['empid']);
		$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
		$email = mysqli_real_escape_string($con, $_POST['email']);

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

			// Query to add empid and first name into database
			$sql = "INSERT INTO employees (empid, first_name, email) VALUES ('$empid', '$first_name', '$email')";
			$result = mysqli_query($con, $sql);

		}

		// Check if registration worked
		if($result) {
			echo "<h1> Employee Registration successful!</h1>";
			echo "<h2>Employee ID & Info added.</h2>";
			echo "<h2>Returning to Employee IDs page...</h2>";

			// Waits for 3 seconds before redirecting
			header('refresh:3; url=https://cgi.soic.indiana.edu/~team59/app/EmployeeIDs.php');
		}
		else {
			echo "<h1>Registration failed. </h1>";
			echo "<h2>Returning to Employee IDs page...</h2>";

			// Waits for 3 seconds before redirecting
			header('refresh:3; url=https://cgi.soic.indiana.edu/~team59/app/EmployeeIDs.php');
		}
	}
	?>


				<!-- ESIM Logo -->
					<p class="ESIM_logo">ESIM</p>

			</body>
		</html>
