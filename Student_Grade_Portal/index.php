<?php
	require "./require/db.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>index</title>
	<style>
		body{
			background: black;
			color: white;
			padding: 10px;
			display: flex;
			flex-direction: column;
			border: 2px solid white;
			justify-content: center;
			align-items: center;
		}

		h2{
			font-size: 50px;
		}

		p{
			font-size: 25px;
		}

		button{
			width: 150px;
			height: fit-content;
			font-size: 20px;
			border: 2px solid white;
			background-color: black;
			color:  whitesmoke;
			border-radius: 10px;
			padding: 4px;
		}
		button:hover{
			background-color: whitesmoke;
			color:  black;
		}

	</style>
</head>
<body>
	<h2>Welcome to Student Grade Protal</h2>
	<p>Register as a new User?</p>
	<a href="register.php">
		<button type="button">got to register</button>
	</a>

	<p>already registered? log in?</p>
	<a href="login.php">
		<button type="button">got to login</button>
	</a>

</body>
</html>