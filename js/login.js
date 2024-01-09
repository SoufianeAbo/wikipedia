const loginForms = document.querySelectorAll(".loginForm");
const registerForms = document.querySelectorAll(".registerForm");

const loginBtn = document.getElementById("LoginBtn");
const registerBtn = document.getElementById("RegisterBtn");

function makeRegisterHidden() {
    loginForms.forEach((form) => {
        form.classList.remove("hidden");
    });

    registerForms.forEach((form) => {
        form.classList.add("hidden");
    })
}

function makeLoginHidden() {
    registerForms.forEach((form) => {
        form.classList.remove("hidden");
    })

    loginForms.forEach((form) => {
        form.classList.add("hidden");
    });
}

loginBtn.addEventListener("click", makeLoginHidden);
registerBtn.addEventListener("click", makeRegisterHidden);