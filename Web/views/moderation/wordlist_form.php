<div class="card">
    <div class="card-body">
        <h4 class="card-title">Ajouter un mot à censurer</h4>

        <form action="../moderation/addword" method="POST">
            <div class="form-group">
                <label for="word">Mot à censurer</label>
                <input type="text" class="form-control" id="word" name="word" placeholder="Mot à censurer">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

    </div>
</div>