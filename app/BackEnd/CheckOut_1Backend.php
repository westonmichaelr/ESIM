<?php
//Connect to the database
$con = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");
// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// Updating the number of out_quantity for the specified items
$sql = 
