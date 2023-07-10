<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <h4>Modification du mot de passe</h4>
            <form action="../Users/editUserPassword" method="POST" class="p-2">
                <div class="form-group">
                    <label for="password_actual">Mot de passe actuel</label>
                    <input class="form-control" type="password" required="" id="password_actual" name="password_actual" placeholder="Mot de passe">
                </div>
                <div class="form-group">
                    <label for="password_new">Nouveau mot de passe</label>
                    <input class="form-control" type="password" required="" id="password_new" name="password_new" placeholder="Mot de passe" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirmation du mot de passe</label>
                    <input class="form-control" type="password" required="" id="password_confirm" name="password_confirm" placeholder="Mot de passe" autocomplete="new-password">
                </div>
                <div class="mb-3 text-center">
                    <button class="btn btn-primary btn-block" type="submit" data-translation-key="Modifier"></button>
                </div>
            </form>
        </div>
    </div>
</div>