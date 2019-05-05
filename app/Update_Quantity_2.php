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
							$keys = array_keys($_POST);
							// Sets $item = the first key of the POST array
							$item = $keys[0];
							// Gets the size of the item
							$size = $_SESSION[$item];


							// Show what's being updated
							echo "<h2> UPDATING QTY FOR: </h2>";
							// If not a radio or tag, show size
							if ($item != 'radios' && $item != 'tags') {
								echo "<p>" . $size . " " . $item . "</p>";
							}
							// If a radio or tag, don't show size
							else {
								echo "<p>" . $item . "</p>";
							}

							// Connects to the database
							$con = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");

							// Selects the total qty from each item type
							if ($item != 'radios' && $item != 'tags') {
								$sql = "SELECT t_quantity, out_quantity FROM $item WHERE size = '$size'";
							}
							else {
								$sql = "SELECT t_quantity, out_quantity FROM $item";
							}
							$result = mysqli_query($con, $sql);

							if (mysqli_num_rows($result) > 0) {


			 				//Output data of each row
			 			  while($row = mysqli_fetch_assoc($result)) {
									// Sets total qty to variable
									$total_qty = $row['t_quantity'];
									// Sets in qty to variable
									$out_qty = $row['out_quantity'];

			 						echo "<h2>Current QTY: </h2><p>" . $total_qty . "</p>";
			 				}
			 						echo "";
			 				}
			 				else {
			 				    echo "0 results";
			 				}


	      		?>

					<form action="Update_Quantity_3.php" method="post">

							<!-- Change QTY label -->
							<h2>Change total QTY to: </h2>

							<!-- Input new qty -->
							<input type="text" class="text_input" name="new_qty" autocomplete="off" maxlength="3" id="text_input">

							<!-- Used to display the new qty -->
							<div id="display"></div>

							</input>

										<button class="update_btn" id="update_btn" type="submit"> UPDATE QTY &#187;</button>

							</form>

							<script>
								$(function () {
										// Gets the input
										var $input = $('#text_input');
										var $display = $('#display');

										// Adds the text input to the display below
										$input.on('keydown', function () {
												setTimeout(function () {
													// Sets the PHP in_qty variable to a JS variable (JS_in_qty)
													var JS_out_qty = <?php echo $out_qty; ?>;
													// Sets the input value variable to a JS variable (JS_update_qty)
													var JS_update_qty = $input.val();

													if (JS_update_qty < JS_out_qty) {
														// Display an error message
														$display.html("<br><h3 style='color: red;'>ERROR: New QTY is less than the amount currently checked out (" + JS_out_qty + ") </h3>");

														// Don't show the submit button
														document.getElementById("update_btn").style.display = "none";
													}
													else {
														// Display an error message
														$display.html("");

														// Do show the submit button
														document.getElementById("update_btn").style.display = "block";
													}

												}, 0);
											});
										})
							</script>

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
