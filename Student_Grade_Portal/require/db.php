<?php
	$serverName = "localhost";
	$userName = "root";
	$password="";

	$conn =  new mysqli($serverName, $userName, $password);

	if ($conn -> connect_error){
		die('connection failed:'.$conn->connetion_error);
	}
	// echo "Connected to server successfully";

	$sql ='CREATE DATABASE IF NOT EXISTS Student_Grade_Portal';
	// echo ($conn->query($sql) === TRUE) ?  "Database created successfully":  $conn->error;

	$conn->select_db("Student_Grade_Portal");

	$tableSql = 'CREATE TABLE IF NOT EXISTS studentGradePortal(
			id INT(100) AUTO_INCREMENT PRIMARY KEY,
			studentId VARCHAR(100) UNIQUE NOT NULL,
			full_name VARCHAR(100) NOT NULL,
			password_hash VARCHAR(255) NOT NULL
		)';

	// echo ($conn->query($tableSql) === TRUE) ? "table created successfully" : "error:".$conn -> error;
?>