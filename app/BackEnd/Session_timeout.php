<!DOCTYPE HTML>
<html>
	<head>

	<!-- Stylesheet -->
	<link rel="stylesheet" href="../css/lr_css.css">
	</head>

	<body>


<?php
    // Starts the session
    session_start();

		echo "<h1>Session Timed Out!</h1>";
		echo "<h2>Returning to login page...</h2>";

    session_unset();
    session_destroy();

    // Waits for 3 seconds before redirecting
		header('refresh:3; url=https://cgi.soic.indiana.edu/~team59/app/Login.php');

?>


		<!-- ESIM Logo -->
			<p class="ESIM_logo">ESIM</p>

	</body>
</html>
