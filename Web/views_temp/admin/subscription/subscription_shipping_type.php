<div class="col-lg-4">
    <div class="card card-animate">
        <div class="card-body">
            <div class="dropdown float-right position-relative">
                <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item">Créer un nouveau mode de livraison </a></li>
                    <li class="dropdown-divider"></li>
                    <li><a href="#" class="dropdown-item">Edition</a></li>
                </ul>
            </div>
            <h4 class="card-title d-inline-block mb-3"><i class="fas fa-gifts"></i> Mode de livraison</h4>

            <div data-simplebar style="max-height: 380px;">

                <?php
                foreach ($shippingTypes as $shippingType) {
                    echo "
                    <a href=\"#\" class=\"d-flex align-items-center border-bottom py-3\">

                        <div class=\"mr-3\">
                            <i class=\"" . $shippingType['icon'] . "\"></i>
                        </div>
                        
                        <div class=\"w-100\">
                            <div class=\"d-flex justify-content-between\">
                                <h6 class=\"mb-1\"> " . $shippingType['name'] . "</h6>
                            </div>
                        </div>

                    </a>
                
                    ";
                }
                ?>

            </div>

        </div>
    </div>
</div>
