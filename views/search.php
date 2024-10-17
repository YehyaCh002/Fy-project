<?php
// Include the function file for database operations
require_once "../php/function.php";

// Initialize $results as empty array
$results = [];

// Check if the search form has been submitted via POST and search term is not empty
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
    $searchTerm = $_POST['search'];

    // Perform a search query using your function (assuming getSearchResults() is implemented)
    $results = getSearchResults($searchTerm); // Implement this function in php/function.php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Search results for <?php echo htmlspecialchars($searchTerm ?? '') ?>">
    <meta name="keywords" content="phones, search">
    <link rel="stylesheet" href="../Css/style.css">
    <title>Search Results - Y phone</title>
</head>
<body>

<?php require_once "../includes/nav.php"; ?>

<main>
    <div class="search-results">
        <h2>Search Results for "<?php echo htmlspecialchars($searchTerm ?? '') ?>"</h2>

        <?php if (empty($results)): ?>
            <p>No results found for "<?php echo htmlspecialchars($searchTerm ?? '') ?>"</p>
        <?php else: ?>
            <?php foreach ($results as $product): ?>
                <div class="product">
                    <div class="product-left">
                        <img src="<?php echo "../products/{$product['image']}" ?>" alt="">
                        <p class="title">
                            <a href="product.php?title=<?php echo urlencode($product['title']) ?>">
                            <?php  echo ($product['title']) ?>                    
                            </a>
                        </p>
                    </div>
                    <div class="product-right">
                        <p class="description"><b><?php echo $product['description'] ?>.</b></p>
                        <p class="price"><b>Price:</b> <?php echo $product['price'] ?>DA</p>
                    </div>
                </div>
                <br>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>
<?php require_once "../includes/footer.php"; ?>
            
</body>
</html>
