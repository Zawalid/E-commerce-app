"use strict";

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

const forgotPassword = document.getElementById("forgot_password");
const forgotPasswordModal = document.getElementById("forgot_password_modal");

if (window.location.pathname === "/Project/build/authentication/login.php") {
  forgotPassword.addEventListener("click", () => {
    forgotPasswordModal.classList.add("show");
  });
  forgotPasswordModal.querySelector("button").addEventListener("click", () => {
    forgotPasswordModal.classList.remove("show");
  });
}
if (window.location.pathname === "/Project/build/authentication/signUp.php") {
  const passwordInput = document.querySelector("[name='password']");
  const passwordValidation = document.getElementById("password_validation");
  const charsLongValidation = document.getElementById("chars_long_validation");
  const specialCharsValidation = document.getElementById(
    "special_chars_validation"
  );
  const numbersValidation = document.getElementById("numbers_validation");
  const uppercaseValidation = document.getElementById("uppercase_validation");
  const lowercaseValidation = document.getElementById("lowercase_validation");
  const checked = "fa-solid fa-check-circle text-green-500  mr-3";
  const unchecked = "fa-regular fa-check-circle text-red-300 mr-3";
  console.log(charsLongValidation);
  passwordInput.addEventListener("input", function () {
    function validatePassword(condition, icon) {
      if (condition) {
        icon.className = checked;
      } else {
        icon.className = unchecked;
      }
    }
    validatePassword(this.value.length >= 8, charsLongValidation);
    validatePassword(this.value.match(/[^a-zA-Z0-9]/g), specialCharsValidation);
    validatePassword(this.value.match(/[0-9]/g), numbersValidation);
    validatePassword(this.value.match(/[A-Z]/g), uppercaseValidation);
    validatePassword(this.value.match(/[a-z]/g), lowercaseValidation);
    document.forms[0].addEventListener("submit", (e) => {
      if (
        charsLongValidation.className === unchecked ||
        specialCharsValidation.className === unchecked ||
        numbersValidation.className === unchecked ||
        uppercaseValidation.className === unchecked ||
        lowercaseValidation.className === unchecked
      ) {
        e.preventDefault();
      }
    });
  });
}

