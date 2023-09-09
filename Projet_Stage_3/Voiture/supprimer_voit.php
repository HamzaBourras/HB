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

    if(isset($_GET['nomvoit']) && !empty($_GET['nomvoit'])){
            $voiture_supp=$_GET['nomvoit'];
        $sql="delete from ajouter_voiture where `nom_utilisateur`='$nom_utili' and `nomV`='$voiture_supp'";
        
        $Res=$conn->query($sql);

        if($Res===true){
            sleep(1);
            header("location:modifier_une_voiture/modifier_voit_1.php");
        }
        if($Res===false){
            echo "Ereur!!" . $conn->error;
        }
    }


?>