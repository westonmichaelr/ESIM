<!DOCTYPE HTML>
<html>
	<head>

	<!-- Google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

	<!-- Stylesheet -->
	<link rel="stylesheet" href="css/Home.css">
	</head>

	<body>

			<!-- Header -->
			<h1>Home</h1>

			<!--For use in demo to see when media queries are breaking-->
			<!-- <div id="rwd"> </div> -->


			<?php

			// START THE SESSION
			session_start();

			// Check if logged in
			if(!isset($_SESSION['username_stored'])) {
				// Redirect to timeout page if not
				header('Location: https://cgi.soic.indiana.edu/~team59/app/BackEnd/Session_timeout.php');
			}

			?>

			<!-- Buttons (TABLE) -->
			<table class="home_buttons">

				<!-- ROW 1 -->
					<tr>
						<!-- Check-Out Button -->
						<td colspan=2>
								<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/CheckOut_1.php" class="co_btn">Check-Out</button>
						</td>

						<!-- Check-In Button -->
						<td colspan=2>
								<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/CheckIn_1.php" class="ci_btn">Check-In</button>
						</td>

					</tr>

				<!-- ROW 2 -->
					<tr>
						<!-- Inventory Status Button -->
						<td colspan=1>
								<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/InventoryStatus.php" class="is_btn">Inventory Status</button>
						</td>

						<!-- Inventory Tracking Button -->
						<td colspan=1>
								<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/InventoryTracking_1.php" class="it_btn">Inventory Tracking</button>
						</td>

						<!-- Employee IDs Button -->
						<td colspan=1>
								<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/EmployeeIDs.php" class="empid_btn">Employee IDs</button>
						</td>

						<!-- Update Quantity Button -->
						<td colspan=1>
								<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Update_Quantity.php" class="uq_btn">Update Quantity</button>
						</td>
					</tr>

			<!-- Link to Register Page -->
				<p class="register_link"><a href="https://cgi.soic.indiana.edu/~team59/app/Register.php">Register a new manager</a> <p>

			<!-- ESIM Logo -->
			  <p class="ESIM_logo">ESIM</p>
	    <!-- Who's logged in -->
	      <p class="user">Logged in: </p>
				<p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>
			<!-- Logout Link-->
				<a href="Login.php" class="Logout">Logout</a>

	</body>
</html>
