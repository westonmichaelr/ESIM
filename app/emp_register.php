<DOCTYPE>
<html>
  <head>

    <!--stylesheet-->
    <link rel="stylesheet" href="css/emp_reg_css.css">
  	</head>

  	<body>
      <!-- Top navigation bar -->
      <div class="topnav">
        <!-- Header -->
        <h1>Register a new Employee:</h1>

      </div>

      <!-- <div id="rwd"> </div> -->

      <!-- ESIM Logo -->
      <p class="ESIM_logo">ESIM</p>


      <?php
      /* CONTINUE SESSION */
				session_start();

			// Check if logged in
			if(!isset($_SESSION['username_stored'])) {
        // Redirect to timeout page if not
        header('Location: https://cgi.soic.indiana.edu/~team59/app/BackEnd/Session_timeout.php');
      }
        ?>


        <table class="new_employee">

          <form action="BackEnd/Employee_Register_backend.php" method="post">

          <!-- Row 1 -->
            <tr>
              <!-- EmpID Label -->
                <td colspan=1>
                  <p>Employee ID:</p>
                </td>
              <!-- EmpID Entry -->
                <td colspan=2>
                  <input id="empid" name="empid" type="text" placeholder="EmpID" value=""></input>
                </td>
            </tr>

          <!-- Row 2 -->
            <tr>
              <!-- First Name Entry-->
                <td colspan=1>
                  <p>First Name:</p>
                </td>
              <!-- Password Entry -->
                <td colspan=2>
                  <input id="first_name" name="first_name" type="text" placeholder="First_Name" value=""></input>
                </td>
            </tr>

          <!--Row 3 -->
            <tr>
              <!-- Email Label -->
              <td colspan=1>
                <p>Email:</p>
							</td>
              <!-- Email Entry -->
							<td colspan=2>
								<input id="email" name="email" type="text" placeholder="Email" value=""></input>
							</td>
            </tr>

            <tr>
                <!-- Emp_register button -->
                  <td colspan=3>
                    <button type="submit" name="submit">REGISTER</button>
                  </td>
                </tr>

          </form>
        </table>
        <!-- Logout Link -->
        <a href="Login.php" class="Logout">Logout</a>

        <!-- Return to Home Page Button -->
        <button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="button2">Return Home</button>

        <!-- Return to EmployeeIDs -->
        <button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/EmployeeIDs.php" class="buttonE">Employee IDs</button>

        <!-- Who's Logged In -->
        <p class="user">Logged in:</p>
        <p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>

  </body>
</html>
