<?php

function dbConnect() {
    $host = 'localhost';
    $dbname = 'produit';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Set PDO to throw exceptions on error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }           
}

function getCategories() {
    $pdo = dbConnect();
    $sql = "SELECT DISTINCT category FROM products";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getHomePageProducts($int) {
    $pdo = dbConnect();
    $stmt = $pdo->prepare("SELECT * FROM products ORDER BY RAND() LIMIT :limit");
    $stmt->bindParam(':limit', $int, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductsByCategory($category) {
    $pdo = dbConnect();
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = :category");
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($data) == 0) {
        header("Location: index.php");
        exit();
    } else {
        return $data;
    }
}

function getProductByTitle($title) {
    $pdo = dbConnect();
    $stmt = $pdo->prepare("SELECT * FROM products WHERE title = :title");
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($data) == 0) {
        header("Location: index.php");
        exit();
    } else {
        return $data;
    }
}

function getSearchResults($searchTerm) {
    $pdo = dbConnect();
    $searchTerm = "%$searchTerm%";
    $query = "SELECT * FROM products WHERE title LIKE :search OR description LIKE :search OR category LIKE :search";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<?php

// Function to check if input fields are empty
function isEmptyInput($inputArray) {
    foreach ($inputArray as $input) {
        if (empty(trim($input))) {
            return true;
        }
    }
    return false;
}

// Function to validate an email address
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Function to check if username already exists in the database
function isUsernameTaken($username) {
    $pdo = dbConnect(); // Establish PDO connection
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $count = $stmt->fetchColumn();
    return $count > 0;
}

// Function to check if email already exists in the database
function isEmailTaken($email) {
    $pdo = dbConnect(); // Establish PDO connection
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $count = $stmt->fetchColumn();
    return $count > 0;
}

// Function to check if the password is strong
function isStrongPassword($password) {
    // Minimum eight characters, 
       return 
           preg_match('/[a-z]/', $password) &&
           preg_match('/[0-9]/', $password) &&
           strlen($password) >= 8;
}
// In php/function.php
function getUserById($userId) {
    $db = dbConnect(); // Connect to the database

    // Prepare the SQL query
    $stmt = $db->prepare("SELECT id, username, email FROM users WHERE id = :id");

    // Bind the user ID to the parameter
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Fetch the user data
    $user = $stmt->fetch();

    // Return the user data
    return $user;
}

?>
