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

//* Add to cart
const addToCart = (buttons) => {
  buttons.forEach((cart) => {
    cart.addEventListener("click", () => {
      if (checkIfUserLoggedIn()) {
        cart.classList.contains("fa-cart-plus")
          ? (cart.className =
              "fa-solid fa-check cursor-pointer text-lg text-white")(
              cart.parentElement.classList.remove("bg-grey-500"),
              cart.parentElement.classList.add("bg-green-500"),
              document.getElementById("cart_toggler").dataset.cart++
            )
          : (cart.className =
              "fa-solid fa-cart-plus  cursor-pointer text-lg text-white")(
              cart.parentElement.classList.remove("bg-green-500"),
              cart.parentElement.classList.add("bg-grey-500"),
              document.getElementById("cart_toggler").dataset.cart--
            );
      } else {
        window.location.href = "authentication/login.php";
      }
    });
  });
};
addToCart(document.querySelectorAll("#addToCart"));

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
const type = [];
const capacity = [];
const customRecommendation = [];

aside.addEventListener("click", (e) => {
  if (e.target.closest("#checkBox")) {
    const filterEl = e.target
      .closest("#checkBox")
      .nextElementSibling.innerText.split(" (")[0];
    e.target.closest("#checkBox").nextElementSibling.parentElement.parentElement
      .id == "filterByType"
      ? type.includes(filterEl)
        ? type.splice(type.indexOf(filterEl), 1)
        : type.push(filterEl)
      : e.target.closest("#checkBox").nextElementSibling.parentElement
          .parentElement.id == "filterByCapacity"
      ? capacity.includes(filterEl)
        ? capacity.splice(capacity.indexOf(filterEl), 1)
        : capacity.push(filterEl)
      : customRecommendation.includes(filterEl)
      ? customRecommendation.splice(customRecommendation.indexOf(filterEl), 1)
      : customRecommendation.push(filterEl);

    console.log(type);
    console.log(capacity);
    console.log(customRecommendation);
  }
});

//* Send the search query to search.php and display results

function search() {
  let searchQuery = document.getElementById("search_input").value;
  const data = {
    query: searchQuery,
    type,
    capacity,
    customRecommendation,
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
      document.getElementById("search_results").scrollTop = 0;
      addToCart(document.querySelectorAll("#addToCart"));
    })
    .catch(function (error) {
      console.log("An error occurred while processing the search.", error);
    });
}
document.getElementById("search_input").addEventListener("keyup", search);
document.getElementById("search_button").addEventListener("click", search);
