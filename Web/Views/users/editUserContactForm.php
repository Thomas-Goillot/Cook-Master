<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <h4>Modification du contact</h4>
            <form action="../Users/editUserContact" method="POST" class="p-2">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" required="" autocomplete="email" value="<?= $user['email'] ?>">
                </div>
                <div class="form-group">
                    <label>Numéro de téléphone</label>
                    <input type="text" class="form-control" id="phone" name="phone" data-toggle="input-mask" data-mask-format="(+99) 99 99 99 99 99" maxlength="13" autocomplete="phone" required="" value="<?= $user['phone'] ?>">
                    <span class="font-13 text-muted">(+xx) xx xx xx xx xx</span>
                </div>
                <div class="mb-3 text-center">
                    <button class="btn btn-primary btn-block" type="submit"> Modifier mes informations </button>
                </div>
            </form>
        </div>
    </div>
</div>