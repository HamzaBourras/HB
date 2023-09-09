
var nav1 = document.getElementById('nav1');
var bars = document.getElementById('bars');
var crois = document.getElementById('crois');


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

