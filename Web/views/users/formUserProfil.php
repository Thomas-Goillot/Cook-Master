<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4 mt-3">
                <?= $this->loadAvatar($this->getUserId(), $path_prefix, "90px", "100px") ?>
            </div>
            <form action="../Users/editUserProfil/" method="POST" class="p-2">
                <h4 data-translation-key="Modification du nom et prénom"></h4>
                <div class="form-group">
                    <label for="username" data-translation-key="Nom"></label>
                    <input class="form-control" type="text" id="name" name="name" required="" placeholder="Michael" autocomplete="name" value="<?= $user['name'] ?>">
                </div>
                <div class="form-group">
                    <label for="username" data-translation-key="Prénom"></label>
                    <input class="form-control" type="text" id="surname" name="surname" required="" placeholder="Zenaty" autocomplete="surname" value="<?= $user['surname'] ?>">
                </div>
                <div class="mb-3 text-center">
                    <button class="btn btn-primary btn-block" type="submit" data-translation-key="Modifier"></button>
                </div>
            </form>

        </div>
    </div>
</div>