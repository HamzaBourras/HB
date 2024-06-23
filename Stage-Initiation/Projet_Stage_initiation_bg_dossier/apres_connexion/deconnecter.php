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

    //détruire la session 
    session_destroy();

    header("location:../Connexion_Compte/connecter.html");
    exit;
?>