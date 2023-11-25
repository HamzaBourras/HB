<pre>

<?php
session_start();
// session_destroy();
include_once("geredata.php");
$idprodToAdd = $_GET["idprod"];
$prodToAdd = getproductById($idprodToAdd);
// var_dump($prodToAdd);

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
    $_SESSION["cart"] += [$prodToAdd["id"] => [
        "id"=>$idprodToAdd,
        "image" => $prodToAdd["image"],
        "titre" => $prodToAdd["titre"],
        "quantite" => 1,
        "prix"=>$prodToAdd["prix"]
        ]];
        $_SESSION["total"] = $prodToAdd["prix"];
} else {
    $_SESSION["total"] += $prodToAdd["prix"];
    if (array_key_exists($prodToAdd["id"], $_SESSION["cart"])) {
        $_SESSION["cart"][$prodToAdd["id"]]["quantite"] += 1;
    } else {
        $_SESSION["cart"] += [$prodToAdd["id"] => [
            "id"=>$idprodToAdd,
            "image" => $prodToAdd["image"],
            "titre" => $prodToAdd["titre"],
            "quantite" => 1,
            "prix"=>$prodToAdd["prix"]
        ]];
    }
}


    header("location:../views/home.php");
?>