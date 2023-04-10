<li class="menu-title">Administrateur</li>

<li><a href="<?= $path_prefix ?>admin/users" class="waves-effect"><i class="bx bx-group"></i><span>Utilisateurs</span></a></li>

<li><a href="<?= $path_prefix ?>admin/event" class=" waves-effect"><i class="bx bx-calendar"></i><span>Evènements</span></a></li>

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
        <li><a href="<?= $path_prefix ?>admin/wordlist"><i class="bx bx-list-check"></i>Liste de mots</a></li>
        <li><a href="<?= $path_prefix ?>admin/chat"><i class="bx bx-chat"></i>Conversations</a></li>
    </ul>
</li>

<li><a href="<?= $path_prefix ?>admin/stats" class=" waves-effect"><i class="bx bx-pie-chart-alt"></i><span>Statistiques</span></a></li>