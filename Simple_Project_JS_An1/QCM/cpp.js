 
  /*   Données   */

  let QSTNc = ['quelle heure'];

  let CHOIX1c = ['12'];

  let CHOIX2c = ['13'];

  let CHOIX3c = ['15'];

      /* tableau des reponses */

  let VRAIc = ['12'];

  /* button d'aller au QSM */
  let ALLERc = document.getElementById('cpp');

  let ALLERht = document.getElementById('html');
  let ALLERjs = document.getElementById('JS');

  let ic=0;
      
  let Notec=0;

  let DIVGLOBc = document.getElementById('D');

      /* button suivant */
  let SUIVANTc=document.getElementById('btnsu');

    /* ----------------------- Ajout dse elements */

ALLERc.addEventListener('click',()=>{

    ALLERht.style.display="none";   /* supprimer les autres button d'aller */
    ALLERjs.style.display="none";

  SUIVANTc.style.display ="block";    /* afficher le button suivant */ 
  DIVGLOBc.style.display="block";

SUIVANTc.addEventListener('click',()=>{
      if(ic!=QSTNc.length){SUIVANT.textContent="Suivant -->";}
      if(ic==QSTNc.length-1){SUIVANT.textContent="Savoir La Note --> "}
      

  if(ic<QSTNc.length){

  DIVGLOBc.textContent = " ";

          //ajouter la question 
      let questionc=document.createElement('p');
      questionc.textContent=QSTNc[i];
      DIVGLOBc.append(questionc); 
          questionc.setAttribute('id','questionc'); 

          //Ajouter le premier choix
      let CH1c = document.createElement('input');
      CH1c.setAttribute('type','checkbox');
          let PA1c = document.createElement('p');
          let PA01c = document.createElement('span');
          PA01c.textContent = CHOIX1c[ic];
              PA1c.append(CH1c);
              PA1c.append(PA01c);
                  CH1c.setAttribute('id','cho1c');
                  PA01c.setAttribute('id','text1c');
                  PA1c.setAttribute('id','rep1c');
                

          //Ajouter le dexieme choix
      let CH2c = document.createElement('input');
      CH2c.setAttribute('type','checkbox');
          let PA2c = document.createElement('p');
          let PA02c = document.createElement('span');
          PA02c.textContent = CHOIX2c[ic];
              PA2c.append(CH2c);
              PA2c.append(PA02c);
                  CH2c.setAttribute('id','cho2c');
                  PA02c.setAttribute('id','text2c');
                  PA2c.setAttribute('id','rep2c');


          //Ajouter le troisieme choix
      let CH3c = document.createElement('input');
      CH3c.setAttribute('type','checkbox');
          let PA3c = document.createElement('p');
          let PA03c = document.createElement('span');
          PA03c.textContent = CHOIX3c[ic];
              PA3c.append(CH3c);
              PA3c.append(PA03c);
                  CH3c.setAttribute('id','cho3c');
                  PA03c.setAttribute('id','text3c');
                  PA3c.setAttribute('id','rep3c');

              DIVGLOBc.append(PA1c,PA2c,PA3c);

             ic=ic+1; }


             /* --------------------- Tester les reponses Vrai */
             
              
          DIVGLOB.addEventListener('click',(event)=>{
                  let ec=event.target;
                  if(ec.tagName=="INPUT"){

                      //les checkboxs
              let c1c=document.getElementById('cho1c');
              let c2c=document.getElementById('cho2c');
              let c3c=document.getElementById('cho3c');

                     //les paragraphes global (checkbox+span)
              let REP1c=document.getElementById('rep1c');
              let REP2c=document.getElementById('rep2c');
              let REP3c=document.getElementById('rep3c');

                     //les spans
              let p1c=document.getElementById('text1c');
              let p2c=document.getElementById('text2c');
              let p3c=document.getElementById('text3c');

              

                   //tester sur le choix 1 :
              if(c1c.checked){
                  c2c.style.display="none";
                  c3c.style.display="none";

                   if(p1c.textContent == VRAIc[ic-1]){
                      REP1c.style.backgroundColor ="green";
                      REP1c.textContent="Correct ✓";
                      Notec++;}

                   else{
                      REP1c.style.backgroundColor ="red";
                      REP1c.textContent="Faux ✘";
                      Notec--;
                      }
              }

              //tester sur le choix 2 :
              if(c2c.checked){
                  c1c.style.display="none";
                  c3c.style.display="none";

                  if(p2c.textContent == VRAIc[ic-1]){
                     REP2c.style.backgroundColor ="green";
                     REP2c.textContent="Correct ✓";
                     Notec++;
                     }

                  else{
                     REP2c.style.backgroundColor ="red";
                     REP2c.textContent="Faux ✘";
                     Notec--;}
             }

             //tester sur le choix 3 :
             if(c3c.checked){
              c2c.style.display="none";
              c1c.style.display="none";
                  
              if(p3c.textContent == VRAIc[ic-1]){
                 REP3c.style.backgroundColor ="green";
                 REP3c.textContent="Correct ✓";
                 Notec++;}

              else{
                 REP3c.style.backgroundColor ="red";
                 REP3c.textContent="Faux ✘";
                 Notec--;}
         }
             
        

                  }
             });
      
  if(SUIVANTc.textContent=="Savoir La Note --> "){
      SUIVANTc.addEventListener('click',()=>{
          DIVGLOBc.textContent=" ";
          let Nc=document.createElement('p');
          Nc.setAttribute('id','notec');
          Nc.textContent = "Note : "+Notec+"/10";
          DIVGLOBc.append(Nc);
          SUIVANTc.remove();
      })
  }
});
     ALLERc.remove();   /* suppression du button d'aller au QSM */
     

});



