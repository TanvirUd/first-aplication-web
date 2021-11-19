<?php

    session_start();
    include "functions.php";
    include "db-functions.php";

    $action = filter_input(INPUT_GET, "action", FILTER_VALIDATE_REGEXP, [
        "options" => [
            "regexp" => "/increaseQtt|addTableau|addProduct|delProduct|delAll|decreaseQtt/"
        ]
        ]);

    if($action){

        switch($action){

            case "addProduct":
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                
                $productExist = null;
                foreach($_SESSION["products"] as $index => $value){
                    if($id == $value["id"]) {
                        $productExist = $index;                        
                    }
                }

                if($productExist !== null){
                    redirect("traitement.php?action=increaseQtt&id=$productExist");
                }else{
                    $product = findOneById($id);
                    $product['qtt'] = 1;
                    $_SESSION['products'][] = $product;
                }
                
                setMessage("success", "Produit ajouté avec succès ! <a href='recap.php'>Voir le panier</a>");
                redirect("index.php");
                break;
            
            case "addTableau":
                if(isset($_POST['submit'])){
                    $name= filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);

                    if($name && $price && $description){
                        insertProduct($name, $description, $price);
                        setMessage("success", "Produit $name ajouté avec succès !");
                    }else{
                        setMessage("notice", "Vérifiez les données du formulaire !");
                    }
                }else{
                    setMessage("error", "Sale pirate de ta maman, tu valides le formulaire STP !");
                }
                redirect("index.php");
                break;

            case "delProduct":
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                if(isset($_SESSION['products'][$id])){ 
                    unset($_SESSION['products'][$id]);
                }
                break;
            
            case "delAll":
                if(isset($_SESSION['products'])){
                    unset($_SESSION['products']);
                }
                break;

            case "decreaseQtt":
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                if($id >= 0){
                    $_SESSION['products'][$id]['qtt']--;
                    if($_SESSION['products'][$id]['qtt'] == 0){
                        redirect("traitement.php?action=delProduct&id=$id");
                    }
                }
                break;

            case "increaseQtt":
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                if($id >= 0){
                    $_SESSION['products'][$id]['qtt']++;
                }
                break;
        }
    }

    redirect("recap.php");