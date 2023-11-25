<?php 
    include_once("../controllers/geredata.php");
$allProduits = getproducts();

$product = array_filter($allProduits, function ($p) {
    return $p["id"] == $_GET["id"];
});
foreach ($product as $p) {
    $product=$p;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-300 font-['Poppins'] w-full h-full">
    <?php include_once("header.php"); ?>
    <h1 class="text-4xl mt-4 ml-4">Description du <span class="text-4xl font bold"><?php echo $product["titre"] ?> </span> : </h1>
    <div class=" p-5  absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/4 w-[70%] text-center">
        <div class="mt-2 text-left text-xl bg-sky-500 p-4 text-white">
            <?php echo $product["detail"] ?>
        </div>
    </div>

    <?php include_once("footer.html"); ?>

</body>
</html>