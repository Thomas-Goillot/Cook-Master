<?php
include_once('Views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-exclamation-triangle mr-2"></i> Liste des lieux</h4>

                <table id="datatable" class="table nowrap">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>adresse</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        foreach ($locations as $location) {
                            echo "<tr class=\"location\" data-idLocation=\"" . $location['id_location'] . "\">";
                            echo "<td>" . $location['name'] . "</td>";
                            echo "<td>" . $location['address'] . "</td>";
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-exclamation-triangle mr-2"></i> Information</h4>

                <div id="locationImageCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#locationImageCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#locationImageCarousel" data-slide-to="1"></li>
                        <li data-target="#locationImageCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="<?= $path_prefix ?>assets/images/home/image4.png" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="<?= $path_prefix ?>assets/images/home/image4.png" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="<?= $path_prefix ?>assets/images/home/image4.png" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#locationImageCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#locationImageCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <p class="m-0 p-0 text-muted">Lundi</p>

                        <div class="p-l-5 d-flex flex-column">
                            <p class="m-0 p-0 text-muted">08:00-12:00</p>
                            <p class="m-0 p-0 text-muted">14:00-18:00</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <p class="m-0 p-0 text-muted">Lundi</p>

                        <div class="p-l-5 d-flex flex-column">
                            <p class="m-0 p-0 text-muted">08:00-12:00</p>
                            <p class="m-0 p-0 text-muted">14:00-18:00</p>
                        </div>
                    </div>

                </div>




            </div>
        </div>
    </div>



</div>

<script>




</script>