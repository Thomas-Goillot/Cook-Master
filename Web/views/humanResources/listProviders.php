<?php
    include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <?php foreach($getAllProvidersValidate as $request): ?>
        <div class="col-lg-3 mb-3">
            <div class="card">
                <img src="<?php echo $path_prefix . 'assets/images/request/pictures/' . $request['image']; ?>" class="card-img-top" alt="Photo">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $request['name'] . ' ' . $request['surname']; ?></h5>
                    <p class="card-text"><strong>Téléphone :</strong> <?php echo $request['phone']; ?></p>
                    <p class="card-text"><strong>Email :</strong> <?php echo $request['email']; ?></p>
                    <p class="card-text"><strong>Numéro de siret :</strong> <?php echo $request['siret']; ?></p>
                    <p class="card-text"><strong>Métier recherché :</strong> <?php echo $request['type']; ?></p>
                    <a href="<?php echo $path_prefix . 'assets/images/request/cv/' . $request['file']; ?>" target="_blank" class="btn btn-primary">Voir CV</a>
                    <a href="<?php echo $path_prefix .'Providers/supp/' . $request['id_users']; ?>" class="btn btn-primary">Supprimer</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>