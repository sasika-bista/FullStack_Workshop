<?php
    require "./require/db.php";
    $message = '';
    $id = intval($_GET['id']); // safe conversion

    $sql = "SELECT studentName, email, course 
            FROM studentregistration 
            WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        echo "Student not found";
        exit;
    }else{
        $userName = $student["studentName"];
        $email = $student["email"];
        $course = $student["course"];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        try {
            $name = trim($_POST["stdName"]);
            $email = trim($_POST["email"]);
            $course = trim($_POST["course"]);
            echo $name . "," .$email. "," .$course;

            if (empty($name) || empty($email) || empty($course)) {
                throw new Exception("All fields are required.");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email address");
            }

            $sql = "UPDATE  studentregistration 
                    SET studentName = '$name', email ='$email', course='$course' WHERE id = $id";
            // echo $sql;
            $stmt = $conn->query($sql);
            print_r($stmt);
            // $stmt->execute([
            //     ':name'   => $name,
            //     ':email'  => $email,
            //     ':course' => $course
            // ]);

            $message = "record  updated successfully";

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
        <div>
            <p>Edit student info for : <?= $userName;?></p>
        </div>
       
        <form  method="POST">
             <p class="message"><?php echo $message?></p>
            <div>
                <label for="stdName">Name:</label>
                <input type="text" name="stdName" id="stdName" value="<?= htmlspecialchars($userName) ?>">
                <br>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($email)?>">
                <br>

                <label for="course">Course:</label>
                <input type="text" name="course" id="course" value="<?= htmlspecialchars($course)?>">
                <br>
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