<?php
require "./require/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
try {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $course = trim($_POST["course"]);
    // echo $name . "," .$email. "," .$course;

    if (empty($name) || empty($email) || empty($course)) {
        throw new Exception("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email address");
    }

    $sql = "INSERT INTO studentregistration (studentName, email, course)
            VALUES ('$name',' $email', '$course')";
    // echo $sql;
    $stmt = $conn->query($sql);
    print_r($stmt);
    // $stmt->execute([
    //     ':name'   => $name,
    //     ':email'  => $email,
    //     ':course' => $course
    // ]);

    $message = "New record created successfully";

} catch (PDOException $e) {
    $message = "Database Error: " . $e->getMessage();
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
}


}

?>

<html>
    <link rel="stylesheet" href="style.css">
<body>
    <h2>
        Add Students
    </h2>

    

    <form method="post">
        <p class="message"><?php echo $message?></p>
        <div>
            <label for="name">Name:</label><br>
        <input type="text" name="name" id="name"><br><br>

        <label for="email">Email:</label><br>
        <input type="text" name="email" id="email"><br><br>

        <label>Course:</label><br>
        <input type="text" name="course"><br><br>
        </div>
        <div class="btn_div">
            <a href="viewStudents.php">
                    <button type="button" >Back</button>
            </a>
            <button type="submit" >Update</button>
        </div>       

    </form>
</body>
</html>