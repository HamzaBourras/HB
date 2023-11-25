var nav = document.querySelector('.nav1');
var bars = document.getElementById('bars');
var crois = document.getElementById('crois');

nav.style.cssText = `display : none;`;

 bars.addEventListener('click',()=>{
   
   nav.style.cssText = `display : block;`;
   crois.style.cssText = `display: block;`;
   bars.style.cssText = `display : none;`;
 });

 crois.addEventListener('click',()=>{
   nav.style.cssText = `display : none;`;
   crois.style.cssText = `display : none;`;
   bars.style.cssText = `display : block;`;
 });


 

 function verifierLargeurEcran() {

  let largeurEcran = window.innerWidth;
  
  if (largeurEcran > 900) {
    bars.style.cssText = `display : none;`
    crois.style.cssText = `display : none;`
  }

  if (largeurEcran <= 900) {
    bars.style.cssText = `display : block;`
    nav.style.cssText = `display : none;`
    crois.style.cssText = `display : none`
}
}


window.addEventListener('resize', verifierLargeurEcran);