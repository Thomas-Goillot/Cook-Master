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
                                    <form action="register" method="POST" class="p-2">
                                        <div class="form-group">
                                            <label for="username">Name</label>
                                            <input class="form-control" type="text" id="name" name="name" required="" placeholder="Michael" autoccomplete="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Surname</label>
                                            <input class="form-control" type="text" id="surname" name="surname" required="" placeholder="Zenaty" autocomplete="surname">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input class="form-control" type="email" id="email" name="email" required="" placeholder="john@deo.com" autocomplete="email">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone number</label>
                                            <input type="text" class="form-control" id="phone" name="phone" data-toggle="input-mask" data-mask-format="(+99) 99 99 99 99 99" maxlength="13" autocomplete="phone" required="">
                                            <span class="font-13 text-muted">e.g "(+xx) xx xx xx xx xx"</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password" autocomplete="new-password">
                                        </div>
                                        <div class="form-group mb-4 pb-3">
                                            <div class="custom-control custom-checkbox checkbox-primary">
                                                <input type="checkbox" class="custom-control-input" id="terms" name="terms">
                                                <label class="custom-control-label" for="terms">I accept <a href="#">Terms and Conditions</a></label>
                                            </div>
                                        </div>
                                        <div class="mb-3 text-center">
                                            <button class="btn btn-primary btn-block" type="submit"> Sign Up Free </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-12 text-center">
                                    <p class="text-white-50 mb-0">Already have an account? <a href="login" class="text-white-50 ml-1"><b>Sign In</b></a></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>