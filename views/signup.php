<?php
require '../php/function.php'; // Ensure this points to your actual functions file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; 

    // Initialize error messages array
    $errors = [];

    // Perform validations
    if (isEmptyInput([$username, $email, $password])) {
        $errors[] = "Please fill in all fields.";
    }

    if (!isValidEmail($email)) {
        $errors[] = "Invalid email format.";
    }

    // Establish database connection
    $db = dbConnect(); // Assume this function returns a PDO instance

    // Use PDO for database operations
    try {
        // Check if username is already taken
        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            $errors[] = "Username is already taken.";
        }

        // Check if email is already taken
        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            $errors[] = "Email is already taken.";
        }

        // Validate password strength
        if (!isStrongPassword($password)) {
            $errors[] = "Password must be at least 8 characters long.";
        }

        // Handle errors
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<p>Error: " . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</p>";
            }
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user data into the database
            $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                throw new Exception("Failed to insert user: " . implode(" ", $stmt->errorInfo()));
            }
        }
    } catch (Exception $e) {
        echo "<p>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../Css/style.css">
</head>
<body>
    <div class="form-container">
        <form action="signup.php" method="post">
            <h2>Sign Up</h2>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required placeholder='must be at least 8 characters long [a..z] [0..9]'>
            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
