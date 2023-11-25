
let fahran_input = document.querySelector('#fahr');
let celsius_input = document.querySelector('#cels');

let fahran_value;
let celsius_value;

let number;

fahran_input.addEventListener('input',()=>{
    fahran_value = parseFloat(fahran_input.value);

    if(fahran_input.value == ''){
        fahran_input.parentNode.style.cssText = "background-color:inherit";
        celsius_input.parentNode.style.cssText = "background-color:inherit";
        celsius_input.value = "";
    }
   
   if(!isNaN(fahran_value)) {
        celsius_value= (fahran_value-32)*(5/9);
        celsius_input.value = celsius_value;   
   }
   
    if(fahran_input.value != '' && isNaN(fahran_value)){
        fahran_input.parentNode.style.cssText = "background-color:red";
        celsius_input.parentNode.style.cssText = "background-color:red";
        celsius_input.value = "";
    }

   
    
})

celsius_input.addEventListener('input',()=>{
    celsius_value = parseFloat(celsius_input.value);
   

    if(celsius_input.value == ''){
        fahran_input.parentNode.style.cssText = "background-color:inherit";
        celsius_input.parentNode.style.cssText = "background-color:inherit";
        fahran_input.value = "";
    }
   
   if(!isNaN(celsius_value)) {
        fahran_value= 32+celsius_value*(9/5);
        fahran_input.value = fahran_value;   
   }
   
    if(celsius_input.value != '' && isNaN(celsius_value)){
        fahran_input.parentNode.style.cssText = "background-color:red";
        celsius_input.parentNode.style.cssText = "background-color:red";
        fahran_input.value = "";
    }

   
    
})




