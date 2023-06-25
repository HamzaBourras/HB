<?php 


    /* connection */
    $servername = "localhost";
    $username = "root";

    $conn = new mysqli ($servername,$username);
        // check connection 

    if($conn->connect_error){
        die("connexion fieled");
    }

        /****  Création de base de données s'elle n'existe pas ****/
    $sql="create database IF NOT EXISTS projet_stage";
        $conn->query($sql);

        // utiliser la base de données 
    $sql="use projet_stage";
    $conn->query($sql);


        /**** Création de la table s'il n'existe pas  ****/
        $sql="create table IF NOT EXISTS inscrire ( nom varchar(20), cin varchar(20), email varchar(30), motpass varchar(15))  ";
        $conn->query($sql);

        
$set=0;   
    if(isset($_GET['nom']) && isset($_GET['cin']) && isset($_GET['email'])  && isset($_GET['password'])){
        $set=1;
    }

$nonempty=0;
    if(!empty($_GET['nom']) && !empty($_GET['cin']) && !empty($_GET['email'])  && !empty($_GET['password'])){
        $nonempty=1;
    }


        /**** enregistrer les informations ****/
    if($set==1) {

            $Nom =  $_GET['nom'];
            $Cin =  $_GET['cin'];
            $Email =  $_GET['email'];
            $Motpass =  $_GET['password'];
            
                /* vérifier si l'utilisateur n'existe pas déja */
                $existe=0;
                    $sql="select nom,cin,email,motpass from inscrire ;";
                    $client=$conn->query($sql);
                
                    if($client->num_rows > 0){
                    while($row =$client->fetch_assoc()){
                        $Nm = $row["nom"];
                        $Cn = $row["cin"];
                        $El = $row["email"];
                        $Ps = $row["motpass"];
                
                        if( $Nm==$Nom || $Cn==$Cin || $El==$Email || $Ps==$Motpass){
                            $existe=1; break;
                        }
                    }
                    }
        
        /**** Inserer les informations dans le tableau ****/
        if($nonempty==1 && $existe==0) {

    $sql="INSERT INTO inscrire (nom,cin,email,motpass) VALUES ('$Nom','$Cin','$Email','$Motpass');";                           
                 }

$true=0;
if($conn->query($sql)===true){$true=1;}

        /* affichage de la fenetre de message */       
        echo '<script>';
        echo 'function() {';
        echo '    var modal = document.getElementById("fenetre");';
        echo '    modal.style.display = "block";';
        echo '}';
        echo '</script>';

    }  
    





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <style>

        body{
            background-color:#395144;
        }

        #fenetre {
            background-color:#c8af85;
            color:red;
            font-weight: bold;
            width:800px;
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
                /* si un champ est vide */
            if($nonempty==0 ) {
                echo "veuilez remplir tous les champs !";
                echo '<script>';
                echo 'setTimeout(function (){window.history.back()},2000)';
                echo '</script>';
            } 
                /* si l'utilisateur existe déja */
            if($existe==1) {
                echo "cet utilisateur existe déja !";
                echo '<script>';
                echo 'setTimeout(function (){window.history.back()},2000)';
                echo '</script>';
            }
                /* rediction vers la page de connexion si l'inscrition est correcte */
            if($true==1 && $existe==0 ){
                echo "Inscription terminé !";
                $redicpage="connecter.html";
                header("refresh:1.5; url=" . $redicpage);
            } 
                /* s'il y a un ereur */
            if($true==0 ) {
                echo "Ereur !" . $conn->error;
                echo '<script>';
                echo 'setTimeout(function (){window.history.back()},3000)';
                echo '</script>';
            }
        ?> </p>
    </div>
    

</body>
</html>

<?php 

    // Fermeture de la connexion 
 $conn->close();
?>