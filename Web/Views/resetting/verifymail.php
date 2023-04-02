<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center min-vh-100">
                <div class="w-100 d-block my-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center mb-4 mt-3">
                                        <a href="home">
                                            <span><img src="<?= $path_prefix ?><?= LOGO_SVG ?>" alt="" height="150"></span>
                                        </a>
                                    </div>
                                    <?php
                                    if (isset($error) && !empty($error)) {
                                        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                                    }
                                    ?>
                                    <div class="text-center">
                                        <p class="text-muted w-75 mx-auto"> Nous venons de vous envoyez un mail de validation ! Merci de renseigner le code de validation ci-dessous. </p>
                                    </div>
                                    <form action="" method="POST" class="p-2">
                                        <div class="form-group">
                                            <label for="code_validation">Code de validation</label>
                                            <input class="form-control" type="number" id="code_validation" name="code_validation" required="" placeholder="xxxxxxxx">
                                        </div>
                                        <div class="mb-3 text-center">
                                            <button class="btn btn-primary btn-block" type="submit"> Valider mon email </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-12 text-center">
                                    <p class="text-white-50 mb-0">Already have an account? <a href="../login" class="text-white-50 ml-1"><b>Sign In</b></a></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>