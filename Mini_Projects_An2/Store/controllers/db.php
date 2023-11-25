<?php

/* connection */
try {
    $conn = new PDO( 'mysql:host=localhost;', 'root', '' );
} catch( PDOException $e ) {
    echo $e->getMessage();
}

/* Création de la base de données */
$req = $conn->prepare('create database IF NOT EXISTS hanouti');
$req->execute();

/* connection à la base de données */
try {
    $conn = new PDO( 'mysql:host=localhost;dbname=hanouti', 'root', '' );
} catch( PDOException $e ) {
    echo $e->getMessage();
}


/* Création du table du produits */
$req = $conn->prepare('create table IF NOT EXISTS produits (id INT AUTO_INCREMENT PRIMARY KEY, titre varchar (80), prix float, image varchar (80), detail varchar (200) )');
$req->execute();


/* Création du table du users */
$req = $conn->prepare('create table IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, email varchar (60), password varchar (20), role varchar (20) )');
$req->execute();


?>