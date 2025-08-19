const toSignup = document.getElementById("toSignup");
const toLogin = document.getElementById("toLogin");
const loginForm = document.querySelector(".login-form");
const signupForm = document.querySelector(".signup-form");
const tinta = document.getElementById("tinta");

function transicaoPara(formMostrar, formOcultar) {
  tinta.classList.add("active");

  setTimeout(() => {
    formOcultar.classList.remove("active");
    formMostrar.classList.add("active");
  }, 1000);

  setTimeout(() => {
    tinta.classList.remove("active");
  }, 1600);
}

toSignup.addEventListener("click", () => {
  transicaoPara(signupForm, loginForm);
});

toLogin.addEventListener("click", () => {
  transicaoPara(loginForm, signupForm);
});
