    /* recupurer le div container des divs des aides  */
var divglob = document.querySelector('.AIDE');
    /* recuperer le div des buttons */
var divbutton = document.querySelector('.pass');
    /* recuperer les divs des aides */
var divad=document.querySelectorAll(".ad");


divad[0].style.display = "block";

var a=0;
var b=0;

    /***** changer le contenu sans les buttons *****/

function passer() {
        for (let i = 0; i < divad.length; i++) {
            if(divad[i].style.display == "block"){
            a=i;

        }

    }
        if(a==divad.length-1){
            b=0
        }
        else{
            b=a+1;
        }

        divad[b].style.cssText = `animation: anim_afficher_ad 1s;  display:block;`
        divad[a].style.display = "none";
}

I = setInterval(passer, 5000);  




    /*****  changer le contenu avec les buttons *****/

// afficher le div .pass lorsque le cursor entre
function afficher_div_button(){
    divbutton.style.display = "flex";
}

    /* recuperer les buttons */
var buttonsup=document.getElementById("sp");
var buttoninf=document.getElementById("if");


var a=0;
var b=0;

    /* suivant div */
buttonsup.addEventListener('click',()=>{
    clearInterval(I); // arreter le changment automatique des divs aide
    
        // commencer le changement automatique si le button n'est pas cliqué après 20 secondes 
    setTimeout(() => {
        I = setInterval(passer,5000);
    }, 10000);


    for (let i = 0; i < divad.length; i++) {
        if(divad[i].style.display == "block"){
            a=i;

        }

    }
        if(a==divad.length-1){
            b=0
        }
        else{
            b=a+1;
        }

        divad[b].style.cssText = `animation: anim_afficher_ad 1s;  display:block;`
        divad[a].style.display = "none";
})

    /* precedent div */
buttoninf.addEventListener('click',()=>{
    clearInterval(I); // arreter le changment automatique des divs aide
    
        // commencer le changement automatique si le button n'est pas cliqué après 20 secondes 
    setTimeout(() => {
        I = setInterval(passer,5000);
    }, 10000);


    for (let i = 0; i < divad.length; i++) {
        if(divad[i].style.display == "block"){
            a=i;
            break;
        }

    }

        if(a==0){
            b=divad.length-1
        }
        else{
            b=a-1
        }
        divad[b].style.cssText = `animation: anim_afficher_ad 1s;  display:block;`
        divad[a].style.display = "none";
            
})





