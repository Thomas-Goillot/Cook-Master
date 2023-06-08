<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">

<?php
foreach ($courses as $course) {   
?>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cours de cuisine<?= ($course['type'] === COURSES_IS_AT_HOME ? " présentiel" : " en ligne") ?></h5>
                <p class="card-text">Statut : <?= fancyStatut($course['statut']) ?></p>
                <p class="card-text">Demande spéciale : <?= isset($course['special_request']) ? $course['special_request'] : "Aucune demande spéciale" ?></p>
                <p class="card-text">Date du cours : <?= $this->convertDateFrench($course['date_of_courses']) ?></p>
                <?php 
                    if($course['statut'] == COURSES_REQUEST){
                        echo '<a href="'.$path_prefix.'courses/invoice/'.$course['id_courses']. '" class="btn btn-primary">Finaliser la demande</a>';
                    }
                    else{
                        echo '<a href="'.$path_prefix.'courses/details/'.$course['id_courses'].'" class="btn btn-primary">Voir les détails</a>';
                    }
                ?>
            </div>
        </div>
    </div>

<?php
}
?>
</div>
