<!DOCTYPE HTML>
<html lang="en">
	<head>
      <meta charset="utf-8">
      <title>InventoryStatus</title>
			<!-- Reset browser defaults -->
			<link rel="stylesheet" type="text/css" href="css/normalize.css">
	    <!-- Custom Stylesheet -->
	    <link rel="stylesheet" href="css/InventoryStatus.css">
	</head>
  <body>

		<!-- Top navigation bar -->
		<div class="topnav">
		    <!--Header-->
		    <h1>Inventory Status</h1>
		</div>

		<div id="rwd"> </div>

		<!--For use in demo to see when media queries are breaking-->
		<!-- <div id="rwd"></div> -->

		<!--Return to Home Page Button-->
		<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="button2">Return Home</button>

      <!-- ESIM Logo -->
      <p class="ESIM_logo">ESIM</p>

			<!-- Currently Checked in and out Headers -->
			<div class="chin">
				<p class="checkedin">Currently Checked in:</p>
				<p class="underline1">_____________________</p>
			</div>
			<div class="chout">
				<p class="checkedout">Currently Checked Out:</p>
				<p class="underline2">_____________________</p>
			</div>


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

				//Pull data from database
				$sql = "SELECT blazerid, size, in_quantity FROM blazers UNION SELECT coatid, size, in_quantity FROM coats UNION SELECT jacketid, size, in_quantity FROM jackets UNION SELECT poloid, size, in_quantity FROM polos UNION SELECT earpieceid, size, in_quantity FROM earpieces UNION SELECT ponchoid, size, in_quantity FROM ponchos UNION SELECT sweaterid, size, in_quantity FROM sweaters UNION SELECT radioid, repair_qty, in_quantity FROM radios UNION SELECT tagsid, t_quantity, in_quantity FROM tags";

				$result = mysqli_query($con, $sql);


				if (mysqli_num_rows($result) > 0) {

				// Display Items_Checked_In Header
				echo "<table class='fixed_header'>
					<thead>
						<tr>
							<th>Items</th>
							<th>Size</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody>";
				//Output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					if(in_array("blazer_l", $row) ||
						 in_array("blazer_m", $row) ||
						 in_array("blazer_s", $row) ||
						 in_array("blazer_xl", $row)){
							 $item = "blazer";
					} elseif (in_array("coat_l", $row) ||
							in_array("coat_m", $row) ||
							in_array("coat_s", $row) ||
							in_array("coat_xl", $row)) {
								$item = "coat";
					} elseif (in_array("jacket_l", $row) ||
							in_array("jacket_m", $row) ||
							in_array("jacket_s", $row) ||
							in_array("jacket_xl", $row)) {
						$item = "jacket";
					} elseif (in_array("polo_l", $row) ||
							in_array("polo_m", $row) ||
							in_array("polo_s", $row) ||
							in_array("polo_xl", $row)) {
						$item = "polo";
					} elseif (in_array("earpiece_l", $row) ||
							in_array("earpiece_m", $row) ||
							in_array("earpiece_s", $row) ||
							in_array("earpiece_xl", $row)) {
						$item = "earpiece";
					} elseif (in_array("poncho_l", $row) ||
							in_array("poncho_m", $row) ||
							in_array("poncho_s", $row) ||
							in_array("poncho_xl", $row)) {
						$item = "poncho";
					} elseif (in_array("sweater_l", $row) ||
							in_array("sweater_m", $row) ||
							in_array("sweater_s", $row) ||
							in_array("sweater_xl", $row)) {
						$item = "sweater";
					} elseif (in_array("radios", $row)) {
						//Pulled repair_qty from $sql database statement above to fill array in order to use N/A for size
						$row['size'] = "N/A";
						$item = "radios";
					} elseif (in_array("tags", $row)) {
						//Pulled t_quantity from $sql database statement above to fill array in order to use N/A for size
						$row['size'] = "N/A";
						$item = "tags";
					}

						echo "<tr>
										<td>".$item."</td>
										<td>".$row["size"]."</td>
										<td>".$row["in_quantity"]."</td>
									</tr>";
					}	echo "</tbody>
							</table>";

					} else {
					    echo "0 results";
					}

					//Pull data from database
					$sql = "SELECT blazerid, size, out_quantity FROM blazers UNION SELECT coatid, size, out_quantity FROM coats UNION SELECT jacketid, size, out_quantity FROM jackets UNION SELECT poloid, size, out_quantity FROM polos UNION SELECT earpieceid, size, out_quantity FROM earpieces UNION SELECT ponchoid, size, out_quantity FROM ponchos UNION SELECT sweaterid, size, out_quantity FROM sweaters UNION SELECT radioid, repair_qty, out_quantity FROM radios UNION SELECT tagsid, t_quantity, out_quantity FROM tags";

					$result = mysqli_query($con, $sql);


					if (mysqli_num_rows($result) > 0) {

						// Display Items_Checked_Out Header
						echo "<table class='fixed_header2'>
							<thead>
								<tr>
									<th>Items</th>
									<th>Size</th>
									<th>Quantity</th>
								</tr>
							</thead>
							<tbody>";
					//Output data of each row
					while($row = mysqli_fetch_assoc($result)) {
						if(in_array("blazer_l", $row) ||
							 in_array("blazer_m", $row) ||
							 in_array("blazer_s", $row) ||
							 in_array("blazer_xl", $row)){
								 $item = "blazer";
						} elseif (in_array("coat_l", $row) ||
								in_array("coat_m", $row) ||
								in_array("coat_s", $row) ||
								in_array("coat_xl", $row)) {
									$item = "coat";
						} elseif (in_array("jacket_l", $row) ||
								in_array("jacket_m", $row) ||
								in_array("jacket_s", $row) ||
								in_array("jacket_xl", $row)) {
							$item = "jacket";
						} elseif (in_array("polo_l", $row) ||
								in_array("polo_m", $row) ||
								in_array("polo_s", $row) ||
								in_array("polo_xl", $row)) {
							$item = "polo";
						} elseif (in_array("earpiece_l", $row) ||
								in_array("earpiece_m", $row) ||
								in_array("earpiece_s", $row) ||
								in_array("earpiece_xl", $row)) {
							$item = "earpiece";
						} elseif (in_array("poncho_l", $row) ||
								in_array("poncho_m", $row) ||
								in_array("poncho_s", $row) ||
								in_array("poncho_xl", $row)) {
							$item = "poncho";
						} elseif (in_array("sweater_l", $row) ||
								in_array("sweater_m", $row) ||
								in_array("sweater_s", $row) ||
								in_array("sweater_xl", $row)) {
							$item = "sweater";
						} elseif (in_array("radios", $row)) {
							//Pulled repair_qty from $sql database statement above to fill array in order to use N/A for size
							$row['size'] = "N/A";
							$item = "radios";
						} elseif (in_array("tags", $row)) {
							//Pulled t_quantity from $sql database statement above to fill array in order to use N/A for size
							$row['size'] = "N/A";
							$item = "tags";
						}

						if($row["out_quantity"] < 1) {
							$item = "";
							$row["size"] = "";
							$row["out_quantity"] = "";

						} else {
						echo "<tr>
										<td>".$item."</td>
										<td>".$row["size"]."</td>
										<td>".$row["out_quantity"]."</td>
									</tr>";
						}
					}
						echo "</tbody>
								</table>";

						} else {
								echo "0 results";
						}

					if(!mysqli_query($con, $sql))
					{die('Error:'.mysqli_error($con));}

					echo "";
					mysqli_close($con);
				?>

			<!-- Go to Check In Page Button -->
			<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/CheckIn_1.php" class="button1">Go to Check-in Page</button>

			<!-- Go to Check Out Page Button -->
			<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/CheckOut_1.php" class="button_check_out">Go to Check-out Page</button>

      <!-- Logout Link -->
      <a href="Login.php" class="Logout">Logout</a>

      <!-- Who's Logged In -->
      <p class="user">Logged in:</p>
      <p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>
		</div>
  </body>
  </html>
