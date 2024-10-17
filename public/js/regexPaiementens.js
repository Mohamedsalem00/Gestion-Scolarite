const form = document.querySelector("#myPay");
        const typepaiementInput = document.querySelector("#typepaiement");
        const typepaiement_errorInput = document.querySelector("#typepaiement_error");

        function validateTypepaiement() {
    if (typepaiementInput.value === "") {
        typepaiementInput.classList.add("is-invalid");
        typepaiementInput.classList.remove("is-valid");
        typepaiement_errorInput.style.display = "block";
        typepaiement_errorInput.textContent = "Veuillez choisir un genre.";
        return false;
    } else {
        typepaiementInput.classList.remove("is-invalid");
        typepaiementInput.classList.add("is-valid");
        typepaiement_errorInput.style.display = "none";
        return true;
    }
}
typepaiementInput.addEventListener("input", validateTypepaiement);


        form.addEventListener("submit", function(event) {
            event.preventDefault();

            if (
                validateTypepaiement() 
            ) {
                // Submit the form
                form.submit();
            }
        });