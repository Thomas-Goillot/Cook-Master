<div class="col-lg-4">
    <div class="card card-animate">
        <div class="card-body">
            <div class="dropdown float-right position-relative">
                <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item">Créer une nouvelle récompense </a></li>
                    <li class="dropdown-divider"></li>
                    <li><a href="#" class="dropdown-item">Edition</a></li>
                </ul>
            </div>
            <h4 class="card-title d-inline-block mb-3"><i class="fas fa-gifts"></i> Récompenses d'abonnement</h4>

            <div data-simplebar style="max-height: 380px;">

                <?php
                foreach ($rewards as $reward) {
                    echo "
                    <a href=\"#\" class=\"d-flex align-items-center border-bottom py-3\" data-toggle=\"modal\" data-target=\"#modal" . $reward['id_rewards'] . "\">

                        <div class=\"mr-3\">
                            <i class=\"fas fa-gift \"></i>
                        </div>
                        
                        <div class=\"w-100\">
                            <div class=\"d-flex justify-content-between\">
                                <h6 class=\"mb-1\"> " . $reward['name'] . "</h6>
                            </div>
                            <p class=\"text-muted font-size-13 mb-0\">" . $reward['description'] . "</p>
                        </div>

                    </a>
                
                    ";
                }
                ?>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal1">" . $reward['name'] . "</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                " . $reward['description'] . "
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div>
    </div>
</div>
