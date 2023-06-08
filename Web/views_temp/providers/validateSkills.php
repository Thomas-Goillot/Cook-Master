<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title d-inline-block mb-3"><i class="fas fa-list-ul"></i> Création d'un abonnement</h4>

                <form method="POST" action="<?= $path_prefix ?>CourseService/handleSkills/<?= $idCourse ?>">
                    <div class="form-group">
                        <label>Selectionnez les compétences travailler et acquises par l'utilisateur</label>

                        <select class="form-control select2-multiple" name="skills[]" id="skills" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                            <optgroup label="Subscriptions options">
                                <?php
                                foreach ($allSkills as $skill) {
                                    echo '<option value="' . $skill['id_skills'] . '">' . $skill['name'] . '</option>';
                                }
                                ?>
                            </optgroup>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="commentaire">Commentaire :</label>
                        <textarea class="form-control" id="commentary" name="commentary" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>