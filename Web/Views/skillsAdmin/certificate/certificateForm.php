<div class="card">
    <div class="card-body">
        <h4 class="card-title">Créer un certificat</h4>

        <form action="../skillsAdmin/addCertificate" method="POST">

            <div class="form-group">
                <label for="name">Nom du certificat</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nom du certificat" required>
            </div>

            <div class="form-group">
                <label for="description">Description du certificat</label>
                <textarea class="form-control" name="description" id="description" placeholder="Description du certificat" required></textarea>
            </div>

            <div class="form-group">
                <label>Compétences nécessaires</label>

                <select class="form-control select2-multiple" name="Skills[]" id="Skills" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                    <optgroup label="Skills options">
                        <?php
                        foreach ($allSkills as $skill) {
                            echo '<option value="' . $skill['id_skills'] . '">' . $skill['name'] . '</option>';
                        }
                        ?>
                    </optgroup>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Créer le certificat</button>

        </form>
    </div>
</div>