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
            <form action="Join/sendRequest" method="POST" enctype="multipart/form-data">
                
                <div class="card-title center">
                    <h1 class="card-title">Rejoignez l'équipe CookMaster !</h1>
                </div>

                <div class="form-group">
                    <h4>N° SIRET</h4>
                    <input type="text" name="siret" class="form-control" data-toggle="input-mask" data-mask-format="0000-0000">
                </div>

                <div class="form-group">
                    <h4>Poste souhaité</h4>
                        <div class="d-flex justify-content-center align-items-center">
                        <div class="custom-control custom-radio  button-eloigne">
                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" value="chef">
                            <label class="custom-control-label" for="customRadio1">Chef</label>
                        </div>
                        <div class="custom-control custom-radio  button-eloigne">
                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="livreur">
                            <label class="custom-control-label" for="customRadio2">Livreur</label>
                        </div>
                        <div class="custom-control custom-radio  button-eloigne">
                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" value="autre">
                            <label class="custom-control-label" for="customRadio3">Autre</label>
                        </div>
                    </div> 
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