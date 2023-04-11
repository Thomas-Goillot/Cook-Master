<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cook Master</title>
    <link rel="icon" type="image/x-icon" href="<?= $path_prefix ?>assets/logo.svg" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="<?= $path_prefix ?>assets/css/recipes/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top white" id="mainNav">
        <div class="container px-4 px-lg-5">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= $path_prefix ?>home">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#recipes">Recettes</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $path_prefix ?>chefs">Nos Chefs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#signup">Contact</a></li>
                    <li><a class="nav-link" href="login"><i class="bi bi-person"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead" id="recipes">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">Recettes</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center hop name-red">
        <div class="d-flex justify-content-center">
            <div class="text-center tuconnépas">
                <section class="aucentre"><h2>CookMaster</h2></section>
                <p class="tuconnépas tuconnépas1">est fier de vous présentez quelques unes de nos recettes emblématiques. Afin d'accéder à la bibliothèque complète ainsi qu'à nos nombreux services nous vous conseillons de vous inscrire au plus vite.</p>
            </div>
        </div>
    </div>

        <!-- Entrées -->

    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center hop name-red">
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">Entrées</h1>
                <hr class="my-4 mx-auto" />
            </div>
        </div>
    </div>
    
<section class="aucentre">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">


    <?php
        $caroussel = 0;
            foreach($getAllRecipesStarters as $info){
                if($caroussel == 0){
                    echo    '<div class="carousel-item active">';
                }else{
                    echo    '<div class="carousel-item">';
                }
                echo    '<img src="' . $path_prefix  . 'assets/images/recipes/' . $info['image'] . '" class="d-block w-100 radius">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><a href=# class="nosurlignage">'. $info['name'] .'</a></h5>
                            </div>
                        </div>';
                $caroussel++;
            }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
</section>

<!-- Plats -->

    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center hop name-red">
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">Plats</h1>
                <hr class="my-4 mx-auto" />
            </div>
        </div>
    </div>


    
<section class="aucentre">
    <div id="carouselExampleCaptions1" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">


    <?php
        $caroussel = 0;
            foreach($getAllRecipesDishes as $info){
                if($caroussel == 0){
                    echo    '<div class="carousel-item active">';
                }else{
                    echo    '<div class="carousel-item">';
                }
                echo    '<img src="' . $path_prefix  . 'assets/images/recipes/' . $info['image'] . '" class="d-block w-100 radius">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><a href=# class="nosurlignage">'. $info['name'] .'</a></h5>
                            </div>
                        </div>';
                $caroussel++;
            }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
</section>

    <!-- Desserts -->
<div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center hop name-red">
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">Desserts</h1>
                <hr class="my-4 mx-auto" />
            </div>
        </div>
    </div>


    
<section class="aucentre bottom">
    <div id="carouselExampleCaptions2" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">


    <?php
        $caroussel = 0;
            foreach($getAllRecipesDesserts as $info){
                if($caroussel == 0){
                    echo    '<div class="carousel-item active">';
                }else{
                    echo    '<div class="carousel-item">';
                }
                echo    '<img src="' . $path_prefix  . 'assets/images/recipes/' . $info['image'] . '" class="d-block w-100 radius">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><a href=# class="nosurlignage">'. $info['name'] .'</a></h5>
                            </div>
                        </div>';
                $caroussel++;
            }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
</section>

   <!-- Signup-->
   <section class="signup-section" id="signup">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-10 col-lg-8 mx-auto text-center">
                    <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                    <h2 class="text-white mb-5">Inscrivez-vous pour recevoir les dernières news !</h2>
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- * * SB Forms Contact Form * *-->
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- This form is pre-integrated with SB Forms.-->
                    <!-- To make this form functional, sign up at-->
                    <!-- https://startbootstrap.com/solution/contact-forms-->
                    <!-- to get an API token!-->
                    <form class="form-signup" id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <!-- Email address input-->
                        <div class="row input-group-newsletter">
                            <div class="col"><input class="form-control" id="emailAddress" type="email" placeholder="Entrez votre adresse mail..." aria-label="Entrez votre adresse mail" data-sb-validations="required,email" /></div>
                            <div class="col-auto"><button class="btn btn-primary" id="submitButton" type="submit">Notifiez moi !</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact-->
    <section class="contact-section bg-black">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary-black mb-2"></i>
                            <h4 class="text-uppercase m-0">Adresse</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black">172 rue Faubourg St-Nicolas, Paris</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary-black mb-2"></i>
                            <h4 class="text-uppercase m-0">Email</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black"><a href="#!">cook-master@gmail.com</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-primary-black mb-2"></i>
                            <h4 class="text-uppercase m-0">Téléphone</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black">06 01 02 03 04</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social d-flex justify-content-center">
                <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </section>

    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5"><?= date('Y'); ?> © <?= APPNAME ?>.</div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $path_prefix ?>assets/pages/scripts_home.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>