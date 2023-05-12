<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h4>Modification des conversations</h4>
            <form action="../Users/editUserProfil" method="POST" class="p-2">
                <div class="form-group d-flex flex-column justify-content-center align-items-center">
                    <label for="email">Censuration de la conversation</label>
                    <input type="checkbox" data-toggle="switchery" name="censure_tchat" data-color="#9e1b21" <?php if ($user['censure_tchat'] == 1) {echo " checked='' "; } ?> />
                </div>
            </form>
        </div>
    </div>
</div>