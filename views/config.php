<?php
// Define database constants
define('SERVER', 'localhost');
define('DATABASE', 'produit');
define('USERNAME', 'root');
define('PASSWORD', '');

ini_set('session.use_only_cookies', 1); // Use cookies only for session IDs
ini_set('session.use_strict_mode', 1); // Enable strict mode to prevent uninitialized session IDs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Define a function to set additional session cookie parameters
function createSessionParams($domain = 'localhost', $path = '/', $secure = true, $httponly = true) {
    session_set_cookie_params(
        30 * 60, // lifetime
        $path, // path
        $domain, // domain
        $secure, // secure
        $httponly // httponly
    );
}
// Call the function to set session parameters
createSessionParams();
// Regenerate session ID if not already done
if (!isset($_SESSION['last_generation'])) {
    regenerate_session_id();
}

// Check if session ID needs regeneration based on expiration time
$interval = 30 * 60;
if (time() - $_SESSION['last_generation'] >= $interval) {
    regenerate_session_id();
}

// Function to regenerate session ID
function regenerate_session_id() {
    // Generate a new session ID
    session_start();
    session_regenerate_id(true);
    // Update the last generation time
    $_SESSION['last_generation'] = time();
}
?>