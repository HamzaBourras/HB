<?php
    //commencer la ssesion
    session_start();

        $cle_session=$_SESSION['nom_utilisateur'];
        $nom_utili = $_SESSION[$cle_session]['Nom'];

    if(isset($_SESSION[$cle_session]['connecter']) && $_SESSION[$cle_session]['connecter']!==true || !isset($_SESSION['nom_utilisateur'])){
        //rediriger vers la page de connexion pour se connecter
        header("location:../../Connexion_Compte/connecter.html");
        exit;
    }


    /* connection */
    $servername = "localhost";
    $username = "root";

    $conn = new mysqli ($servername,$username);
        // check connection 

    if($conn->connect_error){
        die("connexion fieled");
    }

        /****  Création de base de données s'elle n'existe pas ****/
     $sql="create database IF NOT EXISTS projet_stage";
     $conn->query($sql);
    
        // utiliser la base de données 
    $sql="use projet_stage";
    $conn->query($sql);

    if(isset($_GET['matvoit']) && !empty($_GET['matvoit'])){
            $voiture_supp=$_GET['matvoit'];
        $sql="delete from ajouter_voiture where `nom_utilisateur`='$nom_utili' and `matricule`='$voiture_supp'";
        
        $Res=$conn->query($sql);

        if($Res===true){
            sleep(1);
            header("location:modifier_voit_1.php");
        }
        if($Res===false){
            echo "Ereur!!" . $conn->error;
            
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        body{
            background-image: url(../../bg_image/bg-3.jpg);
            background-size: 100% 100%;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    
</body>
</html>