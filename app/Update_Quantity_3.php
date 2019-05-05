<!DOCTYPE HTML>
<html lang="en">
	<head>
      <meta charset="utf-8">
      <title>Update Quantity Page</title>
			<!-- Reset browser defaults -->
			<link rel="stylesheet" type="text/css" href="css/normalize.css">
	    <!-- Custom Stylesheet -->
	    <link rel="stylesheet" type="text/css" href="css/Update_Quantity.css">
			<!-- JQuery Script -->
			<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
	</head>
  <body>
		<!-- Top navigation bar -->
		<div class="topnav">
		    <!--Header-->
		    <h1>Update Quantity</h1>

		</div>

		<!--For use in demo to see when media queries are breaking-->
		<!-- <div id="rwd"> </div> -->


      <!-- ESIM Logo -->
      <p class="ESIM_logo">ESIM</p>

			<!-- Display results -->
	      <div class="update">
					<?php

							/* CONTINUE SESSION */
							session_start();
							$_SESSION += $_POST;

							// Check if logged in
							if(!isset($_SESSION['username_stored'])) {
								// Redirect to timeout page if not
								header('Location: https://cgi.soic.indiana.edu/~team59/app/BackEnd/Session_timeout.php');
							}

							// Gets all keys in POST array
							$keys = array_keys($_SESSION);
							// Sets $item = the second key of the POST array
							$item = $keys[1];
							// Gets the value (new qty) to be used in SQL statement
							$size = $_SESSION[$item];
							// Gets the new qty total to be input in the database
							$new_qty = $_SESSION['new_qty'];


							// Connects to the database
							$con = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");

							// Selects the total qty from each item type

							// If not a radio or tag, show size
							if ($item != 'radios' && $item != 'tags') {
									$sql = "UPDATE $item SET t_quantity = $new_qty, in_quantity = $new_qty WHERE size = '$size'";
							}
							else {
									$sql = "UPDATE $item SET t_quantity = $new_qty, in_quantity = $new_qty";
							}


							$result = mysqli_query($con, $sql);

							// IF the result works, there will be 0 results
							if (mysqli_num_rows($result) > 0) {
									 // Displays error if SQL Query not successful
									 echo "Error updating record: " . mysqli_error($conn);
								}
							// IF the result doesn't work, there will be 0 results
							else {
								// Displays Success if SQL Query is successful
								echo "<br><h1>SUCCESS!!</h1>";

							// Show what's being updated
							 echo "<h2> UPDATED QTY FOR: </h2>";
							 // If not a radio or tag, show size
							 if ($item != 'radios' && $item != 'tags') {
								 echo "<p>" . $size . " " . $item . "</p><br>";
							 }
							 // If a radio or tag, don't show size
							 else {
								 echo "<p>" . $item . "</p><br>";
							 }

								 // THESE ARE THE VALUES TO INPUT IN DATABASE !!!
	 							echo "<h2>NEW QTY: </h2><p>" . $new_qty . "</p><br>";
							}

							echo "<button onclick=location.href='https://cgi.soic.indiana.edu/~team59/app/Home.php' class='return_home2'>Return Home</button>";

	      		?>
				</div>

						<!-- Used to display the error -->
						<div id="display"></div>
						</input>

				</div>


      <!-- Logout Link -->
      <a href="Login.php" class="Logout">Logout</a>

      <!-- Return to Home Page Button -->
      <button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="return_home">Return Home</button>

			<!-- Return to InventoryTracking_1  -->
			<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Update_Quantity.php" class="go_back">Update Quantity</button>

      <!-- Who's Logged In -->
      <p class="user">Logged in:</p>
      <p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>
  </body>
</html>
