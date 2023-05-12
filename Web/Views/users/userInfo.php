<div class="col col-lg-4">
    <div class="card card-animate">
        <div class="card-body">
            <div class="dropdown float-right position-relative">
                <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="<?= $path_prefix ?>users/editProfil" class="dropdown-item">Modifier mes informations </a></li>
                    <li><a href="#" class="dropdown-item">Changer d'abonnement</a></li>
                    <li class="dropdown-divider"></li>
                    <li><a href="<?= $path_prefix ?>users/downloadInformation" class="dropdown-item">Télécharger en PDF</a></li>
                </ul>
            </div>
            <h4 class="card-title d-inline-block"><i class="fas fa-info-circle"></i> Vos Informations</h4>

            <p class="card-text">
                Nom : <?= ucfirst($data['user']['name']) ?>
                <br>
                Prénom : <?= ucfirst($data['user']['surname']) ?>
                <br>
                Email : <?= $data['user']['email'] ?>
                <br>
                Mail validé : <?= $this->isVerified($data['user']['mail_verified']) ?>
                <br>
                Téléphone : <?= $data['user']['phone'] ?>
                <br>
                Adresse : <?= $data['user']['address'] ?>
                <br>
                Ville : <?= $data['user']['city'] ?>
                <br>
                Code Postal : <?= $data['user']['zip_code'] ?>
                <br>
                Pays : <?= $data['user']['country'] ?>
                <br>
                Abonnement : <strong><?= $data['subscription'] ?></strong>

            </p>

            <p class="card-text">
                <small class="text-muted">Compte créé le <?= $this->convertDateFrench($data['user']['creation_date']) ?> </small>
            </p>

        </div>
    </div>
</div>


