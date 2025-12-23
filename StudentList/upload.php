<?php
include "./includes/headers.php";
include "./includes/functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        if (!isset($_FILES['portfolio'])) {
            throw new Exception("No file uploaded.");
        }

        $fileName = uploadPortfolioFile($_FILES['portfolio']);
        $message = "File uploaded successfully as: $fileName";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<h2>Upload Portfolio</h2>

<p><?php echo $message; ?></p>

<form method="post" enctype="multipart/form-data">
    Select file:
    <input type="file" name="portfolio"><br><br>
    <button type="submit">Upload</button>
</form>

<?php include "./includes/footer.php"; ?>
