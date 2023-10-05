
var nav1 = document.getElementById('nav1');
var bars = document.getElementById('bars');
var crois = document.getElementById('crois');



// bars.style.visibility ="hidden";

 bars.addEventListener('click',()=>{
   nav1.style.cssText = `visibility : visible;`;
   crois.style.cssText = `visibility : visible;`;
   bars.style.cssText = `visibility : hidden;`;
 });

 crois.addEventListener('click',()=>{
   nav1.style.cssText = `visibility : hidden;`;
   crois.style.cssText = `visibility : hidden;`;
   bars.style.cssText = `visibility : visible;`;
 });


 function verifierLargeurEcran() {

  let largeurEcran = window.innerWidth;
  
  if (largeurEcran > 1355) {
    bars.style.cssText = `display : none;`
    crois.style.cssText = `display : none;`
    nav1.style.cssText = `display : none;`
  }

  if (largeurEcran <= 1355) {
    bars.style.cssText = `display : flex;`
    nav1.style.cssText = `display : none;`
    crois.style.cssText = `display : none`
}
}


window.addEventListener('resize', verifierLargeurEcran);

