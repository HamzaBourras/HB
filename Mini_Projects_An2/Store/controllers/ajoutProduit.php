<pre>
<?php 
session_start();


if(isset($_POST["titre"]) && isset($_POST["prix"]) && isset($_POST["detail"]) ) {
        include_once("geredata.php");
        $path=basename($_FILES["image"]["name"]);
        $ext=pathinfo($path,PATHINFO_EXTENSION);
        $newName="images/".time().".".$ext;
        move_uploaded_file($_FILES["image"]["tmp_name"], "../".$newName);

        ajoutProduit($_POST["titre"],$_POST["prix"],$_POST["detail"],$newName);
        header("location:../views/home.php");
    }


?>