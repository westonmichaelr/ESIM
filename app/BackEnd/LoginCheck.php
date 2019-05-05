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

	// Grabs posted username/pw and first name from Login.php
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);

	// Stores username to use later
	session_start();
	$_SESSION['username_stored'] = $_POST['username'];

	// Gets the hashed password from the database, given a username
	$hashed_pw = "SELECT password FROM managers WHERE username='$username'";

	// Produces an sql query
	$result = mysqli_query($con, $hashed_pw);

		// Gets the hashed password from the database
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$pw_check = $row["password"];
			}
		}

	//Used to get the first name from databsae
	$first_name = "SELECT first_name FROM Managers WHERE username='$username'";
	$result2 = mysqli_query($con, $first_name);

	//Stores it as $first_name_var
		if ($result2->num_rows > 0) {
			while($row = $result2->fetch_assoc()) {
				$first_name_var = $row["first_name"];
			}
		}

	// Checks if the hashed pw: ($pw_check)
	// matches the posted pw: ($password)
	if (password_verify($password, $pw_check)) {
		echo "<h1>Login Successful!!!</h1>";
		echo "<h2>Redirecting you to the Home Page...</h2>";

		// Used for tracking the session
		session_start();
		// Transfers the first name value to the calculator
		$_SESSION['first_name'] = $first_name_var;

		// Waits for 3 seconds before redirecting
		header('refresh:3; url=https://cgi.soic.indiana.edu/~team59/app/Home.php');
	}
	else {
		echo "<h1>Login failed.</h1>";
		echo "<h2>Returning to login page...</h2>";

    // Waits for 3 seconds before redirecting
		header('refresh:3; url=https://cgi.soic.indiana.edu/~team59/app/Login.php');
	}
}
?>


		<!-- ESIM Logo -->
			<p class="ESIM_logo">ESIM</p>

	</body>
</html>
