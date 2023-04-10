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

        <!-- Entrées -->

        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center hop name-red">
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">Entrées</h1>
            </div>
        </div>
    </div>

    <section class="contact-section bg-white noschefs1">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <?php
                    foreach($getAllRecipesStarters as $info){
                        echo    '<div class="col-md-4 mb-3 mb-md-0">
                                    <div class="card py-4 h-100">
                                        <img src="' . $path_prefix  . 'assets/images/recipes/' . $info['image'] . '" class="img-thumbnail noschefs">
                                            <div class="card-body text-center"> 
                                                <hr class="my-4 mx-auto" />
                                                <h4 class="text-uppercase m-0 name-red">' . $info['name'] . '</h4>
                                                <div class="small text-black chef2">' . $info['description'] . '</div>
                                            </div>
                                    </div>
                                </div>';
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- Plats -->

    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center hop name-red">
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">Plats</h1>
            </div>
        </div>
    </div>

    <section class="contact-section bg-white noschefs1">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <?php
                    foreach($getAllRecipesDishes as $info){
                        echo    '<div class="col-md-4 mb-3 mb-md-0">
                                    <div class="card py-4 h-100">
                                        <img src="' . $path_prefix  . 'assets/images/recipes/' . $info['image'] . '" class="img-thumbnail noschefs">
                                            <div class="card-body text-center"> 
                                                <hr class="my-4 mx-auto" />
                                                <h4 class="text-uppercase m-0 name-red">' . $info['name'] . '</h4>
                                                <div class="small text-black chef2">' . $info['description'] . '</div>
                                            </div>
                                    </div>
                                </div>';
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- Desserts -->

    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center hop name-red">
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">Desserts</h1>
            </div>
        </div>
    </div>

    <section class="contact-section bg-white noschefs1">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <?php
                    foreach($getAllRecipesDesserts as $info){
                        echo    '<div class="col-md-4 mb-3 mb-md-0">
                                    <div class="card py-4 h-100">
                                        <img src="' . $path_prefix  . 'assets/images/recipes/' . $info['image'] . '" class="img-thumbnail noschefs">
                                            <div class="card-body text-center"> 
                                                <hr class="my-4 mx-auto" />
                                                <h4 class="text-uppercase m-0 name-red">' . $info['name'] . '</h4>
                                                <div class="small text-black chef2">' . $info['description'] . '</div>
                                            </div>
                                    </div>
                                </div>';
                    }
                ?>
            </div>
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