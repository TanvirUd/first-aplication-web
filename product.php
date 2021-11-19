<?php 
    session_start();
    include "db-functions.php";
    include "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div id="nav">
        <?php include "menu.php" ?>
    </div>
    <article class="prodArticle">
        <a href="index.php">return</a>
        <?php
            $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
            $product = findOneById($id);
            ?>
            <figure id="imageBig">
                <img src="imgProd/<?=$product['image']?>" alt="Image de <?=$product['name']?>">
            </figure>
            <h1><?=$product['name']?></h1>

            <p><?=$product['description']?></p> 

            <p class='price'><?=$product['price']?> &euro;</p> 
            
            <div class="button">
                <a href='traitement.php?action=addProduct&id=<?=$product['id']?>'>Add to cart</a>       
            </div>
    
    </article>
</body>
</html>