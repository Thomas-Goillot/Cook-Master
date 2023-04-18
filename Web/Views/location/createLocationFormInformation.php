<div class="card card-animate">
    <div class="card-body">

        <div class="dropdown float-right position-relative align-items-center">
            Disponible <input type="checkbox" name="location_is_open" id="location_is_open" data-toggle="switchery" data-color="#df3554" data-size="small" checked />
        </div>

        <h4 class="card-title d-inline-block mb-3"><i class="fas fa-list-ul"></i> Information</h4>


        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label for="location_name">Name</label>
                    <input type="text" class="form-control" id="location_name" name="location_name" placeholder="Enter name">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="location_available_to_rental">Location</label>
                    <select class="form-control" id="location_available_to_rental" name="location_available_to_rental">
                        <option disabled selected>Choisir...</option>
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="location_address">Address</label>
            <input type="text" class="form-control" id="location_address" placeholder="Enter address" name="location_address">
        </div>

        <div class="form-group">
            <label for="location_price_day">Price per Day</label>
            <input type="text" class="form-control" id="location_price_day" placeholder="Enter price per day" name="location_price_day">
        </div>
        <div class="form-group">
            <label for="location_price_half_day">Price per Half Day</label>
            <input type="text" class="form-control" id="location_price_half_day" placeholder="Enter price per half day" name="location_price_half_day">
        </div>

    </div>
</div>