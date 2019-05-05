<!DOCTYPE HTML>
<html lang="en">
	<head>
      <meta charset="utf-8">
      <title>EmployeeIDs Page</title>
			<!-- Reset browser defaults -->
			<link rel="stylesheet" type="text/css" href="css/normalize.css">
	    <!-- Custom Stylesheet -->
	    <link rel="stylesheet" type="text/css" href="css/EmployeeIDs.css">
	</head>
  <body>
		<!-- Top navigation bar -->
		<div class="topnav">
		    <!--Header-->
		    <h1>Employee IDs</h1>

		</div>

		<!--For use in demo to see when media queries are breaking-->
		<!-- <div id="rwd"> </div> -->


			<!-- Employee register link -->
			<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/emp_register.php" class="buttonR">Register New Employee </button>
			<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/emp_delete.php" class="buttonD">Delete an Employee</button>

      <!-- ESIM Logo -->
      <p class="ESIM_logo">ESIM</p>

			<!-- Used to search through the employees -->
			<input type="text" id="employee_search" class="employee_search" onkeyup="myFunction()" placeholder="Search for employees..">


			<?php
			/* CONTINUE SESSION */
				session_start();

			// Check if logged in
			if(!isset($_SESSION['username_stored'])) {
				// Redirect to timeout page if not
				header('Location: https://cgi.soic.indiana.edu/~team59/app/BackEnd/Session_timeout.php');
			}

				// Check if logged in
				if(!isset($_SESSION['username_stored'])) {
					// Destroy session & Redirect to Login page if not
					session_destroy();
					header('Location: https://cgi.soic.indiana.edu/~team59/app/Login.php');
				}

				// Connects to the database
				$con = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");
				//Check connection
				if(mysqli_connect_errno())
					{echo nl2br("Failed to connect to MySql:".mysqli_connent_error(). "\n");}
				else
			  	{echo nl2br("\n");}
				$sql = "SELECT empid, first_name FROM employees";
				$result = mysqli_query($con, $sql);


			 if (mysqli_num_rows($result) > 0) {
				 	echo "<table id='empTable' class='empTable'><tr><th>Employees</th><th>ID</th><form id='to_tracking_page' action='InventoryTracking_2-Emp.php' method='post'>";

				//Output data of each row
			  while($row = mysqli_fetch_assoc($result)) {
					echo "<tr><td>".$row["first_name"]."</td><td><button name='" . $row['first_name'] . "' value='" .$row["empid"]. "'>".$row["empid"]."</button></td></tr>";}
					echo "</form></table>";
				} else {
				    echo "0 results";
				}

				if(!mysqli_query($con, $sql))
				{die('Error:'.mysqli_error($con));}
				echo "";
				mysqli_close($con);
			?>

			<!-- Script to search for a name in the table -->
			<script>
					function myFunction() {
					  // Declare variables
					  var input, filter, table, tr, td, i, txtValue;
					  input = document.getElementById("employee_search");
					  filter = input.value.toUpperCase();
					  table = document.getElementById("empTable");
					  tr = table.getElementsByTagName("tr");

					  // Loop through all table rows, and hide those who don't match the search query
					  for (i = 0; i < tr.length; i++) {
					    td = tr[i].getElementsByTagName("td")[0];
					    if (td) {
					      txtValue = td.textContent || td.innerText;
					      if (txtValue.toUpperCase().indexOf(filter) > -1) {
					        tr[i].style.display = "";
					      } else {
					        tr[i].style.display = "none";
					      }
					    }
					  }
					}
			</script>


      <!-- Logout Link -->
      <a href="Login.php" class="Logout">Logout</a>

      <!-- Return to Home Page Button -->
      <button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="return_home">Return Home</button>

      <!-- Who's Logged In -->
      <p class="user">Logged in:</p>
      <p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>
  </body>
</html>
