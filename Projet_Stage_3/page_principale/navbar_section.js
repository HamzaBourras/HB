var presentation = document.querySelectorAll("#pres");
var services = document.querySelectorAll('#serv');
var apropos = document.querySelectorAll('#prop');
var contact = document.querySelectorAll('#conta');


var sectionserv = document.getElementById("service");
var sectionprop = document.getElementById("apropos");
var sectioncont = document.getElementById("contact");

var nav = document.getElementById('nav');




presentation[0].addEventListener('click',()=>{
    sectionserv.style.display = "none";
    sectionprop.style.display = "none";
    sectioncont.style.display = "none";

    apropos[0].style.borderBottom = " none";
    apropos[0].style.color="rgba(255, 255, 255, 0.689)";
    services[0].style.borderBottom = "none";
    services[0].style.color="rgba(255, 255, 255, 0.689)";
    presentation[0].style.borderBottom = " 2px solid white";
    presentation[0].style.color="white";
    contact[0].style.borderBottom = "none";
    contact[0].style.color="rgba(255, 255, 255, 0.689)";
})

services[0].addEventListener('click',()=>{
    sectionserv.style.display = "block";
    sectionprop.style.display = "none";
    sectioncont.style.display = "none";

    presentation[0].style.borderBottom = " none";
    presentation[0].style.color="rgba(255, 255, 255, 0.689)";
    apropos[0].style.borderBottom = " none";
    apropos[0].style.color="rgba(255, 255, 255, 0.689)";
    services[0].style.borderBottom = " 2px solid white";
    services[0].style.color="white";
    contact[0].style.borderBottom = "none";
    contact[0].style.color="rgba(255, 255, 255, 0.689)";
})

apropos[0].addEventListener('click',()=>{
    sectionserv.style.display = "none";
    sectioncont.style.display = "none";
    sectionprop.style.display = "block";

    presentation[0].style.borderBottom = "none";
    presentation[0].style.color="rgba(255, 255, 255, 0.689)";
    services[0].style.borderBottom = "none";
    services[0].style.color="rgba(255, 255, 255, 0.689)";
    apropos[0].style.borderBottom = " 2px solid white";
    apropos[0].style.color="white";
    contact[0].style.borderBottom = "none";
    contact[0].style.color="rgba(255, 255, 255, 0.689)";
})

contact[0].addEventListener('click',()=>{
    sectionserv.style.display = "none";
    sectionprop.style.display = "none";
    sectioncont.style.display = "block";

    presentation[0].style.borderBottom = "none";
    presentation[0].style.color="rgba(255, 255, 255, 0.689)";
    services[0].style.borderBottom = "none";
    services[0].style.color="rgba(255, 255, 255, 0.689)";
    apropos[0].style.borderBottom = "none";
    apropos[0].style.color="rgba(255, 255, 255, 0.689)";
    contact[0].style.borderBottom = " 2px solid white";
    contact[0].style.color="white";
})

    


        presentation[1].style.borderBottom = " 2px solid black";
        presentation[1].style.color="black";

presentation[1].addEventListener('click',()=>{
    sectionserv.style.display = "none";
    sectionprop.style.display = "none";
    sectioncont.style.display = "none";

    apropos[1].style.borderBottom = " none";
    apropos[1].style.color="rgba(0, 0, 0, 0.689)";
    services[1].style.borderBottom = "none";
    services[1].style.color="rgba(0, 0, 0, 0.689)";
    presentation[1].style.borderBottom = " 2px solid black";
    presentation[1].style.color="black";
    contact[1].style.borderBottom = "none";
    contact[1].style.color="rgba(0, 0, 0, 0.689)";
})

services[1].addEventListener('click',()=>{
    sectionserv.style.display = "block";
    sectionprop.style.display = "none";
    sectioncont.style.display = "none";

    presentation[1].style.borderBottom = " none";
    presentation[1].style.color="rgba(0, 0, 0, 0.689)";
    apropos[1].style.borderBottom = " none";
    apropos[1].style.color="rgba(0, 0, 0, 0.689)";
    services[1].style.borderBottom = " 2px solid black";
    services[1].style.color="black";
    contact[1].style.borderBottom = "none";
    contact[1].style.color="rgba(0, 0, 0, 0.689)";
})

apropos[1].addEventListener('click',()=>{
    sectionserv.style.display = "none";
    sectionprop.style.display = "block";
    sectioncont.style.display = "none";

    presentation[1].style.borderBottom = "none";
    presentation[1].style.color="rgba(0, 0, 0, 0.689)";
    services[1].style.borderBottom = "none";
    services[1].style.color="rgba(0, 0, 0, 0.689)";
    apropos[1].style.borderBottom = " 2px solid black";
    apropos[1].style.color="black";
    contact[1].style.borderBottom = "none";
    contact[1].style.color="rgba(0, 0, 0, 0.689)";
})

contact[1].addEventListener('click',()=>{
    sectionserv.style.display = "none";
    sectionprop.style.display = "none";
    sectioncont.style.display = "block";

    presentation[1].style.borderBottom = " none";
    presentation[1].style.color="rgba(0, 0, 0, 0.689)";
    apropos[1].style.borderBottom = " none";
    apropos[1].style.color="rgba(0, 0, 0, 0.689)";
    services[1].style.borderBottom = "rgba(0, 0, 0, 0.689)";
    services[1].style.color="none";
    contact[1].style.borderBottom = " 2px solid black";
    contact[1].style.color="black";
})

    