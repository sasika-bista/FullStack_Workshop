<?php
include "./includes/headers.php";

if (!file_exists("students.txt")) {
    echo "<p>No students found.</p>";
} else {
    $students = file("students.txt");

    echo "<h2>Student List</h2>";

    foreach ($students as $student) {
        list($name, $email, $skills) = explode(",", trim($student));
        $skillsArray = explode("|", $skills);

        echo "<p>";
        echo "<strong>Name:</strong> $name <br>";
        echo "<strong>Email:</strong> $email <br>";
        echo "<strong>Skills:</strong> ";
        for ($i = 0; $i < count($skillsArray); $i++) {
            echo $skillsArray[$i] . ",";
        }
        echo "</p><hr>";
    }
}

include "./includes/footer.php";
?>
