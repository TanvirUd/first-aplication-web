<?php
    session_start();
    include "functions.php"
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
    <title>Ajout produit</title>
</head>
<body>
    <div id="nav">
        <?php include "menu.php" ?>
    </div>
    <div class="container">
        <div id="title">
            <h1>Ajouter un produit</h1>
        </div>
        
        <form action="traitement.php?action=addProduct" method="post">
            <p>
                <label>
                    Nom du produit :
                    <input type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                    Prix du produit :
                    <input type="number" step="any" name="price">
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée :
                    <input type="number" name="qtt" value="1">
                </label>
            </p>
            <p>              
                <input type="submit" name="submit" value="Ajouter le produit">        
            </p>
        </form>
    </div>
    
</body>
</html>