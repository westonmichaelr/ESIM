<!DOCTYPE HTML>
<html lang="en">
	<head>
			<!-- Adds jQuery functionality to this page -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <meta charset="utf-8">
      <title>CheckIn_1 Page</title>
	    <!-- Stylesheet -->
	    <link rel="stylesheet" href="css/CheckIn_1.css">
	</head>

	<body>


		<!-- The Modal -->
			<div id="myModal" class="modal">

				<!--Scan Item(s) Now container-->
						<div class="scan_items_label" id="scan_items_label">
							<h1>SCAN ITEM(S)</h1>
							<h1>NOW!</h1>
						</div>

						<button onclick="remove_popup_manual()" class="manual_label" id="manual_label">
							or, CHECK IN MANUALLY
						</button>
				</div>


		<!-- Top navigation bar -->
		<div class="topnav">
		    <!--Header-->
		    <h1>Check-In</h1>

		</div>

		<!--For use in demo to see when media queries are breaking-->
		<!-- <div id="rwd"></div> -->

		<!--Item input form-->
		<div class="queue_item" id="queue_item">

			<!-- Textbox for entering items -->
			Add Item(s): <input class="item_input" id="item_input"> </input>

			<!-- Adds item to list button -->
			<button type="button" class="add_button" id="add_button" onclick="add_items()">ADD</button>

		</div>

		<!-- Items LIST -->
		<div class="items_list_div">
		<h2>CHECK-IN QUEUE:</h2>

			<!-- List of items being checked in -->
			<form action="CheckIn_2.php" id="item_list" method="post">

				<!-- PHP code for Employees dropdown -->
					<?php

					/* CONTINUE SESSION */
						session_start();

					// Check if logged in
					if(!isset($_SESSION['username_stored'])) {
						// Redirect to timeout page if not
						header('Location: https://cgi.soic.indiana.edu/~team59/app/BackEnd/Session_timeout.php');
					}

					// Connect to database
					$con = mysqli_connect("db.sice.indiana.edu", "i494f18_team59", "my+sql=i494f18_team59", "i494f18_team59");

					// Check connection
					if (!$con) {
							die("Connection failed: " . mysqli_connect_error());
					}
							$employee_sql = "SELECT empid FROM employees";
							$result = mysqli_query($con, $employee_sql);

							// Gathers the table names as $rows
							while ($row = $result->fetch_assoc()) {
									$rows[] = $row;
							}
					?>

				<p>Employee: <select name="employee_select" id="employee_select"></p>
					<!-- Fills dropdown with each $row in $rows (the tables) -->
						<?php
							foreach ($rows as $row) {
								echo "<option value='" . $row['empid'] . "'>" . $row['empid'] . "</option>";
							}
						?>
				</select>

				<!-- Submitting to CheckOut_2.php button -->
				<button type="submit" id="submit_button" class="submit_button">SUBMIT CHECK-IN &#187;</button>

			</form>

		</div>

				<!-- Deletes all queued items -->
				<button class="remove_items" onclick="delete_items()">REMOVE ITEMS</button>


		<!--View Inventory Status Button-->
		<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/InventoryStatus.php" class="view_IS_button">View Inventory Status</button>

		<!--Return to Home Page Button-->
		<button onclick=location.href="https://cgi.soic.indiana.edu/~team59/app/Home.php" class="return_home">Return Home</button>

		<!--ESIM Logo-->
      <p class="ESIM_logo">ESIM</p>
    <!--Who's logged in-->
      <p class="user">Logged in: </p>
			<p class="user_logged_in"> <?php echo $_SESSION['username_stored']; ?> </p>
    <!--Logout Link-->
      <a href="Login.php" class="Logout">Logout</a>


		<!-- SCRIPT functions -->
			<script>

			// Var to check if items are in queue
			var items_in_queue = document.getElementsByClassName('queued_item');
			var the_submit_button = document.getElementById('submit_button');

			// Checks if items are in queue
			function check_queue() {
						if (items_in_queue.length > 0) {
							// Display submit button
							the_submit_button.style.display = "inline";
						}
						else {
							// Don't display submit button
							console.log('no stuff');
							the_submit_button.style.display = "none";
						}
					}

			// Runs Check Queue every ms
			setInterval(check_queue, 1);


			// Flag variable- default as checking out with scanner
			var checkout_type = "scanner";

			// Run this function when the page first loads
			window.onload = function() {

				// Automatically select item input textbox (for scanning)
				document.getElementById('item_input').focus();
				// Get the input field
				var input = document.getElementById("item_input");
				// Execute a function when the user releases a key on the keyboard
				input.addEventListener("keyup", function(event) {

						// Number 13 is the "Enter" key on the keyboard
						if (event.keyCode === 13 && checkout_type == "scanner") {
							// Cancel the default action, if needed
							event.preventDefault();
							// Trigger the button element with a click
							document.getElementById("add_button").click();

							// Do the remove_popup_scanner function
							remove_popup_scanner();
									}
							});
						}

				// Used to remove the MODAL overlay
				// Manual mode (keeps item enter)
				function remove_popup_manual() {

						// Flag variable- checking out manually
						checkout_type = "manual";
						// Get the modal
						var modal = document.getElementById('myModal');
						// Don't display the modal
						modal.style.display = "none";

				}

				// Used to remove the MODAL overlay
				// Scanner mode (removes item enter)
				function remove_popup_scanner() {

						// Get the modal
						var modal = document.getElementById('myModal');
						//Don't display the modal
						modal.style.display = "none";

						// Get the item queue div
						var queue_item = document.getElementById('queue_item');
						// Don't display it
						queue_item.style="position:absolute; top:0px;";
						queue_item.style.zIndex = "-1";

						// Automatically select item input textbox (for scanning)
						document.getElementById('item_input').focus();
				}


				// This function adds items to the check-out
				function add_items() {


						/* TEST TEST TEST TEST */
						var e = jQuery.Event("keypress");
							e.which = 9; //choose the one you want
							e.keyCode = 9;
						$("#theInputToTest").trigger(e);


						/* Used for creating the item select */
						var items_list = document.getElementById("item_list");
						var item_div = document.createElement("div");
						item_div.className = 'queued_item';

						/* Gets the 'value' of item in item_input */
						var item = document.getElementById("item_input").value;

						/* Check if a valid item is entered before adding to queue */
						if (['Blazers', 'Coats', 'Earpieces', 'Jackets', 'Polos', 'Ponchos', 'Radios', 'Sweaters', 'Tags'].indexOf(item) >= 0) {

									/* Appends that item value to item_div */
									item_div.appendChild(document.createTextNode(item));

									/* Creates the qty_select parent */
									var qty_select = document.createElement("select");
									/* Sets the qty_select NAME to the item name */
									qty_select.name = item + "_qty";

									/* Creates the 10 qty_option children of the qty_select parent */
									for (var i = 1; i < 10; ++i) {
											var qty_option = document.createElement("option");
											qty_option.text = i;
											qty_option.value = i;
											qty_select.add(qty_option);
									}

									/* Creates an array of values to be added later */
									var array = ["small","medium","large","x_large"];
									var array2 = ["Checking in", "*Done w/repair"];

									/* Creates the size_select parent */
									var size_select = document.createElement("select");
									size_select.name = item + "_size";
									items_list.appendChild(size_select);


									/* If the item IS NOT a Radio: */
									if (item !== "Radios") {
											/* Creates the size_option children of the size_select parent */
											for (var i = '0'; i < array.length; i++) {
												var size_option = document.createElement("option");
												size_option.text = array[i];
												size_option.value = array[i];
												size_select.add(size_option);
											}
									}
									/* If the item IS a Radio: */
									else {
											/* Creates the size_option children of the size_select parent */
											for (var i = '0'; i < array2.length; i++) {
												var size_option = document.createElement("option");
												size_option.text = array2[i];
												size_option.value = array2[i];
												size_select.add(size_option);
											}
									}

									/* Appends the item select to item_div */
									item_div.appendChild(qty_select);
									/* Appends the size select to item_div */
									item_div.appendChild(size_select);
									/* Adds the qty dropdown to items_list */
									items_list.appendChild(item_div);

							}

						/* Makes the textbox empty again */
						document.getElementById('item_input').value = "";
			}


				/* This function deletes all queued items */
				function delete_items() {

					// Removes all items that are queued
					$('.queued_item').remove();

					// Automatically select item input textbox (for scanning)
					document.getElementById('item_input').focus();

				}

			</script>

  </body>
</html>
