<?php
include_once('views/layout/dashboard/path.php');
?>


<div class="row">

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cours de cuisine<?= ($course['type'] === COURSES_IS_AT_HOME ? " présentiel" : " en ligne") ?></h5>
                <p class="card-text">Statut : <?= fancyStatut($course['statut']) ?></p>
                <p class="card-text">Date du cours : <?= $this->convertDateFrench($course['date_of_courses']) ?></p>
                <p class="card-text">Date de création : <?= $this->convertDateFrench($course['date_of_request']) ?></p>
            </div>
        </div>
    </div>


    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Recettes demandées</h5>
                <?php
                if (count($recipes) !== 0) {
                    foreach ($recipes as $recipe) {
                        echo '<p class="card-text">' . $recipe['name'] . '</p>';
                    }
                } else {
                    echo '<p class="card-text">Aucune recette demandée</p>';
                }
                ?>
                <p class="card-text">Demande spéciale : <?= isset($course['special_request']) ? $course['special_request'] : "Aucune demande spéciale" ?></p>
            </div>
        </div>
    </div>


    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Votre prestataire</h5>
                <?php 
                    if ($provider != null && $providerInfo != null) {
                        echo "<p>Prestataire : " . $providerInfo['name'] . ' ' . $providerInfo['surname'] . "</p>";
                        echo "<p>Préstataire chez nous depuis: " . $this->convertDateFrench($provider['date_of_join']) . "</p>";
                    } else { 
                        echo '<p>Il n\'y a pas encore de prestataire pour votre cours</p>';
                    } 
                ?>
            </div>
        </div>
    </div>


    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Action</h5>

                <a href="<?= $path_prefix ?>courses/cancelRequest/<?= $course['id_courses'] ?>" class="btn btn-primary">Annuler la demande</a>
                <a href="<?= $path_prefix ?>courses/activate/<?= $course['id_courses'] ?>" class="btn btn-primary">Réactiver la demande</a>

            </div>
        </div>
    </div>


</div>