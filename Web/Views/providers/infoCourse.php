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

            </div>
        </div>
    </div>

    <?php
    if ($course['type'] === COURSES_IS_ONLINE) : ?>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cours en ligne</h4>

                    <p>Lien: <?= isset($course['url']) ? $course['url'] : "Le lien n'a pas encore été défini" ?></p>

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


    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Action</h4>

                    <?php
                    if (dateDiff(explode(" ", $course['date_of_courses'])[0], date("Y-m-d")) == 0) {
                        echo '<a href="CourseService/startCourse/' . $course['id_courses'] . '" class="btn btn-primary">Commencer le cours</a>';
                        echo '<a href="CourseService/endCourse/' . $course['id_courses'] . '" class="btn btn-warning">Terminer le cours</a>';
                    } else {
                        echo '<p class="mx-3">Ce n\'est pas encore le moment du cours</p>';
                    }
                    ?>

                    <a href="CourseService/reportCourse/<?= $course['id_courses'] ?>" class="btn btn-info">Reporter le cours</a>

                    <a href="CourseService/cancelCourse/<?= $course['id_courses'] ?>" class="btn btn-primary">Annuler le cours</a>

            </div>
        </div>
    </div>

</div>