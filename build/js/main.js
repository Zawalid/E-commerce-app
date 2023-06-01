"use strict";
//* Checkboxes
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
    heart.classList.contains("fa-regular")
      ? (heart.className =
          "fa-solid fa-heart  cursor-pointer text-lg text-red-300")
      : (heart.className =
          "fa-regular fa-heart  cursor-pointer text-lg text-grey-600");
  });
});
//* Show and hide aside and dropdown
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

const headerDropDownParent = document.getElementById("headerDropDownParent");
const sideBarDropDownParent = document.getElementById("sideBarDropDownParent");

const mediaQuery = window.matchMedia("(max-width: 768px)");

const handleTabletChange = (e) => {
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

// Register event listener
mediaQuery.addEventListener("change", handleTabletChange);
// Initial check
handleTabletChange(mediaQuery);
