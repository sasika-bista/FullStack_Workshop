<?php
session_start();
$name = $email = "";
$errors = [];
$success = [];
$file = "User.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];


    if (empty($name)) {
        $errors["name"] = "Name is required.";
    }

    if (empty($email)) {
        $errors["email"] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format.";
    }


    if (empty($password)) {
        $errors["password"] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors["password"] = "Password must be at least 8 characters.";
    } elseif (!preg_match("/[@$!%*?&#]/", $password)) {
        $errors["password"] = "Password must include at least one special character.";
    }


    if ($password !== $confirmPassword) {
        $errors["confirm_password"] = "Passwords do not match.";
    }

  
    if (empty($errors)) {

        
        if (!file_exists($file)) {
            $errors["file"] = "User data file not found.";
        } else {

            
            $jsonData = file_get_contents($file);

            if ($jsonData === false) {
                $errors["file"] = "Failed to read users.json file.";
            } else {
               
                $users = json_decode($jsonData, true);

                if ($users === null) {
                    $users = []; 
                }
                
                $newUser = [
                    "name" => $name,
                    "email" => $email,
                    "password" => $password
                ];
                
                $users[] = $newUser;
             
                $updatedJson = json_encode($users);
                $filePut = file_put_contents($file, $updatedJson);
               
                if ($filePut === false) {
                    $errors["file"] = "Failed to write to users.json file.";
                }else {
                    $_SESSION["success"] = "Registration successful!";
                    header("Location: " . $_SERVER["PHP_SELF"]);
                    exit();
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>User Registration</h2>

    <?php if (isset($_SESSION["success"])) : ?>
    <div class="success">
        <?php 
            echo $_SESSION["success"]; 
            unset($_SESSION["success"]); 
        ?>
    </div>
<?php endif; ?>

    <?php if (isset($errors["file"])) : ?>
        <div class="error"><?php echo $errors["file"]; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <div class="error"><?php echo $errors["name"] ?? ""; ?></div>

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="error"><?php echo $errors["email"] ?? ""; ?></div>

        <label>Password:</label>
        <input type="password" name="password">
        <div class="error"><?php echo $errors["password"] ?? ""; ?></div>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password">
        <div class="error"><?php echo $errors["confirm_password"] ?? ""; ?></div>

        <button type="submit" >Register</button>
    </form>
</div>

</body>
</html>
