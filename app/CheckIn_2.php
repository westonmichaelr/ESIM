<!DOCTYPE HTML>
<html lang="en">
	<head>
      <meta charset="utf-8">
      <title>CheckIn_2 Page</title>
	    <!-- Stylesheet -->
	    <link rel="stylesheet" href="css/CheckIn_2.css">
	</head>

	<body>
		<!-- Top navigation bar -->
		<div class="topnav">
		    <!--Header-->
		    <h1>Check-In</h1>

		</div>

		<!--For use in demo to see when media queries are breaking-->
		<!-- <div id="rwd"></div> -->

		<!--You are checking in-->
		<div class="items_list_div">
			<h2>CHECK-IN QUEUE</h2>
			<!--Confirm Check In Button-->
			<form action="CheckIn_3.php" method="post">
				<?php

					/* CONTINUE SESSION */
						session_start();
						$_SESSION += $_POST;

					// Check if logged in
					if(!isset($_SESSION['username_stored'])) {
						// Redirect to timeout page if not
						header('Location: https://cgi.soic.indiana.edu/~team59/app/BackEnd/Session_timeout.php');
					}

					/* GRABBING POST INFO SECTION */

							// This grabs the employee
							$employee = $_POST['employee_select'];
							echo "Employee: ".$employee."<br><br>";

							// Items qty selction
							$items_qty = array('Blazers_qty'=>$_POST['Blazers_qty'], 'Polos_qty'=>$_POST['Polos_qty'],
							'Sweaters_qty'=>$_POST['Sweaters_qty'], 'Jackets_qty'=>$_POST['Jackets_qty'], 'Ponchos_qty'=>$_POST['Ponchos_qty'],
						  'Coats_qty'=>$_POST['Coats_qty'], 'Radios_qty'=>$_POST['Radios_qty'], 'Earpieces_qty'=>$_POST['Earpieces_qty'],
							'Tags_qty'=>$_POST['Tags_qty']);

							// Items size selection
							$items_size = array('Blazers_size'=>$_POST['Blazers_size'], 'Polos_size'=>$_POST['Polos_size'],
							'Sweaters_size'=>$_POST['Sweaters_size'], 'Jackets_size'=>$_POST['Jackets_size'], 'Ponchos_size'=>$_POST['Ponchos_size'],
						  'Coats_size'=>$_POST['Coats_size'], 'Radios_status'=>$_POST['Radios_size'], 'Earpieces_size'=>$_POST['Earpieces_size'],
							'Tags_size'=>$_POST['Tags_size']);



					/* PRINT OUT ITEM QUEUE */
							// For every element in the $items_qty:
							foreach($items_qty as $item => $qty) {
								// If there is a qty for the item and it's not = 1
								if ($qty && $qty != 1) {

									// Regex to split $item into just the item name
									preg_match('/^(.*?)(?=_)/', $item, $item_split);

									// Then print out the items qty and its name
									echo "".$qty." ".$item_split[0]." ";
									echo "<br>";
							}
								// If the qty is = 1
								elseif ($qty && $qty == 1) {
								// Regex to split $item into just the item name
								preg_match('/^(.*?)(?=s_)/', $item, $item_split);

								// Then print out the items qty and its name
								echo "".$qty." ".$item_split[0]." ";
								echo "<br>";
								}
							}

				?>

		</div>

				<!-- Confirms Check-in -->
				<button class="confirm_button" onclick="update_database()">Confirm Check In &#187;</button>
		</form>


		<!--Return to Home Page Button-->
		<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="return_home">Return Home</button>

		<!-- Return to CheckIn_1 -->
		<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/CheckIn_1.php" class="go_back">Check-In</button>

    <!--ESIM Logo-->
      <p class="ESIM_logo">ESIM</p>
    <!--Who's logged in-->
      <p class="user">Logged in: </p>
			<p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>
    <!--Logout Link-->
      <a href="Login.php" class="Logout">Logout</a>


  </body>
</html>
