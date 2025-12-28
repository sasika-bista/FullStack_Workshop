<?php
require "./require/db.php";

if (!isset($_GET['id'])) {
    echo "No ID provided";
    exit;
}

$id = intval($_GET['id']); 

$sql = "DELETE FROM studentregistration WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);


if ($stmt->execute()) {
    header("Location: viewStudents.php");
    exit;
} else {
    echo "Error deleting student";
}
?>
