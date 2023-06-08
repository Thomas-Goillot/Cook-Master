<div class="card card-animate">
    <div class="card-body">

        <div class="dropdown float-right position-relative align-items-center">
            <a href="javascript:void(0);" id="replicate" class=" text-muted">
                <i class="bx bx-copy-alt"></i>
                Recopier
            </a>
        </div>

        <h4 class="card-title d-inline-block mb-3"><i class="bx bxs-time"></i> Horaires d'ouverture </h4>

        <ul class="nav nav-tabs mb-3">
            <?php
            for ($i = 0; $i < count($days); $i++) {
                if ($i == 0) {
                    $active = 'active';
                } else {
                    $active = '';
                }
                echo '<li class="nav-item">
                <a href="#' . $days[$i] . '" data-toggle="tab" aria-expanded="true" class="nav-link ' . $active . '">
                    <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                    <span class="d-none d-lg-block">' . $days_fr[$i] . '</span>
                </a>';
            }
            ?>
        </ul>

        <div class="tab-content">
            <?php
            for ($i = 0; $i < count($days); $i++) {
                if ($i == 0) {
                    $active = 'active';
                } else {
                    $active = '';
                }
                echo '
                <div class="tab-pane ' . $active . '" id="' . $days[$i] . '">
                    <div class="form-group">
                        <label>Plage horaire d\'ouverture pour le matin</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="time" class="form-control" name="opening_hours_morning_' . $days[$i] . '" id="opening_hours_morning_' . $days[$i] . '" placeholder="Heure d\'ouverture">
                            </div>
                            <div class="col-6">
                                <input type="time" class="form-control" name="closing_hours_morning_' . $days[$i] . '" id="closing_hours_morning_' . $days[$i] . '" placeholder="Heure de fermeture">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Plage horaire d\'ouverture pour l\'après-midi</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="time" class="form-control" name="opening_hours_afternoon_' . $days[$i] . '" id="opening_hours_afternoon_' . $days[$i] . '" placeholder="Heure d\'ouverture">
                            </div>
                            <div class="col-6">
                                <input type="time" class="form-control" name="closing_hours_afternoon_' . $days[$i] . '" id="closing_hours_afternoon_' . $days[$i] . '" placeholder="Heure de fermeture">
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>

    </div>
</div>