<?php
include_once('Views/layout/dashboard/path.php');
?>

<form action="../location/add" method="POST">


    <div class="row">

        <div class="col-lg-6">

            <?php include_once('Views/location/createLocationFormInformation.php'); ?>

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title"><i class="fas fa-exclamation-triangle mr-2"></i> Attention</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group h-100">
                                <li class="list-group-item list-group-item-danger h-100"><i class="fas fa-exclamation-triangle mr-2"></i>Attention, l'ajout d'un nouveau site peut avoir un impact sur la sécurité de l'ensemble de notre système. Merci de vérifier scrupuleusement la conformité des équipements et des procédures avant de poursuivre.</li>
                                <li class="list-group-item list-group-item-warning h-100"><i class="fas fa-exclamation-triangle mr-2"></i>Avant de créer un nouveau site, merci de vérifier que le domaine est disponible et que le nom ne contient pas de marque déposée. Nous ne pourrons être tenus responsables en cas de violation de propriété intellectuelle.</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group h-100">
                                <li class="list-group-item list-group-item-warning h-100"><i class="fas fa-exclamation-triangle mr-2"></i>Merci de bien vouloir remplir tous les champs du formulaire avec des informations correctes. Les informations incomplètes ou inexactes pourraient retarder la création du site.</li>
                                <li class="list-group-item list-group-item-info h-100"><i class="fas fa-info-circle mr-2"></i>Si vous rencontrez des difficultés lors de l'ajout d'un nouveau site, n'hésitez pas à contacter le support technique pour obtenir de l'aide. Nous sommes là pour vous aider.</li>
                            </ul>
                        </div>
                    </div>



                </div>
            </div>



        </div>

        <div class="col-lg-6">

            <?php include_once('Views/location/createLocationFormOpeningHours.php'); ?>

            <?php include_once('Views/location/createLocationFormImages.php'); ?>

        </div>

    </div>


</form>