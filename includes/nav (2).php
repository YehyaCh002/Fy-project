<?php 
require_once "../views/config.php";
?>
<nav>
    <div class="brand">Y phone</div>
    <div class="links">
        <!-- Home link with a condition based on user login status -->
        <a href="<?php echo isset($_SESSION['user_id']) ? '../users/index_logged_in.php' : '../views/index.php'; ?>" 
           class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == 'index_logged_in.php') ? 'active' : ''; ?>">
            Home
        </a>
        <a href="../views/about.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>">About</a>
        <a href="../views/contact.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>">Contact</a>
    </div>
    
    <div class="auth-links">
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Links for logged-in users -->
            <a href="../users/profile.php" class="profile-btn">Profile</a>
            <!-- Favorites link with heart icon -->
            <a href="../users/favorites.php" class="favorites-btn">
               Favorites 
            </a>
            <a href="../php/logout.php" class="logout-btn">Logout</a>
        <?php else: ?>
            <!-- Links for guests -->
            <a href="../views/login.php" class="login-btn">Login</a>
            <a href="../views/signup.php" class="signup-btn">Sign Up</a>
        <?php endif; ?>
    </div>
</nav>
