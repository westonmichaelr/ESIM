<!DOCTYPE HTML>
<html lang="en">
	<head>
      <meta charset="utf-8">
      <title>CheckOut_3 Page</title>
	    <!-- Stylesheet -->
	    <link rel="stylesheet" href="css/CheckOut_3.css">
	</head>

	<body>
		<!-- Top navigation bar -->
		<div class="topnav">
		    <!--Header-->
		    <h1>Check-Out</h1>

		</div>

		<!--For use in demo to see when media queries are breaking-->
		<!-- <div id="rwd"></div> -->

			<?php

				/* CONTINUE SESSION */
					session_start();
					$_SESSION += $_POST;

				// Check if logged in
				if(!isset($_SESSION['username_stored'])) {
					// Redirect to timeout page if not
					header('Location: https://cgi.soic.indiana.edu/~team59/app/BackEnd/Session_timeout.php');
				}


				/* GRABBING SESSION INFO SECTION */

						// Sets employee name to variable (for mysql statement)
						$employee = $_SESSION['employee_select'];

						// Set each qty to a variable (for mysql statement)
						$Blazer_qty = $_SESSION['Blazers_qty'];
						$Polo_qty = $_SESSION['Polos_qty'];
						$Sweater_qty = $_SESSION['Sweaters_qty'];
						$Jacket_qty = $_SESSION['Jackets_qty'];
						$Poncho_qty = $_SESSION['Ponchos_qty'];
						$Coat_qty = $_SESSION['Coats_qty'];
						$Radio_qty = $_SESSION['Radios_qty'];
						$Earpiece_qty = $_SESSION['Earpieces_qty'];
						$Tag_qty = $_SESSION['Tags_qty'];

						// Set each size to a variable (for mysql statement)
						$Blazer_size = $_SESSION['Blazers_size'];
						$Polo_size = $_SESSION['Polos_size'];
						$Sweater_size = $_SESSION['Sweaters_size'];
						$Jacket_size = $_SESSION['Jackets_size'];
						$Poncho_size = $_SESSION['Ponchos_size'];
						$Coat_size = $_SESSION['Coats_size'];
							// Radios have a status instead of size
							$Radio_status = $_SESSION['Radios_size'];
						$Earpiece_size = $_SESSION['Earpieces_size'];
						$Tag_size = $_SESSION['Tags_size'];


				/* UPDATING DATABASE SECTION */

						// Create connection
						$conn = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");
						if (!$conn) {
							 die("Connection failed: " . mysqli_connect_error());
						}

						//Gets the current time
						$get_time = mktime();
						$current_time = date("Y-m-d h:i:s", $get_time);

						// Used for updating item qty in employee table
						$sql = "UPDATE employees SET blazerid = '$Blazer_qty', poloid = '$Polo_qty',
						sweaterid = '$Sweater_qty', jacketid = '$Jacket_qty', ponchoid = '$Poncho_qty',
						coatid = '$Coat_qty', radioid = '$Radio_qty', earid = '$Earpiece_qty', tagid = '$Tag_qty',
						checkout_time = CURRENT_TIMESTAMP() WHERE EmpID = '$employee';";

						// Used for changing qty in each item table
						$sql .= "UPDATE blazers SET in_quantity = (in_quantity - '$Blazer_qty'), out_quantity = (out_quantity + '$Blazer_qty')  WHERE size = '$Blazer_size';";
						$sql .= "UPDATE polos SET in_quantity = (in_quantity - '$Polo_qty'), out_quantity = (out_quantity + '$Polo_qty')  WHERE size = '$Polo_size';";
						$sql .= "UPDATE sweaters SET in_quantity = (in_quantity - '$Sweater_qty'), out_quantity = (out_quantity + '$Sweater_qty')  WHERE size = '$Sweater_size';";
						$sql .= "UPDATE jackets SET in_quantity = (in_quantity - '$Jacket_qty'), out_quantity = (out_quantity + '$Jacket_qty')  WHERE size = '$Jacket_size';";
						$sql .= "UPDATE ponchos SET in_quantity = (in_quantity - '$Poncho_qty'), out_quantity = (out_quantity + '$Poncho_qty')  WHERE size = '$Poncho_size';";
						$sql .= "UPDATE coats SET in_quantity = (in_quantity - '$Coat_qty'), out_quantity = (out_quantity + '$Coat_qty')  WHERE size = '$Coat_size';";

						// THIS IS FOR RADIOS ONLY
								// Radio Statement 1- Not getting marked for repair (normal checkout)
								if ($Radio_status != "*Getting Repaired") {
										$sql .= "UPDATE radios SET in_quantity = (in_quantity - '$Radio_qty'), out_quantity = (out_quantity + '$Radio_qty');";
								}
								// Radio Statement 2- Getting marked for repair
								else {
										$sql .= "UPDATE radios SET repair_qty = (repair_qty + '$Radio_qty'), in_quantity = (in_quantity - '$Radio_qty'), out_quantity = (out_quantity + '$Radio_qty');";
								}

						$sql .= "UPDATE earpieces SET in_quantity = (in_quantity - '$Earpiece_qty'), out_quantity = (out_quantity + '$Earpiece_qty')  WHERE size = '$Earpiece_size';";
						$sql .= "UPDATE tags SET in_quantity = (in_quantity - '$Tag_qty'), out_quantity = (out_quantity + '$Tag_qty')";

						// Checks & displays if SQL Query is successful
						if (mysqli_multi_query($conn, $sql)) {
							 echo "<div class='confirmation_div'><h2>Check-out Successful!!</h2>"
											 	. "<p> Check-Out time: ". $current_time . "</p>"
												. "<p> Employee: ". $employee . "</p>"
							 			. "</div>";

						} else {
						// Displays error if SQL Query not successful
							 echo "Error updating record: " . mysqli_error($conn);
						}

						// Close connection
						mysqli_close($conn);

						// KEEPS username_stored variable WHILE deleting all other session variables
						foreach($_SESSION as $key => $val) {
						    if ($key !== 'username_stored') {
						      unset($_SESSION[$key]);
						    }
						}
			?>


		<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/CheckOut_1.php" class="check_out_again">Check-out another item</button>
			<p class="or">OR</p>
		<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="return_home2">Return Home</button>

		<!--Return to Home Page Button-->
		<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="return_home">Return Home</button>

		<!-- Return to CheckOut_1 -->
		<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/CheckOut_1.php" class="go_back">Check-Out</button>

    <!--ESIM Logo-->
      <p class="ESIM_logo">ESIM</p>
    <!--Who's logged in-->
      <p class="user">Logged in: </p>
			<p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>
    <!--Logout Link-->
      <a href="Login.php" class="Logout">Logout</a>

  </body>
</html>
