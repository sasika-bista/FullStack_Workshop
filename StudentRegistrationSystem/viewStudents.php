<?php
    require "./require/db.php";
    $sql = "SELECT id, studentName, email, course FROM studentregistration";
    $stmt = $conn->query($sql);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     if (count($rows) > 0) {
//     foreach ($rows as $row) {
//         echo $row['id'] . " - " .
//              $row['studentName'] . " - " .
//              $row['email'] . " - " .
//              $row['course'] . "<br>";
//     }
// } else {
//     echo "0 results";
// }
?>

<html>
    <link rel="stylesheet" href="style.css">
    <body>
        <h1>
            Student Registration System 
        </h1>
        <div class="add_btn">
            <a href="add_students.php">
                    <button type="button" >add students</button>
                </a>
        </div>
        <table class="student-table" >
            <th>
             
                <td>Name</td>
                <td>Email</td>
                <td>Course</td>
            </th>
           <?php if (count($rows) > 0): ?>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['studentName'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td>
                            <?= $row['course'] ?>
                            <a href="editStudent.php?id=<?= $row['id'] ?>">
                                <button type="button">Edit</button>
                            </a>

                            <a href="deleteStudent.php?id=<?= $row['id'] ?>">
                                <button type="button">Del</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </body>
</html>