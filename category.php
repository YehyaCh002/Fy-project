<?php require "php/function.php" ?>
<?php 
   if(isset($_GET['category'])){
      $cat = $_GET['category'];
   }else{
      header("Location: index.php");
      exit();
   }
?>
<?php $products = getProductsByCategory($cat) ?>
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
<body id="index">
   <?php include "includes/nav.php" ?>
   <?php include "includes/header.php" ?>
 
   <main>
      <div class="left">
         <div class="section-title">Product Categories</div>
         <?php $categories = getCategories() ?>
         <?php 
            foreach ($categories as $category) {
               ?>
                  <a href="category.php?category=<?php echo $category['category'] ?>"><?php echo ucfirst($category['category']) ?></a>
               <?php
            }
         ?>
      </div>
 
      <div class="right">
         <div class="section-title">Products in the <?php echo ucfirst($cat) ?> category</div>
         <div class="product">
            <?php 
               foreach ($products as $product) {
                  ?>
                     <div class="product-item">
                        <div class="product-left">
                           <img src="<?php echo "products/{$product['image']}" ?>" alt="">
                        </div>
                        <div class="product-right">
                           <p class="title">
                              <a href="product.php?title=<?php echo urlencode($product['title']) ?>">
                                 <?php echo $product['title'] ?>
                              </a>
                           </p>
                           <p class="description"><?php echo $product['description'] ?></p>
                           <p class="price"><?php echo $product['price'] ; ?>DA</p>
                        </div>
                     </div>
                     <br>
                  <?php
               }
            ?>
         </div>
      </div>
   </main>
      
   <?php include "includes/footer.php" ?>
</body>
</html>
