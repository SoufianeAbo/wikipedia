const loginForms = document.querySelectorAll(".loginForm");
const registerForms = document.querySelectorAll(".registerForm");

const loginBtn = document.getElementById("LoginBtn");
const registerBtn = document.getElementById("RegisterBtn");

const submitBtn = document.getElementById("submitBtn");

function makeRegisterHidden() {
    loginForms.forEach((form) => {
        form.classList.remove("hidden");
    });

    registerForms.forEach((form) => {
        form.classList.add("hidden");
    })

    submitBtn.innerHTML = "Login";
}

function makeLoginHidden() {
    registerForms.forEach((form) => {
        form.classList.remove("hidden");
    })

    loginForms.forEach((form) => {
        form.classList.add("hidden");
    });

    submitBtn.innerHMTL = "Register";
}

loginBtn.addEventListener("click", makeLoginHidden);
registerBtn.addEventListener("click", makeRegisterHidden);