const form = document.querySelector("#myForm");
const nomInput = document.querySelector("#nom");
const prenomInput = document.querySelector("#prenom");
const telephoneInput = document.querySelector("#telephone");
const adresseInput = document.querySelector("#adresse");
const DateNaissanceInput = document.querySelector("#DateNaissance");
const classeInput = document.querySelector("#id_classe");
const genreInput = document.querySelector("#genre");
const nomErrorInput = document.querySelector("#nom_error");
const prenom_errorInput = document.querySelector("#prenom_error");
const telephone_errorInput = document.querySelector("#telephone_error");
const adresse_errorInput = document.querySelector("#adresse_error");
const DateNaissance_errorInput = document.querySelector("#DateNaissance_error");
const classe_errorInput = document.querySelector("#id_classe_error");
const genre_errorInput = document.querySelector("#genre_error");

const nomRegex = /^[a-zA-Z]{3,25}(\s[a-zA-Z]+)?$/;
const prenomRegex = /^[a-zA-Z]{2,25}(\s[a-zA-Z]+)?$/;
const telephoneRegex = /^[2-4]\d{7}$/;
const DateNaissanceRegex =/^(199[5-9]|200\d|201[0-7])-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/;
const adresseRegex = /^[a-zA-Z0-9\s\-\',.#]+$/;

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
            "Veuillez entrer un numéro de téléphone valide qui commence par 2, 3 ou 4 (8 chiffres).";
        return false;
    } else {
        telephoneInput.classList.remove("is-invalid");
        telephoneInput.classList.add("is-valid");
        telephone_errorInput.style.display = "none";
        return true;
    }
}

function validateAdresse() {
    if (!adresseRegex.test(adresseInput.value)) {
        adresseInput.classList.add("is-invalid");
        adresseInput.classList.remove("is-valid");
        adresse_errorInput.style.display = "block";
        adresse_errorInput.textContent = "Veuillez entrer une adresse.";
        return false;
    } else {
        adresseInput.classList.remove("is-invalid");
        adresseInput.classList.add("is-valid");
        adresse_errorInput.style.display = "none";
        return true;
    }
}

function validateDateNaissance() {
    if (!DateNaissanceRegex.test(DateNaissanceInput.value)) {
        DateNaissanceInput.classList.add("is-invalid");
        DateNaissanceInput.classList.remove("is-valid");
        DateNaissance_errorInput.style.display = "block";
        DateNaissance_errorInput.textContent =
            "Veuillez entrer une date de naissance valide.";
        return false;
    } else {
        DateNaissanceInput.classList.remove("is-invalid");
        DateNaissanceInput.classList.add("is-valid");
        DateNaissance_errorInput.style.display = "none";
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

function validateGenre() {
    if (genreInput.value === "") {
        genreInput.classList.add("is-invalid");
        genreInput.classList.remove("is-valid");
        genre_errorInput.style.display = "block";
        genre_errorInput.textContent = "Veuillez choisir un genre.";
        return false;
    } else {
        genreInput.classList.remove("is-invalid");
        genreInput.classList.add("is-valid");
        genre_errorInput.style.display = "none";
        return true;
    }
}

nomInput.addEventListener("input", validateNom);
prenomInput.addEventListener("input", validatePrenom);
telephoneInput.addEventListener("input", validateTelephone);
adresseInput.addEventListener("input", validateAdresse);
DateNaissanceInput.addEventListener("input", validateDateNaissance);
classeInput.addEventListener("input", validateClasse);
genreInput.addEventListener("input", validateGenre);

form.addEventListener("submit", function (event) {
    event.preventDefault();

    if (
        validateNom() &&
        validatePrenom() &&
        validateTelephone() &&
        validateAdresse() &&
        validateDateNaissance() &&
        validateClasse() &&
        validateGenre()
    ) {
        form.submit();
    }
});
