<?php
	session_start();

	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !==true){
		header("Location: login.php");
		exit;
	}

	echo "Welcome".$_SESSION['full_name'];

	$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'dark';

	$background = $theme === 'dark' ? '#121212' : '#ffffff';
	$color = $theme === 'dark' ? '#ffffff' : '#000000';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>dashboard</title>
	<style>
		body{
			background-color: <?= $background?>;
			color: <?= $color?>;
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
			background-color: aqua;
			color:  black;
		}
		label{
			font-size: 20px;
		}

		input{
			width: 300px;
			height: fit-content;
			font-size: 20px;
			border: 2px solid white;
			background-color: black;
			color:  whitesmoke;
			border-radius: 10px;
			padding: 4px;
		}
		a{
			color: white;
		}
		a:hover{
			color: aqua;
		}
		a:visted{
			  color: inherit;
			  text-decoration: none; 
		}

	</style>
</head>
<body>
	<h1>Welcome <?php echo $_SESSION['full_name']?></h1>
	<p>please select your theme: <?php echo $theme?></p>

	<a href="preference.php">
		<button type="button">Change theme</button>
	</a>
	<br><br>
	<a href="logout.php">
		<button type="button">logout</button>

	</a>


</body>
</html>