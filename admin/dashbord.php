<?php
session_start();
require_once "../views/config.php";

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../views/login.php"); // Redirect to login if not logged in or not admin
    exit();
}

try {
    // Database connection and queries
    $db = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE, USERNAME, PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // User count query
    $userCountStmt = $db->query("SELECT COUNT(*) as user_count FROM users");
    $userCount = $userCountStmt->fetch(PDO::FETCH_ASSOC)['user_count'];

    // User details query
    $userDetailsStmt = $db->query("SELECT username, email, created_at FROM users");
    $userDetails = $userDetailsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Orders, categories, and products counts queries
    $ordersCountStmt = $db->query("SELECT COUNT(*) as orders_count FROM orders");
    $ordersCount = $ordersCountStmt->fetch(PDO::FETCH_ASSOC)['orders_count'];

    $categoriesCountStmt = $db->query("SELECT COUNT(*) as categories_count FROM categories");
    $categoriesCount = $categoriesCountStmt->fetch(PDO::FETCH_ASSOC)['categories_count'];

    $productsCountStmt = $db->query("SELECT COUNT(*) as products_count FROM products");
    $productsCount = $productsCountStmt->fetch(PDO::FETCH_ASSOC)['products_count'];

    // Unavailable products and today's earnings queries
    $unavailableProductsCountStmt = $db->query("SELECT COUNT(*) as unavailable_products_count FROM products WHERE stock = 0");
    $unavailableProductsCount = $unavailableProductsCountStmt->fetch(PDO::FETCH_ASSOC)['unavailable_products_count'];

    $todaysEarningsStmt = $db->query("SELECT SUM(total) as todays_earnings FROM orders WHERE created_at >= CURDATE()");
    $todaysEarnings = $todaysEarningsStmt->fetch(PDO::FETCH_ASSOC)['todays_earnings'];

} catch (Exception $e) {
    $error = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../Css/admin_css.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside>
            <a href="dashboard.php">Home</a>
            <a href="users.php">Users</a>
            <a href="categories.php">Categories</a>
            <a href="products.php">Products</a>
            <a href="../php/logout.php" class="logout_butt">Logout</a>
        </aside>

        <!-- Main Dashboard Content -->
        <div class="dashboard-content">
            <div class="card">
                <h3>Welcome, Admin!</h3>
                <p>Here is a summary of user statistics and details.</p>
            </div>
            <div class="card">
                <h3>User Statistics</h3>
                <p>Total number of users: <?php echo htmlspecialchars($userCount); ?></p>
            </div>
            <div class="card">
                <h3>User Details</h3>
                <?php if (!empty($userDetails)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userDetails as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No user details found.</p>
                <?php endif; ?>
            </div>
            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>Orders Received</th>
                            <th>Orders In Progress</th>
                            <th>New Orders</th>
                            <th>Today's Earnings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>4</td>
                            <td>0</td>
                            <td>0</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <th>Categories</th>
                            <th>Unavailable Products</th>
                            <th colspan="2">Available Products</th>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>7</td>
                            <td colspan="2">7</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
