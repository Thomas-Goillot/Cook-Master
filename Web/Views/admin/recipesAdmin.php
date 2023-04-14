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
                            <option>1 - Entrée</option>
                            <option>2 - Plat</option>
                            <option>3 - Dessert</option>
                        </select>
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
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ingrédients</h4>
                <p class="card-subtitle mb-4">
                    Choisissez les ingrédients pour votre recette ici.
                </p>

                <table id="datatable" class="table dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                        </tr>
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->