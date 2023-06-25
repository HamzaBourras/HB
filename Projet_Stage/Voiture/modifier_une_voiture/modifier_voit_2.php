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

        //recevoir le nom du voiture;
    $nom_voiture = $_GET['nomvoit'];

    
        //Selectioner  la voiture 
        $sql = "select nom_utilisateur,nomV,matricule,marque,modele,anneeFab,kilometrage,coleur from ajouter_voiture
                     where `nom_utilisateur`='$nom_utili' AND `nomV`='$nom_voiture';";
                $client_voit = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de la voiture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid ">
        <h2 class="mt-2 display-5">Veuillez changer les informations de votre véhicule :</h2>
        <div class="container mt-4">
            <form action="modifier_voit_3.php" method="get">
                <?php
                    if($client_voit->num_rows >0){
                        while($row = $client_voit->fetch_assoc()){
                            $Nm = $row["nomV"];
                            $Mt = $row["matricule"];
                            $Mq = $row["marque"];
                            $Md = $row["modele"];
                            $An = $row["anneeFab"];
                            $Kl = $row["kilometrage"];
                            $Cl = $row["coleur"];

                //concerver l'ancienne nom du voiture 
            $_SESSION['nom_ancienne']=$Nm;
                 // Affichage des informations de la voiture
                
                echo '<label style="font-size:25px" class="form-label">Nom de la voiture :</label><br>';
            echo '<input style="font-size:20px" class="form-control" type="text" value="' .$Nm.'" name="nomV"><br>';
                echo '<label style="font-size:25px" class="form-label">Matricule :</label><br>';
            echo '<input style="font-size:20px" class="form-control" type="text" value="' .$Mt.'" name="matricule"><br>';
                echo '<label style="font-size:25px" class="form-label">Marque :</label><br>';
            echo '<input style="font-size:20px" class="form-control" type="text" value="' .$Mq.'" name="marque"><br>';
                echo '<label style="font-size:25px" class="form-label">Modèle :</label><br>';
            echo '<input style="font-size:20px" class="form-control" type="text" value="' .$Md.'" name="modele"><br>';
                echo '<label style="font-size:25px" class="form-label">Annee de fabrication :</label><br>';
            echo '<input style="font-size:20px" class="form-control" type="text" value="' .$An.'" name="anneeFab"><br>';
                echo '<label style="font-size:25px" class="form-label">Kilométrage :</label><br>';
            echo '<input style="font-size:20px" class="form-control" type="text" value="' .$Kl.'" name="kilometrage"><br>';
                echo '<label style="font-size:25px" class="form-label">Coleur :</label><br>';  
            echo '<input style="font-size:20px" class="form-control" type="text" value="' .$Cl.'" name="coleur"><br><br>';

                ?>
            <input style="font-size:25px" class="btn btn-success" type="submit" value="valider la modification">

            </form>
            
            <?php
                        }
                    }
                //fermeture de la connexion 
                    $conn->close();
            ?>
        </div>
    </div>
          
</body>
</html>