 function INPT(){

 let VA = document.getElementById("INP").value;
 let VAS = document.getElementById("ADD");
 let NEWTAS = document.createElement('li');
 NEWTAS.classList.add('LI');
 NEWTAS.textContent = VA ;

 VAS.append(NEWTAS);

  let SUP = document.createElement('input');
  SUP.setAttribute('value','-');
  SUP.setAttribute('type','button');

  SUP.setAttribute('class','hgu');
  
  let k=0;
  SUP.addEventListener('click',()=>{
    //  NEWTAS.style.textDecoration = "line-through"
    if(k==0){
      NEWTAS.style.textDecoration = "line-through";
      k=k+1;
      SUP.value = "X";
    }
    else{
      NEWTAS.remove();
      
    }
  });

  NEWTAS.append(SUP);

 }