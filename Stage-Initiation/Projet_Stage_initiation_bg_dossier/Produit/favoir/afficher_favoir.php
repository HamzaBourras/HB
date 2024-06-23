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

  // use BD
      $conn->query("use projet_stage");

  // selectioner les produits favoirs :
    $sql="select DISTINCT nom_utilisateur,nom_prod from favoir where `nom_utilisateur`='$nom_utili'";
    $client=$conn->query($sql);

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Affichage des favoirs</title>

    <style>
        body{
            background-image: url(../../bg_image/bg-7.jpg);
            background-size: 100% 100%;
            background-attachment: fixed;
        }
    </style>

</head>
<body>
    <div class="container-fluid">
        <h1 class="mt-5 display-4 text-white mb-5">Affichage des favoirs :</h1>
        <div class="container mt-5" style="display:flex; flex-wrap:wrap; justify-content:space-around;">
            <?php
                if($client->num_rows >0){
                    while($row=$client->fetch_assoc()){
                        $nom_produit = $row["nom_prod"];

                    $nom_produit_majiscule=strtoupper($nom_produit);


            $produit="../produit_photos/" .$nom_produit_majiscule; ?>

            <div style="text-align:center; padding: 2% 2%; margin:2% 2%; border-radius:15px; border: 3px solid #dabb74;">
                <?php echo '<img src="' .$produit. '" alt="'.$nom_produit_majiscule.'" width="200px" height="150px">' ?>
                
                <p style="padding-top:25px; font-size:25px; color:white;"> <?php echo $nom_produit; ?></p>
                <p> 
                    <form action="supprimer_favoir.php" method="get">
                        <input type="submit" value="supprimer" class="btn" style="background-color:#dabb74; margin-top:15px">
                        <?php echo '<input type="text" value="'.$nom_produit.'" name="nomp" hidden >' ?>
                    </form>
                </p>
            </div>

            <?php }  } ?>
                    
                
        </div>
    </div>
</body>
</html>

<?php


  //fermeture de la connexion 
    $conn->close();

?>