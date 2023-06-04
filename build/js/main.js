"use strict";

//* Check if user is logged in
const userName = document.getElementById("userName");
const checkIfUserLoggedIn = () => {
  if (userName.textContent === "Guest") return false;
  return true;
};

//* Filter Checkboxes
const checkBoxes = document.querySelectorAll("#checkBox");
checkBoxes.forEach((checkBox) => {
  checkBox.addEventListener("click", () => {
    checkBox.classList.toggle("checkedBox");
  });
});

//* Heart icons
const addToFavorites = document.querySelectorAll("#addToFav");
addToFavorites.forEach((heart) => {
  heart.addEventListener("click", () => {
    if (checkIfUserLoggedIn()) {
      heart.classList.contains("fa-regular")
        ? (heart.className =
            "fa-solid fa-heart  cursor-pointer text-lg text-red-300")
        : (heart.className =
            "fa-regular fa-heart  cursor-pointer text-lg text-grey-600");
    } else {
      window.location.href = "authentication/login.php";
    }
  });
});

//* Show and hide aside and dropdown and sidebar
const aside = document.querySelector("aside");
const filterBtn = document.getElementById("filterBtn");
const dropDownBtn = document.getElementById("dropDownBtn");
const dropDown = document.getElementById("dropDown");
const sideBar = document.getElementById("sideBar");
const sideBarOpenBtn = document.getElementById("sideBarOpenBtn");
const showAndHideElement = (element, elementBtn) => {
  elementBtn?.addEventListener("click", () => {
    element.classList.toggle("show");
    elementBtn === dropDownBtn && dropDownBtn.classList.toggle("rotate-180");
    elementBtn === sideBarOpenBtn && dropDownBtn.classList.remove("rotate-180");
  });

  document.addEventListener("click", (e) => {
    if (
      ![element, elementBtn].includes(e.target) &&
      !element.contains(e.target)
    ) {
      element.classList.remove("show");
      element === sideBar && dropDownBtn.classList.remove("rotate-180");
    }
  });
};
showAndHideElement(aside, filterBtn);
showAndHideElement(dropDown, dropDownBtn);
showAndHideElement(sideBar, sideBarOpenBtn);

//* Keep track of the media query to know when to change the dropdown position
const headerDropDownParent = document.getElementById("headerDropDownParent");
const sideBarDropDownParent = document.getElementById("sideBarDropDownParent");
const mediaQuery = window.matchMedia("(max-width: 768px)");
const handleMediaQueryChange = (e) => {
  const drDpaClasses = ["justify-between", "flex-row-reverse"];
  if (e.matches) {
    dropDown.className =
      "absolute bottom-14 left-1/2 -z-10 h-0 w-52 -translate-x-1/2 overflow-hidden rounded-xl bg-white p-0 transition-all duration-500";
    dropDown.parentElement.classList.add(...drDpaClasses);
    dropDown.parentElement.classList.remove("max-md:hidden");
    dropDownBtn.classList.remove("fa-chevron-down");
    dropDownBtn.classList.add("fa-chevron-up");
    sideBarDropDownParent.appendChild(dropDown.parentElement);
    headerDropDownParent.contains(dropDown) &&
      headerDropDownParent.removeChild(dropDown.parentElement);
  } else {
    dropDown.className =
      "absolute right-0 top-[3.3rem] -z-10 h-0 w-52 overflow-hidden rounded-xl bg-white p-0 transition-all duration-500";
    headerDropDownParent.appendChild(dropDown.parentElement);
    dropDown.parentElement.classList.remove(...drDpaClasses);
    dropDownBtn.classList.remove("fa-chevron-up");
    dropDownBtn.classList.add("fa-chevron-down");
    dropDown.parentElement.classList.add("max-md:hidden");
    sideBarDropDownParent.contains(dropDown) &&
      sideBarDropDownParent.removeChild(dropDown.parentElement);
  }
};
mediaQuery.addEventListener("change", handleMediaQueryChange);
// Initial check
handleMediaQueryChange(mediaQuery);

//* Get the filters
let type = [];
const capacity = [];

aside.addEventListener("click", (e) => {
  if (e.target.closest("#checkBox")) {
    const filterEl = e.target
      .closest("#checkBox")
      .nextElementSibling.innerText.split(" (")[0];

    e.target.closest("#checkBox").nextElementSibling.parentElement.parentElement
      .id == "filterByType"
      ? type.includes(filterEl)
        ? type.pop(filterEl)
        : type.push(filterEl)
      : capacity.includes(filterEl)
      ? capacity.pop(filterEl)
      : capacity.push(filterEl);

    console.log(type);
    console.log(capacity);
  }
});

//* Send the search query to search.php and display results
document
  .getElementById("search_input")
  .addEventListener("keyup", function (event) {
    // event.preventDefault(); // Prevent form submission

    const searchQuery = this.value;
    const data = {
      query: searchQuery,
      type,
      capacity,
    };
    // Perform AJAX request
    fetch("search.php", {
      method: "POST",
      headers: {
        "Content-type": "application/x-www-form-urlencoded",
      },
      body: JSON.stringify(data),
    })
      .then(function (response) {
        return response.text();
      })
      .then(function (data) {
        document.getElementById("search_results").innerHTML = data;
      })
      .catch(function (error) {
        console.log("An error occurred while processing the search.", error);
      });
  });
