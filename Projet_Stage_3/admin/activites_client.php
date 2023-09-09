<?php
    //commencer la ssesion
    session_start();

    $nom_client=$_GET['nom_cl'];


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
        <div class="voitures">
            <h1 class="mt-5 display-4">Informations des Voitures du client:</h1>
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
                                where `nom_utilisateur`='$nom_client';";
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
                            ?>
                        
                    </table>
                </div>
        </div>


        <div class="produits">
            <h1 class="mt-5 display-4">Affichage des achats du client:</h1>
            <div class="container mt-5" style="display:flex; flex-wrap:wrap; justify-content:space-around">
                <?php 
                    // selectioner les produits achetés :
                    $sql="select DISTINCT nom_utilisateur,nom_produit,date_achat from produit_achetée where `nom_utilisateur`='$nom_client'";
                    $client=$conn->query($sql);

                    if($client->num_rows >0){
                        while($row=$client->fetch_assoc()){
                            $nom_produit = $row["nom_produit"];
                            $date_dachat = $row["date_achat"];

                $nom_produit_majiscule=strtoupper($nom_produit);


                $produit="../Produit/produit_photos/" .$nom_produit_majiscule; ?>
                
                <div style="text-align:center; padding: 2% 2%; margin: 2% 2%; border-radius:15px; background-color:#90b2facc" >
                    <?php echo '<img src="' .$produit. '" alt="'.$nom_produit_majiscule.'" width="250px" height="200px">' ?>
                    
                    <p style="padding-top:25px; font-size:25px"><?php echo $nom_produit ?></p>
                    <p style="font-size:17px"><?php echo $date_dachat ?></p>
                </div>

                <?php
                        }
                    }
                    ?>
            </div>
        </div>
    </div>
</body>
</html>