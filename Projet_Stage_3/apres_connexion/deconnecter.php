<?php

    //commencer la session
    session_start();

    //détruire la session 
    session_destroy();

    header("location:../Connexion_Compte/connecter.html");
    exit;
?>