<?php
include_once('views/layout/dashboard/path.php');
?>

<form action="../Courses/validation" method="POST">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <div class="dropdown float-right position-relative align-items-center">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label" for="course-type">En Ligne</label>
                                <input type="checkbox" id="course-type" name="course-type" data-toggle="switchery" data-color="#df3554" data-size="small">
                                <label class="form-check-label" for="course-type">En présentiel</label>
                            </div>
                        </div>
                    </div>

                    <h4 class="card-title d-inline-block mb-3"><i class="bx bx-book-reader"></i> Votre cours personnalisé</h4>

                    <div class="form-group">
                        <label>Recettes</label>
                        <select class="form-control select2-multiple" name="recipes[]" id="recipes" data-toggle="select2" multiple="multiple" data-placeholder="Choose a recipes...">
                            <optgroup label="Entrée">
                                <?php
                                foreach ($starters as $starter) {
                                    echo '<option value="' . $starter['id_recipes'] . '">' . $starter['name'] . '</option>';
                                }
                                ?>
                            </optgroup>
                            <optgroup label="Plat">
                                <?php
                                foreach ($dishes as $dish) {
                                    echo '<option value="' . $dish['id_recipes'] . '">' . $dish['name'] . '</option>';
                                }
                                ?>
                            </optgroup>
                            <optgroup label="Dessert">
                                <?php
                                foreach ($desserts as $dessert) {
                                    echo '<option value="' . $dessert['id_recipes'] . '">' . $dessert['name'] . '</option>';
                                }
                                ?>
                            </optgroup>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="special-request">Demande spéciale:</label>
                        <textarea class="form-control" id="special-request" name="special-request" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Date du cours</label>
                        <input type="text" class="form-control" data-provide="datepicker" data-date-autoclose="true" id="course-date" name="course-date">
                    </div>

                    <!-- Heure du cours -->
                    <div class="form-group">
                        <label for="course-time">Heure du cours:</label>
                        <input type="time" class="form-control" id="course-time" name="course-time">
                    </div>

                    <button type="submit" class="btn btn-primary">Soumettre</button>

                </div>
            </div>
        </div>

        <div class="col-lg-6" id="address-fields" style="display: none;">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title d-inline-block mb-3"><i class="bx bx-map"></i> Adresse du cours</h4>

                    <div class="form-group">
                        <label for="address">Adresse:</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="city">Ville:</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="form-group">
                        <label for="postal-code">Code postal:</label>
                        <input type="text" class="form-control" id="postal-code" name="postal-code">
                    </div>
                    <div class="form-group">
                        <label for="postal-code">Pays:</label>
                        <input type="text" class="form-control" id="country" name="country">
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>