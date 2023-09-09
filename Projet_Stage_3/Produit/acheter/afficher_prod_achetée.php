<?php

    session_start();

    $cle_session = $_SESSION['nom_utilisateur'];
    $nom_utili = $_SESSION[$cle_session]['Nom'];


    /* connection */
  $servername = "localhost";
  $username = "root";

  $conn = new mysqli ($servername,$username);
      // check connection 

  if($conn->connect_error){
      die("connexion fieled");
  }

  // use BD
      $conn->query("use projet_stage");

       

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Affichage des achats</title>
</head>
<body  style="background-color:#94b6ff4c">
    <div class="container-fluid">
        <h1 class="mt-5 display-5">Affichage des achats :</h1>

        <div class="container mt-5" style="display:flex; flex-wrap:wrap; justify-content:space-around">
            <?php 
                // selectioner les produits achetés :
                $sql="select DISTINCT nom_utilisateur,nom_produit,date_achat from produit_achetée where `nom_utilisateur`='$nom_utili'";
                $client=$conn->query($sql);

                if($client->num_rows >0){
                    while($row=$client->fetch_assoc()){
                        $nom_produit = $row["nom_produit"];
                        $date_dachat = $row["date_achat"];

            $nom_produit_majiscule=strtoupper($nom_produit);


            $produit="../produit_photos/" .$nom_produit_majiscule; ?>
            
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
</body>
</html>

<?php

  //fermeture de la connexion 
    $conn->close();

?>