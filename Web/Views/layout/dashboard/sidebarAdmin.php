<li class="menu-title">Administrateur</li>

<li><a href="<?= $path_prefix ?>admin/users" class="waves-effect"><i class="bx bx-group"></i><span>Utilisateurs</span></a></li>

<li><a href="<?= $path_prefix ?>admin/recipesAdmin" class=" waves-effect"><i class="bx bx-restaurant"></i><span>Recettes</span></a></li>

<li><a href="<?= $path_prefix ?>admin/recipesAdmin" class=" waves-effect"><i class="fas fa-glass-cheers"></i><span>Préstations</span></a></li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fa fa-book-reader"></i><span>Cours</span></a>
    <ul class="sub-menu" aria-expanded="true">
        <li><a href="javascript: void(0);" class="has-arrow"><i class="bx bx-wifi"></i>En ligne</a>
            <ul class="sub-menu" aria-expanded="true">
                <li><a href="javascript: void(0);"><i class="bx bx-list-ol"></i>Gestion cours</a></li>
                <li><a href="javascript: void(0);"><i class="bx bx-bookmark-plus"></i>Création cours</a></li>
            </ul>
        </li>
        <li><a href="javascript: void(0);" class="has-arrow"><i class="bx bx-home-alt"></i>Présentiel</a>
            <ul class="sub-menu" aria-expanded="true">
                <li><a href="javascript: void(0);"><i class="bx bx-list-ol"></i>Gestion cours</a></li>
                <li><a href="javascript: void(0);"><i class="bx bx-bookmark-plus"></i>Création cours</a></li>
            </ul>
        </li>
        <li><a href="javascript: void(0);" class="has-arrow"><i class="bx bx-sitemap"></i>Formation</a>
            <ul class="sub-menu" aria-expanded="true">
                <li><a href="javascript: void(0);"><i class="bx bx-list-ol"></i>Liste formations</a></li>
                <li><a href="javascript: void(0);"><i class="bx bx-bookmark-plus"></i>Créer Formation</a></li>
            </ul>
        </li>
    </ul>
</li>
<!-- fas fa-file-contract 
fas fa-file-invoice-->


<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-cart"></i><span>Evènements</span></a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="<?= $path_prefix ?>admin/eventsTemplate"><i class="bx bxs-file-plus"></i>Template</a></li>
        <li><a href="<?= $path_prefix ?>admin/events"><i class="bx bx-calendar"></i>Liste des évènements</a></li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bxs-cake"></i><span>Atelier</span></a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="<?= $path_prefix ?>WorkshopAdmin/listWorkshop"><i class="bx bx-list-ul"></i>Liste des ateliers</a></li>
        <li><a href="<?= $path_prefix ?>WorkshopAdmin/index"><i class="bx bx-bookmark-plus"></i>Créer un atelier</a></li>
    </ul>
</li>



<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-map"></i><span>Emplacement</span></a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="<?= $path_prefix ?>location/index"><i class="bx bx-map-alt"></i>Liste des Lieux</a></li>
        <li><a href="<?= $path_prefix ?>location/createLocation"><i class="bx bxs-image-add"></i>Ajout d'un Lieu</a></li>
    </ul>
</li>

<li><a href="<?= $path_prefix ?>admin/subscription" class=" waves-effect"><i class="mdi mdi-trophy-award"></i><span>Abonnement</span></a></li>

<li><a href="<?= $path_prefix ?>admin/monitoring" class=" waves-effect"><i class="bx bx-server"></i><span>Monitoring</span></a></li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-cart"></i><span>Gestion Boutique</span></a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="<?= $path_prefix ?>admin/products"><i class="bx bx-cart-alt"></i>Produits</a></li>
        <li><a href="<?= $path_prefix ?>admin/sales"><i class="bx bx-list-check"></i>Ventes</a></li>
    </ul>
</li>


<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-check-shield"></i><span>Modération</span></a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="<?= $path_prefix ?>moderation/wordlist"><i class="bx bx-list-check"></i>Liste de mots</a></li>
        <li><a href="<?= $path_prefix ?>moderation/Chat"><i class="bx bx-chat"></i>Conversations</a></li>
    </ul>
</li>

<li><a href="<?= $path_prefix ?>stats/index" class=" waves-effect"><i class="bx bx-pie-chart-alt"></i><span>Statistiques</span></a></li>