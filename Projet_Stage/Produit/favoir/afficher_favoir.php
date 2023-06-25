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

  // selectioner les produits favoirs :
    $sql="select DISTINCT nom_utilisateur,nom_prod from favoir where `nom_utilisateur`='$nom_utili'";
    $client=$conn->query($sql);

       if($client->num_rows >0){
            while($row=$client->fetch_assoc()){
                $nom_produit = $row["nom_prod"];

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <p> <?php echo $nom_produit; ?></p>
    </div>
</body>
</html>

<?php
            }
       }



  //fermeture de la connexion 
    $conn->close();

?>