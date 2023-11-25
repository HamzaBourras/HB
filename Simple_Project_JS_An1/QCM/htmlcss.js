
    /* Données */

 let QSTN = ['HTML est considéré comme ?','HTML utilise des  ?','HTML a été proposé pour la première fois l’année ?','Lequel des éléments suivants n’est pas un exemple de navigateur ?','Si nous souhaitons définir le style d’un seule élément, quel sélecteur css utiliserons-nous ?','La balise HTML qui spécifie un style CSS intégré dans un élément est appelée ?','La norme HTML qui n’exige pas des double quotes autour des valeurs d’un attribut est dite ?','Peut-on définir la direction du texte via une propriété CSS ?','À quoi sert iframe en HTML ?','La valeur par défaut de l’attribut « position » est ?'];

    let CHOIX1 = [' Langage POO','Balises fixes définis par le langage','1990','Netscape','class','Design','HTML 5','non','Pour afficher une page Web sans navigateur','relative'];

    let CHOIX2 = ['Langage de balisage','Balises uniquement pour les liens','1995','Opéra','id','Style','HTML 1','oui','Pour afficher une page Web avec un effet d’animation','absolute'];

    let CHOIX3 = ['Langage de haut niveau','Balises définis par l’utilisateur','2004','Microsoft Bing','tagname','Define','HTML 7','Tout les reponses est vrai','Pour afficher une page Web dans une page Web','sticky'];

        /* tableau des repones */
    let VRAI = ['Langage de balisage','Balises fixes définis par le langage','1990','Microsoft Bing','id','Style','HTML 5','oui','Pour afficher une page Web dans une page Web','relative'];

        /* button d'aller au QSM */
    let ALLER = document.getElementById('html');

    let ALLERcpp = document.getElementById('cpp');
    let ALLERjsr = document.getElementById('JS');


    let i=0;
      
    let Note=0;
 
    let DIVGLOB = document.getElementById('D');

        /* button suivant */
    let SUIVANT=document.getElementById('btnsu');

      /* ----------------------- Ajout dse elements */

 ALLER.addEventListener('click',()=>{

    ALLERcpp.style.display="none";   /* supprimer les autres button d'aller */
    ALLERjsr.style.display="none";

    SUIVANT.style.display ="block";    /* afficher le button suivant */ 
    DIVGLOB.style.display="block";

  SUIVANT.addEventListener('click',()=>{
        if(i!=QSTN.length){SUIVANT.textContent="Suivant -->";}
        if(i==QSTN.length-1){SUIVANT.textContent="Savoir La Note --> "}
        

    if(i<QSTN.length){

    DIVGLOB.textContent = " ";

            //ajouter la question 
        let question=document.createElement('p');
        question.textContent=QSTN[i];
        DIVGLOB.append(question); 
            question.setAttribute('id','question'); 

            //Ajouter le premier choix
        let CH1 = document.createElement('input');
        CH1.setAttribute('type','checkbox');
            let PA1 = document.createElement('p');
            let PA01 = document.createElement('span');
            PA01.textContent = CHOIX1[i];
                PA1.append(CH1);
                PA1.append(PA01);
                    CH1.setAttribute('id','cho1');
                    PA01.setAttribute('id','text1');
                    PA1.setAttribute('id','rep1');
                  

            //Ajouter le dexieme choix
        let CH2 = document.createElement('input');
        CH2.setAttribute('type','checkbox');
            let PA2 = document.createElement('p');
            let PA02 = document.createElement('span');
            PA02.textContent = CHOIX2[i];
                PA2.append(CH2);
                PA2.append(PA02);
                    CH2.setAttribute('id','cho2');
                    PA02.setAttribute('id','text2');
                    PA2.setAttribute('id','rep2');


            //Ajouter le troisieme choix
        let CH3 = document.createElement('input');
        CH3.setAttribute('type','checkbox');
            let PA3 = document.createElement('p');
            let PA03 = document.createElement('span');
            PA03.textContent = CHOIX3[i];
                PA3.append(CH3);
                PA3.append(PA03);
                    CH3.setAttribute('id','cho3');
                    PA03.setAttribute('id','text3');
                    PA3.setAttribute('id','rep3');
 
                DIVGLOB.append(PA1,PA2,PA3);
 
               i=i+1; }


               /* --------------------- Tester les reponses Vrai */
               
                
            DIVGLOB.addEventListener('click',(event)=>{
                    let e=event.target;
                    if(e.tagName=="INPUT"){

                        //les checkboxs
                let c1=document.getElementById('cho1');
                let c2=document.getElementById('cho2');
                let c3=document.getElementById('cho3');

                       //les paragraphes global (checkbox+span)
                let REP1=document.getElementById('rep1');
                let REP2=document.getElementById('rep2');
                let REP3=document.getElementById('rep3');

                       //les spans
                let p1=document.getElementById('text1');
                let p2=document.getElementById('text2');
                let p3=document.getElementById('text3');

                

                     //tester sur le choix 1 :
                if(c1.checked){
                    c2.style.display="none";
                    c3.style.display="none";

                     if(p1.textContent == VRAI[i-1]){
                        REP1.style.backgroundColor ="green";
                        REP1.textContent="Correct ✓";
                        Note++;}

                     else{
                        REP1.style.backgroundColor ="red";
                        REP1.textContent="Faux ✘";
                        Note--;
                        }
                }

                //tester sur le choix 2 :
                if(c2.checked){
                    c1.style.display="none";
                    c3.style.display="none";
 
                    if(p2.textContent == VRAI[i-1]){
                       REP2.style.backgroundColor ="green";
                       REP2.textContent="Correct ✓";
                       Note++;
                       }

                    else{
                       REP2.style.backgroundColor ="red";
                       REP2.textContent="Faux ✘";
                       Note--;}
               }

               //tester sur le choix 3 :
               if(c3.checked){
                c2.style.display="none";
                c1.style.display="none";
                    
                if(p3.textContent == VRAI[i-1]){
                   REP3.style.backgroundColor ="green";
                   REP3.textContent="Correct ✓";
                   Note++;}

                else{
                   REP3.style.backgroundColor ="red";
                   REP3.textContent="Faux ✘";
                   Note--;}
           }
               
          

                    }
               });
        
    if(SUIVANT.textContent=="Savoir La Note --> "){
        SUIVANT.addEventListener('click',()=>{
            DIVGLOB.textContent=" ";
            let N=document.createElement('p');
            N.setAttribute('id','note');
            N.textContent = "Note : "+Note+"/10";
            DIVGLOB.append(N);
            SUIVANT.remove();
        })
    }
  });
       ALLER.remove();   /* suppression du button d'aller au QSM */

});

 
 
     
    
 

 
 
