
 var btnvoiture = document.getElementById('voiture');
 var btnproduit = document.getElementById('produit');
 var glob = document.getElementById('glob');

 var Imagesdiv = document.getElementById('IMAGES');
 var bgproduit = document.getElementById('pr');
 var bgvoiture = document.getElementById('vt');



 btnvoiture.addEventListener('click',()=>{

    glob.style.display =" none";

    bgvoiture.style.cssText = `
        display: block;

        animation-delay: 0.2s;
        animation: btnanim 0.5s;
        animation-fill-mode: forwards;
    `
    var redicpage2 ="../Voiture/voit.php";
            setTimeout(function() {window.location.href = redicpage2;}, 450);

 })

 btnproduit.addEventListener('click',()=>{

    glob.style.display =" none";

    bgproduit.style.cssText = `
        display: block;

        animation-delay: 0.2s;
        animation: btnanim 0.5s;
        animation-fill-mode: forwards;
    `
    var redicpage1 ="../Produit/prod.php";
        setTimeout(function() {window.location.href = redicpage1;}, 450);
 })



