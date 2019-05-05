<!DOCTYPE HTML>
<html lang="en">
	<head>
      <meta charset="utf-8">
      <title>InventoryTracking_1</title>
			<!-- Reset browser defaults -->
			<link rel="stylesheet" type="text/css" href="css/normalize.css">
	    <!-- Custom Stylesheet -->
	    <link rel="stylesheet" href="css/InventoryTracking_2-Item.css">
	</head>
  <body>

		<!-- Top navigation bar -->
		<div class="topnav">
				<!--Header-->
				<h1>Inventory Tracking</h1>

		</div>

		<div id="rwd"> </div>


      <!-- ESIM Logo -->
      <p class="ESIM_logo">ESIM</p>

			<!-- Display results -->
	      <div class="label">
					<h2>Tracking report for:
	      		<?php

							// Gets all keys in POST array
							$keys = array_keys($_POST);
							// Sets $item = the first key of the POST array
							$item = $keys[0];
							// Prints item out
							echo $item;

							// Gets the value (itemid) to be used in SQL statement
							$itemid = $_POST[$item];

	      		?>
					</h2>
				</div>

			<!-- Display results -->
		    <div class="results">
					<?php

					/* CONTINUE SESSION */
						session_start();

					// Check if logged in
					if(!isset($_SESSION['username_stored'])) {
						// Redirect to Login page if not
						header('Location: https://cgi.soic.indiana.edu/~team59/app/Login.php');
					}
						// Connects to the database
						$con = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");
						//Check connection
						if(mysqli_connect_errno())
							{echo nl2br("Failed to connect to MySql:".mysqli_connent_error(). "\n");}
						else
					  	{echo nl2br("\n");}


						// For the check-in/check-out quantity
						$sql = "SELECT SUM(in_quantity), SUM(out_quantity) FROM $item;";
						// For the last checkout_time
						// $sql .= "SELECT checkout_time FROM employees WHERE '$itemid' != 0 ORDER BY checkout_time DESC LIMIT 1";
						// For the last checkin_time
						// $sql .= "SELECT checkout_time FROM employees WHERE '$itemid' != 0 ORDER BY checkout_time DESC LIMIT 1";

						$result = mysqli_query($con, $sql);

					 if (mysqli_num_rows($result) > 0) {
						 	echo "<table class='results_table'><thead><tr><th>Status</th><th>Qty</th><th>Timestamp</th></thead>";
						//Work in Progress
						//Output data of each row
					  while($row = mysqli_fetch_assoc($result)) {
							echo "<tr><td>CHECKED-OUT</td><td>".$row["SUM(out_quantity)"]."</td><td>".$row["checkout_time"]."</td></tr>";
							echo "<tr><td>CHECKED-IN</td><td>".$row["SUM(in_quantity)"]."</td><td>".$row["checkout_time"]."</td></tr>";}
							echo "</table>";
						} else {
						    echo "0 results";
						}
						if(!mysqli_query($con, $sql))
						{die('Error:'.mysqli_error($con));}
						echo "";
						mysqli_close($con);


					?>
				</div>

      <!-- Logout Link -->
      <a href="Login.php" class="Logout">Logout</a>

      <!-- Return to Home Page Button -->
      <button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="button2">Return Home</button>

      <!-- Who's Logged In -->
      <p class="user">Logged in:</p>
      <p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>
  </body>
  </html>
