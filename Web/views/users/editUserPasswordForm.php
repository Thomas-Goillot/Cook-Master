<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <h4>Modification du mot de passe</h4>
            <form action="../Users/editUserPassword" method="POST" class="p-2">
                <div class="form-group">
                    <label for="password">Mot de passe actuel</label>
                    <input class="form-control" type="password" required="" id="password" name="password_actual" placeholder="Mot de passe">
                </div>
                <div class="form-group">
                    <label for="password">Nouveau mot de passe</label>
                    <input class="form-control" type="password" required="" id="password" name="password" placeholder="Mot de passe" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label for="password">Confirmation du mot de passe</label>
                    <input class="form-control" type="password" required="" id="password" name="password_confirm" placeholder="Mot de passe" autocomplete="new-password">
                </div>
                <div class="mb-3 text-center">
                    <button class="btn btn-primary btn-block" type="submit" data-translation-key="Modifier"></button>
                </div>
            </form>
        </div>
    </div>
</div>