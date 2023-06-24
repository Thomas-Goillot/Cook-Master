<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajoutez une recette</h4>

                <form action="<?= $path_prefix ?>Recipes/addRecipe" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nameRecipe">Nom</label>
                        <input type="text" id="nameRecipe" name="nameRecipe" class="form-control" placeholder="Entrer un nom">
                    </div>

                    <div class="form-group">
                        <label for="typeRecipe">Type</label>
                        <select class="form-control" name="typeRecipe" id="typeRecipe">
                            <option value="1">Entrée</option>
                            <option value="2">Plat</option>
                            <option value="3">Dessert</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Ingrédients</label>
                        <div class="table-responsive">
                            <table class="table mb-0" id="recipeTable">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Quantité</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-floating ecarte">
                        <label for="infoRecipe">Recette</label>
                        <textarea class="form-control" placeholder="Entrez une recette" id="infoRecipe" name="infoRecipe" style="height: 100px"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="imageRecipe">Image</label>
                        <p class="card-subtitle mb-4">Mettez une image afin d'illustrer votre recette.</p>

                        <input type="file" class="dropify" data-max-file-size="1M" id="imageRecipe" name="imageRecipe" />
                    </div>

                    <button class=" btn btn-primary mt-4 mb-2 btn-rounded" type="submit" data-translation-key="Ajouter"><i class="mdi mdi-arrow-right ml-1"></i></button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0 p-0">Rechercher un ingrédient</h4>


                    <div class="form-group">
                        <label for="numberOutput">Nombre de valeurs de retour:</label>
                        <input type="number" id="numberOutput" class="form-control" placeholder="Valeur de retour" value="5">
                    </div>
                </div>



                <div class="table-responsive">

                    <div class="input-group">
                        <input type="text" id="ingredient" name="ingredient" class="form-control" required placeholder="Rechercher un ingrédient">
                        <div class="input-group-append">
                            <button class="btn btn-primary waves-effect waves-light" id="searchIngredient" type="submit">Rechercher</button>
                        </div>
                    </div>

                    <hr>

                    <table class="table mb-0" id="tableIngredients">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


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