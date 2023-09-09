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

    /* création du tableau */
    $sql="create table if not EXISTS favoir (nom_utilisateur varchar (20),nom_prod varchar (30));";
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
            background-color:white;
        }

        #fenetre {
            background-color:#94b6ff4c;
            color:red;
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
    if(!empty($_GET['produit_fav'])){$nonempty=1;}

if(isset($_GET['produit_fav']) ){
        /* recevoir le nom du produit */
    $nom = $_GET['produit_fav'];
    
        $true=0;
        if($nonempty==1){
    foreach ($nom as $n) {
        $sql="insert into favoir (nom_utilisateur,nom_prod) values ('$nom_utili','$n');";

        if($conn->query($sql)===true){$true=1;}
                        }
                    }       

                if($true==1 && $nonempty==1){
                    header("location:../prod.html");
                }
                if($true==0 && $nonempty==1){
                    echo "ereur!" . $conn->error;
                    echo '<script>';
                    echo 'setTimeout(function (){window.history.back()},3000)';
                    echo '</script>';
                }
}
    /* s'il n'a pas séléctioner aucun produit */

if($nonempty==0 || isset($_GET['produit_fav'])===false){
    echo "Veuillez sélectioner un produit";
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