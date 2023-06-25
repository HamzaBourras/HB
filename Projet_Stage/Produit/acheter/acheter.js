
    /*********** liée le chexbox au label ***********/
const checkboxe = document.querySelectorAll('input[id^="acheter"]');
const lab = document.querySelectorAll('.acheter label');


checkboxe.forEach((checkbox, index) => {
  checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
      lab[index].classList.add('checked');
      lab[index].textContent = "supprimer";
    } else {
      lab[index].classList.remove('checked');
      lab[index].textContent = "acheter";
    }
  });
});
    
    
    /***********  Ajouter un border lorsque le produit est acheter **********/
var labelsAcheter = document.querySelectorAll('label[for^="acheter"]');

labelsAcheter.forEach(function(label) {
  label.addEventListener("click", function() {
    var divAchat = this.closest('.achat');

    var hasBorder = divAchat.classList.contains('border-blanc');


    if (hasBorder) {
      divAchat.classList.remove('border-blanc');
    } else {

      divAchat.classList.add('border-blanc');
    }

  });
});
