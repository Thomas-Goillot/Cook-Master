<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <h4>Modification des informations personnel</h4>
            <form action="../Users/editUserAddress" method="POST" class="p-2">
                <div class="form-group">
                    <label for="email">Pays</label>
                    <input class="form-control" type="text" name="country" required="" value="<?= isset($user['country']) ? $user['country'] : "" ?>">
                </div>
                <div class="form-group">
                    <label>Adresse</label>
                    <input type="text" class="form-control" name="address" data-toggle="input-mask" required="" value="<?= isset($user['address']) ? $user['address'] : "" ?>">
                </div>
                <div class="form-group">
                    <label>Ville</label>
                    <input type="text" class="form-control" name="city" data-toggle="input-mask" required="" value="<?= isset($user['city']) ? $user['city'] : "" ?>">
                </div>
                <div class="form-group">
                    <label>Code postal</label>
                    <input type="text" class="form-control" name="zip_code" data-toggle="input-mask" required="" value="<?= isset($user['zip_code']) ? $user['zip_code'] : "" ?>">
                </div>
                <div class="mb-3 text-center">
                    <button class="btn btn-primary btn-block" type="submit" data-translation-key="Modifier"></button>
                </div>
            </form>
        </div>
    </div>
</div>