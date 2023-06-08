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

    var msnry = new Masonry(document.getElementById("domicile"), {
        itemSelector: ".col-lg-6",
        columnWidth: ".col-lg-6",
        gutter: 20,
    });

    $(".list-group-item").click(function () {
    var addr = $(this).data("addr");

    $(this).find('input[type="radio"]').prop("checked", true);

    findLocationCoordinates(addr)
        .then(function (coords) {
        macarte.setView(coords, 15);
        })
        .catch(function (error) {
        console.error(error);
        });
    });


    /* 
    *  Gestion de la selection d'adresse 
    */
    $("#userShippingAddress").change(function () {
      var id = $("#userShippingAddress option:selected").val();

      if(id == -1){
        $("#name").val("");
        $("#address").val("");
        $("#country").val("");
        $("#city").val("");
        $("#zipCode").val("");
        return;
      }
      
      var name = $("#userShippingAddress option:selected").data("name");
      var addr = $("#userShippingAddress option:selected").data("address");
      var country = $("#userShippingAddress option:selected").data("country");
      var city = $("#userShippingAddress option:selected").data("city");
      var zipCode = $("#userShippingAddress option:selected").data("zipcode");
      
      //set all the value in the input
      $("#name").val(name);
      $("#address").val(addr);
      $("#country").val(country);
      $("#city").val(city);
      $("#zipCode").val(zipCode);








    });




};

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
