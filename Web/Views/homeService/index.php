<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-xl-4">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-clipboard-list mr-2"></i>Une petite envie à la maison ? 😋</h4>
                <?php
                echo '<p><strong>Nom : </strong>' . $user['name'] . ' ' . $user['surname'] . '</p>';
                echo '<p><strong>Numéro : </strong>' . $user['phone'] . '</p>';
                echo '<p><strong>Adresse : </strong>' . $address . '</p>';
                ?>
                <form action="HomeService/sendRequest" method="POST" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <p><strong>Couverts : </strong></p>
                        <div class="d-flex justify-content-start">
                            <div class="custom-control custom-radio">
                                <input data-toggle="touchspin" type="text" name="couverts" data-step="1" data-decimals="0">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <p><strong>Prestation recherchée : </strong></p>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="customRadio1">Chef uniquement (400€/20pers)</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="2">
                            <label class="custom-control-label" for="customRadio2">Chef et serveur (800€/20pers)</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <p><strong>Equipement : </strong></p>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio3" name="customRadio1" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="customRadio3">Equipement personnel</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio4" name="customRadio1" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="customRadio4">Kit de cuisine (+50€/20pers)</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <p><strong>Nourriture : </strong></p>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio5" name="customRadio2" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="customRadio5">Produits personnels</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio6" name="customRadio2" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="customRadio6">Produits du chef (+100€/couvert)</label>
                        </div>
                        <div id="foodInputs">
                            <div class="form-group">
                                <label>Entrée</label>

                                <select class="form-control select2-multiple" name="Entrances" id="Entrances" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                    <optgroup label="Entrances options">
                                        <?php
                                        foreach ($getAllEntrancesWithoutIngredients as $Entrances) {
                                            echo '<option value="' . $Entrances['id_recipes'] . '">' . $Entrances['name'] . '</option>';
                                        }
                                        ?>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Plat</label>

                                <select class="form-control select2-multiple" name="Dishes" id="Dishes" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                    <optgroup label="Dishes options">
                                        <?php
                                        foreach ($getAllDishesWithoutIngredients as $Dishes) {
                                            echo '<option value="' . $Dishes['id_recipes'] . '">' . $Dishes['name'] . '</option>';
                                        }
                                        ?>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Dessert</label>

                                <select class="form-control select2-multiple" name="Desserts" id="Desserts" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                    <optgroup label="Desserts options">
                                        <?php
                                        foreach ($getAllDessertsWithoutIngredients as $Desserts) {
                                            echo '<option value="' . $Desserts['id_recipes'] . '">' . $Desserts['name'] . '</option>';
                                        }
                                        ?>
                                    </optgroup>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <p><strong>Prix : </strong><span id="prixTotal">0</span> euros</p>
                    </div>

                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary btn-block w-25">Payer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-map-marker-alt mr-2"></i>Domicile</h4>
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fonction pour calculer et afficher le prix total
    function calculerPrix() {
        // Obtenir les valeurs sélectionnées par l'utilisateur
        var prestation = document.querySelector('input[name="customRadio"]:checked').value;
        var equipement = document.querySelector('input[name="customRadio1"]:checked').value;
        var nourriture = document.querySelector('input[name="customRadio2"]:checked').value;
        var couverts = parseInt(document.querySelector('input[name="couverts"]').value);

        // Définir les coûts supplémentaires en fonction des sélections
        var prestationCost = 0;
        var equipementCost = 0;
        var nourritureCost = 0;

        if (prestation === "1") {
            prestationCost = Math.ceil(couverts / 20) * 400;
        } else if (prestation === "2") {
            prestationCost = Math.ceil(couverts / 20) * 800;
        }

        if (equipement === "1") {
            equipementCost = Math.ceil(couverts / 20) * 50;
        }

        if (nourriture === "1") {
            nourritureCost = couverts * 100;
        }

        // Calculer le prix total
        var prixTotal = prestationCost + equipementCost + nourritureCost;

        // Afficher le prix total
        var prixElement = document.getElementById('prixTotal');
        prixElement.textContent = prixTotal;
    }

    // Écouter les événements de changement d'options et de saisie de nombre de couverts
    var options = document.querySelectorAll('input[name="customRadio"], input[name="customRadio1"], input[name="customRadio2"]');
    options.forEach(function (option) {
        option.addEventListener('change', calculerPrix);
    });

    var couvertsInput = document.querySelector('input[name="couverts"]');
    couvertsInput.addEventListener('input', calculerPrix);
</script>
<script>
    var adresses = [
        <?php
            echo "\"" . $address . "\",";
        ?>
    ];
</script>
