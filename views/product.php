<?php require "../php/function.php" ?>
<?php 
   if(isset($_GET['title'])){
      $title = urldecode($_GET['title']);
   }else{
      header("Location: index.php");
      exit();
   }
?>
<?php $product = getProductBytitle($title) ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <link rel="stylesheet" href="../Css/style.css">
   <title><?php echo $product[0]['title'] ?></title>
   <style>
      main .right .product-left img{
         height: 200px;
      }
      footer{
         position: fixed;
         bottom: 0;
      }
   .buttons{
    display: flex;
    gap: 10px; /* Adds spacing between buttons */
}

.buttons
    button {
    padding: 10px 20px;
    font-size: 18px;
    border: thin solid #d4d4d4;
};


   </style>
</head>
<body id="index">
   <?php require_once "../includes/nav.php" ?>
 
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
         <div class="section-title">Product details</div>
         <div class="product">
            <div class="product-left">
               <img src="<?php echo "../products/{$product[0]['image']}" ?>" alt="">
            </div>
            <div class="product-right">
               <p class="title"><?php echo $product[0]['title'] ?></p>
               <p class="description"><?php echo $product[0]['description'] ?></p>
               <p class="price"><?php echo $product[0]['price'] ; ?>DA</p>
               <div class="buttons">
               <button>Buy Now</button>
               <?php if (isset($_SESSION['user_id'])) : ?>
                  <form action="../users/add_to_favorites.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product[0]['id'] ?>">
            <button class='fav' type="submit">Add to Favorites</button>
                  </form>
               <?php endif; ?>
            </div>
            </div>
         </div>
      </div>
   </main>
      
   <?php require_once "../includes/footer.php" ?>
   
</body>
</html>