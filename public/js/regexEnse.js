const form = document.querySelector("#myForm");
const nomInput = document.querySelector("#nom");
const prenomInput = document.querySelector("#prenom");
const telephoneInput = document.querySelector("#telephone");
const emailInput = document.querySelector("#email");
const classeInput = document.querySelector("#id_classe");
const matiereInput = document.querySelector("#matiere");
const nomErrorInput = document.querySelector("#nom_error");
const prenom_errorInput = document.querySelector("#prenom_error");
const telephone_errorInput = document.querySelector("#telephone_error");
const email_errorInput = document.querySelector("#email_error");
const classe_errorInput = document.querySelector("#id_classe_error");
const matiere_errorInput = document.querySelector("#matiere_error");

const nomRegex = /^[a-zA-Z]{3,25}(\s[a-zA-Z]+)?$/;
const prenomRegex = /^[a-zA-Z]{2,25}(\s[a-zA-Z]+)?$/;
const telephoneRegex = /^[2-4]\d{7}$/;
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

function validateNom() {
    if (!nomRegex.test(nomInput.value)) {
        nomInput.classList.add("is-invalid");
        nomInput.classList.remove("is-valid");
        nomErrorInput.style.display = "block";
        nomErrorInput.textContent = "Veuillez entrer un nom valide.";
        return false;
    } else {
        nomInput.classList.remove("is-invalid");
        nomInput.classList.add("is-valid");
        nomErrorInput.style.display = "none";
        return true;
    }
}

function validatePrenom() {
    if (!prenomRegex.test(prenomInput.value)) {
        prenomInput.classList.add("is-invalid");
        prenomInput.classList.remove("is-valid");
        prenom_errorInput.style.display = "block";
        prenom_errorInput.textContent = "Veuillez entrer un prénom valide.";
        return false;
    } else {
        prenomInput.classList.remove("is-invalid");
        prenomInput.classList.add("is-valid");
        prenom_errorInput.style.display = "none";
        return true;
    }
}

function validateTelephone() {
    if (!telephoneRegex.test(telephoneInput.value)) {
        telephoneInput.classList.add("is-invalid");
        telephoneInput.classList.remove("is-valid");
        telephone_errorInput.style.display = "block";
        telephone_errorInput.textContent =
            "Veuillez entrer un numéro de téléphone valide qui commence par 2, 3 ou 4 (8 chiffres)."
        return false;
    } else {
        telephoneInput.classList.remove("is-invalid");
        telephoneInput.classList.add("is-valid");
        telephone_errorInput.style.display = "none";
        return true;
    }
}

function validateEmail() {
    if (!emailRegex.test(emailInput.value)) {
        emailInput.classList.add("is-invalid");
        emailInput.classList.remove("is-valid");
        email_errorInput.style.display = "block";
        email_errorInput.textContent = "Veuillez entrer une email valide.";
        return false;
    } else {
        emailInput.classList.remove("is-invalid");
        emailInput.classList.add("is-valid");
        email_errorInput.style.display = "none";
        return true;
    }
}


function validateClasse() {
    if (classeInput.value === "") {
        classeInput.classList.add("is-invalid");
        classeInput.classList.remove("is-valid");
        classe_errorInput.style.display = "block";
        classe_errorInput.textContent = "Veuillez choisir une classe.";
        return false;
    } else {
        classeInput.classList.remove("is-invalid");
        classeInput.classList.add("is-valid");
        classe_errorInput.style.display = "none";
        return true;
    }
}

function validateMatiere() {
    if (matiereInput.value === "") {
        matiereInput.classList.add("is-invalid");
        matiereInput.classList.remove("is-valid");
        matiere_errorInput.style.display = "block";
        matiere_errorInput.textContent = "Veuillez choisir un matiere.";
        return false;
    } else {
        matiereInput.classList.remove("is-invalid");
        matiereInput.classList.add("is-valid");
        matiere_errorInput.style.display = "none";
        return true;
    }
}

nomInput.addEventListener("input", validateNom);
prenomInput.addEventListener("input", validatePrenom);
telephoneInput.addEventListener("input", validateTelephone);
emailInput.addEventListener("input", validateEmail);
classeInput.addEventListener("input", validateClasse);
matiereInput.addEventListener("input", validateMatiere);

form.addEventListener("submit", function (event) {
    event.preventDefault();

    if (
        validateNom() &&
        validatePrenom() &&
        validateTelephone() &&
        validateEmail() &&
        validateClasse() &&
        validateMatiere()
    ) {
        form.submit();
    }
});




