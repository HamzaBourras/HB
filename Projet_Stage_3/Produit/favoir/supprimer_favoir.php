<?php

    //commencer la ssesion
    session_start();

    $cle_session=$_SESSION['nom_utilisateur'];
    $nom_utili = $_SESSION[$cle_session]['Nom'];


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

    if(isset($_GET['nomp']) && !empty($_GET['nomp'])){
            $produit_supp=$_GET['nomp'];
        $sql="delete from favoir where `nom_utilisateur`='$nom_utili' and `nom_prod`='$produit_supp'";
        
        $Res=$conn->query($sql);

        if($Res===true){
            sleep(1);
            header("location:afficher_favoir.php");
        }
        if($Res===false){
            echo "Ereur!!" . $conn->error;
        }
    }


?>