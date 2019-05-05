<!DOCTYPE HTML>
<html lang="en">
	<head>
      <meta charset="utf-8">
      <title>InventoryTracking_1</title>
			<!-- Reset browser defaults -->
			<link rel="stylesheet" type="text/css" href="css/normalize.css">
	    <!-- Custom Stylesheet -->
	    <link rel="stylesheet" href="css/InventoryTracking_2-Emp.css">
	</head>
  <body>

		<!-- Top navigation bar -->
		<div class="topnav">
				<!--Header-->
				<h1>Inventory Tracking</h1>

		</div>

			<!--For use in demo to see when media queries are breaking-->
			<!-- <div id="rwd"> </div> -->


      <!-- ESIM Logo -->
      <p class="ESIM_logo">ESIM</p>

			<!-- Display results -->
	      <div class="label">
					<h2>Tracking report for:
	      		<?php

							// Gets all KEYS in POST array
							$keys = array_keys($_POST);
							// Sets $item = the first KEY of the POST array
							$employee = $keys[0];
							// Prints employee out
							echo $employee;

							// Gets the first VALUE of the post array (to be used later)
							$first_value = reset($_POST);

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
						// Redirect to timeout page if not
						header('Location: https://cgi.soic.indiana.edu/~team59/app/BackEnd/Session_timeout.php');
					}

						// Connects to the database
						$con = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");
						//Check connection
						if(mysqli_connect_errno())
							{echo nl2br("Failed to connect to MySql:".mysqli_connent_error(). "\n");}
						else
					  	{echo nl2br("\n");}

						$sql = "SELECT blazerid, poloid, sweaterid, jacketid, ponchoid, coatid, radioid, earid, tagid FROM employees WHERE empid = '$first_value'";
						$result = mysqli_query($con, $sql);

					 if (mysqli_num_rows($result) > 0) {
						 	echo "<table class='results_table'><thead><tr><th>Item</th><th>Checked-out</th></thead>";

						//Output data of each row
					  while($row = mysqli_fetch_assoc($result)) {
							echo "<tr><td>Blazers</td><td>".$row["blazerid"]."</td></tr>";
							echo "<tr><td>Polos</td><td>".$row["poloid"]."</td></tr>";
							echo "<tr><td>Sweaters</td><td>".$row["sweaterid"]."</td></tr>";
							echo "<tr><td>Jackets</td><td>".$row["jacketid"]."</td></tr>";
							echo "<tr><td>Ponchos</td><td>".$row["ponchoid"]."</td></tr>";
							echo "<tr><td>Coats</td><td>".$row["coatid"]."</td></tr>";
							echo "<tr><td>Radios</td><td>".$row["radioid"]."</td></tr>";
							echo "<tr><td>Earpieces</td><td>".$row["earid"]."</td></tr>";
							echo "<tr><td>Tags</td><td>".$row["tagid"]."</td></tr>";}
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
      <center><button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="button2">Return Home</button></center>

			<!-- Return to InventoryTracking_1  -->
			<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/InventoryTracking_1.php" class="buttonI">Inventory Tracking</button>

      <!-- Who's Logged In -->
      <p class="user">Logged in:</p>
      <p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>
  </body>
  </html>
