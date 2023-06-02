
/*   Données   */

let QSTNj = ['quelle heure'];

let CHOIX1j = ['12'];

let CHOIX2j = ['13'];

let CHOIX3j = ['15'];

    /* tableau des reponses */

let VRAIj = ['12'];

/* button d'aller au QSM */
let ALLERj = document.getElementById('JS');

let ALLERhtm = document.getElementById('html');
let ALLERcp = document.getElementById('cpp');

let ij=0;
    
let Notej=0;

let DIVGLOBj = document.getElementById('D');

    /* button suivant */
let SUIVANTj=document.getElementById('btnsu');

  /* ----------------------- Ajout dse elements */

ALLERj.addEventListener('click',()=>{

  ALLERhtm.style.display="none";   /* supprimer les autres button d'aller */
  ALLERcp.style.display="none";

SUIVANTj.style.display ="block";    /* afficher le button suivant */ 
DIVGLOBj.style.display="block";

SUIVANTj.addEventListener('click',()=>{
    if(ij!=QSTNj.length){SUIVANTj.textContent="Suivant -->";}
    if(ij==QSTNj.length-1){SUIVANTj.textContent="Savoir La Note --> "}
    

if(ij<QSTNj.length){

DIVGLOBj.textContent = " ";

        //ajouter la question 
    let questionj=document.createElement('p');
    questionj.textContent=QSTNj[ij];
    DIVGLOBj.append(questionj); 
        questionj.setAttribute('id','questionj'); 

        //Ajouter le premier choix
    let CH1j = document.createElement('input');
    CH1j.setAttribute('type','checkbox');
        let PA1j = document.createElement('p');
        let PA01j = document.createElement('span');
        PA01j.textContent = CHOIX1j[ij];
            PA1j.append(CH1j);
            PA1j.append(PA01j);
                CH1j.setAttribute('id','cho1j');
                PA01j.setAttribute('id','text1j');
                PA1j.setAttribute('id','rep1j');
              

        //Ajouter le dexieme choix
    let CH2j = document.createElement('input');
    CH2j.setAttribute('type','checkbox');
        let PA2j = document.createElement('p');
        let PA02j = document.createElement('span');
        PA02j.textContent = CHOIX2j[ij];
            PA2j.append(CH2j);
            PA2j.append(PA02j);
                CH2j.setAttribute('id','cho2j');
                PA02j.setAttribute('id','text2j');
                PA2j.setAttribute('id','rep2j');


        //Ajouter le troisieme choix
    let CH3j = document.createElement('input');
    CH3j.setAttribute('type','checkbox');
        let PA3j = document.createElement('p');
        let PA03j = document.createElement('span');
        PA03j.textContent = CHOIX3j[ij];
            PA3j.append(CH3j);
            PA3j.append(PA03j);
                CH3j.setAttribute('id','cho3j');
                PA03j.setAttribute('id','text3j');
                PA3j.setAttribute('id','rep3j');

            DIVGLOBj.append(PA1j,PA2j,PA3j);

           ij=ij+1; }


           /* --------------------- Tester les reponses Vrai */
           
            
        DIVGLOBj.addEventListener('click',(event)=>{
                let ej=event.target;
                if(ej.tagName=="INPUT"){

                    //les checkboxs
            let c1j=document.getElementById('cho1j');
            let c2j=document.getElementById('cho2j');
            let c3j=document.getElementById('cho3j');

                   //les paragraphes global (checkbox+span)
            let REP1j=document.getElementById('rep1j');
            let REP2j=document.getElementById('rep2j');
            let REP3j=document.getElementById('rep3j');

                   //les spans
            let p1j=document.getElementById('text1j');
            let p2j=document.getElementById('text2j');
            let p3j=document.getElementById('text3j');

            

                 //tester sur le choix 1 :
            if(c1j.checked){
                c2j.style.display="none";
                c3j.style.display="none";

                 if(p1j.textContent == VRAIj[ij-1]){
                    REP1j.style.backgroundColor ="green";
                    REP1j.textContent="Correct ✓";
                    Notej++;}

                 else{
                    REP1j.style.backgroundColor ="red";
                    REP1j.textContent="Faux ✘";
                    Notej--;
                    }
            }

            //tester sur le choix 2 :
            if(c2j.checked){
                c1j.style.display="none";
                c3j.style.display="none";

                if(p2j.textContent == VRAIj[ij-1]){
                   REP2j.style.backgroundColor ="green";
                   REP2j.textContent="Correct ✓";
                   Notej++;
                   }

                else{
                   REP2j.style.backgroundColor ="red";
                   REP2j.textContent="Faux ✘";
                   Notej--;}
           }

           //tester sur le choix 3 :
           if(c3j.checked){
            c2j.style.display="none";
            c1j.style.display="none";
                
            if(p3j.textContent == VRAIj[ij-1]){
               REP3j.style.backgroundColor ="green";
               REP3j.textContent="Correct ✓";
               Notej++;}

            else{
               REP3j.style.backgroundColor ="red";
               REP3j.textContent="Faux ✘";
               Notej--;}
       }
           
      

                }
           });
    
if(SUIVANTj.textContent=="Savoir La Note --> "){
    SUIVANTj.addEventListener('click',()=>{
        DIVGLOBj.textContent=" ";
        let Nj=document.createElement('p');
        Nj.setAttribute('id','notej');
        Nj.textContent = "Note : "+Notej+"/10";
        DIVGLOBj.append(Nj);
        SUIVANTj.remove();
    })
}
});
   ALLERj.remove();   /* suppression du button d'aller au QSM */
   

});
