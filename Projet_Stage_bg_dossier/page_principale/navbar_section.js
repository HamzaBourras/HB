var presentation = document.querySelectorAll("#pres");
var services = document.querySelectorAll('#serv');
var apropos = document.querySelectorAll('#prop');
var contact = document.querySelectorAll('#conta');


var sectionserv = document.getElementById("service");
var sectionprop = document.getElementById("apropos");
var sectioncont = document.getElementById("contact");

var nav1 = document.getElementById('nav1');

let section_affich ;

    presentation[0].classList.add('nav_li_active');

presentation[0].addEventListener('click',()=>{

        section_affich = 0;

    sectionserv.style.display = "none";
    sectionprop.style.display = "none";
    sectioncont.style.display = "none";

    presentation[0].classList.add('nav_li_active');

    apropos[0].classList.remove('nav_li_active');
    services[0].classList.remove('nav_li_active');
    contact[0].classList.remove('nav_li_active');
})


services[0].addEventListener('click',()=>{

    section_affich = 1;

    sectionserv.style.display = "block";
    sectionprop.style.display = "none";
    sectioncont.style.display = "none";

    services[0].classList.add('nav_li_active');

    presentation[0].classList.remove('nav_li_active');
    apropos[0].classList.remove('nav_li_active');
    contact[0].classList.remove('nav_li_active');
})

apropos[0].addEventListener('click',()=>{

    section_affich = 2;

    sectionserv.style.display = "none";
    sectioncont.style.display = "none";
    sectionprop.style.display = "block";

    apropos[0].classList.add('nav_li_active');

    presentation[0].classList.remove('nav_li_active');
    services[0].classList.remove('nav_li_active');
    contact[0].classList.remove('nav_li_active');
})

contact[0].addEventListener('click',()=>{

    section_affich = 3;

    sectionserv.style.display = "none";
    sectionprop.style.display = "none";
    sectioncont.style.display = "block";

    contact[0].classList.add('nav_li_active');

    presentation[0].classList.remove('nav_li_active');
    services[0].classList.remove('nav_li_active');
    apropos[0].classList.remove('nav_li_active');
})

    


        presentation[1].classList.add('nav_li_active');

presentation[1].addEventListener('click',()=>{

    section_affich = 0;

    sectionserv.style.display = "none";
    sectionprop.style.display = "none";
    sectioncont.style.display = "none";

    presentation[1].classList.add('nav_li_active');

    apropos[1].classList.remove('nav_li_active');
    services[1].classList.remove('nav_li_active');
    contact[1].classList.remove('nav_li_active');
})

services[1].addEventListener('click',()=>{

    section_affich = 1;

    sectionserv.style.display = "block";
    sectionprop.style.display = "none";
    sectioncont.style.display = "none";

    services[1].classList.add('nav_li_active');

    presentation[1].classList.remove('nav_li_active');
    apropos[1].classList.remove('nav_li_active');
    contact[1].classList.remove('nav_li_active');
})

apropos[1].addEventListener('click',()=>{

    section_affich = 2;

    sectionserv.style.display = "none";
    sectionprop.style.display = "block";
    sectioncont.style.display = "none";

    apropos[1].classList.add('nav_li_active');

    presentation[1].classList.remove('nav_li_active');
    services[1].classList.remove('nav_li_active');
    contact[1].classList.remove('nav_li_active');
})

contact[1].addEventListener('click',()=>{

    section_affich = 3;

    sectionserv.style.display = "none";
    sectionprop.style.display = "none";
    sectioncont.style.display = "block";

    contact[1].classList.add('nav_li_active');

    presentation[1].classList.remove('nav_li_active');
    apropos[1].classList.remove('nav_li_active');
    services[1].classList.remove('nav_li_active');
})



function verifierLargeurEcran() {

    switch (section_affich) {
        case 0: {
            for (let i=0;i<2;i++) {
                presentation[i].classList.add('nav_li_active');
                services[i].classList.remove('nav_li_active');
                apropos[i].classList.remove('nav_li_active');
                contact[i].classList.remove('nav_li_active');
            }
        }
            
            break;
        case 1: {
            for (let i=0;i<2;i++) {
                services[i].classList.add('nav_li_active');
                presentation[i].classList.remove('nav_li_active');
                apropos[i].classList.remove('nav_li_active');
                contact[i].classList.remove('nav_li_active');
            }
        }

        break;

        case 2: {
            for (let i=0;i<2;i++) {
                apropos[i].classList.add('nav_li_active');
                presentation[i].classList.remove('nav_li_active');
                services[i].classList.remove('nav_li_active');
                contact[i].classList.remove('nav_li_active');
            }
        }
        
        break;

        case 3: {
            for (let i=0;i<2;i++) {
                contact[i].classList.add('nav_li_active');
                presentation[i].classList.remove('nav_li_active');
                services[i].classList.remove('nav_li_active');
                apropos[i].classList.remove('nav_li_active');
            }
        }
        
        break;
    
        default:
            break;
    }
    
  }
  
  
  
  window.addEventListener('resize', verifierLargeurEcran);

    