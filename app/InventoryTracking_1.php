<!DOCTYPE HTML>
<html lang="en">
	<head>
      <meta charset="utf-8">
      <title>InventoryTracking_1</title>
			<!-- Reset browser defaults -->
			<link rel="stylesheet" type="text/css" href="css/normalize.css">
	    <!-- Custom Stylesheet -->
	    <link rel="stylesheet" href="css/InventoryTracking_1.css">
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

			<!-- Items side- the left -->
			<div class="items_div">
					<!-- Item Header -->
					<p class="viewitem">View By Item:</p>
					<p class="underline">________________</p>

						<table class='item_list'><form action='InventoryTracking_2-Item.php' method='post'>
								<td><button name="blazers" value="blazerid"> Blazers </button>
								<td><button name="coats" value="coatid"> Coats </button>
								<td><button name="earpieces" value="earid"> Earpieces </button>
								<td><button name="jackets" value="jacketid"> Jackets </button>
								<td><button name="polos" value="poloid"> Polos </button>
								<td><button name="ponchos" value="ponchoid"> Ponchos </button>
								<td><button name="radios" value="radioid"> Radios </button>
								<td><button name="sweaters" value="sweaterid"> Sweaters </button>
								<td><button name="tags" value="tagid"> Tags </button>
						</form></table>

				</div>


				<!-- Employees side- the right -->
				<div class="employees_div">
						<!-- Employee Header -->
						<p class="viewemployee">View By Employee:</p>
						<p class="underline">________________</p>

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

								$sql = "SELECT empid, first_name FROM employees WHERE checkout_time != '0000-00-00 00:00:00'";
								// $sql = "SELECT empid, first_name FROM Employees";
								$result = mysqli_query($con, $sql);

								/* Output results into the employees table */

								if (mysqli_num_rows($result) > 0) {

									/* Employees Table */
									echo "<table class='employee_list'><form action='InventoryTracking_2-Emp.php' method='post'>";

			 								//Output data of each row
			 								while($row = mysqli_fetch_assoc($result)) {
												echo "<td><button name='" . $row['first_name'] . "' value='" . $row['empid'] . "'>" . $row['first_name'] . "</button></td>";}
			 									echo "</form></table>";
 								}
								else {
 										echo "<h1> 0 results </h1>";
 								}
 								if (!mysqli_query($con, $sql)) {
 									die('Error:'.mysqli_error($con));
 								}
								echo "";
								mysqli_close($con);
							?>
					</div>

      <!-- Logout Link -->
      <a href="Login.php" class="Logout">Logout</a>

      <!-- Return to Home Page Button -->
      <center><button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="return_home">Return Home</button></center>

      <!-- Who's Logged In -->
      <p class="user">Logged in:</p>
      <p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>
  </body>
  </html>
