<div class="col-lg-4 col-sm-12">
    <div class="card card-animate">
        <div class="card-body">
            <div class="dropdown float-right position-relative">
                <a href="#" class="dropdown-toggle text-muted" data-toggle="dropdown" aria-expanded="false">
                    Voir plus
                </a>
            </div>
            <h4 class="card-title d-inline-block mb-3"><i class="fas fa-shopping-cart "></i> Vos Commandes</h4>

            <div data-simplebar style="max-height: 380px;">

                <?php 

                    foreach($allCommands as $command){
                        echo '<a href="order/information/' . $command['id_shopping_cart'] . '" class="d-flex align-items-center border-bottom py-3">
                                <div class="mr-3">
                                    <i class="fas fa-shopping-cart fa-2x text-dark"></i>
                                </div>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Commande #'. $command['id_shopping_cart'].'</h6>
                                        <p class="text-muted font-size-11 mb-0">'.$this->convertDateFrench($command['date_purchase']).'</p>
                                    </div>
                                </div>
                            </a>';
                    }
                ?>

                


            </div>

        </div>
    </div>
</div>