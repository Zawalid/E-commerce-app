"use strict";
const rememberMe = document.getElementById("rememberMe");
const illustration = document.getElementById("illustration");

rememberMe.addEventListener("click", () =>
  rememberMe.classList.toggle("checkedRememberMe")
);

//* Show password
const showPassword = () => {
  const showPasswordButtons = document.querySelectorAll(
    "input ~ #show_password "
  );
  showPasswordButtons.forEach((button) => {
    const input = button.previousElementSibling;
    button.addEventListener("click", () => {
      if (input.type == "password" && input.value != "") {
        input.type = "text";
        button.className = "fa-solid fa-eye-slash showPasswordIcon";
      } else {
        input.type = "password";
        button.className = "fa-solid fa-eye showPasswordIcon";
      }
    });
    document.addEventListener("click", (e) => {
      if (
        !input.contains(e.target) &&
        !button.contains(e.target) &&
        input.type == "text"
      ) {
        input.type = "password";
        button.className = "fa-solid fa-eye showPasswordIcon";
      }
    });
  });
};
showPassword();
console.log(777);