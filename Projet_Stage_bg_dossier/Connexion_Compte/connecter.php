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

    if(isset($_GET['nom']) && isset($_GET['motpass'])) {
        $Nom = $_GET['nom'];
        $Mptpass = $_GET['motpass'];

        if(!empty($_GET['nom']) && !empty($_GET['motpass'])){
        
                /* vérifier est ce que le mot de passe est coorect */
            $sql="select motpass from inscrire where `nom`='$Nom';";
            $client=$conn->query($sql);
            
                if($client->num_rows > 0){
                while($row =$client->fetch_assoc()){
                    $Ps = $row["motpass"];
            if($Mptpass==$Ps){
                /* concerver le nom du client */
                $_SESSION['nom_utilisateur']=$Nom . "1";
                $_SESSION[$Nom . "1"] = array(
                        'Nom' => $Nom,
                        'connecter' => true
                );
                header("location:../apres_connexion/aprescon.php");
                
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
        }
    }

}
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>

        body{
            background-image: url(../bg_image/bg-4.jpg);
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
                /* si le mot de passe ou le nom est incorecte */
            echo "le nom d'utilisateur ou le mot de passe est incorrect !";
            echo '<script>';
            echo 'setTimeout(function (){window.history.back()},2500)';
            echo '</script>';
        ?> </p>
    </div>
</body>
</html>

<?php 
// Fermeture de la connexion 
$conn->close();
?>
