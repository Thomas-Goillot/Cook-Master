window.onload = function () {

  var macarte = null;

  var xhrs = adresses.map(function (adresse) {
    return new Promise(function (resolve, reject) {
      var xhr = new XMLHttpRequest();
      xhr.open(
        "GET",
        "https://nominatim.openstreetmap.org/search?q=" +
          encodeURIComponent(adresse) +
          "&format=json&polygon_geojson=1&addressdetails=1",
        true
      );
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
          var response = xhr.responseText;
          var json = JSON.parse(response);
          if (json.length > 0) {
            var ville = json[0];
            var lat = ville.lat;
            var lon = ville.lon;
            var nom = ville.display_name;
            resolve({
              nom: nom,
              lat: lat,
              lon: lon,
            });
          } else {
            resolve({
              nom: adresse,
              lat: 0,
              lon: 0,
            });
          }
        }
      };
      xhr.send(null);
    });
  });

  // Attendre la fin de toutes les requêtes AJAX
  Promise.all(xhrs)
    .then(function (villes) {
      // Créer l'objet "macarte" et l'insérer dans l'élément HTML qui a l'ID "map"
      macarte = L.map("map").setView([villes[0].lat, villes[0].lon], 13);
      var markerClusters = L.markerClusterGroup(); // Nous initialisons les groupes de marqueurs

      L.tileLayer("https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png", {
        attribution:
          'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
        minZoom: 1,
        maxZoom: 20,
      }).addTo(macarte);

      // Ajouter un marqueur pour chaque ville
      for (var i = 0; i < villes.length; i++) {
        var ville = villes[i];
        var marker = L.marker([ville.lat, ville.lon]);
        marker.bindPopup(ville.nom);
        markerClusters.addLayer(marker);
      }
      macarte.addLayer(markerClusters);
    })
    .catch(function (error) {
      console.error(error);
    });


  $(".location").click(function () {
    var idLocation = $(this).data("idlocation");

    const request = new XMLHttpRequest();
    const params = {
      idLocation: idLocation,
    };

    request.open("POST", "../location/getlocationWithView");

    request.onreadystatechange = function () {
      if (request.readyState === 4) {
        document.getElementById("locationCol").innerHTML = request.responseText;
      }
    };

    request.send(JSON.stringify(params));

    findLocationCoordinates(
      document.getElementById("addr" + idLocation).innerHTML
    )
      .then(function (coords) {
        macarte.setView(coords, 15);
      })
      .catch(function (error) {
        console.error(error);
      });

    var msnry = new Masonry(document.getElementById("locationCol"), {
      itemSelector: ".col-lg-8",
      columnWidth: ".col-lg-8",
      gutter: 20,
    });
  });
};



$("#replicate").click(function () {
  const mondayMorningOpening = document.getElementById(
    "opening_hours_morning_Monday"
  ).value;
  const mondayMorningClosing = document.getElementById(
    "closing_hours_morning_Monday"
  ).value;
  const mondayAfternoonOpening = document.getElementById(
    "opening_hours_afternoon_Monday"
  ).value;
  const mondayAfternoonClosing = document.getElementById(
    "closing_hours_afternoon_Monday"
  ).value;

  const arrayDays = [
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
    "Sunday",
  ];

  for (let i = 0; i < arrayDays.length; i++) {
    document.getElementById("opening_hours_morning_" + arrayDays[i]).value =
      mondayMorningOpening;
    document.getElementById("closing_hours_morning_" + arrayDays[i]).value =
      mondayMorningClosing;
    document.getElementById("opening_hours_afternoon_" + arrayDays[i]).value =
      mondayAfternoonOpening;
    document.getElementById("closing_hours_afternoon_" + arrayDays[i]).value =
      mondayAfternoonClosing;
  }
});

function findLocationCoordinates(addr) {
  return new Promise(function (resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      "https://nominatim.openstreetmap.org/search?q=" +
        encodeURIComponent(addr) +
        "&format=json&polygon_geojson=1&addressdetails=1",
      true
    );
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var result = JSON.parse(xhr.responseText);
        var lat = result[0].lat;
        var lon = result[0].lon;
        resolve([lat, lon]);
      } else if (xhr.readyState == 4) {
        reject(
          "Une erreur est survenue lors de la récupération des coordonnées"
        );
      }
    };
    xhr.send(null);
  });
}
