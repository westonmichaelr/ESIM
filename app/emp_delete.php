<DOCTYPE>
<html>
  <head>

    <!--stylesheet-->
    <link rel="stylesheet" href="css/emp_del_css.css">
  	</head>

  	<body>
      <!-- Top navigation bar -->
      <div class="topnav">
        <!-- Header -->
        <h1>Delete an Employee:</h1>

      </div>

      <!--For use in demo to see when media queries are breaking-->
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

        <table class="delete_employee">

          <form action="BackEnd/Employee_Delete_backend.php" method="post">

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

            <tr>
                <!-- Emp_delete button -->
                  <td colspan=3>
                    <button type="submit" name="submit">DELETE</button>
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
