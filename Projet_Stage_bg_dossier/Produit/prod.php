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
    <title>Produit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="produt.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<body>
    <div class="container">
        <!-- Navbar -->
        <section class="navbar">
            <div class="logo"><img src="../page_principale/image/logo.png" alt="non trouvé" width="200px" height="90px"></div>
            <div class="nav">
                <ul>
                    <a href="favoir/afficher_favoir.php" title="afficher les favoirs"><li><i class="fa-sharp fa-solid fa-star"></i></li></a>
                    <a href="acheter/afficher_prod_achetée.php" title="afficher l'historique des achats"><li><i class="fa-solid fa-cart-shopping"></i></li></a>
                    <!-- <a href="../Contactez_nous/cont.html" title="contactez-nous"><li><i class="fa-sharp fa-solid fa-message"></i></li></a> -->
                </ul>
            </div>
        </section>

        <!-- Produits -->
        <section class="produits">
            <form action="acheter/acheter_prod.php" method="get">
                
                <div class="buttons" style="margin-bottom: 20px; flex-wrap: wrap;">
                    <input type="submit" value="Ajouter au panier">
                    <input type="submit" formaction="favoir/ajouter_favoir.php" value="Ajouter au favoirs">
                </div>


                <div class="prod1">
                    <div class="achat">
                        <img src="produit_photos/FMB120" alt="">
                        <div class="nom">
                            <p>FMB120</p>
                            
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter3" name="produit_acht[]" value="FMB120" hidden>
                            <label for="acheter3">acheter</label>
                        </div>

                        <p>
                            <!-- pour l'ajouter au favoirs -->
                        <input type="checkbox" id="checkbox3" name="produit_fav[]" value="FMB120" hidden>
                        <label for="checkbox3">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    
                    <div class="achat">
                        <img src="produit_photos/FMB130" alt="">
                        <div class="nom">
                            <p>FMB130</p>
                            
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter4" name="produit_acht[]" value="FMB130" hidden>
                            <label for="acheter4">acheter</label>
                        </div>

                        <p>
                            <!-- pour l'ajouter au favoirs -->
                        <input type="checkbox" id="checkbox4" name="produit_fav[]" value="FMB130" hidden>
                        <label for="checkbox4">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    <div class="achat">
                        <img src="produit_photos/FMB140" alt="">
                        <div class="nom">
                            <p>FMB140</p>
                            
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter5" name="produit_acht[]" value="FMB140" hidden>
                            <label for="acheter5">acheter</label>
                        </div>

                        <p>
                            <!-- pour l'ajouter au favoirs -->
                        <input type="checkbox" id="checkbox5" name="produit_fav[]" value="FMB140" hidden>
                        <label for="checkbox5">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    <div class="achat">
                        <img src="produit_photos/FMB640" alt="">
                        <div class="nom">
                            <p>FMB640</p>
                            
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter6" name="produit_acht[]" value="FMB640" hidden>
                            <label for="acheter6">acheter</label>
                        </div>

                        <p>
                            <!-- pour l'ajouter au favoirs -->
                        <input type="checkbox" id="checkbox6" name="produit_fav[]" value="FMB640" hidden>
                        <label for="checkbox6">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    
               </div>
               


                <div class="prod2">
                    <div class="achat">
                        <img src="produit_photos/FMB920" alt="">
                        <div class="nom">
                            <p>FMB920</p>
                            
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter7" name="produit_acht[]" value="FMB920" hidden>
                            <label for="acheter7">acheter</label>
                        </div>

                        <p>
                            <!-- pour l'ajouter au favoirs -->
                        <input type="checkbox" id="checkbox7" name="produit_fav[]" value="FMB920" hidden>
                        <label for="checkbox7">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    
                    <div class="achat">
                        <img src="produit_photos/ALL_CAN_300" alt="">
                        <div class="nom">
                            <p>ALL CAN 300</p>
                            
                        </div>
                        
                        <div class="acheter">
                            <input type="checkbox" id="acheter1" name="produit_acht[]" value="ALL_CAN_300" hidden>
                            <label for="acheter1">acheter</label>
                        </div>

                        <p>
                            <!-- pour l'ajouter au favoirs -->
                            <input type="checkbox" id="checkbox1" name="produit_fav[]" value="ALL_CAN_300" hidden>
                            <label for="checkbox1">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    <div class="achat">
                        <img src="produit_photos/LV_CAN200" alt="">
                        <div class="nom">
                            <p>LV CAN200</p>
                            
                        </div>
                        
                        <div class="acheter">
                            <input type="checkbox" id="acheter13" name="produit_acht[]" value="LV_CAN200" hidden>
                            <label for="acheter13">acheter</label>
                        </div>
    
                        <p>
                            <!-- pour l'ajouter au favoirs -->
                            <input type="checkbox" id="checkbox13" name="produit_fav[]" value="LV_CAN200" hidden>
                            <label for="checkbox13">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    <div class="achat">
                        <img src="produit_photos/IGNITION_BLOCK_RELAY.png" alt="">
                        <div class="nom">
                            <p>IGNITION BLOCK RELAY</p>
                    
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter10" name="produit_acht[]" value="IGNITION_BLOCK_RELAY" hidden>
                            <label for="acheter10">acheter</label>
                        </div>
    
                        <p>
                            <!-- pour l'ajouter au favoirs -->
                            <input type="checkbox" id="checkbox10" name="produit_fav[]" value="IGNITION_BLOCK_RELAY" hidden>
                            <label for="checkbox10">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    
                    
                </div>


                <div class="prod3">
                    <div class="achat">
                        <img src="produit_photos/FM_PRO4.png" alt="">
                        <div class="nom">
                            <p>FM PRO4</p>
                    
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter2" name="produit_acht[]" value="FM_PRO4" hidden>
                            <label for="acheter2">acheter</label>
                        </div>

                        <p>
                            <!-- pour l'ajouter au favoirs -->
                            <input type="checkbox" id="checkbox2" name="produit_fav[]" value="FM_PRO4" hidden>
                            <label for="checkbox2">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    <div class="achat">
                        <img src="produit_photos/PRO5.png" alt="">
                        <div class="nom">
                            <p>PRO5</p>
                    
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter14" name="produit_acht[]" value="PRO5" hidden>
                            <label for="acheter14">acheter</label>
                        </div>
    
                        <p>
                            <!-- pour l'ajouter au favoirs -->
                            <input type="checkbox" id="checkbox14" name="produit_fav[]" value="PRO5" hidden>
                            <label for="checkbox14">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    <div class="achat">
                        <img src="produit_photos/HCV5.png" alt="">
                        <div class="nom">
                            <p>HCV5</p>
                            
                        </div>
                        
                        <div class="acheter">
                            <input type="checkbox" id="acheter9" name="produit_acht[]" value="HCV5" hidden>
                            <label for="acheter9">acheter</label>
                        </div>
    
                        <p>
                            <!-- pour l'ajouter au favoirs -->
                            <input type="checkbox" id="checkbox9" name="produit_fav[]" value="HCV5" hidden>
                            <label for="checkbox9">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    <div class="achat">
                        <img src="produit_photos/LCV5.png" alt="">
                        <div class="nom">
                            <p>LCV5</p>
                            
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter11" name="produit_acht[]" value="LCV5" hidden>
                            <label for="acheter11">acheter</label>
                        </div>
    
                        <p>
                            <!-- pour l'ajouter au favoirs -->
                        <input type="checkbox" id="checkbox11" name="produit_fav[]" value="LCV5" hidden>
                        <label for="checkbox11">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    
                    
                </div>


                
                <div class="prod4">
                    
                    <div class="achat">
                        <img src="produit_photos/TRACE5.png" alt="">
                        <div class="nom">
                            <p>TRACE5</p>
                            
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter15" name="produit_acht[]" value="TRACE5" hidden>
                            <label for="acheter15">acheter</label>
                        </div>
    
                        <p>
                            <!-- pour l'ajouter au favoirs -->
                        <input type="checkbox" id="checkbox15" name="produit_fav[]" value="TRACE5" hidden>
                        <label for="checkbox15">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    <div class="achat">
                        <img src="produit_photos/LIGO_FUEL_SENSOR" alt="">
                        <div class="nom">
                            <p>LIGO FUEL SENSOR</p>
                            
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter12" name="produit_acht[]" value="LIGO_FUEL_SENSOR" hidden>
                            <label for="acheter12">acheter</label>
                        </div>
    
                        <p>
                            <!-- pour l'ajouter au favoirs -->
                        <input type="checkbox" id="checkbox12" name="produit_fav[]" value="LIGO_FUEL_SENSOR" hidden>
                        <label for="checkbox12">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                    <div class="achat">
                        <img src="produit_photos/FUEL_LEVEL_SENSOR.png" alt="">
                        <div class="nom">
                            <p>FUEL LEVEL SENSOR</p>
                        </div>

                        <div class="acheter">
                            <input type="checkbox" id="acheter8" name="produit_acht[]" value="FUEL_LEVEL_SENSOR" hidden>
                            <label for="acheter8">acheter</label>
                        </div>
                            
                        <p>
                                <!-- pour l'ajouter au favoirs -->
                            <input type="checkbox" id="checkbox8" name="produit_fav[]" value="FUEL_LEVEL_SENSOR" hidden>
                            <label for="checkbox8">
                                <i class="fa-regular fa-star" id="ID1"></i>
                            </label>
                            <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                          
                        </p>
                    </div>
                    <div class="achat">
                        <img src="produit_photos/WIRELESS_FUEL_LEVEL_SENSOR.png" alt="">
                        <div class="nom">
                            <p>WIRELESS FUEL LEVEL SENSOR</p>
                            
                        </div>
                    
                        <div class="acheter">
                            <input type="checkbox" id="acheter16" name="produit_acht[]" value="WIRELESS_FUEL_LEVEL_SENSOR" hidden>
                            <label for="acheter16">acheter</label>
                        </div>
    
                        <p>
                            <!-- pour l'ajouter au favoirs -->
                        <input type="checkbox" id="checkbox16" name="produit_fav[]" value="WIRELESS_FUEL_LEVEL_SENSOR" hidden>
                        <label for="checkbox16">
                            <i class="fa-regular fa-star" id="ID1"></i>
                        </label>
                        <i class="fa-sharp fa-solid fa-star" style="visibility: hidden;" id="ID2"></i>
                      
                    </p>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <script src="acheter/acheter.js"></script>
    <script src="favoir/favoiret.js"></script>
        
    
</body>
</html>