let text = document.querySelector("#text").textContent;
let ecritText = document.querySelector("#ecritText");
let chrono = document.querySelector("#chrono");
let redemarer = document.querySelector("#redemarer");
let spanMin = document.querySelector('#min');
let spanSec = document.querySelector('#sec');
let spanDiv = document.querySelector('#div');


let div = 0;
let sec = 0;
let min = 0;
let i = 0, j = 0;
let I;
let a=0;

ecritText.addEventListener('input', () => {
    
    if(a==0){
        I = setInterval(() => {
            div++;
            if (div == 100) {
                sec++;
                div = 0;
                j = 0;
            }
            if (sec == 60) {
                min++;
                sec = 0;
                i = 0;
            }
            if (min < 10 && i == 0) {
                min = "0" + min;
                i = 1;
            }
            if (sec < 10 && j == 0) {
                sec = "0" + sec;
                j = 1;
            }
    
            spanMin.textContent = min;
            spanSec.textContent = sec;
            spanDiv.textContent = div;
        }, 10);
    }
    a=1;

    if(text.trim()==ecritText.value.trim()) {
        clearInterval(I);
        chrono.style.cssText = "background-color:green";
    }
})

redemarer.addEventListener('click', () => {
    sec = 0;
    min = 0;
    div = 0;
    spanMin.textContent = "00";
    spanSec.textContent = "00";
    spanDiv.textContent = "00";
    ecritText.value = "";
    clearInterval(I);
})