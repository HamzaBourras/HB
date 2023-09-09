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


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification des voitures</title>
    <link href="../../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#94b6ff4c">
    <div class="container-fluid"> 
        <h2 class="mt-5 display-5">Choisissez une voiture :</h2>
        
                <?php  /* selectioner les voitures du client */
                    $sql = "select nom_utilisateur,nomV,marque from ajouter_voiture
                     where `nom_utilisateur`='$nom_utili';";
                $client_voit = $conn->query($sql);

                    if($client_voit->num_rows >0){
                        while($row = $client_voit->fetch_assoc()){
                            $Nm = $row["nomV"];
                            $Mq = $row["marque"];

                            $Marquemajiscule=strtoupper($Mq);
                            $a=1;
                ?>
                    <!-- Affichage des voitures pour les modifier -->
                    <div class="d-flex align-items-center mb-4 mt-5 pt-5 container" style="justify-content:space-around; flex-wrap:wrap; text-align:center;">
                       <?php 
                        $photo="../logo_voiture/" .$Marquemajiscule;
                            echo ' <img src="' .$photo.'" alt="'.$Marquemajiscule.'" width="200px" height="150px" class="mr-3 rounded">';
                       ?>
                        <p class="ms-5" style="font-size:25px"> <?php echo $Nm; ?></p>
                        <form method="get" class="ms-auto">
                            <?php echo '<input type="hidden" name="nomvoit" value="' .$Nm.'">' ?>
                            <input type="submit" value="modifier" formaction="modifier_voit_2.php" class="btn btn-lg btn-primary" >
                            <input type="submit" value="supprimer" formaction="../supprimer_voit.php" class="btn btn-lg btn-primary" >
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



                
