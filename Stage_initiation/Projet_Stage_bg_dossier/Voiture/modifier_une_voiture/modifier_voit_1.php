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


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification des voitures</title>
    <link href="../../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-image: url(../../bg_image/bg-3.jpg);
            background-size: 100% 100%;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    <div class="container-fluid"> 
        <h2 class="mt-5 display-5 text-white">Choisissez une voiture :</h2>
        
                <?php  /* selectioner les voitures du client */
                    $sql = "select nom_utilisateur,nomV,marque,matricule from ajouter_voiture
                     where `nom_utilisateur`='$nom_utili';";
                $client_voit = $conn->query($sql);

                    if($client_voit->num_rows >0){
                        while($row = $client_voit->fetch_assoc()){
                            $Nm = $row["nomV"];
                            $Mq = $row["marque"];
                            $Mt = $row["matricule"];

                            $Marquemajiscule=strtoupper($Mq);
                            $a=1;
                ?>
                    <!-- Affichage des voitures pour les modifier -->
                    <div class="d-flex align-items-center mb-4 mt-5 pt-5 container" style="justify-content:space-around; flex-wrap:wrap; text-align:center;">
                       <?php 
                        $photo="../logo_voiture/" .$Marquemajiscule;
                            echo ' <img src="' .$photo.'" alt="'.$Marquemajiscule.'" width="200px" height="150px" class="mr-3 rounded text-white">';
                       ?>
                        <p class="ms-5" style="font-size:25px; color:white;"> <?php echo $Nm; ?></p>
                        <form method="get" class="ms-auto">
                            <?php echo '<input type="hidden" name="matvoit" value="' .$Mt.'">' ?>
                            <input type="submit" value="modifier" formaction="modifier_voit_2.php" class="btn btn-lg bg-white" >
                            <input type="submit" value="supprimer" formaction="supprimer_voit.php" class="btn btn-lg bg-white" >
                        </form>
                    </div>
                <?php
                        }
                    }
                     //fermeture de connexion
                        $conn->close();
                ?>
            

                
            
    </div>
</body>
</html>



                
