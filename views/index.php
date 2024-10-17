<?php
require_once "../php/function.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Y phone is a phone store where you'll find the best phones at the best prices">
    <meta name="keywords" content="phones">
    <link rel="stylesheet" href="../Css/style.css">
    <title>Y phone</title>
</head>
<body>

<?php require_once "../includes/nav.php"; ?>
<?php require_once "../includes/header.php"; ?>

<main>

    <!-- Guest-specific content -->
    <form action="search.php" method="POST">
        <input type="text" name="search" placeholder="Tap to search">
        <button type="submit">Search</button>
    </form>

    <div class="left">
        <div class="section-title">Phones Categories</div>
        <?php
        $categories = getCategories(4);
        if (!empty($categories)) {
            foreach ($categories as $category):
        ?>
                <a href="category.php?category=<?php echo urlencode($category['category']); ?>">
                    <?php echo ucfirst($category['category']); ?>
                </a>
        <?php
            endforeach;
        } else {
            echo "No categories found.";
        }
        ?>
    </div>
    <div class="right">
        <div class="section-title">Home page</div>
        <?php
        $products = getHomePageProducts(4);
        if (!empty($products)) {
            foreach ($products as $product):
        ?>
                <div class="product">
                    <div class="product-left">
                        <img src="../products/<?php echo htmlspecialchars($product['image']); ?>" alt="">
                        <p class="title" style="padding-top: 25px;">
                            <a href="product.php?title=<?php echo urlencode($product['title']); ?>">
                                <?php echo htmlspecialchars($product['title']); ?>
                            </a>
                        </p>
                    </div>
                    <div class="product-right">
                        <p class="description"><b><?php echo htmlspecialchars($product['description']); ?>.</b></p>
                        <p class="price"><b>Price:</b> <?php echo htmlspecialchars($product['price']); ?>DA</p>
                    </div>
                </div>
                <br>
        <?php
            endforeach;
        } else {
            echo "No products found.";
        }
        ?>
    </div>
</main>

<?php require_once "../includes/footer.php"; ?>

</body>
</html>