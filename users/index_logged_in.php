<?php
require_once "../views/config.php"; // Ensure this path is correct


// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location:../views/login.php");
    exit();
}

// Include necessary files
require_once "../php/function.php"; // Ensure this path is correct
require_once "../includes/nav.php"; // Navigation bar for logged-in users
require_once "../includes/header.php"; // Header for the page

// Fetch user-specific data if needed
$user_id = $_SESSION['user_id'];
$user = getUserById($user_id); // Example function to get user data
$categories = getCategories(4); // Fetch categories
$products = getHomePageProducts(4); // Fetch products
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Y phone - Personalized content for logged-in users">
    <meta name="keywords" content="phones, logged in">
    <link rel="stylesheet" href="../Css/style.css">
    <title>Y phone - Welcome</title>
</head>
<body>
<main>
    <form action="../views/search.php" method="POST"> <!-- Ensure correct path -->
        <input type="text" name="search" placeholder="Tap to search">
        <button type="submit">Search</button>
    </form>

    <div class="left">
        <div class="section-title">Phones Categories</div>
        <?php foreach ($categories as $category): ?>
            <a href="../views/category.php?category=<?php echo urlencode($category['category']); ?>"> <!-- Ensure correct path -->
                <?php echo ucfirst($category['category']); ?>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="right">
        <div class="section-title">Home page</div>
        <?php foreach ($products as $product): ?>
            <div class="product">
                <div class="product-left">
                    <img src="../products/<?php echo htmlspecialchars($product['image']); ?>" alt=""> <!-- Ensure correct path and escape output -->
                    <p class="title" style="padding-top: 25px;">
                        <a href="../views/product.php?title=<?php echo urlencode($product['title']); ?>"> <!-- Ensure correct path -->
                            <?php echo htmlspecialchars($product['title']); ?> <!-- Escape output for safety -->
                        </a>
                    </p>
                </div>
                <div class="product-right">
                    <p class="description"><b><?php echo htmlspecialchars($product['description']); ?>.</b></p> <!-- Escape output -->
                    <p class="price"><b>Price:</b> <?php echo htmlspecialchars($product['price']); ?>DA</p> <!-- Escape output -->
                </div>
            </div>
            <br>
        <?php endforeach; ?>
    </div>
</main>

<?php require_once "../includes/footer.php"; // Ensure this path is correct ?>
</body>
</html>