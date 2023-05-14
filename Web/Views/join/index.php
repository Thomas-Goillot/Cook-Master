<head>
    <link href="<?= $path_prefix ?>assets/css/join/styles.css" rel="stylesheet" />
</head>
<?php
    include_once('views/layout/dashboard/path.php');
?>
<div class="aucentre">
    <video autoplay loop muted>
    <?php
    echo '
    <source src="' . $path_prefix  . 'assets/images/videos/video.mp4" type="video/mp4">
    ';
    ?>
    Votre navigateur ne prend pas en charge les vidéos HTML5.
    </video>

    <div class="card card-animate">
        <div class="card-body">
            <form action="../Events/addEvent" method="POST">

                <div class="card-title center">
                    <h1 class="card-title">Rejoignez l'équipe CookMaster !</h1>
                </div>

                <div class="form-group">
                    <h4>N° SIRET</h4>
                    <input type="text" name="siret" class="form-control" data-toggle="input-mask" data-mask-format="0000-0000">
                </div>
                <div class="row">
                <div class="col-xl-6">
                    <div class="form-group">   
                        <h4>Curriculum Vitae</h4>
                        <input type="file" name="cv" class="dropify"/>       
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">   
                        <h4>Photo de profil</h4>
                        <input type="file" name="photo" class="dropify"/>      
                    </div>
                </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="fas fa-plus"></i>
                        Envoyer
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>