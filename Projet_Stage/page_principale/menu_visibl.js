var nav = document.querySelector('.nav1');

 function afficher(){
    nav.style.cssText = `visibility : visible;`
    console.log(1);
    nav.addEventListener('onmouseenter',()=>{
      afficher();
    });
 }

 function supprimer(){
    nav.style.cssText = "visibility: hidden;"
 }

