<?php  
        /* commancer une ssesion */
    session_start();


    /* connection */
    $servername = "localhost";
    $username = "root";

    $conn = new mysqli ($servername,$username);
        // check connection 

    if($conn->connect_error){
        die("connexion fieled");
    }

        // utiliser la base de données 
    $sql="use projet_stage";
    $conn->query($sql);

    if(isset($_GET['nom']) && isset($_GET['nvpass']) && isset($_GET['confrpass'])){
        
            if($_GET['confrpass']==$_GET['nvpass']){
                    $novmotpass=$_GET['nvpass'];
                    $nomutilisateur=$_GET['nom'];
                $sql="UPDATE inscrire set motpass='$novmotpass' where `nom`='$nomutilisateur'";
            }

            /* affichage de la fenetre de message */       
            echo '<script>';
            echo 'function() {';
            echo '    var modal = document.getElementById("fenetre");';
            echo '    modal.style.display = "block";';
            echo '}';
            echo '</script>';
        
    $true=0;
    if($conn->query($sql)===true){
        $true=1;
    }        
            

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation de la modification</title>

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
            <p>
                <?php

                if($true==1 && !empty($_GET['nom']) && !empty($_GET['nvpass']) && !empty($_GET['confrpass'])    ){
                    sleep(1);
                    header("location:connecter.html");
                }

                else{
                    echo "un ereur s'est produit, veuillez réssayer";
                    echo '<script>';
                    echo 'setTimeout(function (){window.history.back()},2000)';
                    echo '</script>';
                }

                ?>
            </p>

        </div>
</body>
</html>

<?php
    }
    $conn->close();

?>