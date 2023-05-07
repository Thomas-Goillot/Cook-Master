<head>
<link href="<?= $path_prefix ?>assets/css/recipesAdmin/recipesAdmin.css" rel="stylesheet" />
</head>

<?php
include_once('Views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajoutez une recette</h4>

                <form>
                    <div class="form-group">
                        <label for="simpleinput">Nom</label>
                        <input type="text" id="simpleinput" class="form-control" placeholder="Enter the name">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Type</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Entrée</option>
                            <option>Plat</option>
                            <option>Dessert</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Ingrédients</label>
                            <div class="table-responsive">
                                <table class="table mb-0" id="cart-table">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                    </div>

                    <div class="form-floating ecarte">
                        <label for="floatingTextarea2">Recette</label>
                        <textarea class="form-control" placeholder="Enter your recipe" id="floatingTextarea2" style="height: 100px"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Image</label>
                                    <p class="card-subtitle mb-4">Mettez une image afin d'illustrer votre recette.</p>

                                    <input type="file" class="dropify" data-max-file-size="1M" />
                    </div>
                <!-- end row-->
                <button class="btn btn-primary mt-4 mb-2 btn-rounded">Ajouter<i class="mdi mdi-arrow-right ml-1"></i></button>

                </form>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card -->
    </div>

<!-- start page title -->
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Basic example</h4>
                    <div class="table-responsive">

                        <form method="get" action="">
                            <label for="ingredient">Entrez un ingrédient :</label>
                            <input type="text" id="ingredient" name="ingredient" required>
                            <button type="submit">Rechercher</button>
                        </form>

                        <?php
                        if (isset($_GET['ingredient'])) {
                            $ingredient = urlencode($_GET['ingredient']);
                            $url = "https://api.apilayer.com/spoonacular/food/ingredients/search?sortDirection=asc&sort=calories&query=$ingredient&offset=0&number=10&intolerances=gluten";
                            $headers = array("apikey: uJcZp67EZpodT8Vegm9Nuxlmfs6G6a4g");
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $resultat = curl_exec($ch);
                            curl_close($ch);
                            $resultats = json_decode($resultat);
                            ?>

                            <h2>Résultats pour "<?php echo $_GET['ingredient']; ?>" :</h2>

                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resultats->results as $resultat) { ?>
                                        <tr>
                                            <td><?php echo $resultat->name; ?></td>
                                            <td><button class="btn" onclick="addToCart('<?php echo $resultat->name; ?>')">Ajouter</button></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
            </div>

        </div>
                    <!-- end card-body-->
    </div>
                <!-- end card -->
</div>
            <!-- end col -->

<script>
    var cartTable = document.getElementById("cart-table");

    function addToCart(name) {
        // Vérifier si l'élément est déjà présent dans le panier
        var rows = cartTable.rows;
        for (var i = 0; i < rows.length; i++) {
            if (rows[i].cells[0].innerHTML === name) {
                alert("Cet élément est déjà dans votre panier !");
                return;
            }
        }

        // Créer une nouvelle ligne pour l'élément à ajouter
        var newRow = cartTable.insertRow();
        var nameCell = newRow.insertCell();
        nameCell.innerHTML = name;

        var quantityCell = newRow.insertCell();
        var quantityInput = document.createElement("input");
        quantityInput.type = "number";
        quantityInput.min = 1;
        quantityInput.value = 1;
        quantityInput.addEventListener("change", function() {
            if (quantityInput.value < 1) {
                quantityInput.value = 1;
            }
        });
        quantityCell.appendChild(quantityInput);

        var deleteCell = newRow.insertCell();
        var deleteButton = document.createElement("button");
        deleteButton.innerHTML = "Supprimer";
        deleteButton.addEventListener("click", function() {
            cartTable.deleteRow(newRow.rowIndex);
        });
        deleteCell.appendChild(deleteButton);
    }
</script>