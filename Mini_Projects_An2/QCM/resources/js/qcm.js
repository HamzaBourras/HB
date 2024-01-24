let Bloc = document.querySelector("#bloc")
let validButton = document.querySelector("#validButton")

let choiceDivs = document.querySelectorAll("#choiceDiv")
let addChoiceButtons = document.querySelectorAll("#addChoice")

let choiceInput = document.querySelector("#choice-text")
let trueOrFalseInput = document.querySelector("#trueOrFalse")


let buttonIndex = 0

// "add choice" button event
addChoiceButtons.forEach(function (button, index) {
    button.addEventListener("click", function (event) {

        choiceInput.value = ''
        choiceInput.classList.remove("border-red-500")
        trueOrFalseInput.value = ''
        trueOrFalseInput.classList.remove("border-red-500")
        // Affichez le bloc de choix
        Bloc.classList.remove("hidden");

        buttonIndex = Array.from(addChoiceButtons).indexOf(event.currentTarget);


    });
});


// "valid" button event

validButton.addEventListener("click", function () {
    // Récupérez les valeurs des champs
    let choiceText = choiceInput.value;
    let trueOrFalse = trueOrFalseInput.value;
    let questionId = addChoiceButtons[buttonIndex].getAttribute("data-question-id")

    let choice = choiceText + "**" + trueOrFalse + "**" + questionId  // concatener les données en ajoutant **


    if (choiceText.trim() !== '' && trueOrFalse !== '') {
        choiceDivs[buttonIndex].classList.remove('hidden')
        choiceDivs[buttonIndex].innerHTML += `
        <div class="w-[47%]">
            <div class="flex items-center justify-between w-full border-2 rounded-md my-2 py-3 px-3">
                <p>${choiceText}</p>
                <p>${trueOrFalse}</p>
                <input hidden type="text" name="choices[]" value="${choice}"> 
            </div>
        </div>
                                        `
        Bloc.classList.add("hidden");
    } else {
        if (choiceText.trim() === '') choiceInput.classList.add("border-red-500")
        else choiceInput.classList.remove("border-red-500")

        if (trueOrFalse.trim() === '') trueOrFalseInput.classList.add("border-red-500")
        else trueOrFalseInput.classList.remove("border-red-500")
    }

});


let closeButton = document.querySelector("#closebutton");

closeButton.addEventListener('click', () => {
    Bloc.classList.add("hidden")
    choiceInput.value = ''
    choiceInput.classList.remove("border-red-500")
    trueOrFalseInput.value = ''
    trueOrFalseInput.classList.remove("border-red-500")
})

