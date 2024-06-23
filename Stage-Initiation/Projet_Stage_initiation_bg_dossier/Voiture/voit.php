<?php
    //commencer la ssesion
    session_start();

        $cle_session=$_SESSION['nom_utilisateur'];
        $nom = $_SESSION[$cle_session]['Nom'];

    if(isset($_SESSION[$cle_session]['connecter']) && $_SESSION[$cle_session]['connecter']!==true || !isset($_SESSION['nom_utilisateur'])){
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
    <title>Voiture</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="voit.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<body>

    <div class="container">
        <!-- NavBar -->
            <section class="navbar">
                <div class="logo"><img src="../page_principale/image/logo.png" alt="non" width="200px" height="90px"></div>
                <div class="nav">
                    <ul>
                        <a href="#ajouter"><li title="Ajouter une voiture">Ajouter</li></a>
                        <a href="afficher_voit.php"><li title="Afficher les informations de vos voitures">Afficher</li></a>
                        <a href="modifier_une_voiture/modifier_voit_1.php"><li title="Modifier les informations de vos voitures">Modifier</li></a>
                    </ul>
                </div>
            <div class="menu" id="bars"><i><ion-icon name="reorder-four-outline"></ion-icon></i></div>
            <div class="crois" id="crois"><i><ion-icon name="close-outline"></ion-icon></i></div>

            </section>

            <div class="nav1">
                <ul>    
                    <a href="#ajouter"><li title="Ajouter une voiture">Ajouter</li></a>
                    <a href="afficher_voit.php"><li title="Afficher les informations de vos voitures">Afficher</li></a>
                    <a href="modifier_une_voiture/modifier_voit_1.php"><li title="Modifier les informations de vos voitures">Modifier</li></a>

                </ul>
            </div>


        <!-- Section d'affichage d'une position -->
            <section class="maps">
                        <h1>Affichage d'une position</h1>
                        <div class="position">
                            <div class="posi">
                                <input type="text" placeholder="Entrez votre position" id="pos">
                                <button onclick="afficherposition()">Afficher</button>
                            </div>
                            <div class="carte"><iframe src="" frameborder="0" id="iframe"></iframe></div>
                        
                        </div>
            </section>

        
        <!-- Section d'ajouter une voiture -->
            <section class="Ajout" id="ajouter">
                <h1>Ajouter une voiture</h1>
                <form action="ajouter_voit.php" method="get">
                    <div class="d1">
                        <label for="n">Nom de la voiture :</label><br>
                        <input type="text" id="n" name="nomV"><br>
                        <label for="m">Matricule : </label><br>
                        <input type="text" id="m" name="matricule"><br>
                        <label for="mq">Marque : </label><br>
                        <input type="text" id="mq" name="marque"><br>
                        <label for="ml">Modèle : </label><br>
                        <input type="text" id="ml" name="modele"><br>
                    </div>

                    <div class="d2">
                        <label for="an">Année de fabrication : </label><br>
                        <input type="number" id="an" name="anneeFab"><br>
                        <label for="k">Kilométrage : </label><br>
                        <input type="number" id="k" name="kilometrage"><br>
                        <label for="c">Coleur : </label><br>
                        <input type="text" id="c" name="coleur"><br>
                        <input type="submit" value="Ajouter">
                    </div>
                </form>
            </section>
            
    </div>
    <script src="cartemaps.js"></script>
    <script src="nav1_visible.js"></script>
</body>
</html>