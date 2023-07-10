<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div class="navbar-brand-box">
            <a href="<?= ROOT ?>" class="logo">
                <img src="<?= $path_prefix ?><?= LOGO_SVG ?>" />
            </a>
        </div>

        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">


                <li class="menu-title"><?= APPNAME ?></li>

                <li>
                    <a href="<?= $path_prefix ?>home" class="waves-effect"><i class='bx bx-home-smile'></i><span data-translation-key="Accueil"></span></a>
                </li>

                <li>
                    <a href=" <?= $path_prefix ?>shop" class="waves-effect"><i class='bx bx-shopping-bag'></i><span data-translation-key="Boutique des produits"></span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>rentalEquipment" class="waves-effect"><i class='mdi mdi-earth-arrow-right'></i><span data-translation-key="Louer des produits"></span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>EventsPresentation" class="waves-effect"><i class='bx bx-calendar-event'></i><span data-translation-key="Evènements"></span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>WorkshopPresentation" class="waves-effect"><i class='mdi mdi-silverware'></i><span data-translation-key="Atelier"></span></a>
                </li>
                <li>
                    <a href="<?= $path_prefix ?>cookLocation/cookLocation" class="waves-effect"><i class='bx bx-home-circle'></i><span data-translation-key="Louer une cuisine"></span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>UserSubscription/information" class="waves-effect"><i class='mdi mdi-trophy-award'></i><span data-translation-key="Nos abonnements"></span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>jobTraining" class="waves-effect"><i class="bx bxs-analyse"></i><span data-translation-key="Formations"></span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>join" class="waves-effect"><i class='bx bx-id-card'></i><span data-translation-key="Nous rejoindre"></span></a>
                </li>


                <?php
                if (!$this->isSubscription(FREE_SUBSCRIPTION) || $this->isAdmin($this->getUserId())) {
                    echo '<li>
                        <a href="' . $path_prefix . 'HomeService" class="waves-effect"><i class=\'bx bx-buildings\'></i><span data-translation-key="Prestation à domicile"></span></a>
                    </li>';
                }
                ?>

                <li>
                    <a href="<?= $path_prefix ?>Recipes" class="waves-effect"><i class='bx bx-food-menu'></i><span data-translation-key="Recettes"></span></a>
                </li>

                <li><a href="javascript: void(0);" class="has-arrow" data-translation-key="Cours"><i class="bx bx-book-reader"></i></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= $path_prefix ?>Courses/request" data-translation-key="Faire une demande"><i class="bx bx-edit"></i></a></li>
                        <li><a href="<?= $path_prefix ?>Courses/myRequest" data-translation-key="Mes demandes"><i class="bx bx-list-ol"></i></a></li>
                    </ul>
                </li>

                <li class="menu-title" data-translation-key="Utilisateur"></li>

                <li>
                    <a href="<?= $path_prefix ?>users/profil" class="waves-effect"><i class='bx bx-user'></i><span data-translation-key="Profil"></span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>SkillsUsers/increase" class="waves-effect"><i class='bx bx-line-chart'></i><span data-translation-key="Progression"></span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>avatar/createAvatar" class="waves-effect"><i class='bx bx-user-circle'></i><span data-translation-key="Avatar"></span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>rent" class="waves-effect"><i class='bx bx-cart'></i><span data-translation-key="Locations"></span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>personnalEvents" class="waves-effect"><i class='bx bx-calendar-event'></i><span data-translation-key="Evènements"></span></a>
                </li>

                <?php
                if (!$this->isSubscription(FREE_SUBSCRIPTION) || $this->isAdmin($this->getUserId())) {
                    echo '<li>
                        <a href="' . $path_prefix . 'sponsor" class="waves-effect"><i class=\'bx bx-award\'></i><span data-translation-key="Parainage"></span></a>
                    </li>';
                }
                ?>

                <?php
                if (!$this->isSubscription(FREE_SUBSCRIPTION) || $this->isAdmin($this->getUserId())) {
                    echo '<li>
                        <a href="' . $path_prefix . 'Chat" class="waves-effect"><i class=\'bx bx-chat\'></i><span data-translation-key="Conversations"></span></a>
                    </li>';
                }
                ?>

                <?= $sidebarProviders ?>

                <?= $sidebarRh ?>

                <?= $sidebarGestionnaire ?>

                <?= $sidebarAdmin ?>

            </ul>
        </div>
    </div>
</div>