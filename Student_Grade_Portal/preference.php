<?php
	session_start();

	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
		header("Location: loginphp");
		exit;
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$theme = $_POST['theme'] === 'dark' ? 'dark': 'light';
		setcookie('theme',$theme, time() + 120,'/');
		$_COOKIE['theme'] = $theme;
		header("Location: dashboard.php");
		exit;
	}

	$currentTheme = isset($_COOKIE['theme']) ? $_COOKIE['theme']: 'dark';

	$background = $currentTheme === 'dark' ? '#121212' : '#ffffff';
	$color = $currentTheme === 'dark' ? '#ffffff' : '#000000';

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>preference page</title>
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
	
	<h2>please choose your theme</h2>
	<form method="POST">
		
		<label>
			<input type="radio" name="theme" value="light" <?php echo  ($currentTheme === "light") ? "checked" : ""?>>
			light mode
		</label>
		<br>
		<label>
			<input type="radio" name="theme" value="dark" <?php echo ($currentTheme === 'dark') ? "checked" : '';?>>
			dark mode
		</label>
		<br><br>
		<button type="submit">save</button>
		<a href="dashboard.php">
			<button type="button">Back</button>
		</a>


	</form>

</body>
</html>