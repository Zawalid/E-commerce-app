"use strict";
//! Utility Functions

//* Check if user is logged in
const userName = document.getElementById("userName");
const checkIfUserLoggedIn = () => {
  if (userName.textContent === "Guest") return false;
  return true;
};

//* Get the uploaded image
const getUploadedImage = async (img) => {
  return new Promise((resolve) => {
    const reader = new FileReader();
    reader.addEventListener("load", (event) => {
      resolve(event.target.result);
    });
    reader.readAsDataURL(img);
  });
};

//* Preview the image
const previewImage = () => {
  uploadedImage.addEventListener("change", () => {
    try {
      if (!uploadedImage?.files[0].type.startsWith("image/")) {
        document.querySelector("#type_error").classList.remove("opacity-0");
        addAndEditCarModal.querySelector(
          "#image_preview"
        ).style.backgroundImage = "unset";
        return;
      } else {
        document.querySelector("#type_error").classList.add("opacity-0");
        addAndEditCarForm
          .querySelector("[name='Image']")
          .classList.remove("text-transparent");
        getUploadedImage(uploadedImage.files[0]).then((src) => {
          addAndEditCarModal.querySelector(
            "#image_preview"
          ).style.backgroundImage = `url(${src}`;
        });
      }
    } catch (err) {}
  });
};

//* Response actions after sending a request
const responseActions = (data) => {
  document.getElementById("search_results").innerHTML = data;
  showCarView();
};

//* Show error
const showError = (errorModal) => {
  errorModal.style.top = "0";
  setTimeout(() => {
    errorModal.style.top = "-70px";
  }, 3200);
};

//* Check for empty input fields
const checkForEmptyFields = (inputs) => {
  const emptyFieldsError = document.querySelector("#empty_fields");
  const fields = emptyFieldsError.querySelector("#fields");
  fields.textContent = "";
  const emptyFields = inputs.filter((input) => input.value == "");
  emptyFields.forEach((field) => {
    fields.textContent += `${field.name} ${
      emptyFields.length > 1 &&
      emptyFields.indexOf(field) != emptyFields.length - 1
        ? ", "
        : ""
    }`;
    field.classList.add("field_error");
    setTimeout(() => field.classList.remove("field_error"), 3200);
  });
  showError(emptyFieldsError);
};

//! Main Code

//* Filter Checkboxes
const checkBoxes = document.querySelectorAll("#checkBox");
checkBoxes.forEach((checkBox) => {
  checkBox.addEventListener("click", () => {
    checkBox.classList.toggle("checkedBox");
  });
});

//* Show and hide aside , dropdown , sidebar and cart
const aside = document.querySelector("aside");
const filterBtn = document.getElementById("filterBtn");
const dropDownBtn = document.getElementById("dropDownBtn");
const dropDown = document.getElementById("dropDown");
const sideBar = document.getElementById("sideBar");
const sideBarOpenBtn = document.getElementById("sideBarOpenBtn");
const showCart = document.getElementById("cart_toggler");
const cart = document.getElementById("cart");
const actions = document.getElementById("actions");
const actionsBtn = document.getElementById("actionsBtn");
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
      e.target.id !== "close_cart" &&
      !cart.contains(e.target)
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
showAndHideElement(actions, actionsBtn);

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
const transmission = [];
const price = [];
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
      : e.target.closest("#checkBox").nextElementSibling.parentElement
          .parentElement.id == "filterByRecommendation"
      ? customRecommendation.includes(filterEl)
        ? customRecommendation.splice(customRecommendation.indexOf(filterEl), 1)
        : customRecommendation.push(filterEl)
      : e.target.closest("#checkBox").nextElementSibling.parentElement
          .parentElement.id == "filterByTransmission"
      ? transmission.includes(filterEl)
        ? transmission.splice(transmission.indexOf(filterEl), 1)
        : transmission.push(filterEl)
      : price.includes(filterEl)
      ? price.splice(price.indexOf(filterEl), 1)
      : price.push(filterEl);
  }
});

//* Send the search query to search.php and display results
function search() {
  let searchQuery = document.getElementById("search_input").value;
  const data = {
    query: searchQuery,
    type,
    capacity,
    transmission,
    price,
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
      responseActions(data);
      document.getElementById("search_results").scrollTop = 0;
      addToCart();
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
            document.getElementById("cart_cars").innerHTML = data.cars;
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
          document.getElementById("cart_cars").innerHTML = data.cars;
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

//* Show car view
const carView = document.getElementById("car_view");
const carQuantity = carView.querySelector("#car_quantity");
const plusBtn = carQuantity.querySelector(".fa-plus");
const minusBtn = carQuantity.querySelector(".fa-minus");
const quantity = carQuantity.querySelector("span");
const carViewName = carView.querySelector("#name");
const carViewPrice = carView.querySelector("#price");
const carViewType = carView.querySelector("#type");
const carViewCapacity = carView.querySelector("#capacity");
const carViewRecommendation = carView.querySelector("#recommendation");
const carViewTransmission = carView.querySelector("#gear_shift");
const carViewImage = carView.querySelector("img");

const showCarView = () => {
  [...document.getElementById("search_results").children].forEach((car) => {
    car.querySelector("#show_car_view")?.addEventListener("click", () => {
      carViewImage.src = car.querySelector("img").src;

      carViewName.textContent = car.querySelector(".carName").innerText;

      carViewPrice.textContent = car.querySelector(".carPrice").innerText;

      carViewType.textContent = car.querySelector(".carType").innerText;

      carViewCapacity.textContent = `${
        car.querySelector(".carCapacity").innerText
      } Seats`;

      carViewRecommendation.textContent = `${
        car.querySelector(".carRec").innerText
      }%`;

      carViewTransmission.textContent =
        car.querySelector(".carTransmission").innerText;
      if (window.matchMedia("(max-width: 768px)").matches) {
        window.scrollTo(0, 0);
      }

      quantity.textContent = 1;

      carView.classList.add("show");
    });
  });
};
showCarView();

//* Close car view
document.getElementById("close_car_view").addEventListener("click", () => {
  carView.classList.remove("show");
});

//* car quantity
plusBtn.addEventListener("click", () => {
  quantity.textContent = +quantity.textContent + 1;
  if (+quantity.textContent > 100) quantity.textContent = 100;
});
minusBtn.addEventListener("click", () => {
  quantity.textContent = +quantity.textContent - 1;
  if (+quantity.textContent < 1) quantity.textContent = 1;
});

//* Add to cart from car view
carView.querySelector("button").addEventListener("click", function () {
  if (checkIfUserLoggedIn()) {
    const carName = carView.querySelector("#name").textContent;
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

        document.getElementById("cart_cars").innerHTML = data.cars;
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

//* car modal
const addAndEditCarModal = document.getElementById("add_edit_car_modal");
const addAndEditCarForm = addAndEditCarModal.querySelector("form");
const deleteCarModal = document.getElementById("delete_car_modal");
const addNewCarBtn = document.getElementById("add_new_car");
const editCarBtn = document.getElementById("edit_car");
const deleteCarBtn = document.getElementById("delete_car");
const uploadedImage = addAndEditCarForm.querySelector("[name='Image']");
const addAndEditCarCloseBtn = document.getElementById("close");

//* Add new car
addNewCarBtn.addEventListener("click", () => {
  // Change modal title and button text and
  addAndEditCarModal.querySelector("h2").textContent = "Add New Car";
  addAndEditCarModal.querySelector("button").innerHTML =
    "  <i class='fa-solid fa-circle-plus  mr-2 text-lg text-white'></i> Add";

  // Set the action to add
  addAndEditCarForm.querySelector("[name='action']").value = "add";

  // Reset the form
  addAndEditCarForm.reset();
  addAndEditCarModal.querySelector("#image_preview").style.backgroundImage =
    "unset";

  //  Show the 'No chosen file'
  addAndEditCarForm
    .querySelector("[name='Image']")
    .classList.remove("text-transparent");

  // Preview the image
  previewImage();

  // Show the modal
  addAndEditCarModal.classList.add("show");
});

//* Edit car
editCarBtn.addEventListener("click", () => {
  // Change modal title and button text and
  addAndEditCarModal.querySelector("h2").textContent = "Edit Car";
  addAndEditCarModal.querySelector("button").innerHTML =
    ' <i class="fa-solid fa-floppy-disk  mr-2 text-lg text-white"></i> Save';

  // Set the action to edit
  addAndEditCarForm.querySelector("[name='action']").value = "edit";

  // Set the values of the inputs
  addAndEditCarModal.querySelector(
    "#image_preview"
  ).style.backgroundImage = `url(${carViewImage.src}`;
  addAndEditCarForm.querySelector("[name='Name']").value =
    carViewName.textContent;
  addAndEditCarForm.querySelector("[name='Price']").value =
    +carViewPrice.textContent.replace(/[$,]/g, "");
  addAndEditCarForm.querySelector("[name='Type']").value =
    carViewType.textContent;
  addAndEditCarForm.querySelector("[name='Capacity']").value = parseInt(
    carViewCapacity.textContent
  );
  // Remove the checked from both and add it to the current
  addAndEditCarForm
    .querySelectorAll("[type='radio']")
    .forEach((radio) => radio.removeAttribute("checked"));
  addAndEditCarForm
    .querySelector(`#${carViewTransmission.textContent}`)
    .setAttribute("checked", "checked");
  // Hide the 'No chosen file'
  addAndEditCarForm
    .querySelector("[name='Image']")
    .classList.add("text-transparent");
  // Set the value as the title attribute
  addAndEditCarForm
    .querySelector("[name='Capacity']")
    .setAttribute("title", parseInt(carViewCapacity.textContent));
  // Preview the image
  previewImage();
  // Show modal
  addAndEditCarModal.classList.add("show");
});

//* Delete car
deleteCarBtn.addEventListener("click", () => {
  actions.classList.remove("show");
  deleteCarModal.classList.add("show");
});
deleteCarModal.querySelector("#yes_button").addEventListener("click", () => {
  fetch("adminPrivileges.php", {
    method: "DELETE",
    body: JSON.stringify({ carName: carViewName.textContent }),
  })
    .then(function (response) {
      return response.text();
    })
    .then((data) => {
      responseActions(data);
    })
    .catch(function (error) {
      console.log("An error occurred while processing the request ", error);
    });
  [deleteCarModal, carView].forEach((element) => {
    element.classList.remove("show");
  });
});
deleteCarModal.querySelector("#no_button").addEventListener("click", () => {
  deleteCarModal.classList.remove("show");
});

//* Send the form data to adminPrivileges.php
addAndEditCarForm.addEventListener("submit", function (e) {
  e.preventDefault();
  const sendFormData = (func) => {
    const inputs = [...this.querySelectorAll("input")];
    addAndEditCarModal.querySelector("#image_preview").style.backgroundImage !==
      "unset" && inputs.pop();
    if (inputs.some((input) => input.value == "")) {
      checkForEmptyFields(inputs);
    } else if (
      addAndEditCarModal.querySelector("#image_preview").style
        .backgroundImage === "unset"
    ) {
      if (!uploadedImage.files[0].type.startsWith("image/")) {
        document.querySelector("#type_error").classList.remove("opacity-0");
        addAndEditCarModal.querySelector(
          "#image_preview"
        ).style.backgroundImage = "unset";
      }
    } else {
      const data = new FormData(this);
      this.querySelector("[name='action']").value === "edit" &&
        data.append("carName", carViewName.textContent);
      fetch("adminPrivileges.php", {
        method: "POST",
        body: data,
      })
        .then(function (response) {
          return response.text();
        })
        .then((data) => {
          func(data);
        })
        .catch(function (error) {
          console.log("An error occurred while processing the request ", error);
        });
    }
  };
  if (this.querySelector("[name='action']").value === "add") {
    sendFormData((data) => {
      if (data === "already exist") {
        // search();
        document.getElementById("car_already_exists").classList.add("show");
      } else {
        responseActions(data);
        addAndEditCarModal.classList.remove("show");
      }
    });
  } else if (this.querySelector("[name='action']").value === "edit") {
    sendFormData((data) => {
      responseActions(data);
      // Update the cart
      addToCart();

      // Update the car view
      const newData = new FormData(this);
      carViewName.textContent = newData.get("Name");
      carViewPrice.textContent = `$${newData.get("Price")}`;
      carViewType.textContent = newData.get("Type");
      carViewCapacity.textContent = `${newData.get("Capacity")} Seats`;
      carViewTransmission.textContent = newData.get("Transmission");
      carViewImage.src = addAndEditCarModal
        .querySelector("#image_preview")
        .style.backgroundImage.slice(5, -2);
      // Close the form
      setTimeout(() => {
        addAndEditCarModal.classList.remove("show");
      }, 700);
    });
  }
});

//* Set the little box text content to the value of the range input
document.querySelector("[type='range']").addEventListener("input", function () {
  document.querySelector("#capacityValue").textContent = this.value;
});

//* Close the modal
addAndEditCarCloseBtn.addEventListener("click", () => {
  addAndEditCarModal.classList.remove("show");
});

//* Cars slider
const slide = document.getElementById("slide");
const slides = document.querySelectorAll(".slide_img");
let index = 0;
setInterval(() => {
  slide.src = slides[index].src;
  index === document.getElementById("search_results").children.length - 1
    ? (index = 0)
    : index++;
}, 3500);

//* Car already exists error
document
  .getElementById("car_already_exists")
  .querySelector("button")
  .addEventListener("click", () => {
    document.getElementById("car_already_exists").classList.remove("show");
  });
