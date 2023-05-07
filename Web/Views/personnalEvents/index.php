<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">

                <div id='calendar' class="mt-3 mt-lg-0"></div>

            </div>
        </div>
        </div>


<script>
    var dateEvents = [
        <?php
        foreach ($events as $event) {
            echo "{\n";
            echo "title: '" . $event['name'] . "',\n";
            echo "start: new Date(" . $event['date_start']['year'] . "," . $event['date_start']['month'] . "," . $event['date_start']['day'] . "),\n";
            echo "end: new Date(" . $event['date_end']['year'] . "," . $event['date_end']['month'] . "," . $event['date_end']['day'] . "),\n";
            echo "},\n";
        }
        ?>
    ];
</script>

<div class="col-xl-6">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-inline-block mb-3"><i class="bx bx-calendar-event"></i> Vos évènements à venir</h4>
                <div class="dropdown float-right position-relative">
                    <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="<?= $path_prefix ?>PersonnalEvents/downloadUpcomingEventsInformations" class="dropdown-item">Toutes vos factures en PDF</a></li>
                    </ul>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Début</th>
                                <th>Fin</th>
                                <th>Prix</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($upcomingEvents as $informations){
                                    echo '<tr class="table-success">
                                            <th>' . $informations['name'] .'</th>
                                            <th>' . $informations['date_start'] .'</th>
                                            <th>' . $informations['date_end'] .'</th>
                                            <th>' . $informations['price'] .'€</th>
                                            <th>
                                                <a href="' . $path_prefix . 'PersonnalEvents/downloadUpcomingEventInformation" class="dropdown-item">PDF</a>
                                            </th>
                                            </tr>';
                                }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end card-body-->
    </div>
    <!-- end card -->

    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-inline-block mb-3"><i class="bx bx-calendar-event"></i> Vos évènements à venir</h4>
            <div class="dropdown float-right position-relative">
                <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="<?= $path_prefix ?>personnalevents/downloadPastEventsInformations" class="dropdown-item">Toutes vos factures en PDF</a></li>
                </ul>
            </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Début</th>
                                <th>Fin</th>
                                <th>Prix</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($pastEvents as $informations){
                                    echo '<tr class="table-danger">
                                            <th>' . $informations['name'] .'</th>
                                            <th>' . $informations['date_start'] .'</th>
                                            <th>' . $informations['date_end'] .'</th>
                                            <th>' . $informations['price'] .'€</th>
                                            <th>
                                                <a href="' . $path_prefix . ' personnalevents/downloadPastEventInformation?id_event='. $informations['id_event'].'" class="dropdown-item">PDF</a>
                                            </th>
                                            </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
            </div>
        </div>
        <!-- end card-body-->
    </div>
    <!-- end card -->
</div>