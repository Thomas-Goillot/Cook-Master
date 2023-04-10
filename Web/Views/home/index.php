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
    <link href="<?= $path_prefix ?>assets/css/home/styles.css" rel="stylesheet" />
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
                    <li class="nav-item"><a class="nav-link" href="#about">A propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $path_prefix ?>recipes">Recettes</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $path_prefix ?>chefs">Nos Chefs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#signup">Contact</a></li>
                    <li><a class="nav-link" href="login"><i class="bi bi-person"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">Cook Master</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- About-->
<div class="fondjaparis" id="about">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="text-center text-white">
                    <h1>Une cuisine d’excellence</h1>
                    <p class="text-white-50">
                        Une cuisine reconnue à travers le monde et appréciée de tous.
                        Du Japon, aux Etats-Unis, en passant par la France, essayez chaque
                        une des recettes emblématiques que nous proposons.
                    </p>
                </div>
        </div>
</div>
    <!-- Projects-->
    <section class="projects-section bg-light" id="about">
        <div class="container px-4 px-lg-5">
            <!-- Project One Row-->
            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="<?= $path_prefix ?>assets/images/home/img1.png" alt="..." /></div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <!-- <h4 class="text-white"></h4> -->
                                <p class="mb-0 text-white-50">Spécialisée dans la cuisine et la gastronomie, CookMaster se distingue par son accueil chaleureux et ses prestations riches et variées.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Two Row-->
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="<?= $path_prefix ?>assets/images/home//image4.png" alt="..." /></div>
                <div class="col-lg-6 order-lg-first">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <!-- <h4 class="text-white"></h4> -->
                                <p class="mb-0 text-white-50">Nous proposons des ateliers de cuisine, des cours à domicile, des leçons en ligne, la location d'espaces équipés, des formations professionnelles et bien plus encore.</p>
                            </div>

                        </div>

                    </div>

                </div>
            </div>


            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="<?= $path_prefix ?>assets/images/home/img2.png" alt="..." /></div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <!-- <h4 class="text-white"></h4> -->
                                <p class="mb-0 text-white-50">Besoin de conseils ? Une messagerie avec des chefs est disponible pour une assistance totalement personnalisée.</p>
                            </div>
                        </div>
                    </div>
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