<div class="col-lg-4 col-sm-12">
    <div class="card card-animate">
        <div class="card-body">
            <div class="dropdown float-right position-relative">
                <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="row">
                        <div class="col">
                            <a href="<?= $path_prefix ?>users/editProfil" class="dropdown-item" data-translation-key="Modifier mes informations"></a>
                            <a href="<?= $path_prefix ?>users/downloadInformation" class="dropdown-item" data-translation-key="Télécharger en PDF"></a>
                        </div>

                    </div>
                </div>
            </div>


            <h4 class="card-title d-inline-block" data-translation-key="Vos Informations"><i class="fas fa-info-circle"></i> </h4>

            <p class="card-text">
                <span data-translation-key="Nom"></span> : <?= ucfirst($data['user']['name']) ?>
                <br>
                <span data-translation-key="Prénom"></span> : <?= ucfirst($data['user']['surname']) ?>
                <br>
                Email : <?= $data['user']['email'] ?>
                <br>
                <span data-translation-key="Mail validé"></span> : <?= $this->isVerified($data['user']['mail_verified']) ?>
                <br>
                <span data-translation-key="Téléphone"></span> : <?= $data['user']['phone'] ?>
                <br>
                <span data-translation-key="Adresse"></span> <?= $data['user']['address'] ?>
                <br>
                <span data-translation-key="Ville"></span> : <?= $data['user']['city'] ?>
                <br>
                <span data-translation-key="Code postal"></span> : <?= $data['user']['zip_code'] ?>
                <br>
                <span data-translation-key="Pays"></span> : <?= $data['user']['country'] ?>
                <br>
                <span data-translation-key="Abonnement"></span> : <strong><?= $data['subscription'] ?></strong>

            </p>

            <p class="card-text">
                <small class="text-muted">Compte créé le <?= $this->convertDateFrench($data['user']['creation_date']) ?> </small>
            </p>

        </div>
    </div>
</div>