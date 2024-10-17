<?php
session_start();
session_unset();
session_destroy();
// Redirect to login page or home page
header('Location:../views/index.php');
exit();
?>