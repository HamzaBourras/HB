<pre>
<?php
session_start();
if (isset($_POST["nomcherch"])) {
    $prodchercher = strtoupper($_POST["nomcherch"]);
    $_SESSION["cherchercart"] = [];

    foreach ($_SESSION["cart"] as $prod) {

        if (str_contains(strtoupper($prod["titre"]), $prodchercher)) {
            array_push($_SESSION["cherchercart"],$prod);
            
        }
    }
    header("location:../views/home.php");
}
?>