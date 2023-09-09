<?php //commencer la ssesion
    session_start();

        $cle_session=$_SESSION['nom_utilisateur'];
        $nom = $_SESSION[$cle_session]['Nom'];
    

    if(isset($_SESSION[$cle_session]['connecter']) && $_SESSION[$cle_session]['connecter']!==true || !isset($_SESSION['nom_utilisateur'])){
        //rediriger vers la page de connexion pour se connecter
        header("location:../Connexion_Compte/connecter.html");
        exit;
    }

     /* connection */
     $servername = "localhost";
     $username = "root";
 
     $conn = new mysqli ($servername,$username);
         // check connection 

         // utiliser la base de données
     if($conn->connect_error){
         die("connexion fieled");
     }
        
     $sql="use projet_stage";
    $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apres Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="aprescon.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<body>
    <section class="first_section" id="acceuil">
        <div class="profil"><img src="image/avatar_profil.png" alt="non trouvé" width="80px" height="80px" id="profil"></div>
        <p>Bonjour <span><?php  //affichage du nom
                                echo $nom;   
                          ?> </span> </p>
        <?php
            $sql="select nom,cin,email,motpass,telephone from inscrire where `nom`='$nom' ;";
            $client=$conn->query($sql);
        
            if($client->num_rows > 0){
            while($row =$client->fetch_assoc()){
                $Cn = $row["cin"];
                $El = $row["email"];
                $Ps = $row["motpass"];
                $Tl = $row["telephone"];
        ?>
        <div class="informations_profil" id="infor">
            <div class="crois"><i class="fa-solid fa-xmark" id="crois"></i></div>
            <label for="n">Nom d'utilisateur :</label><br>
            <?php echo '<input type="text" id="n" value="' . $nom . '" readonly><br>' ?>
            <label for="m">Mot de passe :</label><br>
            <?php echo '<input type="text" id="m" value="' . $Ps . '"  readonly><br>' ?>
            <label for="c">CIN :</label><br>
            <?php echo '<input type="text" id="c" value="' . $Cn . '"  readonly><br>' ?>
            <label for="e">Email :</label><br>
            <?php echo '<input type="text" id="e" value="' . $El . '"  readonly><br>' ?>
            <label for="t">Téléphone :</label><br>
            <?php echo '<input type="text" id="t" value="' . $Tl . '"  readonly><br>' ?>
        </div>

        <?php } } ?>
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
                    <p>Voitures</p>
                </a>
            </div>
            <div class="produit">
                <a href="../Produit/prod.html">
                    <img src="image/teltonika-fmb920-500x500-1.avif" alt="non">
                    <p>Produits</p>
                </a>
            </div>
       </div>
    </div>

        <!-- Pour l'affichage des informations du profil -->
    <script>
        let imageprofil=document.getElementById('profil');
        let informations_profil=document.getElementById('infor');
        let crois=document.getElementById('crois');


        imageprofil.addEventListener('click',()=>{
            informations_profil.style.visibility="visible";
        });
        crois.addEventListener('click',()=>{
            informations_profil.style.visibility="hidden";
        });

    </script>
</body>
</html>