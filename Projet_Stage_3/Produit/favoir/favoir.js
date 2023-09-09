
    /*********** liée le chexbox au label ***********/
const checkbo = document.querySelectorAll('input[id^="checkbox"]');
const labe = document.querySelectorAll('label i.fa-regular.fa-star');


checkbo.forEach((checkbox, index) => {
  checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
      labe[index].classList.add('checked');
    } else {
      labe[index].classList.remove('checked');
    }
  });
});



    /******  l'action des étoiles de favoir ******/
var etoiles1 = document.querySelectorAll("#ID1");
var etoiles2 = document.querySelectorAll("#ID2");


for (var i = 0; i < etoiles1.length; i++) {
    //ajouter au favoir 
etoiles1[i].addEventListener("click", function() {
    var index = Array.prototype.indexOf.call(etoiles1, this);
    etoiles1[index].style.visibility="visible";
    
    etoiles1[index].style.visibility = "hidden";

    etoiles2[index].style.visibility = "visible";

    etoiles2[index].style.color = "blue";
});

    //supprimer du favoir
etoiles2[i].addEventListener("click", function() {
    var index = Array.prototype.indexOf.call(etoiles2, this);
    
    etoiles1[index].style.visibility = "visible";
    etoiles2[index].style.visibility = "hidden";


});
}
