<?php

/**
 * Retourne une instance de PDO, représentant la base des données
 * 
 * @return \PDO un objet instance de PDO, connecté à la base des données
 */
function connection(){
    $db = new PDO(
        "mysql:dbname=store;host=localhost:3306",
        "root",
        "",
        [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        ]
    );

    return $db;

}

/**
 * Retourne toute les produits dans la base de données
 * en format array[$index][$column]
 * 
 * @return array|false 
 * table de produit avec un autre table de dans contenent les infos du produit, 
 * un tableau vide si aucun produit n'est présent en base de données ou FALSE si la requète a échoué 
 */

function findAll(){
    $product = "SELECT * FROM product";

    $stmt = connection()->prepare($product);
    $stmt->execute();

    return $stmt->fetchAll();
}

/**
 * Retourne le table apartenent a l'index demandé
 * 
 * @param int $id l'index du table
 */

function findOneById($id){
    $product = "SELECT * FROM product WHERE id = :id";
    
    $stmt = connection()->prepare($product);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetch();
}

/**
 * insère un produit en base de données
 * 
 * @param string $name        le nom du produit
 * @param string $description le description du produit
 * @param float|int $price    le prix du produit 
 * 
 * @return bool TRUE si l'ajout en base a réussi, FALSE sinon
 */

function insertProduct($name, $descr, $price){
    $product = "INSERT INTO product (name, description, price)
                VALUES (:name, :descr, :price)";
    
    $stmt = connection()->prepare($product);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":descr", $descr);
    $stmt->bindParam(":price", $price);
    return $stmt->execute();
}
