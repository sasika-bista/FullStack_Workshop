<?php
	require "./require/db.php";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		try{
			$studentId = trim($_POST['studentId']);
			$password = trim($_POST['password']);

			if(empty($studentId)){
				throw new Exception("studentId cannot be empty");
			}

			if (!filter_var($studentId, FILTER_VALIDATE_INT)) {
			    throw new Exception("Student ID must be an integer");
			}

			if(empty($password)){
				throw new Exception("password cannot be empty");
			}

			$sql = 'SELECT  full_name, password_hash FROM studentgradeportal WHERE studentId = ?';
			$stmt = $conn->prepare($sql);

			$stmt->bind_param('i',$studentId);
			$stmt->execute();

			$result = $stmt->get_result();
			$row= $result->fetch_assoc();

			if(!$row){
				throw new Exception("User doesnt exist. please try again.");
			}

			$passwordHash = $row['password_hash'];

			if(password_verify($password, $passwordHash)){
				session_start();

				$_SESSION['logged_in'] = true;
				$_SESSION['studentId'] = $studentId;
				$_SESSION['full_name'] = $row['full_name'];


				header("Location: dashboard.php");
				exit;
			}else{
				throw new Exception("password incorrect");
			}



		}catch (Exception $e){
			echo $e->getMessage();
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log in</title>
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
	<h2>Welcome to Login Page</h2>
	<p>please enter your user name and pass word</p>

	<form method="POST">
		<label for="studentId">Student Id:</label><br>
		<input type="text" name="studentId" placeholder="enter your studentID">
		<br>
		<br>
		<label for="password">Password:</label><br>
		<input type="pasword" name="password" placeholder="enter your password"><br><br>

		<button type="submit">Login</button>
		<br>
		<p>new user? <a href="register.php">sign up</a> </p>
	</form>
</body>
</html>