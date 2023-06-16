<?php
    include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-12">
         <div class="card">
            <div class="card-body">
                <h4 class="card-title">Demande Cours</h4>
                <p class="card-subtitle mb-4">
                    Voici la liste des demandes de cours à domicile ou en ligne
                </p>
                <table id="datatable" class="table dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Date de la demande</th>
                            <th>Actions</th>
                            <th>Demande particulière</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($allCoursesRequest as $course){

                                echo    '<tr>
                                            <td>' . $course['id_courses'] . '</td>
                                            <td>' . ($course['type'] === COURSES_IS_AT_HOME ? "présentiel" : "en ligne") . '</td>
                                            <td>' . fancyStatutCourse($course['statut']) . '</td>
                                            <td>' . $this->convertDateFrench($course['date_of_request']) . '</td>
                                            <td>
                                                <form action="'.$path_prefix. 'CourseService/acceptCourse" method="POST">
                                                    <input type="hidden" name="idCourse" value="'. $course['id_courses']. '" />
                                                    <button type="submit" class="btn btn-success"><i class="bx bx-check"></i> Accepter</button>
                                                </form>
                                            </td>
                                            <td>' . $course['special_request'] . '</td>
                                        </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>