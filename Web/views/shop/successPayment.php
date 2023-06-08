<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="card">
    <div class="card-body text-center">
        <h1 class="card-title">Merci pour votre abonnement !</h1>
        <p class="card-text">Nous vous remercions d'avoir souscrit à notre abonnement. Nous sommes ravis de vous avoir parmi nos membres.</p>
        <p class="card-text">Vous bénéficierez de nombreux avantages exclusifs et d'un excellent service.</p>
        <p class="card-text">N'hésitez pas à nous contacter si vous avez des questions ou des demandes spécifiques.</p>
        <a href="<?= $path_prefix?>Users/profil" class="btn btn-primary">Votre profil</a>
    </div>
</div>