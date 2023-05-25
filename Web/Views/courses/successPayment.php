<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="card">
    <div class="card-body text-center">
        <h1 class="card-title">Merci d'avoir réserver un cours !</h1>
        <p class="card-text">Nous vous remercions d'avoir réserver un cours. Nous sommes ravis de vous avoir parmi nos membres.</p>
        <p class="card-text">Votre réservation a bien été prise en compte.</p>
        <p class="card-text">Lorsqu'un prestataire aura accepté votre réservation, vous recevrez un mail de confirmation.</p>
        <a href="<?= $path_prefix ?>Courses/myRequest" class="btn btn-primary">Vos demandes de cours</a>
    </div>
</div>