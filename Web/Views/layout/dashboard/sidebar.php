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
                    <a href="<?= $path_prefix ?>" class="waves-effect"><i class='bx bx-home-smile'></i><span>Accueil</span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>shop" class="waves-effect"><i class='bx bx-shopping-bag'></i><span>Boutique</span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>rentalEquipment" class="waves-effect"><i class='fas fa-truck-loading'></i><span>Louer</span></a>
                </li>
                
                <li>
                    <a href="<?= $path_prefix ?>EventsPresentation" class="waves-effect"><i class='bx bx-calendar-event'></i><span>Evènements</span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>WorkshopPresentation" class="waves-effect"><i class='fas fa-store'></i><span>Atelier</span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>UserSubscription/information" class="waves-effect"><i class='mdi mdi-trophy-award'></i><span>Nos abonnements</span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>join" class="waves-effect"><i class='bx bx-id-card'></i><span>Nous rejoindre</span></a>
                </li>


                <?php
                if (!$this->isSubscription(FREE_SUBSCRIPTION) || $this->isAdmin($this->getUserId())) {
                    echo '<li>
                        <a href="' . $path_prefix . 'HomeService" class="waves-effect"><i class=\'bx bx-buildings\'></i><span>Prestation à domicile</span></a>
                    </li>';
                }
                ?>
                
                <li>
                    <a href="<?= $path_prefix ?>Recipes" class="waves-effect"><i class='bx bx-food-menu'></i><span>Recettes</span></a>
                </li>

                <li><a href="javascript: void(0);" class="has-arrow"><i class="bx bx-book-reader"></i>Cours</a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= $path_prefix ?>Courses/request"><i class="bx bx-edit"></i>Faire une demande</a></li>
                        <li><a href="<?= $path_prefix ?>Courses/myRequest"><i class="bx bx-list-ol"></i>Mes demandes</a></li>
                    </ul>
                </li>

                <li class="menu-title">Utilisateur</li>

                <li>
                    <a href="<?= $path_prefix ?>users/profil" class="waves-effect"><i class='bx bx-user'></i><span>Profil</span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>SkillsUsers/increase" class="waves-effect"><i class='bx bx-line-chart'></i><span>Progression</span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>avatar/createAvatar" class="waves-effect"><i class='bx bx-user-circle'></i><span>Avatar</span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>rent" class="waves-effect"><i class='bx bx-cart'></i><span>Locations</span></a>
                </li>

                <li>
                    <a href="<?= $path_prefix ?>personnalEvents" class="waves-effect"><i class='bx bx-calendar-event'></i><span>Evènements</span></a>
                </li>


                <?php
                if (!$this->isSubscription(FREE_SUBSCRIPTION) || $this->isAdmin($this->getUserId())) {
                    echo '<li>
                        <a href="' . $path_prefix . 'Chat" class="waves-effect"><i class=\'bx bx-chat\'></i><span>Conversations</span></a>
                    </li>';
                }
                ?>

                <?= $sidebarProviders ?>

                <?= $sidebarRh ?>

                <?= $sidebarAdmin ?>

            </ul>
        </div>
    </div>
</div>