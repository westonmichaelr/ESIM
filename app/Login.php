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
				// Destroy session to ensure no one is logged in
				session_destroy();
			?>

			<!-- Header -->
			<h1>Welcome!</h1>


			<table class="login_entry">

				<form action="BackEnd/LoginCheck.php" method="post">

				<!-- Row 1 -->
					<tr>
						<!-- Username Label-->
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
						<!-- Password Label -->
							<td colspan=1>
								<p>Password:</p>
							</td>
						<!-- Password Entry -->
							<td colspan=2>
								<input id="password" name="password" type="password" placeholder="Password" value=""></input>
							</td>
					</tr>

				<!-- Row 3 -->
					<tr>
						<!-- Login Button -->
							<td colspan=3>
								<button type="submit" name="submit">LOGIN</button>
							</td>
					</tr>

				</form>
			</table>


			<!-- ESIM Logo -->
			<p class="ESIM_logo">ESIM</p>

	</body>
</html>
