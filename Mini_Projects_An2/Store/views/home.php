<?php
include_once("../controllers/db.php");
include_once("../controllers/geredata.php");


$produits = getproducts();

// var_dump($produits);


?>

</pre>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanouti</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-sky-300 font-['Poppins'] w-full h-full">

    <?php include_once("header.php"); ?>

    <div class="flex justify-around my-2 ">
        <!-- Section des produits -->
        <div class="flex flex-wrap justify-around lg:w-[70%] w-[67%] bg-sky-200 rounded-md p-2">

            <!-- Parcourir tous les produits -->

            <?php foreach ($produits as $p) : ?>
                <div class=" relative bg-sky-300 w-[30%] lg:w-[27%] h-[210px] lg:h-[250px] my-2 rounded-md px-2 flex flex-col items-center justify-around">
                    <div class="cursor-pointer absolute right-[-10px] top-[-10px] w-[28px]">
                        <a href="../controllers/addToCart.php?idprod=<?= $p["id"] ?>"><img class="w-full h-full" src="../images/plus.png" alt=""></a>
                    </div>
                    <div class="lg:h-[60%] lg:w-[80%] h-[40%] w-[90%] p-2"><img src="<?= "../" . $p["image"] ?>" alt="non" class="h-[100%] w-full "></div>
                    <div class=" text-center h-1/5 flex items-center text-lg font-bold"> <?php echo $p["titre"] ?> </div>
                    <div class="flex flex-col h-1/4 mb-2  w-full items-center justify-around">
                        <div> <?php echo $p["prix"] ?> DH</div>
                        <div><a href="detail.php?id=<?= $p["id"] ?>"><button class="bg-sky-800  py-[3px] px-2  rounded-md text-white">Detail</button></a></div>
                    </div>
                </div>
            <?php endforeach ?>


        </div>

        <!-- Section du panier -->
        <div class="flex flex-col  lg:w-[28%] w-[31%] bg-sky-200 rounded-md p-2">
            <form action="../controllers/chercherPanier.php" method="post">
                <input name="nomcherch" type="text" placeholder="chercher un produit" class="shadow-lg py-2 px-1 rounded-md bg-slate-100 mb-3">
                <input class="bg-white border-2 shadow-md py-[6px] px-2 cursor-pointer rounded-md " type="submit" value="chercher">
            </form>
            <!-- Si on n' a pas chercher un produit dans le panier on travaille avec la session "cart" -->
            <?php if (isset($_SESSION["cart"]) && !isset($_SESSION["cherchercart"])) { ?>
                <div class="text-center my-1 text-lg">
                    <p>Total : <?php if(isset($_SESSION["total"] )) echo $_SESSION["total"]." DH"  ?>  </p>
                </div>
                <?php foreach ($_SESSION["cart"] as $prodPanier) : ?>
                    <div class="h-[52px] bg-sky-300 flex justify-between items-center my-2 py-1 px-2 rounded-md">
                        <p class="lg:w-[10%] w-[15%] h-8 "><img class="w-full h-full" src=<?= "../". $prodPanier["image"] ?> alt=""></p>
                        <p class="w-[50%] text-center font-bold"><?= $prodPanier["titre"] ?> </p>
                        <p class="w-3"><?= $prodPanier["quantite"] ?></p>
                        <p class="w-8 h-8 "><a href="../controllers/delete.php?idproddelete=<?= $prodPanier["id"] ?>"><img class="w-full h-full" src="../images/del.png" alt=""></a></p>
                    </div>
                <?php endforeach; ?>
            <!-- Si on a chercher un produit dans le panier on travaille avec la session "cherchercart"  --> 
            <?php }elseif (isset($_SESSION["cart"]) && isset($_SESSION["cherchercart"])) { ?>

                <div class="bg-sky-900 py-3 px-[4px] rounded-md">
                    <div class="text-end text-white text-xl pr-2 underline mb-4"><a href="../controllers/close.php">close</a></div>
                    <?php foreach ($_SESSION["cherchercart"] as $prodPanier) : ?>
                        <div class="h-[52px] bg-sky-300 flex justify-between items-center my-2 py-1 px-2 rounded-md">
                            <p class="lg:w-[10%] w-[15%] h-8 "><img class="w-full h-full" src=<?= "../" . $prodPanier["image"] ?> alt=""></p>
                            <p class="w-[50%] text-center font-bold"><?= $prodPanier["titre"] ?> </p>
                            <p class="w-3"><?= $prodPanier["quantite"] ?></p>
                            <p class="w-8 h-8 "><a href="../controllers/delete.php?idproddelete=<?= $prodPanier["id"] ?>"><img class="w-full h-full" src="../images/del.png" alt=""></a></p>
                        </div>
                <?php endforeach;
                } ?>
                </div>

        </div>
    </div>

    <?php include_once("Footer.html"); 
        unset($_SESSION["cherchercart"]);
        // unset($_SESSION["cart"]);
        // unset($_SESSION["total"]); ?>

</body>

</html>