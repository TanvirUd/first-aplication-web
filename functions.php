<?php

    function getQtt(){
        if(isset($_SESSION['products'])){
            return array_reduce($_SESSION["products"], function($acc, $prod){
                return $acc + $prod["qtt"];
            }, 0);
        } else return 0;
    }

    function redirect($url){
        header("Location:".$url);
        die;
    }