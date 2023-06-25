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


        /****création du tableau si il n'existe pas */
    $sql="create table IF NOT EXISTS ajouter_voiture ( nom_utilisateur varchar (20), nomV varchar(20), matricule varchar(20), marque varchar(15), modele varchar(20), anneeFab int(11), kilometrage int(15), coleur varchar(10)) ";
    $conn->query($sql);

    if($conn->query($sql)===false){
        echo "ereur" . $conn->error;
    }

$set=0;   
if(isset($_GET['nomV']) && isset($_GET['matricule']) && isset($_GET['marque'])  && isset($_GET['modele']) && isset($_GET['anneeFab']) && isset($_GET['kilometrage']) && isset($_GET['coleur'])){
    $set=1;
}

$nonempty=0;
    if(!empty($_GET['nomV']) && !empty($_GET['matricule']) && !empty($_GET['marque'])  && !empty($_GET['modele']) && !empty($_GET['anneeFab']) && !empty($_GET['kilometrage']) && !empty($_GET['coleur'])){
        $nonempty=1;
    }


    if($set==1){
        
        $NomVe = $_GET['nomV'];
        $Matricule = $_GET['matricule'];
        $Marque = $_GET['marque'];
        $Modele = $_GET['modele'];
        $AnneeFab = $_GET['anneeFab'];
        $Kilometrage = $_GET['kilometrage'];
        $Coleur = $_GET['coleur'];
    

            /* vérifier si la voiture n'existe pas déja */
        $existe=0;
            $sql="select matricule from ajouter_voiture ;";
            $client=$conn->query($sql);

            if($client->num_rows >0){
                while($row = $client->fetch_assoc()){
                    $Mt = $row["matricule"];
                    if($Mt==$Matricule){
                        $existe=1; break;
                    }
                }
            }

        /* Inserer la voiture dans le tableau */
    if($nonempty==1 && $existe==0){
        $sql="INSERT INTO ajouter_voiture ( nom_utilisateur, nomV , matricule , marque , modele , anneeFab , kilometrage , coleur ) VALUE ('$nom_utili','$NomVe','$Matricule','$Marque','$Modele','$AnneeFab','$Kilometrage','$Coleur')";
    }

$true=0;
if($conn->query($sql)===true){
    $true=1;
}

        /* affichage de la fenetre de message */       
        echo '<script>';
        echo 'function() {';
        echo '    var modal = document.getElementById("fenetre");';
        echo '    modal.style.display = "block";';
        echo '}';
        echo '</script>';


    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de voiture</title>

    <style>
        body{
            background-color:#395144;
        }

        #fenetre {
            background-color:#c8af85;
            color:red;
            font-weight: bold;
            width:800px;
            padding:15px;
            font-size:50px;
            text-align:center;
            align-items:center;
            position:absolute;
            left:50%;
            top:30%;
            transform:translateX(-50%);
        }
    </style>

</head>
<body>
    <div id="fenetre">
        <p> <?php 
                /* si un champ est vide */
            if($nonempty==0 ) {
                echo "veuilez remplir tous les champs !";
                echo '<script>';
                echo 'setTimeout(function (){window.history.back()},2000)';
                echo '</script>';
            } 
                /* si l'utilisateur existe déja */
            if($existe==1) {
                echo "cette voiture existe déja !";
                echo '<script>';
                echo 'setTimeout(function (){window.history.back()},2000)';
                echo '</script>';
            }
                /* rediction vers la page de connexion si l'inscrition est correcte */
            if($true==1 && $existe==0 ){
                echo "Ajoutée correctement";
                $redicpage="voit.html#ajouter";
                header("refresh:1.5; url=" . $redicpage);
            } 
                /* s'il y a un ereur */
            if($true==0 ) {
                echo "Ereur !" . $conn->error;
                echo '<script>';
                echo 'setTimeout(function (){window.history.back()},3000)';
                echo '</script>';
            }
        ?> </p>
    </div>
</body>
</html>

<?php

    //fermeture de connexion
        $conn->close();

?>