<?php //commencer la ssesion
    session_start();

    $cle_session=$_SESSION['nom_utilisateur'];
    $nom = $_SESSION[$cle_session]['Nom'];

    if(isset($_SESSION[$cle_session]['connecter']) && $_SESSION[$cle_session]['connecter']!==true){
        //rediriger vers la page de connexion pour se connecter
        header("location:../Connexion_Compte/connecter.html");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apres_Connexion</title>
    <link rel="stylesheet" href="aprescon.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<body>
    <section class="first_section" id="acceuil">
        <div class="logo"><img src="../page_principale/image/logo.png" alt="non trouvé" width="180px" height="120px"></div>
        <p>Bonjour <span> <?php  //affichage du nom
                                echo $nom;   
                          ?> </span> </p>

        <div class="Div">
            <form action="deconnecter.php" method="get">
                <input type="submit" class="decon" value="Deconnecter">
            </form>
        </div>
    </section>

    <div class="container">
       <div class="glob">
            <div class="voiture">
                <a href="../Voiture/voit.html">
                    <img src="image/Nissan-Car-Background-PNG-Image.png" alt="">
                    <p>Voiture</p>
                </a>
            </div>
            <div class="produit">
                <a href="../Produit/prod.html">
                    <img src="image/teltonika-fmb920-500x500-1.avif" alt="non">
                    <p>Produit</p>
                </a>
            </div>
       </div>
    </div>
</body>
</html>