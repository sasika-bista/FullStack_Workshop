<?php
include "./includes/headers.php";
include "./includes/functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $name = formatName($_POST['name']);
        $email = $_POST['email'];
        $skillsInput = $_POST['skills'];

        if (empty($name) || empty($email) || empty($skillsInput)) {
            throw new Exception("All fields are required.");
        }

        if (!validateEmail($email)) {
            throw new Exception("Invalid email format.");
        }

        $skillsArray = cleanSkills($skillsInput);
        saveStudent($name, $email, $skillsArray);

        $message = "Student saved successfully!";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<h2>Add Student</h2>

<p><?php echo $message; ?></p>

<form method="post">
    <label for="name">Name:</label><br>
    <input type="text" name="name" id="name"><br><br>

    <label for="email">Email:</label><br>
    <input type="text" name="email" id="email"><br><br>

    <label>Skills (comma-separated):</label><br>
    <input type="text" name="skills"><br><br>

    <button type="submit">Save Student</button>
</form>

<?php include "./includes/footer.php"; ?>
