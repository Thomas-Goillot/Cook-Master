<li class="menu-title">Administrateur</li>

<li><a href="<?= $path_prefix ?>admin/users" class="waves-effect"><i class="bx bx-group"></i><span data-translation-key="Utilisateurs"></span></a></li>

<li><a href="<?= $path_prefix ?>admin/subscription" class=" waves-effect"><i class="mdi mdi-trophy-award"></i><span data-translation-key="Abonnement"></span></a></li>

<li><a href="<?= $path_prefix ?>Recipes/recipesAdmin" class=" waves-effect"><i class="bx bx-restaurant"></i><span data-translation-key="Recettes"></span></a></li>

<li><a href="<?= $path_prefix ?>registrationService/admin" class=" waves-effect"><i class="fas fa-glass-cheers"></i><span data-translation-key="Préstations"></span></a></li>

<li><a href="<?= $path_prefix ?>coursesAdmin" class=" waves-effect"><i class="fa fa-book-reader"></i><span data-translation-key="Cours"></span></a></li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bxs-cake"></i><span data-translation-key="Atelier"></span></a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="<?= $path_prefix ?>WorkshopAdmin/listWorkshop" data-translation-key="Liste des ateliers"><i class="bx bx-list-ul"></i></a></li>
        <li><a href="<?= $path_prefix ?>WorkshopAdmin/index" data-translation-key="Créer un atelier"><i class="bx bx-bookmark-plus"></i></a></li>

        <li><a href="javascript: void(0);" class="has-arrow" data-translation-key="Formation"><i class="bx bx-sitemap"></i></a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="javascript: void(0);" data-translation-key="Liste formations"><i class="bx bx-list-ol"></i></a></li>
                <li><a href="javascript: void(0);" data-translation-key="Créer Formation"><i class="bx bx-bookmark-plus"></i></a></li>
            </ul>
        </li>
    </ul>
</li>

<li><a href="javascript: void(0);" class="has-arrow" data-translation-key="Compétences"><i class="bx bx-certification"></i></a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="<?= $path_prefix ?>skillsAdmin/certificate" data-translation-key="Certificats"><i class="bx bxs-wallet-alt"></i></a></li>
        <li><a href="<?= $path_prefix ?>skillsAdmin/skills" data-translation-key="Compétences"><i class="fas fa-lightbulb"></i></a></li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-cart"></i><span data-translation-key="Evènements"></span></a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="<?= $path_prefix ?>admin/eventsTemplate" data-translation-key="Template"><i class="bx bxs-file-plus"></i></a></li>
        <li><a href="<?= $path_prefix ?>admin/events" data-translation-key="Liste des évènements"><i class="bx bx-calendar"></i></a></li>
    </ul>
</li>


<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-map"></i><span data-translation-key="Emplacement"></span></a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="<?= $path_prefix ?>location/index" data-translation-key="Liste des Lieux"><i class="bx bx-map-alt"></i></a></li>
        <li><a href="<?= $path_prefix ?>location/createLocation" data-translation-key="Ajout d'un Lieu"><i class="bx bxs-image-add"></i></a></li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-cart"></i><span data-translation-key="Gestion Boutique"></span></a>
    <ul class=" sub-menu" aria-expanded="false">
        <li><a href="<?= $path_prefix ?>admin/products" data-translation-key="Produits"><i class="bx bx-cart-alt"></i></a></li>
        <li><a href="<?= $path_prefix ?>admin/sales" data-translation-key="Ventes"><i class="bx bx-list-check"></i></a></li>
    </ul>
</li>

<li><a href="<?= $path_prefix ?>moderation/wordlist" data-translation-key="Modération"><i class="bx bx-check-shield"></i></a></li>

<li><a href="<?= $path_prefix ?>stats/index" class=" waves-effect"><i class="bx bx-pie-chart-alt"></i><span data-translation-key="Statistiques"></span></a></li>