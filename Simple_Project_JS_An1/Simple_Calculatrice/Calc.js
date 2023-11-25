
function Calcule (){
  let R = 0 ;

let A = document.getElementById('a').value;
let B = document.getElementById('b').value;
let P = document.getElementById('op').value;


   let x = Number(A);
   let y = Number(B);

   switch(P){
    case '+' : R = x+y ;break;
    case '-' : R = x-y ;break;
    case '*' : R = x*y ;break;
    case '/' : R = x/y ;break;
    case '%' : R = x%y ;break;
    default : R = "Ereur!! l'opérateur n'éxiste pas" ;break;

  }


  let VA = document.getElementById('ID');

  let NEW = document.createElement('span');

  NEW.textContent = R ;

  VA.append(NEW);
  
}


 

