// Fonction pour charger le fichier JSON
function loadJSON(callback, language) {
  var xhr = new XMLHttpRequest();
  xhr.overrideMimeType("application/json");
  xhr.open("GET", "/lang/" + language + ".json", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      callback(JSON.parse(xhr.responseText));
    }
  };
  xhr.send(null);
}

// Fonction pour traduire un texte en fonction des données JSON
function translateText(key, translations) {
  var translatedText = translations[key];
  return translatedText !== undefined ? translatedText : key;
}

// Fonction pour mettre à jour les éléments traduits en fonction de la langue
function updateTranslations(language) {
  loadJSON(function (translations) {
    var elementsToTranslate = document.querySelectorAll(
      "[data-translation-key]"
    );

    for (var i = 0; i < elementsToTranslate.length; i++) {
      var element = elementsToTranslate[i];
      var translationKey = element.getAttribute("data-translation-key");
      var translatedText = translateText(translationKey, translations);
      //check if there is a i teg inside the element and keep it if there is one
      if (element.querySelector("i")) {
        var icon = element.querySelector("i");
        translatedText =  icon.outerHTML + translatedText;
      }


      element.innerHTML = translatedText;
    }

    // Mise à jour du bouton et de l'image
    var button = document.getElementById("page-header-user-dropdown");
    var image = button.querySelector("img");
    var title = button.querySelector(".align-middle");

    var translatedTitle = translateText("title", translations);
    var translatedImageSrc = translateText("png", translations);

    title.innerHTML = translatedTitle;
    image.src = image.src.replace(/[^/]*$/, translatedImageSrc);
  }, language);
}

// Récupérer la langue sélectionnée depuis le stockage local du navigateur
var selectedLanguage = localStorage.getItem("selectedLanguage");

// Si une langue est sélectionnée, mettre à jour les éléments traduits et le bouton/image
if (selectedLanguage) {
  updateTranslations(selectedLanguage);
} else {
  // Sinon, utiliser la langue par défaut (par exemple, "fr" pour le français)
  updateTranslations("fr");
}

// Fonction pour changer la langue en fonction de l'élément cliqué
function changeLanguage(lang) {
  updateTranslations(lang);

  // Enregistrer la langue sélectionnée dans le stockage local du navigateur
  localStorage.setItem("selectedLanguage", lang);
}