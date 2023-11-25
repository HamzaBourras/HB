let divJoueur1 = document.querySelector('.joueur1');  // div de joueur 1
let divJoueur2 = document.querySelector('.joueur2');  // div de joueur 2
let scoreJoueur1 = document.querySelector('#scoreJ1');  // paragraphe score du joueur 1
let tempscoreJoueur1 = document.querySelector('#tempscoreJ1');  // button score temporaire du joueur 1
let scoreJoueur2 = document.querySelector('#scoreJ2'); // paragraphe score du joueur 2
let tempscoreJoueur2 = document.querySelector('#tempscoreJ2'); // button score temporaire du joueur 2
let divDe1 = document.querySelector('.De1');  // div contient le Dé du joueur 1
let divDe2 = document.querySelector('.De2');  // div contient le Dé du joueur 2
let inputScoreMax = document.querySelector('#score_max');  // L'input du score max
let buttonNoveau = document.querySelector('#Nv');  // le bouton NOVEAU
let buttonLance = document.querySelector('#lance');  // le bouton LANCE
let buttonPasse = document.querySelector('#passe');  // le bouton PASSE


let signe1 = document.querySelector('#Sn1');  // signe si le joueur 1 est actif (le manchot)
let signe2 = document.querySelector('#Sn2');  // signe si le joueur 2 est actif
let paraMessage = document.querySelector('#er');  //paragraphe des messages sous l'input
let tempscoreJoueur1Value = 0; // valeur de score temporaire du joueur 1
let tempscoreJoueur2Value = 0; // valeur de score temporaire du joueur 2
let scoreJoueur1Value = 0; // valeur de score du joueur 1
let scoreJoueur2Value = 0; // valeur de score du joueur 2


    // les Sons des boutons
let SonLance = document.querySelector('#son_lance');
let SonPasse = document.querySelector('#son_passe');
let SonNoveau = document.querySelector('#son_noveau');
let SonTermine = document.querySelector('#son_termine');


    /***** Question 1 : Création de la fonction init  *****/

let actif=1;  //determiner le joueur actif

    // la fonction init 
function init () {
    tempscoreJoueur1Value = 0;    tempscoreJoueur2Value = 0;
    tempscoreJoueur1.textContent = tempscoreJoueur1Value; 
    tempscoreJoueur2.textContent = tempscoreJoueur2Value;
    scoreJoueur1Value = 0;      scoreJoueur2Value = 0;
    scoreJoueur1.textContent = scoreJoueur1Value;
    scoreJoueur2.textContent = scoreJoueur2Value;
    
    signe1.style.color="rgb(8,145,178)"; // signer que le joueur 1 est actif
    actif=1;
    divJoueur1.classList.add('actif');
    
    divDe1.style.display = "none";
    divDe2.style.display = "none";
}

    init(); // appel de la focntion inti

// cacher les deux buttons LANCE et PASSE
buttonLance.style.visibility= "hidden";
buttonPasse.style.visibility= "hidden";
    

    /***** Question 2 : Ajout d'un listner au button LANCE  *****/

 
let nombre = 0;  // le nombre aléatoire

    /* fonction pour lancer onclick */
buttonLance.addEventListener('click',()=>{
    SonLance.play();  //demarer le son pour le button LANCE

    divDe1.style.display = "block";
    divDe2.style.display = "block";
    
        // Si le joueur 1 est le joueur actif
    if(actif==1){
        divDe1.classList.add('animation');
        divDe1.addEventListener('animationend', () => {
            divDe1.classList.remove('animation');
        });
        
        nombre = Math.floor(Math.random() * 6) + 1; // choisir un nombre aléatoire
        divDe1.firstElementChild.src = "images/de_n"+nombre+".png"; // placer l'image correspondent
        divDe1.style.display = "block";

        if(nombre != 1){
            tempscoreJoueur1Value += nombre;
            tempscoreJoueur1.textContent = tempscoreJoueur1Value;
       }
       else{
           actif = 2;
           divJoueur2.classList.add('actif');
           signe2.style.color="rgb(8 145 178)";
           divJoueur1.classList.remove('actif');
           signe1.style.color="black";
           tempscoreJoueur1Value=0;
           tempscoreJoueur1.textContent = tempscoreJoueur1Value;
           
       }
    }

        // Si le joueur 2 est le joueur actif
    else{
        divDe2.classList.add('animation');
        divDe2.addEventListener('animationend', () => {
            divDe2.classList.remove('animation');
        });
        
        nombre = Math.floor(Math.random() * 6) + 1; // choisir un nombre aléatoire
        divDe2.firstElementChild.src = "images/de_n"+nombre+".png"; // placer l'image correspondent
        divDe2.style.display = "block";
        if(nombre!=1){
            tempscoreJoueur2Value += nombre;
            tempscoreJoueur2.textContent = tempscoreJoueur2Value;
        }
        else{
            actif = 1;
            divJoueur1.classList.add('actif');
            signe1.style.color="rgb(8 145 178)";
            divJoueur2.classList.remove('actif');
            signe2.style.color="black";
            tempscoreJoueur2Value = 0;
            tempscoreJoueur2.textContent = tempscoreJoueur2Value;
        }
    }

    
});


    /***** Question 6 : ajouter un champ de texte pour le score max *****/

let SCORE_MAX ='';
inputScoreMax.addEventListener('input',()=>{
    SCORE_MAX = parseInt(inputScoreMax.value);
    buttonLance.style.visibility= "hidden";
    buttonPasse.style.visibility= "hidden";
    init();
})

    /***** Question 3 : Ajout d'un listner au button PASSE  *****/

    /* la fonction joueurSuivant() */
function joueurSuivant () {

    if(actif == 1){
        scoreJoueur1Value += tempscoreJoueur1Value;
        scoreJoueur1.textContent = scoreJoueur1Value;
        tempscoreJoueur1Value = 0;
        tempscoreJoueur1.textContent = tempscoreJoueur1Value;
        actif=2;
        divJoueur2.classList.add('actif');
        signe2.style.color="rgb(8 145 178)";
        divJoueur1.classList.remove('actif');
        signe1.style.color="black";
    }
    else{
        scoreJoueur2Value += tempscoreJoueur2Value;
        scoreJoueur2.textContent = scoreJoueur2Value;
        tempscoreJoueur2Value = 0;
        tempscoreJoueur2.textContent = tempscoreJoueur2Value;
        actif=1;
        divJoueur1.classList.add('actif');
        signe1.style.color="rgb(8 145 178)";
        divJoueur2.classList.remove('actif');
        signe2.style.color="black";
    }

    /***** Question 4 : Termine la partie si le score d'un joueur est dépasse SCORE_MAX *****/

    
        if(scoreJoueur1Value>=SCORE_MAX || scoreJoueur2Value>=SCORE_MAX){
            SonTermine.play();  //demarer le son lorsque la partie est terminé

                    // Afficher un message pour le joueur ganger 
                paraMessage.style.cssText = `display:block;
                background-color:rgb(10, 163, 10);`;

            if(scoreJoueur1Value >= SCORE_MAX){
                paraMessage.textContent = "Le joueur 1 a gagné";
            }
            else{
                paraMessage.textContent = "Le joueur 2 a gagné";
            }

            init();
            divJoueur2.classList.remove('actif');
            buttonLance.style.visibility = "hidden";
            buttonPasse.style.visibility = "hidden";
            signe2.style.color="black";

        }
        else{
            SonPasse.play();  //demarer le son pour le button PASSE
        }
        
        

    
    
}

buttonPasse.addEventListener('click',joueurSuivant); // attacher la fonction à l'evenment listner

    /***** Question 5 : ajouter un event listner au button NOVEAU *****/

buttonNoveau.addEventListener('click',()=>{
    

    if(!isNaN(SCORE_MAX) && SCORE_MAX > 1){
        inputScoreMax.value = '';
        buttonLance.style.visibility = "visible";
        buttonPasse.style.visibility = "visible";
        init();

        SonNoveau.play();  //demarer le son pour le button NOVEAU
        paraMessage.style.display="none"; 

    }   
    else{
            // afficher le message d'ereur
        paraMessage.style.cssText = `display: block;  
        background-color: red;`;
        paraMessage.textContent = "Choisissez un SCORE MAX VALIDE";
    }
});
    



    