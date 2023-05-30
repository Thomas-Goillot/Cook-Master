<div class="card">
    <div class="card-body">
        <h4 class="card-title">Créer une compétence</h4>

        <form action="../skillsAdmin/addSkill" method="POST">

            <div class="form-group">
                <label for="name">Nom de la compétence</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nom du certificat" required>
            </div>

            <div class="form-group">
                <label for="description">Description de la compétence</label>
                <textarea class="form-control" name="description" id="description" placeholder="Description du certificat" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Créer la compétence</button>

        </form>
    </div>
</div>