<?php
require_once "../php/function.php";

if (isset($_POST['product_id'])) {
    try {
        // Retrieve the product ID and user ID
        $product_id = $_POST['product_id'];
        $user_id = $_SESSION['user_id'];

        // Create a new PDO instance
        $db = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE, USERNAME, PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the query to check if the product is already in the favorites table
        $stmt = $db->prepare("SELECT * FROM favorites WHERE product_id = :product_id AND user_id = :user_id");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            // Prepare the query to insert the product into the favorites table
            $stmt = $db->prepare("INSERT INTO favorites (product_id, user_id) VALUES (:product_id, :user_id)");
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            // Redirect back to the product page with a success message
            header("Location: ../views/product.php?title=" . urlencode($product[0]['title']) . "&success=1");
            exit();
        } else {
            // Redirect back to the product page with an error message
            header("Location: ../views/product.php?title=" . urlencode($product[0]['title']) . "&error=1");
            exit();
        }
    } catch (PDOException $e) {
        // Log the error message (optional) and redirect with an error
        error_log($e->getMessage());
        header("Location: ../views/product.php?title=" . urlencode($product[0]['title']) . "&error=database");
        exit();
    }
} else {
    // Redirect back to the product page with an error message
    header("Location: ../views/product.php?title=" . urlencode($product[0]['title']) . "&error=1");
    exit();
}
?>
