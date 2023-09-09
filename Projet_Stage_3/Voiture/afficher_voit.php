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
    <title>Affichage des voitures</title>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#94b6ff4c">
    <div class="container-fluid" >
        <h1 class="mt-5 display-4">Informations de vos Voitures :</h1>
            <div class="table-responsive mt-5">
                <table class="table table-hover ">
                    <tr class="text-white" style="font-size:20px; background-color:#2c4d93d3;">
                        <th>Nom de la voiture</th>
                        <th>Matricule</th>
                        <th>Marque</th>
                        <th>Modele</th>
                        <th>Annee de fabrécation</th>
                        <th>Kilométrage</th>
                        <th>Coleur</th>
                    </tr> 
                        <?php 
                        /* selectioner les voitures du client */
                            $sql = "select nom_utilisateur,nomV,matricule,marque,modele,anneeFab,kilometrage,coleur from ajouter_voiture
                            where `nom_utilisateur`='$nom_utili';";
                        $client_voit = $conn->query($sql);

                            if($client_voit->num_rows >0){
                                while($row = $client_voit->fetch_assoc()){
                                    $Nm = $row["nomV"];
                                    $Mt = $row["matricule"];
                                    $Mq = $row["marque"];
                                    $Md = $row["modele"];
                                    $An = $row["anneeFab"];
                                    $Kl = $row["kilometrage"];
                                    $Cl = $row["coleur"];
                        ?>
                            <!-- Affichage des voitures -->
                    <tr style="font-size:18px">
                        <td> <?php echo $Nm; ?></td>
                        <td> <?php echo $Mt; ?></td>
                        <td> <?php echo $Mq; ?></td>
                        <td> <?php echo $Md; ?></td>
                        <td> <?php echo $An; ?></td>
                        <td> <?php echo $Kl; ?></td>
                        <td> <?php echo $Cl; ?></td>

                    </tr>
                        <?php
                                }
                            }
                            //fermeture de connexion
                                $conn->close();
                        ?>
                    
                </table>
            </div>
    </div>
</body>
</html>

