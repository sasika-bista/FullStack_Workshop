<?php
	require "./require/db.php";
	$message ='';

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		try{
			$stdId = trim((int)($_POST['stdId']));
			$name = trim($_POST["stdName"]);
			$password = trim($_POST['password']);

			$passwordHash = password_hash($password, PASSWORD_BCRYPT);

			if(!preg_match("/^[a-zA-z ]+$/",$name)){
				throw new Exception("name must be string only");
			}elseif(empty(trim($name))){
				throw new Exception("empty name");
			}

			if(!filter_var($stdId,FILTER_VALIDATE_INT)){
				throw new Exception("student id must be int");
			}elseif(empty($stdId)){
				throw new Exception("empty stdId");
			}

			if(empty($password)){
				throw new Exception("empty password");
			}


			$stmt = $conn->prepare("SELECT * FROM studentGradePortal WHERE studentID = ?");
			$stmt->bind_param("i", $stdId);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows > 0) {

			    $message = "Student ID already exists!";

			} else {
			    $stmt = $conn->prepare("INSERT INTO studentGradePortal (studentID, full_name, password_hash) VALUES (?, ?, ?)");
			    $stmt->bind_param("iss", $stdId, $name, $passwordHash);
			    if ($stmt->execute()) {
		        header("Location: login.php");
		        exit();

		    } else {
		        echo "Error: " . $stmt->error;
		    }
			}
		}catch (Exception $e){
			$message= $e->getMessage();
		}
	}	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>registration page</title>
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
		div{

			width: 43%;
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
	<div><p style="font-size: 15px; color: red"><?php echo $message;?></p></div>
	<form method="POST">
		<label for="stdId">Enter your STUDENT ID:</label><br>
		<input type="pasword" name="password" id="password"><br><br>
		

		<label for="stdName">Enter your STUDENT Name:</label><br>
		<input type="text" name="stdName" id="stdName"><br><br>

		<label for="stdId">Enter your pasword:</label><br>
		<input type="pasword" name="password" id="password"><br><br>

		<button type="submit">submit</button>
		<a href="index.php">
			<button type="button">Back</button>
		</a>
	</form>
</body>
</html>