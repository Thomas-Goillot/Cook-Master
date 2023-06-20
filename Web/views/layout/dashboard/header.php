<header id="page-topbar">
    <div class="navbar-header">

        <div class="d-flex align-items-left">
            <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex align-items-center">

            <a class="btn header-item noti-icon waves-effect d-flex justify-content-center align-items-center" href="<?= $path_prefix ?>rentalEquipment/cart">
                <i class="mdi mdi-shopping-outline"></i>
            </a>

            <a class="btn header-item noti-icon waves-effect d-flex justify-content-center align-items-center" href="<?= $path_prefix ?>shop/cart">
                <i class="bx bx-shopping-bag"></i>
            </a>

            <div id="traduction_site_web"></div>

            <!-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= $path_prefix ?>assets/images/flags/french.jpg" alt="user-image" class="mr-1" height="12">
                    <span class="align-middle">French</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">

                    <a href="#" class="dropdown-item notify-item" id="fr">
                        <img src="<?= $path_prefix ?>assets/images/flags/french.jpg" alt="user-image" class="mr-1" height="12">
                        <span class="align-middle">French</span>
                    </a>

                    <a href="#" class="dropdown-item notify-item" id="en">
                        <img src="<?= $path_prefix ?>assets/images/flags/us.jpg" alt="user-image" class="mr-1" height="12">

                        <span class="d-none d-sm-inline-block ml-1">English</span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item" id="es">
                        <img src="<?= $path_prefix ?>assets/images/flags/spain.jpg" alt="user-image" class="mr-1" height="12">
                        <span class="align-middle">Spanish</span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item" id="de">
                        <img src="<?= $path_prefix ?>assets/images/flags/germany.jpg" alt="user-image" class="mr-1" height="12">
                        <span class="align-middle">German</span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item" id="it">
                        <img src="<?= $path_prefix ?>assets/images/flags/italy.jpg" alt="user-image" class="mr-1" height="12">
                        <span class="align-middle">Italian</span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item" id="ru">
                        <img src="<?= $path_prefix ?>assets/images/flags/russia.jpg" alt="user-image" class="mr-1" height="12">
                        <span class="align-middle">Russian</span>
                    </a>
                </div>
            </div> -->

            <!--  <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="badge badge-danger badge-pill">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small font-weight-bold"> View All</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <img src="<?= $path_prefix ?>assets/images/users/avatar-5.jpg" class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Samuel Coverdale</h6>
                                    <p class="font-size-12 mb-1">You have new follower on Instagram</p>
                                    <p class="font-size-11 font-weight-bold mb-0 text-muted"><i class="mdi mdi-clock-outline"></i> 2 min ago</p>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-primary rounded-circle">
                                        <i class="mdi mdi-cloud-download-outline"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Download Available !</h6>
                                    <p class="font-size-11 mb-1">Latest version of admin is now available.
                                        Please download here.</p>
                                    <p class="font-size-11 font-weight-bold mb-0 text-muted"><i class="mdi mdi-clock-outline"></i> 4 hours ago</p>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <img src="<?= $path_prefix ?>assets/images/users/avatar-8.jpg" class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Victoria Mendis</h6>
                                    <p class="font-size-12 mb-1">Just upgraded to premium account.</p>
                                    <p class="font-size-11 font-weight-bold mb-0 text-muted"><i class="mdi mdi-clock-outline"></i> 1 day ago</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2">
                        <a class="btn btn-sm btn-link btn-block text-center font-size-14" href="javascript:void(0)">
                            Load More.. <i class="mdi mdi-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div> -->

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $this->loadAvatar($this->getUserId(), $path_prefix) ?>


                    <span class="d-none d-sm-inline-block ml-1"><?= ucfirst($data['user']['name']) . " " . ucfirst($data['user']['surname']) ?></span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="<?= $path_prefix ?>disconnect">
                        <span>Déconnexion</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>