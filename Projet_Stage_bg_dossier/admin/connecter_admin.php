<?php

    /* commancer une ssesion */
    session_start();


    if(isset($_GET['nom']) && !empty($_GET['nom']) && isset($_GET['motpass']) && !empty($_GET['motpass'])){

        $Nom = $_GET['nom'];
        $Motpass = $_GET['motpass'];


        if($Nom=="Hamza Boubakri" && $Motpass=="HamzaBk09"){
            $_SESSION['admin']=$Nom;
            header("location:clients_inscris.php");

            $_SESSION['HamzaBk']=true ;
            
        }
        else{
            echo '<script>';
            echo ' function() {';
            echo '    var modal = document.getElementById("fenetre");';
            echo '    modal.style.display = "block";';
            echo '}';
            echo '</script>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion admin</title>

    <style>

        body{
            background-image: url(../bg_image/bg_admin.jpg);
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
        <p> <?php echo "Vous êtes pas un admin";
            echo '<script>';
            echo 'setTimeout(function (){window.history.back()},2000)';
            echo '</script>';
            ?> </p>
    </div>
</body>
</html>