<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-xl-6">
        <div class="card card-animate">
            <div class="card-body d-flex justify-content-center flex-column">
                <h4 class="card-title d-inline-block mb-3"><i class="fas fa-gift"></i> Parrainage</h4>

                <p>Nous sommes ravis de constater que vous êtes déjà un abonné et que vous souhaitez parrainer un ami pour profiter des avantages exclusifs de notre programme de cooptation.</p>
                <p>En tant qu'abonné, vous pouvez maintenant bénéficier de notre offre spéciale de parrainage. Lorsque vous recommandez un ami à s'abonner à notre plateforme (hors formule Free), nous avons prévu une récompense pour vous deux.</p>
                <p>Pour chaque nouvel inscrit que vous parrainez, nous vous offrirons un chèque cadeau d'une valeur de 5 € en guise de remerciement pour votre confiance et votre soutien. De plus, nous vous réservons un bonus supplémentaire. Vous recevrez un pourcentage de 3% du montant total de la première commande effectuée par votre ami, en plus du chèque cadeau.</p>
                <p>Nous sommes convaincus que cette offre de parrainage est une excellente opportunité pour vous et votre ami de profiter pleinement de notre plateforme, tout en bénéficiant de récompenses supplémentaires.</p>
                <p>N'hésitez pas à partager cette offre avec votre ami et à lui expliquer les avantages qu'il pourra obtenir en s'inscrivant grâce à vous. Nous sommes impatients de les accueillir parmi notre communauté et de leur offrir une expérience exceptionnelle.</p>
                <p>Si vous avez des questions supplémentaires ou besoin d'assistance, n'hésitez pas à nous contacter. Merci encore pour votre fidélité et votre engagement envers notre plateforme.</p>

                <a href="<?= $path_prefix ?>sponsor/generateLink" class="btn btn-primary">Parrainer un ami</a>

            </div>
        </div>
    </div>

    <?php
    if (isset($sponsorLink) && $sponsorLink != null) {
        echo '<div class="col-xl-6">
                <div class="card card-animate">
                    <div class="card-body ">
                        <h4 class="card-title d-inline-block mb-3"><i class="fas fa-qrcode"></i> Votre lien de parrainage</h4>
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <div id="qrCode">' . $qrCode . '</div>
                            <p class="text-muted">Ce code est valable jusqu\'au ' . date('d/m/Y', strtotime($expirationDate)) . ' (3 jours)</p>
                            <button class="btn btn-primary ml-3" onclick="copyToClipboard(\'' . $sponsorLink . '\')"><i class="fas fa-copy"></i> Copier le lien</button>
                            <div class="d-flex mt-3">

                                <a href="https://www.snapchat.com/share?url=' . $sponsorLink . '" class="btn btn-warning mx-2"><i class="fab fa-snapchat"></i></a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=' . $sponsorLink . '" class="btn btn-secondary mx-2"><i class="fab fa-facebook"></i></a>
                                <a href="https://twitter.com/intent/tweet?url='. $sponsorLink . '" class="btn btn-info mx-2"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url='. $sponsorLink . '" class="btn btn-dark mx-2"><i class="fab fa-linkedin"></i></a>
                                <a href="https://api.whatsapp.com/send?text='. $sponsorLink . '" class="btn btn-success mx-2"><i class="fab fa-whatsapp"></i></a>
                                                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }
    ?>



</div>