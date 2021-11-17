<?php

    session_start();
    include "functions.php";

    $action = filter_input(INPUT_GET, "action", FILTER_VALIDATE_REGEXP, [
        "options" => [
            "regexp" => "/increaseQtt|addProduct|delProduct|delAll|decreaseQtt/"
        ]
        ]);

    if($action){

        switch($action){

            case "addProduct":
                if(isset($_POST['submit'])){

                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
            
                    if($name && $price && $qtt){
                        $product = [
                            "name" => $name,
                            "price" => $price,
                            "qtt" => $qtt
                        ];
            
                        $_SESSION['products'][] = $product;                        
                    }         
                    
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