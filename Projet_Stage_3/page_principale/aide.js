
var buttonsup=document.getElementById("sp");
var buttoninf=document.getElementById("if");

var divad=document.querySelectorAll(".ad");


divad[0].style.display = "block";

buttonsup.addEventListener('click',()=>{
    for (let i = 0; i < divad.length; i++) {
        if(divad[i].style.display == "block"){
            a=i;
            break;
        }

    }
        b=a+1;
        divad[b].style.display = "block";
        divad[a].style.display = "none";
})

buttoninf.addEventListener('click',()=>{
    for (let i = 0; i < divad.length; i++) {
        if(divad[i].style.display == "block"){
            a=i;
            break;
        }

    }
        b=a-1;
        divad[b].style.display = "block";
        divad[a].style.display = "none";
})
    






