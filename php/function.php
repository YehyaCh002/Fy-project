<?php

function dbConnect() {
    $db = mysqli_connect('localhost', 'root', '', 'produit');
    return $db;
}

function getCategories() {
    $db = dbConnect();
    $sql = "SELECT DISTINCT category FROM products";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

    function getHomePageProducts($int){
        $mysqli = dbConnect();
        $result = $mysqli->query("SELECT * FROM products ORDER BY rand() LIMIT $int");
        while ($row = $result->fetch_assoc()){
           $data[] = $row;
        }
        return $data;
     }
     function getProductsByCategory($category){
        
            $mysqli = dbConnect();
            $stmt = $mysqli->prepare("SELECT * FROM products WHERE category = ?");
            $stmt->bind_param("s", $category);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            if(count($data) == 0){
               header("Location: index.php");
               exit();
            }else{
               return $data;
            }
         }
         function getProductBytitle($title){
            $mysqli = dbConnect();
            $stmt = $mysqli->prepare("SELECT * FROM products WHERE title = ?");
            $stmt->bind_param("s", $title);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            if(count($data) == 0){
               header("Location: index.php");
               exit();
            }else{
               return $data;
            }
         }

     
 
?>
