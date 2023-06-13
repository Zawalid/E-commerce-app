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

//* Show and hide aside and dropdown and sidebar
const aside = document.querySelector("aside");
const filterBtn = document.getElementById("filterBtn");
const dropDownBtn = document.getElementById("dropDownBtn");
const dropDown = document.getElementById("dropDown");
const sideBar = document.getElementById("sideBar");
const sideBarOpenBtn = document.getElementById("sideBarOpenBtn");
const showCart = document.getElementById("cart_toggler");
const cart = document.getElementById("cart");
const showAndHideElement = (element, elementBtn) => {
  elementBtn?.addEventListener("click", () => {
    if (element === cart) {
      if (checkIfUserLoggedIn()) {
        element.classList.toggle("show");
        removeFromCart(document.querySelectorAll("#removeFromCart"));
      } else {
        window.location.href = "authentication/login.php";
      }
    } else element.classList.toggle("show");
    elementBtn === dropDownBtn && dropDownBtn.classList.toggle("rotate-180");
    elementBtn === sideBarOpenBtn && dropDownBtn.classList.remove("rotate-180");
  });

  document.addEventListener("click", (e) => {
    if (
      ![element, elementBtn].includes(e.target) &&
      !element.contains(e.target) &&
      !e.target.classList.contains("fa-trash-can") &&
      e.target.id !== "close_cart"
    ) {
      element.classList.remove("show");
      element === sideBar && dropDownBtn.classList.remove("rotate-180");
    }
  });
};
showAndHideElement(aside, filterBtn);
showAndHideElement(dropDown, dropDownBtn);
showAndHideElement(sideBar, sideBarOpenBtn);
showAndHideElement(cart, showCart);

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
      "absolute right-0 top-[3.3rem] -z-10 h-0 w-52 overflow-hidden  rounded-xl bg-white p-0 transition-all duration-500";
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
  // Send search query using AJAX
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
      addToCart();
      showProductView();
      toggleLayer();
    })
    .catch(function (error) {
      console.log("An error occurred while processing the search.", error);
    });
}
document.getElementById("search_input").addEventListener("keyup", search);
document.getElementById("search_button").addEventListener("click", search);

//* Add to Cart
const addToCart = () => {
  document.querySelectorAll("#addToCart").forEach((button) => {
    button.addEventListener("click", () => {
      if (checkIfUserLoggedIn()) {
        const carName = button.parentElement.previousElementSibling.textContent;
        // Send car name using AJAX
        fetch("addToCart.php", {
          method: "POST",
          headers: {
            "Content-type": "application/x-www-form-urlencoded",
          },
          body: `carNameToAdd=${carName}`,
        })
          .then(function (response) {
            return response.json();
          })
          .then(function (data) {
            document.getElementById("cart_products").innerHTML = data.cars;
            document.getElementById("cart_count").dataset.cart = data.count;
            cart.querySelector("button").classList.contains("hidden") &&
              cart.querySelector("button").classList.remove("hidden");
          })
          .catch(function (error) {
            console.log(
              "An error occurred while processing the search.",
              error
            );
          });
        // Change the icon

        try {
          if (button.classList.contains("fa-cart-plus")) {
            button.className =
              "fa-solid fa-check cursor-pointer text-lg text-white";
            button.parentElement.classList.remove("bg-grey-500");
            button.parentElement.classList.add("bg-green-500");
            document.getElementById("cart_toggler").dataset.cart++;
          }
          setTimeout(() => {
            button.className =
              "fa-solid fa-cart-plus  cursor-pointer text-lg text-white";
            button.parentElement.classList.remove("bg-green-500");
            button.parentElement.classList.add("bg-grey-500");
            document.getElementById("cart_toggler").dataset.cart--;
          }, 1200);
        } catch (error) {}
      } else {
        window.location.href = "authentication/login.php";
      }
    });
  });
};
addToCart();

//* Remove from Cart
const removeFromCart = (buttons) => {
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      const carName = button.parentElement.querySelector("h5").textContent;
      button.parentElement.remove();
      fetch("addToCart.php", {
        method: "POST",
        headers: {
          "Content-type": "application/x-www-form-urlencoded",
        },
        body: `carNameToRemove=${carName}`,
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (data) {
          data.count === 0 &&
            cart.querySelector("button").classList.add("hidden");
          document.getElementById("cart_products").innerHTML = data.cars;
          document.getElementById("cart_count").dataset.cart = data.count;
          removeFromCart(document.querySelectorAll("#removeFromCart"));
        })
        .catch(function (error) {
          console.log("An error occurred while removing an item.", error);
        });
    });
  });
};

//* CLose cart
document.getElementById("close_cart").addEventListener("click", () => {
  cart.classList.remove("show");
});

//* Check if cart is full and show the checkout button
if (document.getElementById("cart_count").dataset.cart !== "0") {
  cart.querySelector("button").classList.remove("hidden");
}

//* Show Product view
const productView = document.getElementById("product_view");
const productQuantity = productView.querySelector("#product_quantity");
const plusBtn = productQuantity.querySelector(".fa-plus");
const minusBtn = productQuantity.querySelector(".fa-minus");
const quantity = productQuantity.querySelector("span");

const showProductView = () => {
  [...document.getElementById("search_results").children].forEach((product) => {
    product
      .querySelector("#show_product_view")
      .addEventListener("click", () => {
        productView.querySelector("img").src = product.querySelector("img").src;

        productView.querySelector("#name").textContent =
          product.querySelector(".carName").innerText;

        productView.querySelector("#price").textContent =
          product.querySelector(".carPrice").innerText;

        productView.querySelector("#type").textContent =
          product.querySelector(".carType").innerText;

        productView.querySelector("#capacity").textContent = `${
          product.querySelector(".carCapacity").innerText
        } Seats`;

        productView.querySelector("#recommendation").textContent = `${
          product.querySelector(".carRec").innerText
        }%`;

        productView.querySelector("#gear_shift").textContent =
          product.querySelector(".carGearShift").innerText;

        window.scrollTo(0, document.body.scrollHeight);

        quantity.textContent = 1;

        productView.classList.add("show");
      });
  });
};
showProductView();

//* Close product view
document.getElementById("close_product_view").addEventListener("click", () => {
  productView.classList.remove("show");
});
productView.addEventListener(
  "click",
  (e) => e.target === e.currentTarget && productView.classList.remove("show")
);

//* Product quantity
plusBtn.addEventListener(
  "click",
  () => (quantity.textContent = +quantity.textContent + 1)
);
minusBtn.addEventListener("click", () => {
  quantity.textContent = +quantity.textContent - 1;
  if (+quantity.textContent < 1) quantity.textContent = 1;
});

//* Add to cart from product view
productView.querySelector("button").addEventListener("click", function () {
  if (checkIfUserLoggedIn()) {
    const carName = productView.querySelector("#name").textContent;
    const button = this;
    const request = {
      carName,
      quantity: quantity.textContent,
    };
    // Send car name using AJAX
    fetch("addToCart.php", {
      method: "POST",
      headers: {
        "Content-type": "application/x-www-form-urlencoded",
      },
      body: JSON.stringify(request),
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        console.log(data);
        button.innerHTML =
          "<i class='fa-solid fa-check mr-2 text-lg text-white'></i> Added";
        setTimeout(() => {
          button.innerHTML =
            "<i class='fa-solid fa-cart-plus mr-2 text-lg text-white'></i> Add to Cart";
        }, 1500);

        document.getElementById("cart_products").innerHTML = data.cars;
        document.getElementById("cart_count").dataset.cart = data.count;
        cart.querySelector("button").classList.contains("hidden") &&
          cart.querySelector("button").classList.remove("hidden");
      })
      .catch(function (error) {
        console.log("An error occurred while processing the search.", error);
      });
  } else {
    window.location.href = "authentication/login.php";
  }
});

//* Toggle Product layer
const toggleLayer = () => {
  const products = [...document.getElementById("search_results").children];

  // SHow the layer when hover on a product
  products.forEach((product) => {
    product.addEventListener("mouseover", () => {
      product.querySelector("#layer").classList.remove("opacity-0");
    });
  });
  // Hide the layer when leaving
  products.forEach((product) => {
    product.addEventListener("mouseleave", () => {
      product.querySelector("#layer").classList.add("opacity-0");
    });
  });
};
toggleLayer();
