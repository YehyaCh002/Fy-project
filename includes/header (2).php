<?php

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

if ($isLoggedIn) {
    // Fetch user details if logged in
    require_once "C:/xampp/htdocs/Y phone/php/function.php";
    $user = getUserById($_SESSION['user_id']);
}
?>

<header>
    <?php if ($isLoggedIn) : ?>
        <!-- Personalized header for logged-in users -->
        <h2>Welcome Back, <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <br>
        <p><b>Here is some personalized content for you:</b></p>
    <?php else : ?>
        <!-- Default header for guests -->
        <h1>Welcome to <i>Y Phone Store</i></h1>
        <p class="sub-title">
            We have a wide collection of phones with great prices. Enjoy!
        </p>
    <?php endif; ?>
</header>
