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

        //utiliser la base de données
    $sql="use projet_stage";
    $conn->query($sql);

    if(isset($_GET['nomV']) && isset($_GET['matricule']) && isset($_GET['marque'])  && isset($_GET['modele']) && isset($_GET['anneeFab']) && isset($_GET['kilometrage']) && isset($_GET['coleur'])) {

        $AncienneNom=$_SESSION['nom_ancienne'];

        $NomVe = $_GET['nomV'];
        $Matricule = $_GET['matricule'];
        $Marque = $_GET['marque'];
        $Modele = $_GET['modele'];
        $AnneeFab = $_GET['anneeFab'];
        $Kilometrage = $_GET['kilometrage'];
        $Coleur = $_GET['coleur'];

        $sql="UPDATE ajouter_voiture SET nomV='$NomVe', matricule='$Matricule', marque='$Marque', modele='$Modele', anneeFab='$AnneeFab', kilometrage='$Kilometrage', coleur='$Coleur' WHERE `nomV`='$AncienneNom' AND `nom_utilisateur`='$nom_utili'";

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
    <title>Validation de la modification</title>

    <style>
        body{
            background-color:white;
        }

        #fenetre {
            background-color:#94b6ff4c;
            color:red;
            font-weight: bold;
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
            <p>
                <?php

                if($conn->query($sql)===true){
                    echo "les informations sont modifier avec success";
                    $redicpage="modifier_voit_1.php";
                    header("refresh:2; url=" . $redicpage);
                }
                else{
                    echo "un ereur s'est produit, veuillez réssayer";
                    echo '<script>';
                    echo 'setTimeout(function (){window.history.back()},2000)';
                    echo '</script>';
                }

                ?>
            </p>

        </div>
</body>
</html>

<?php
    $conn->close();

?>