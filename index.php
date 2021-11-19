<?php
    session_start();
    include "functions.php";
    include "db-functions.php";
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
    <?php include "menu.php" ?>
    <div id="mainContainer">
        
        <div id="productBox">
            <?php
                $products = findAll();
                foreach ($products as $prod) {
                    ?>
                    <div class='prodContainer'>

                        <figure class="imageProd">
                            <img src="imgProd/<?= $prod['image']?>" alt="Image de <?= $prod['name']?>">
                        </figure>

                        <h3>
                            <a href='product.php?id=<?= $prod['id'] ?>'>
                                <?= $prod['name'] ?>
                            </a>
                        </h3>

                        <?php
                        if(strlen($prod['description']) >= 50){
                            $synopsis = substr($prod['description'], 0, 47)."...";
                        }else{
                            $synopsis = $prod['description'];
                        }   
                        ?>                 
                        <p><?= $synopsis ?></p>
                        
                        <p class='price'><?= $prod['price'] ?>&euro;</p>
                        <a href='traitement.php?action=addProduct&id=<?=$prod['id']?>'>Add to cart</a>
                    </div>
                <?php
                }
            ?>
        </div>
        
    </div>
</body>
</html>