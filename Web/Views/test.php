<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
    <style type="text/css">
        #map {
            /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
            height: 400px;
        }
    </style>
    <title>Carte</title>
</head>

<body>
    <div id="map">
        <!-- Ici s'affichera la carte -->
    </div>

    <!-- Fichiers Javascript -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
    <script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'></script>
    <script type="text/javascript">
        // Fonction d'initialisation de la carte
        function initMap() {


        }
        window.onload = function() {


            //requete ajax
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'https://nominatim.openstreetmap.org/search?q=39+rue+pierre+loti+bourg+la+reine+France&format=json&polygon_geojson=1&addressdetails=1', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    var response = xhr.responseText;
                    var json = JSON.parse(response);
                    console.log(json);

                    // On initialise la latitude et la longitude de Paris (centre de la carte)
                    var lat = 48.852969;
                    var lon = 2.349903;
                    var macarte = null;
                    var markerClusters;


                    var villes = {};

                    for (var i = 0; i < json.length; i++) {
                        var ville = json[i];
                        var lat = ville.lat;
                        var lon = ville.lon;
                        var nom = ville.display_name;
                        villes[nom] = {
                            "lat": lat,
                            "lon": lon
                        };
                    }


                    // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
                    macarte = L.map('map').setView([lat, lon], 11);
                    markerClusters = L.markerClusterGroup(); // Nous initialisons les groupes de marqueurs

                    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {

                        attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                        minZoom: 1,
                        maxZoom: 20
                    }).addTo(macarte);


                    for (ville in villes) {

                        var marker = L.marker([villes[ville].lat, villes[ville].lon]); // pas de addTo(macarte), l'affichage sera géré par la bibliothèque des clusters
                        marker.bindPopup(ville);
                        markerClusters.addLayer(marker); // Nous ajoutons le marqueur aux groupes
                    }
                    macarte.addLayer(markerClusters);
                }
            };

            xhr.send(null);


        };
    </script>
</body>

</html>