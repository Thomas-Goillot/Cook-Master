<div class="col-lg-4 col-sm-12">
    <div class="card card-animate">
        <div class="card-body">
            <div class="dropdown float-right position-relative">
                <a href="#" class="dropdown-toggle text-muted" data-toggle="dropdown" aria-expanded="false">
                    Voir plus
                </a>
            </div>
            <h4 class="card-title d-inline-block mb-3"><i class="fas fa-shopping-cart "></i> Vos locations de cuisine</h4>

            <div data-simplebar style="max-height: 380px;">

                <?php 

                    foreach($cookLocation as $cookLocation){
                        echo '  <div class="mr-3">
                                   <i class="fas fa-shopping-cart fa-2x text-dark"></i>
                                </div>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Location #'. $cookLocation['id_shopping_cart'].'</h6>
                                    </div>
                                </div>
                            </a>';
                    }
                ?>

                


            </div>

        </div>
    </div>
</div>