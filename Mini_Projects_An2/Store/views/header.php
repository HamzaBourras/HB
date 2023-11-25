
<?php
        if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
?>

<div class=" flex justify-between items-center bg-sky-800 py-6 pl-2">
        <a href="home.php"><h1 class="text-4xl text-white">Store
                
        </h1></a>
        <div>
             <?php if(!isset($_SESSION["user"])) { ?>
                <a href="register.php" class="mr-6 py-1 px-2 text-xl text-white pointer rounded-md border-2 border-white hover:bg-white hover:text-black transition delay-150">Register</a>
                <a href="login.php" class="mr-6 py-1 px-2 text-xl text-white pointer rounded-md border-2 border-white hover:bg-white hover:text-black transition delay-150">Login</a>
             <?php } else { ?>
                <?php if($_SERVER["REQUEST_URI"] != "/TPs_Web/TP04_JsonCsv_Hanouti/EX2_Hanouti_Db/views/ajouterProduit.php") { ?>
                        <a href="ajouterProduit.php" class="mr-6 py-1 px-2 text-xl text-white pointer rounded-md border-2 border-white hover:bg-white hover:text-black transition delay-150">Ajouter produit</a>
                <?php } ?>
                <a href="../controllers/logout.php" class="mr-6 py-1 px-2 text-xl text-white pointer rounded-md border-2 border-white hover:bg-white hover:text-black transition delay-150">Logout</a>
             <?php } ?>
        </div>
</div>