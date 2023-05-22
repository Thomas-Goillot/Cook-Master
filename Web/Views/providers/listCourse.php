<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">

                <div id='calendar' class="mt-3 mt-lg-0"></div>

            </div>
        </div>
    </div>


    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste de vos cours</h4>
                <table id="datatable" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom Prénom</th>
                            <th scope="col">Type</th>
                            <th scope="col">Date du cours</th>
                            <th scope="col">Heure du cours</th>
                            <th>Cours dans:</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allCourses as $course) : ?>
                            <tr>
                                <td><?= $course['id_courses'] ?></td>
                                <td><?= ucfirst($course['name']) . " " . ucfirst($course['surname']) ?></td>
                                <td><?= ($course['type'] === COURSES_IS_AT_HOME ? "présentiel" : "en ligne") ?></td>
                                <td><?= $this->convertDateFrench(explode(" ", $course['date_of_courses'])[0]) ?></td>
                                <td><?= explode(" ", $course['date_of_courses'])[1] ?></td>
                                <td><?= fancyDateDiff(dateDiff(explode(" ", $course['date_of_courses'])[0], date("Y-m-d"))) ?></td>
                                <td><?= fancyStatut($course['statut']) ?></td>
                                <td>
                                    <a href="../CourseService/info/<?= $course['id_courses'] ?>" class="btn btn-primary">Voir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var dateEvents = [
        <?php
        foreach ($allCourses as $course) {
            echo "{\n";
            echo "title: '" . $course['surname'] . " " . $course['name'] . " " . ($course['type'] === COURSES_IS_AT_HOME ? "présentiel" : "en ligne") . "',\n";
            echo "start: '". explode(" ", $course['date_of_courses'])[0]."',\n";
            echo "end: '" . explode(" ", $course['date_of_courses'])[0] . "',\n";
            echo "url: '../CourseService/info/" . $course['id_courses'] . "'\n";
            echo "},\n";
        }
        ?>
    ];
</script>