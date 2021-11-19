<?php

    /**
     * Retoune le quantité total des produits dans le panier
     * 
     * @return int return le nombre de produit 
     */
    function getQtt(){
        if(isset($_SESSION['products'])){
            return array_reduce($_SESSION["products"], function($acc, $prod){
                return $acc + $prod["qtt"];
            }, 0);
        } else return 0;
    }

    /**
     * Affiche le méssage enregistré dans la session d'utilisateur
     * 
     * @return void  
     */
    function getMessage(): void
    {
        if(isset($_SESSION["message"])){
            ?>
                <p id="message" class='<?= $_SESSION["message"]['type'] ?>'>
                    <?= $_SESSION["message"]['msg'] ?> 
                </p>
            <?php
                unset($_SESSION["message"]);
        }
    }

    /**
     * Ajoute le type et le message dans le session d'utilisateur 
     * les types cert à changer le couleur de le container du message : 
     * "success" pour vert, "notice" ou "error" pour rouge
     * 
     * @param string $type pour definire le type de message
     * @param string $msg  pour definire le message
     */

    function setMessage(string $type, string $msg): void
    {
        $_SESSION['message'] = ["type" => $type, 'msg' => $msg];
    }

    /**
     * Rediréct à la page démandé solement quand il est appelées 
     * 
     * @param string $url definir le lien du redirect
     */
    function redirect($url){
        header("Location:".$url);
        die;
    }