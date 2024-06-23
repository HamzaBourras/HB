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

        //utiliser la base de données
    $sql="use projet_stage";
    $conn->query($sql);

        //recevoir le nom du voiture;
    $matricule_voiture = $_GET['matvoit'];

    
        //Selectioner  la voiture 
        $sql = "select nom_utilisateur,nomV,matricule,marque,modele,anneeFab,kilometrage,coleur from ajouter_voiture
                     where `nom_utilisateur`='$nom_utili' AND `matricule`='$matricule_voiture';";
                $client_voit = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de la voiture</title>
    <link href="../../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-image: url(../../bg_image/bg-3.jpg);
            background-size: 100% 100%;
            background-attachment: fixed;
        }

        label{
            color:white;
        }

        input{
            background-color:#94b6ff7c;
        }
    </style>

</head>
<body>
    <div class="container-fluid ">
        <h2 class="my-5 display-5 text-white">Veuillez changer les informations de votre véhicule :</h2>
        <div class="container mt-4" >
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
            echo '<input style="font-size:20px; background-color:rgba(255, 255, 255, 0.80);" class="form-control" type="text" value="' .$Nm.'" name="nomV"><br>';
                echo '<label style="font-size:25px" class="form-label">Matricule :</label><br>';
            echo '<input style="font-size:20px; background-color:rgba(255, 255, 255, 0.80);" class="form-control" type="text" value="' .$Mt.'" name="matricule"><br>';
                echo '<label style="font-size:25px" class="form-label">Marque :</label><br>';
            echo '<input style="font-size:20px; background-color:rgba(255, 255, 255, 0.80);" class="form-control" type="text" value="' .$Mq.'" name="marque"><br>';
                echo '<label style="font-size:25px" class="form-label">Modèle :</label><br>';
            echo '<input style="font-size:20px; background-color:rgba(255, 255, 255, 0.80);" class="form-control" type="text" value="' .$Md.'" name="modele"><br>';
                echo '<label style="font-size:25px" class="form-label">Annee de fabrication :</label><br>';
            echo '<input style="font-size:20px; background-color:rgba(255, 255, 255, 0.80);" class="form-control" type="text" value="' .$An.'" name="anneeFab"><br>';
                echo '<label style="font-size:25px" class="form-label">Kilométrage :</label><br>';
            echo '<input style="font-size:20px; background-color:rgba(255, 255, 255, 0.80);" class="form-control" type="text" value="' .$Kl.'" name="kilometrage"><br>';
                echo '<label style="font-size:25px" class="form-label">Coleur :</label><br>';  
            echo '<input style="font-size:20px; background-color:rgba(255, 255, 255, 0.80);" class="form-control" type="text" value="' .$Cl.'" name="coleur"><br><br>';

                ?>
            <input style="font-size:22px; margin-bottom:20px;" class="btn bg-white" type="submit" value="valider la modification">

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