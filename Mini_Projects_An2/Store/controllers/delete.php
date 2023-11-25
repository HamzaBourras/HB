<?php
session_start();
$idProdToDelete = $_GET["idproddelete"];

$prixOfProd = $_SESSION["cart"][$idProdToDelete]["prix"];
$quantiteOfProd = $_SESSION["cart"][$idProdToDelete]["quantite"];

$_SESSION["total"] -= $quantiteOfProd*$prixOfProd;
var_dump($_SESSION["total"]);

$_SESSION["cart"] = array_filter($_SESSION["cart"],function ($id) use ($idProdToDelete) {
    
    return $id["id"] != $idProdToDelete;

});
header("location:../views/home.php");
?>
