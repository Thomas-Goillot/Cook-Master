const checkbox = document.getElementById("price_display");
const priceDiv = document.getElementById("price");
const priceDefault = document.getElementById("price_default");

const checkbox_rent = document.getElementById("rent_display");
const rentDiv = document.getElementById("rent");
const rentDefault = document.getElementById("rent_default");

priceDiv.style.display = "none";

rentDiv.style.display = "none";

window.onload = function () {

    if (checkbox.checked) {
        priceDiv.style.display = "block";
    } else {
        priceDiv.style.display = "none";
        priceDefault.value = "0";
    }
    
    if (checkbox_rent.checked) {
        rentDiv.style.display = "block";
    } else {
        rentDiv.style.display = "none";
        rentDefault.value = "0";
    }
}

checkbox.addEventListener("change", function () {
  if (checkbox.checked) {
    priceDiv.style.display = "block";
  } else {
    priceDiv.style.display = "none";
    priceDefault.value = "0";
  }
});

checkbox_rent.addEventListener("change", function () {
  if (checkbox_rent.checked) {
    rentDiv.style.display = "block";
  } else {
    rentDiv.style.display = "none";
    rentDefault.value = "0";
  }
});
