<div class="col-lg-4 col-sm-12">
    <div class="card card-animate">
        <div class="card-body">
            <h4 class="card-title d-inline-block mb-3"><i class="fas fa-shopping-cart "></i> Vos locations de cuisine à venir</h4>

            <div data-simplebar style="max-height: 380px;">

                <?php
                    echo '
                <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <h5>' . $location["name"] . '</h5>
                    </div>
                    <h5>' . $location["address"] . '</h5>
                    <p>Débute le</p>
                        <p>' . $cookLocation["start_rental"] . '</p>
                        <p>Se termine</p>
                        <p>' . $cookLocation["end_rental"] . '</p>
                </div>';
                ?>




            </div>

        </div>
    </div>
</div>