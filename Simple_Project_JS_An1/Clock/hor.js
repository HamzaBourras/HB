 
   

function setTime(){
   const NOV= new Date();

   trans = `translate(-50%, -100%)`;

   const H = NOV.getHours();
   const HDeg = (H/12) * 360;
   const HHand = document.querySelector('.hour-hand');
   HHand.style.transform = trans + `rotate(${HDeg}deg)`;

   const M = NOV.getMinutes();
   const MDeg = (M/60) * 360;
   const MHand = document.querySelector('.minute-hand');
   MHand.style.transform = trans + `rotate(${MDeg}deg)`;

   const S = NOV.getSeconds();
   const SDeg = (S/60) * 360;
   const SHand = document.querySelector('.second-hand');
   SHand.style.transform = trans + `rotate(${SDeg}deg)`;
}

setInterval(setTime, 1000);

   

