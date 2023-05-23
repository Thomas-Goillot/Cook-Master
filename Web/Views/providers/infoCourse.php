<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informations du cours</h4>

                <p>Type: <?= ($course['type'] === COURSES_IS_AT_HOME ? "présentiel" : "en ligne") ?></p>
                <p>Date du cours: <?= $this->convertDateFrench(explode(" ", $course['date_of_courses'])[0]) ?></p>
                <p>Heure du cours: <?= explode(" ", $course['date_of_courses'])[1] ?></p>
                <p>Echéance: <?= fancyDateDiff(dateDiff(explode(" ", $course['date_of_courses'])[0], date("Y-m-d"))) ?></p>
                <p>Statut: <?= fancyStatut($course['statut']) ?></p>

            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informations du client</h4>

                <p>Nom: <?= ucfirst($course['name']) ?></p>
                <p>Prénom: <?= ucfirst($course['surname']) ?></p>
                <p>Email: <?= $course['email'] ?></p>
                <p>Date d'inscription: <?= $this->convertDateFrench(explode(" ", $course['creation_date'])[0]) ?></p>

                <a href="<?= $path_prefix ?>CourseService/createChat/<?= $course['id_courses'] ?>" class="btn btn-primary">Contacter le client</a>

            </div>
        </div>
    </div>

    <?php
    if ($course['type'] === COURSES_IS_ONLINE) : ?>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cours en ligne</h4>

                    <p>Lien: <?= isset($course['url']) ? '<a href="' . $course['url'] . '" target="_blank">Lien du cours</a>' : "Le lien n'a pas encore été défini" ?></p>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php
    if ($course['type'] === COURSES_IS_AT_HOME) : ?>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cours en présentiel</h4>

                    <p>Adresse: <?= $course['address'] ?></p>
                    <p>Ville: <?= $course['city'] ?></p>
                    <p>Code Postal: <?= $course['zip_code'] ?></p>
                    <p>Country: <?= $course['country'] ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Actions</h4>

                <?php
                if (dateDiff(explode(" ", $course['date_of_courses'])[0], date("Y-m-d")) == 0 && $course['statut'] < COURSES_IS_IN_PROGRESS) {
                    echo '<a href="' . $path_prefix . 'CourseService/startCourse/' . $course['id_courses'] . '" class="btn btn-success mx-2">Commencer le cours</a>';
                } else if ($course['statut'] == COURSES_IS_IN_PROGRESS) {
                    echo '<a href="' . $path_prefix . 'CourseService/endCourse/' . $course['id_courses'] . '" class="btn btn-warning mx-2">Terminer le cours</a>';
                } else if ($course['statut'] <= COURSES_IS_DONE) {
                    echo '<p class="mx-2">Ce n\'est pas encore le moment du cours</p>';
                }


                if (dateDiff(explode(" ", $course['date_of_courses'])[0], date("Y-m-d")) < 0) {
                    echo '<a href="' . $path_prefix . 'CourseService/cancelCourse/' . $course['id_courses'] . '" class="btn btn-primary mx-2">Annuler le cours</a>';
                } else if ($course['statut'] > COURSES_IS_IN_PROGRESS) {
                    echo '<p class="mx-2 mt-2">Le cours est terminé</p>';
                } else {
                    echo '<p class="mx-2 mt-2">Il est trop tard pour annuler le cours...';
                }

                if ($course['statut'] == COURSES_IS_DONE) {
                    echo '<a href="' . $path_prefix . 'CourseService/ValidateSkills/' . $course['id_courses'] . '" class="btn btn-primary mx-2">Valider les compétences</a>';
                }


                ?>

            </div>
        </div>
    </div>

    <?php
    if (isset($course['commentary']) && !empty($course['commentary']) && $course['commentary'] != " " ) : ?>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Commentaire</h4>

                    <p><?= $course['commentary'] ?> </p>

                </div>
            </div>
        </div>
    <?php endif; ?>

</div>