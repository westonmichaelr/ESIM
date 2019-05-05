<!-- This page deletes employees from the database -->

<?php

  // connect to the database
  $con = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");

  // confirm that the 'id' variable has been set
  if (isset($_GET['empid']) && is_numeric($_GET['empid'])) {
      // get the 'id' variable from the URL
      $id = $_GET['empid'];

  // delete record from database
  if ($stmt = $mysqli->prepare("DELETE FROM Employees WHERE empid = ? LIMIT 1")) {
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $stmt->close();
  }
  else {
      echo "ERROR: could not prepare SQL statement.";
  }

  $mysqli->close();

      // redirect user after delete is successful
      header("Location: https://cgi.soic.indiana.edu/~team59/app/EmployeeIDs.php");
  }

  // if the 'id' variable isn't set, redirect the user
  else {
      header("Location: https://cgi.soic.indiana.edu/~team59/app/EmployeeIDs.php");
  }

?>
