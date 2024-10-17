<?php
session_start(); // Ensure session is started

require_once "config.php"; // Include your database configuration file
require_once "../php/function.php";

// Initialize variables
$username = "";
$password = "";
$error = "";

// Set session parameters and start the session
createSessionParams();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password']; // Keep this raw, but hash it before storing

    // Check for empty inputs
    if (empty($username) || empty($password)) {
        $error = "Username and password cannot be empty.";
    } else {
        try {
            // Establish database connection using PDO
            $db = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE, USERNAME, PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare SQL statement
            $stmt = $db->prepare("SELECT id, password, role_id FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch results
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Regenerate session ID for security
                    session_regenerate_id(true);

                    // Store user information in session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role_id'] = $user['role_id']; // Store role information

                    // Redirect based on user role
                    if ($user['role_id'] == 1) {
                        error_log('Redirecting to dashboard.php');
                        header("Location:../admin/dashbord.php");
                        exit();
                    } else {
                        error_log('Redirecting to index_logged_in.php');
                        header("Location:../users/index_logged_in.php");
                        exit();
                    }
                    
                } else {
                    $error = "Invalid password.";
                }
            } else {
                $error = "No user found with that username.";
            }

        } catch (Exception $e) {
            // Handle exceptions
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Css/style.css">
</head>
<body>
    <div class="form-container">
        <form action="login.php" method="post">
            <h2>Login</h2>
            
            <?php if (!empty($error)) : ?>
                <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Login</button>
            
            <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
        </form>
    </div>
</body>
</html>
