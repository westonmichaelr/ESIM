<!DOCTYPE HTML>
<html>
	<head>

	<!-- Stylesheet -->
	<link rel="stylesheet" href="../css/lr_css.css">
	</head>

	<body>

<?php

// Connects to the database
$con = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");

if (isset($_POST)) {
	// Used to grab posted username/pw
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$conf_password = mysqli_real_escape_string($con, $_POST['conf_password']);
	$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);

	// Hashes the given password and stores it as a variable
	$hash = password_hash($password, PASSWORD_DEFAULT);

	// Check if password matches the confirm password and the email is valid
	if (($password == $conf_password) && (filter_var($email, FILTER_VALIDATE_EMAIL))) {

			// Query to add username and hashed pw into database
			$sql = "INSERT INTO managers (USERNAME, PASSWORD, EMAIL, FIRST_NAME) VALUES ('$username', '$hash', '$email', '$first_name')";
			$result = mysqli_query($con, $sql);
	}

	// Check if registration worked
	if($result) {
		echo "<h1>Registration successful!</h1>";
		echo "<h2>Username & password added.</h2>";
		echo "<h2>Returning to login page...</h2>";

		// Waits for 3 seconds before redirecting
		header('refresh:3; url=https://cgi.soic.indiana.edu/~team59/app/Login.php');
	}
	else {
		echo "<h1>Registration failed. </h1>";
		echo "<h2>Returning to register page...</h2>";

		// Waits for 3 seconds before redirecting
		header('refresh:3; url=https://cgi.soic.indiana.edu/~team59/app/Register.php');
	}
}
?>


		<!-- ESIM Logo -->
			<p class="ESIM_logo">ESIM</p>

	</body>
</html>
