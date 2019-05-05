<!DOCTYPE HTML>
<html lang="en">
	<head>
      <meta charset="utf-8">
      <title>Update Quantity Page</title>
			<!-- Reset browser defaults -->
			<link rel="stylesheet" type="text/css" href="css/normalize.css">
	    <!-- Custom Stylesheet -->
	    <link rel="stylesheet" type="text/css" href="css/Update_Quantity.css">
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

			<?php


			/* CONTINUE SESSION */
				session_start();
				$_SESSION += $_POST;

				// KEEPS username_stored variable WHILE deleting all other session variables
				foreach($_SESSION as $key => $val) {
						if ($key !== 'username_stored') {
							unset($_SESSION[$key]);
						}
				}

			// Check if logged in
			if(!isset($_SESSION['username_stored'])) {
				// Redirect to Login page if not
				header('Location: https://cgi.soic.indiana.edu/~team59/app/Login.php');
			}

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

				// Selects the total qty from each item type
				$sql = "SELECT SUM(t_quantity) FROM blazers UNION ALL SELECT SUM(t_quantity) FROM coats
				UNION ALL SELECT SUM(t_quantity) FROM earpieces UNION ALL SELECT SUM(t_quantity) FROM jackets
				UNION ALL SELECT SUM(t_quantity) FROM polos UNION ALL SELECT SUM(t_quantity) FROM ponchos
				UNION ALL SELECT SUM(t_quantity) FROM radios UNION ALL SELECT SUM(t_quantity) FROM sweaters
				UNION ALL SELECT SUM(t_quantity) FROM tags";
				$result = mysqli_query($con, $sql);


				// List of items
				$item_list = array('blazers', 'coats', 'earpieces', 'jackets', 'polos', 'ponchos', 'radios', 'sweaters', 'tags');
				// Variable to increment through items
				$i = 0;

			 if (mysqli_num_rows($result) > 0) {
				 	echo "<table id='itemTable' class='itemTable'><tr><th>Item</th><th>Total Qty</th><th>Update</th><form id='to_tracking_page' action='Update_Quantity_2.php' method='post'>";

				//Output data of each row
			  while($row = mysqli_fetch_assoc($result)) {
					if ($item_list[$i] == 'radios' ||  $item_list[$i] == 'tags') {
						echo "<tr><td>" . $item_list[$i] . "</td><td>" . $row['SUM(t_quantity)'] . "</td><td><button name='" . $item_list[$i] . "' value='total'>All</button></td></tr>";
					}
					else {
						echo "<tr><td>" . $item_list[$i] . "</td><td>" . $row['SUM(t_quantity)'] . "</td><td><button name='" . $item_list[$i] . "' value='small'>Small</button><button name='" . $item_list[$i] . "' value='medium'>Medium</button><button name='" . $item_list[$i] . "' value='large'>Large</button><button name='" . $item_list[$i] . "' value='x_large'>X-Large</button></td></tr>";
				}
					// Increment the item list
					$i = $i + 1;
				}
					echo "</form></table>";
				}
				else {
				    echo "0 results";
				}

				if(!mysqli_query($con, $sql))
				{die('Error:'.mysqli_error($con));}
				echo "";
				mysqli_close($con);
			?>


      <!-- Logout Link -->
      <a href="Login.php" class="Logout">Logout</a>

      <!-- Return to Home Page Button -->
      <button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="return_home">Return Home</button>

      <!-- Who's Logged In -->
      <p class="user">Logged in:</p>
      <p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>
  </body>
</html>
