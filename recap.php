<?php
    session_start();
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
    <title>Récapitulatif des produits</title>
</head>
<body>
    <?php include "menu.php"; ?>
    <div class="container">
        <?php
            $idSup = 0; 
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                echo "<p>Aucun produit en session...</p>";
            } else{
                echo "<table>",
                        "<thead>",
                            "<tr>",
                                "<th>#</th>",
                                "<th>Nom</th>",
                                "<th>Prix</th>",
                                "<th>Quantité</th>",
                                "<th>Total</th>",
                                "<th>Action</th>",
                            "</tr>",
                        "</thead>",
                        "<tbody>";
                $totalGeneral = 0;
                $itemDel = 0;
                foreach($_SESSION['products'] as $index => $product){
                    $totalProd = $product['price']*$product['qtt'];
                    echo "<tr>",
                            "<td>".$index."</td>",
                            "<td>".$product['name']."</td>",
                            "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                            "<td>"."<a class='qttChanger' href='traitement.php?action=decreaseQtt&id=$index'>-</a>"
                                .$product['qtt'].
                                "<a class='qttChanger' href='traitement.php?action=increaseQtt&id=$index'>+</a>"."</td>",
                            "<td>".number_format($totalProd, 2, ",", "&nbsp;")."&nbsp;€</td>",
                            "<td><a href='traitement.php?action=delProduct&id=$index'>Suprimer</a></td>";
                        "</tr>";
                    $totalGeneral+= $totalProd;                                          
                }

                echo "<tr>",
                        "<td colspan=4>Total géneral : </td>",
                        "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                        "<td></td>",
                    "</tbody>",
                    "</table>";

                echo "<div class='button'>
                        <a href='traitement.php?action=delAll'>Delete all from cart</a>
                      </div>";
                

            }
        ?>

        
    </div>
    
</body>
</html>