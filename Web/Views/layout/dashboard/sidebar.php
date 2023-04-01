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
                    <a href="/" class="waves-effect"><i class='bx bx-home-smile'></i><span>Accueil</span></a>
                </li>

                <li>
                    <a href="/shop" class="waves-effect"><i class='bx bx-shopping-bag'></i><span>Boutique</span></a>
                </li>

                <li>
                    <a href="/event" class="waves-effect"><i class='bx bx-calendar-event'></i><span>Evènements</span></a>
                </li>

                <li class="menu-title">Utilisateur</li>

                <li>
                    <a href="users/profil" class="waves-effect active"><i class='bx bx-user'></i><span>Profil</span></a>
                </li>

                <li>
                    <a href="users/command" class="waves-effect"><i class='bx bx-cart'></i><span>Commandes</span></a>
                </li>

                <li>
                    <a href="users/rent" class="waves-effect"><i class='bx bx-cart'></i><span>Locations</span></a>
                </li>

                <li>
                    <a href="users/event" class="waves-effect"><i class='bx bx-calendar-event'></i><span>Evènements</span></a>
                </li>

                <li>
                    <a href="users/chat" class="waves-effect"><i class='bx bx-chat'></i><span>Conversations</span></a>
                </li>


                <?= $sidebarAdmin ?>

            </ul>
        </div>
    </div>
</div>