<!DOCTYPE HTML>
<html>
	<head>

	<!-- Stylesheet -->
	<link rel="stylesheet" href="../css/emp_del_css.css">
	</head>

	<body>

		<!-- START THE SESSION -->
		<?php session_start(); ?>

	<?php
	// Connects to the database
	$con = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");
	// Check connection
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}

	if (isset($_POST)) {
		// Used to grab posted empid/firstname
		$empid = mysqli_real_escape_string($con, $_POST['empid']);
	/*	$first_name = mysqli_real_escape_string($con, $_POST['first_name']);*/

		// Query to delete empid and info from database
		$sql = "DELETE FROM employees WHERE empid='$empid'";
		$result = mysqli_query($con, $sql);

		// Check if registration worked
		if(mysqli_affected_rows($con) > 0) {
			echo "<h1>Employee Deleted successfully!</h1>";
			echo "<h2>Employee ID & Info deleted.</h2>";
			echo "<h2>Returning to Employee IDs page...</h2>";

			// Waits for 3 seconds before redirecting
			header('refresh:3; url=https://cgi.soic.indiana.edu/~team59/app/EmployeeIDs.php');
		}
		else {
			echo "<h1>Employee Delete Failed. </h1>";
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
