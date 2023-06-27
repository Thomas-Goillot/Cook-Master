<div class="col-lg-4">
    <div class="card card-animate">
        <div class="card-body">
            <div class="dropdown float-right position-relative">
                <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item" data-translation-key="Créer une nouvelle option"></a></li>
                    <li class="dropdown-divider"></li>
                    <li><a href="#" class="dropdown-item" data-translation-key="Edition"></a></li>
                </ul>
            </div>
            <h4 class="card-title d-inline-block mb-3"><i class="fas fa-list-ul"></i> <span data-translation-key="Options d'abonnement disponible"></span></h4>

            <div data-simplebar style="max-height: 180px;">
                <?php foreach ($subscriptionOption as $option) { ?>
                    <a href="#" class="d-flex align-items-center border-bottom py-3">
                        <div class="mr-3">
                            <i class="fab fa-adversal"></i>
                        </div>
                        <div class="w-100">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1"><?php echo $option['name']; ?></h6>
                            </div>
                            <p class="text-muted font-size-13 mb-0"><?php echo $option['description']; ?></p>
                        </div>
                    </a>
                <?php } ?>
            </div>

        </div>
    </div>
</div>