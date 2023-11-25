 
 
 const productList = document.querySelector('.products');
 const cartList = document.querySelector('.cart');
 const TOTAL = document.querySelector('.t');
 
 
 let AJprod = [];
 let i = 0,k;
 let Qauantite = 0;

 productList.addEventListener('click',(Event) =>{
      
     const p = Event.target;
     let QID = p.parentNode.parentNode.firstElementChild.nextElementSibling.nextElementSibling;

        /* verification c'est le produit exixte ou non */
        k=0;
     let ID = p.parentNode.parentNode.parentNode.getAttribute('id');
      for(let key in AJprod){
        
         if(AJprod[key] == ID){
            k=1;
            break;
         }
      }


     if(p.tagName === 'BUTTON'){

          /* ajout du produit */

        if(k==0){    /* controler l'ajout du produit */
 
      let A = document.createElement('div');
      
      let H1 = document.createElement('p');
      H1.textContent = p.parentNode.parentNode.parentNode.firstElementChild.textContent ;

      let IMG = p.parentNode.parentNode.parentNode.firstElementChild.nextElementSibling ;
       let image = document.createElement('img');
       let I = IMG.getAttribute('src');
         image.src = I;

        

        A.append(H1);
        A.append(image);

        let PARA = document.createElement('p');
        PARA.textContent = "Quantity : ";
        A.append(PARA);

        let Q = document.createElement('p');    /* calcule du quantité */
        switch (ID){
            case 'ID1' : {Q.setAttribute('id','');
                          Q.id = 'S1';
                          Q.textContent = Qauantite ;
                          A.append(Q);}break;
            case 'ID2' :{Q.setAttribute('id','');
                            Q.id = 'S2';
                            Q.textContent = Qauantite ;
                            A.append(Q);}break;
            case 'ID3' : {Q.setAttribute('id','');
                            Q.id = 'S3';
                            Q.textContent = Qauantite ;
                            A.append(Q);}break;
            case 'ID4' : {Q.setAttribute('id','');
                            Q.id = 'S4';
                            Q.textContent = Qauantite ;
                            A.append(Q);}break;
            case 'ID5' : {Q.setAttribute('id','');
                            Q.id = 'S5';
                            Q.textContent = Qauantite ;
                            A.append(Q);}break;
            case 'ID6' : {Q.setAttribute('id','');
                            Q.id = 'S6';
                            Q.textContent = Qauantite ;
                            A.append(Q);}break;
            case 'ID7' : {Q.setAttribute('id','');
                            Q.id = 'S7';
                            Q.textContent = Qauantite ;
                            A.append(Q);}break;
            case 'ID8' : {Q.setAttribute('id','');
                            Q.id = 'S8';
                            Q.textContent = Qauantite ;
                            A.append(Q);}break;
            case 'ID9' : {Q.setAttribute('id','');
                            Q.id = 'S9';
                            Q.textContent = Qauantite ;
                            A.append(Q);}break;
            default : let r=1;
        }
        
        cartList.append(A);

        

        AJprod[i] = p.parentNode.parentNode.parentNode.getAttribute('id');  /* sauvgarder l'element ajouter dans le tableau */
          i++;

          /* CSS */

        PARA.style.cssText = ` 
            padding-top : 10px;
            height : 20px;
            display : inline;
            margin-top : 20px;
        `

        Q.style.cssText = `height : 20px;
            display : inline;
        `

        A.style.cssText = `
            display: inline-block;
            position: relative;
            text-align: center;
            background-color: rgba(0, 0, 145, 0.23);
            color: white;
            width: 410px;
            height: max-content;
            margin-bottom: 40px;
            font-size: 30px; 
            border-radius: 10px;
            padding-bottom : 20px;
        `

        image.style.cssText = `
        border-bottom: 2px solid white;
        padding-bottom : 30px;`

        H1.style.cssText = `
        border-bottom: 1px solid white;
        padding-bottom: 15px;
        `

        }

        
           /* incrementation du quantite */
             let SOM;
           switch (ID) {
              case 'ID1' :  SOM = document.getElementById('S1');break;
                 
              case 'ID2' :  SOM = document.getElementById('S2');break; 
              
              case 'ID3' :  SOM = document.getElementById('S3');break;

              case 'ID4' :  SOM = document.getElementById('S4');break;

              case 'ID5' :  SOM = document.getElementById('S5');break;

              case 'ID6' :  SOM = document.getElementById('S6');break;

              case 'ID7' :  SOM = document.getElementById('S7');break;

              case 'ID8' :  SOM = document.getElementById('S8');break;

              case 'ID9' :  SOM = document.getElementById('S9');break;

              default :break;
           }
         
        let S = SOM.textContent ;
        SOM.innerHTML = Number(S) + 1;

         
     /* TOTAL */

     let PRICE = p.parentNode.parentNode.parentNode.getAttribute('data-price');

     let Pr = Number(PRICE) + Number(TOTAL.textContent);

     TOTAL.textContent = Pr ; 

     

     }
      
     

     
 })

 
