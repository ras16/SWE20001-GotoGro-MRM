<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<style>
		* {
			box-sizing: border-box;
			font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
			font-size: 16px;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}

		body {
			background-color: #435165;
			padding-top: 10%;
		}

		.login {
			width: 400px;
			background-color: #ffffff;
			box-shadow: rgba(0, 0, 0.7) 13px 13px 10px;
			border-radius: 10px;
			margin: 100px auto;
		}

		.login h1 {
			text-align: center;
			color: #5b6574;
			font-size: 24px;
			padding: 20px 0 20px 0;
			border-bottom: 1px solid #dee0e4;
		}

		.login div {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			padding-top: 20px;
		}

		.login div label {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 50px;
			height: 50px;
			background-color: #3274d6;
			color: #ffffff;
		}

		.login div input[type="password"],
		.login div input[type="text"] {
			width: 310px;
			height: 50px;
			border: 1px solid #dee0e4;
			margin-bottom: 20px;
			padding: 0 15px;
		}

		.login div input[type="submit"] {
			width: 100%;
			padding: 16px;
			margin-top: 20px;
			background-color: #3274d6;
			border: 0;
			cursor: pointer;
			font-weight: bold;
			color: #ffffff;
			transition: background-color 0.2s;
		}

		.login div input[type="submit"]:hover {
			background-color: #2868c7;
			transition: background-color 0.2s;
		}
	</style>
</head>

<body>
	<?php include 'library/library.php'; ?>
	<?php
	if (isset($_COOKIE["token"])) {
		echo script("console.log('token [SET]')");
		echo script("console.log('" . "cuToken: " . $_COOKIE["token"] . "')");
	} else {
		echo script("console.log('token [UNSET]')");
	}
	if(isset($_GET["blocked"])){
		echo alert("The account has been discontinued.");
	}
	?>

	<div class="login">
		<h1>Admin Login</h1>
		<div>
			<label for="email">
				<i class="fas fa-envelope "></i>
			</label>
			<input type="text" placeholder="Email" id="email">

			<label for="password">
				<i class="fas fa-lock"></i>
			</label>
			<input type="password" placeholder="Password" id="password">

			<input type="submit" value="Login" onclick="go_login()">
		</div>
	</div>

	<script src="js/login.js"></script>
</body>

</html>