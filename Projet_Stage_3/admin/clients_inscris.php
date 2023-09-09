<?php


    /* connection */
    $servername = "localhost";
    $username = "root";

    $conn = new mysqli ($servername,$username);
        // check connection 

    if($conn->connect_error){
        die("connexion fieled");
    }

        //utiliser la base de données
    $sql="use projet_stage";
    $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des clients</title>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .decon {
            padding: 10px 20px;
            margin: 0px 20px;
            background-color: white;
            color: black;
            text-align: center;
            text-decoration: none;
            font-size: 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.5s ease;
        }
  
        .decon:hover {
            background-color: #ffffff00;
            border: 1px solid white;
            color: black;
        }
        
        .decon:focus {
            outline: none;
        }
    </style>
</head>
<body style="background-color:#2c4d93d3">
    <div style="display:flex; justify-content:space-between; padding:20px 20px; margin-top:30px; flex-wrap:wrap;">
        <p style="font-size: 30px;font-family: 'Diphylleia', serif;background-color: #2c4d937f;border-radius: 10px 0px;padding: 5px 10px;width: max-content;">Bonjour 
            <span style="color: white; font-size: 35px;font-weight: bold;font-family: 'Diphylleia', serif;"> M. Boubakri Hamza</span>
        </p>
        <form action="../apres_connexion/deconnecter.php">
        <input type="submit" value="Sortir de la session" class="decon" >
        </form>
    </div>
    <div class="container-fluid" >
        <h1 class="mt-2 display-4 text-white">Informations des Clients :</h1>
            <div class="table-responsive mt-5">
                <table class="table table-hover" style="text-align:center">
                    <tr class="text-white" style="font-size:25px; background-color:rgb(9, 9, 78);">
                        <th>Nom du client</th>
                        <th>CIN</th>
                        <th>E-mail</th>
                        <th>Téléphone</th>
                        <th></th>
                    </tr> 
                        <?php 
                        /* selectioner les voitures du client */
                            $sql = "select nom,cin,email,motpass,telephone from inscrire ";
                        $client_inscrit = $conn->query($sql);

                            if($client_inscrit->num_rows >0){
                                while($row = $client_inscrit->fetch_assoc()){
                                    $Nm = $row["nom"];
                                    $Cn = $row["cin"];
                                    $El = $row["email"];
                                    $Mp = $row["motpass"];
                                    $Tl = $row["telephone"];
                        ?>
                            <!-- Affichage des voitures -->
                    <tr style="font-size:20px; color:white;">
                        <td style="font-size:24px; font-weight: bold; font-family: calibri; text-align:left; padding-left:20px;">
                            <?php echo $Nm; ?>
                        </td>
                        <td> <?php echo $Cn; ?></td>
                        <td> <?php echo $El; ?></td>
                        <td> <?php echo $Tl; ?></td>
                        <td>
                            <form action="activites_client.php" method="get">
                                <?php echo '<input type="text" value="' . $Nm . '" hidden name="nom_cl">' ?>
                                <input type="submit" value="voir plus" title="voir les activités du client" class="btn btn-primary" style="font-size:20px">
                            </form>
                        </td>
                    </tr>
                        <?php
                                }
                            }
                            //fermeture de connexion
                                $conn->close();
                        ?>
                    
                </table>
            </div>
    </div>
</body>
</html>