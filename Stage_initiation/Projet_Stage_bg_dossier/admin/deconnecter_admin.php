<?php

    //commencer la session
    session_start();

    /** redirection vers la page de connexion s'il n'est pas connecter **/
    session_start();

    if($_SESSION['HamzaBk']!=true){
        header("location:connecter_admin.html");
        exit;
    }

    //détruire la session 
    session_destroy();

    header("location:connecter_admin.html");
    exit;
?>