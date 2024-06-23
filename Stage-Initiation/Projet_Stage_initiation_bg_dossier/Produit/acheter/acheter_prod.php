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

    /* création du tableau */
    $sql="create table if not EXISTS produit_achetée (nom_utilisateur varchar (20),nom_produit varchar (30), date_achat datetime);";
    $conn->query($sql);
    


             /* affichage de la fenetre de message */       
        echo '<script>';
        echo 'function() {';
        echo '    var modal = document.getElementById("fenetre");';
        echo '    modal.style.display = "block";';
        echo '}';
        echo '</script>';


        
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de voiture</title>

    <style>
        body{
            background-image: url(../../bg_image/bg-7.jpg);
            background-size: 100% 100%;
            background-attachment: fixed;
        }

        #fenetre {
            color:white;
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
        <p> <?php 

    $nonempty=0;
    if(!empty($_GET['produit_acht'])){$nonempty=1;}

if(isset($_GET['produit_acht']) ){
        /* recevoir le nom du produit */
    $nom_produit = $_GET['produit_acht'];
        /* recevoir la date actuelle */
    $dateHeure = date("Y-m-d H:i:s");
    
        $true=0;

        if($nonempty==1){
    foreach ($nom_produit as $p) {
        $sql="insert into produit_achetée (nom_utilisateur,nom_produit,date_achat) values ('$nom_utili','$p','$dateHeure');";

        if($conn->query($sql)===true){$true=$true+1;}
                        }
                    }       

                if($true==count($nom_produit) && $nonempty==1){
                    header("location:../prod.php");
                }
                if($true!=count($nom_produit) && $nonempty==1){
                    echo "ereur!" . $conn->error;
                    echo '<script>';
                    echo 'setTimeout(function (){window.history.back()},3000)';
                    echo '</script>';
                }
}
    /* s'il n'a pas achetée aucun produit */
if($nonempty==0 || isset($_GET['produit_acht'])===false){
    echo "Veuillez sélectionner un produit";
    echo '<script>';
    echo 'setTimeout(function (){window.history.back()},2500)';
    echo '</script>';
}
        ?> </p>
    </div>
</body>
</html>

<?php

    //fermeture de connexion
        $conn->close();

?>