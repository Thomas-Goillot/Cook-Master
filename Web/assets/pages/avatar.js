/*
 * Created on Mon Apr 21 2022
 *
 * Copyright (c) 2022 Thomas GOILLOT
 */
function avatar_items_list(e, id) {
  const nav_list = document.querySelectorAll(".nav-list");
  const items_list = document.querySelectorAll(".items");

  nav_list.forEach((item) => item.classList.remove("active"));
  e.classList.add("active");

  items_list.forEach((item) => item.classList.add("hide"));
  document.getElementById(id).classList.remove("hide");
  document.getElementById(id).classList.add("show");
}

function change_item(e) {
  const parent = e.parentNode;
  const img = parent.querySelector("img");
  const id = img.dataset.id;
  const src = img.src;

  switch (id) {
    case "head":
      document.getElementById("head").src = src;
      break;
    case "eyes":
      document.getElementById("eyes").src = src;
      break;
    case "mouth":
      document.getElementById("mouth").src = src;
      break;
    case "nose":
      document.getElementById("nose").src = src;
      break;
    case "brows":
      document.getElementById("brows").src = src;
      break;
    default:
      break;
  }
}

function random_avatar() {
  const request = new XMLHttpRequest();

  request.open("GET", "../avatar/random");

  request.onreadystatechange = function () {
    if (request.readyState === 4) {
      document.getElementById("avatar_preview").innerHTML =
        request.responseText;
    }
  };

  request.send();
}

function save_avatar() {
  const head = document.getElementById("head").src;
  const eyes = document.getElementById("eyes").src;
  const mouth = document.getElementById("mouth").src;
  const nose = document.getElementById("nose").src;
  const brows = document.getElementById("brows").src;
  const request = new XMLHttpRequest();

  const params = {
    head: head,
    eyes: eyes,
    mouth: mouth,
    nose: nose,
    brows: brows,
  };

  request.open("POST", "../avatar/saveAvatar");

  request.onreadystatechange = function () {
    if (request.readyState === 4) {
      const text = request.responseText;
      const response = JSON.parse(text);
      if (response.type === "success") {
        sendAlert(response.title, response.message, response.type);
      } else {
        sendAlert(response.title, response.message, response.type);
      }
    }
  };

  request.setRequestHeader("Content-Type", "application/json");
  request.send(JSON.stringify(params));
}