<!DOCTYPE HTML>
<html>
	<head>

	<!-- Stylesheet -->
	<link rel="stylesheet" href="css/lr_css.css">
	</head>

	<body>

		<?php

		// Start session
		session_start();

		// Check if logged in
		if(!isset($_SESSION['username_stored'])) {
			// Redirect to timeout page if not
			header('Location: https://cgi.soic.indiana.edu/~team59/app/BackEnd/Session_timeout.php');
		}

		?>

			<!-- Header -->
			<h1>Register as a new user:</h1>

			<table class="register_entry">

				<form action="BackEnd/RegisterCheck.php" method="post">

				<!-- Row 1 -->
					<tr>
						<!-- Username Label -->
							<td colspan=1>
								<p>Username:</p>
							</td>
						<!-- Username Entry -->
							<td colspan=2>
								<input id="username" name="username" type="text" placeholder="Username" value=""></input>
							</td>
					</tr>

				<!-- Row 2 -->
					<tr>
						<!-- Password Label-->
							<td colspan=1>
								<p>Password:</p>
							</td>
						<!-- Password Entry -->
							<td colspan=2>
								<input id="password" name="password" type="password" placeholder="Password" value=""></input>
							</td>
					</tr>

				<!--Row 3 -->
					<tr>
						<!-- Confirm Password Label-->
							<td colspan=1>
								<p>Confirm PW:</p>
							</td>
						<!-- Confirm Password Entry -->
							<td colspan=2>
								<input id="conf_password" name="conf_password" type="password" placeholder="Confirm Password" value=""></input>
							</td>
					</tr>

				<!-- Row 4 -->
					<tr>
						<!-- First Name Label -->
							<td colspan=1>
								<p>First Name:</p>
							</td>
						<!-- First Name Entry -->
							<td colspan=2>
								<input id="first_name" name="first_name" type="text" placeholder="First Name" value=""></input>
							</td>
					</tr>

				<!-- Row 5 -->
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

				<!-- Row 6 -->
					<tr>
						<!-- Register Button -->
							<td colspan=3>
								<button type="submit">REGISTER</button>
							</td>
					</tr>

				</form>
			</table>

			<!-- Link to Login Page -->
			<p class="login_link"><a href="Login.php">Return to Login Page</a><p>

			<!-- ESIM Logo -->
			<p class="ESIM_logo">ESIM</p>

	</body>
</html>
