
 
 let Button = document.getElementById('BTN');

 
 
 Button.addEventListener('click',()=>{
    let k=0;

    let CIL = document.getElementById('CILC').value;
    let FRN = document.getElementById('firn').value;

    let blocC = document.getElementById('C');
    let blocF = document.getElementById('F');

    let B1 = document.getElementById('A1');
    let B2 = document.getElementById('A2');
           
    let SPAN = document.createElement('span');

      if(`${CIL.length}`>0 && k<=1 && `${FRN.length}`==0){   // CIL => FIRN
    
            SPAN.textContent = CIL*33.8;
            B2.append(SPAN);
            blocF.remove();
            
            k++;
        
            B2.style.cssText = `
            font-size: 30px;
            padding: 10px;
            border: 2px solid black;
            border-radius: 10px;
            width : 480px;
            display : inline-block;
            margin-top : 35px;
            background-color: rgba(192, 137, 137, 0.484);
            color: white;
            font-weight: 1000;`
                                    }

    if(`${FRN.length}`>0 && k<=1 && `${CIL.length}`==0){    // FIRN => CIL
        
            SPAN.textContent = FRN/33.8;
            B1.append(SPAN);
            blocC.remove();

            k++;
        
            B1.style.cssText = `
            font-size: 30px;
            padding: 10px;
            border: 2px solid black;
            border-radius: 10px;
            width : 480px;
            display : inline-block;
            background-color: rgba(192, 137, 137, 0.484);
            color: white;
            font-weight: 1000;
            `
        
                                                        }

    
 });
 