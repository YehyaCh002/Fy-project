<?php require "php/function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Y phone is a phone store where you'll find the best phones at the best prices">
    <meta name="keywords" content="phones">
    <link rel="stylesheet" href="Css/style.css">
    <title>Y phone</title>
</head>
<body>
    
<?php include "includes/nav.php"; ?>
<?php include "includes/header.php"; ?>
   
<main>
    <div class="left">
        <div class="section-title">Phones Categories</div>
        <?php $categories = getCategories(4)?>
        <?php foreach($categories as $category): ?>
            <a href="category.php?category=<?php echo urlencode($category['category'])?>">
                <?php echo ucfirst($category['category'])?>
            </a>
        <?php endforeach; ?>      
    </div>
    
    <div class="right">
        <div class="section-title">Home page</div>
        <?php $products = getHomePageProducts(4) ?>
        <?php foreach($products as $product): ?>
            <div class="product">
                <div class="product-left">
                    <img src="<?php echo "products/{$product['image']}" ?>" alt="">
                    <p class="title" style=padding-top:25px;>
                        <a href="product.php?title=<?php echo $product['title'] ?>">
                            <?php echo $product['title'] ?>
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
    </div>
</main>

<?php include "includes/footer.php"; ?>

</body>
</html>
