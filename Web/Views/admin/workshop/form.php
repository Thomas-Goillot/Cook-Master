<div class="form-group">
                        <label>Nom</label>
                        <input class="form-control" type="text" name="name" required="" placeholder="Nom du produit"">
                    </div>
                    <div class=" form-group">
                        <label>Description</label>
                        <textarea class="form-control" type="text" name="description" required="" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="dropify" data-height="100" accept="image/png, image/jpeg">
                    </div>
                    <div class="form-group d-flex flex-column align-items-center">
                        <label class="space">Prix</label>
                        <input type="text" data-toggle="touchspin" name="price_purchase" data-step="0.01" value="0" data-bts-postfix="€" class="form-control" data-color="#df3554" id="price_default" />
                    </div>
                    <div class="form-group">
                        <label class="space">Nombre de place disponible</label>

                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control date" name="WorkshopDate" data-toggle="daterangepicker" data-time-picker="true" data-locale="{'format': 'DD/MM/YYYY hh:mm'}">
                    </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn b btn-primary btn-block btn-rounded small">Ajouter l'atelier</button>
            </div>