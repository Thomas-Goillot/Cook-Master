                   <div class="form-group">
                       <label>Nom</label>
                       <input class="form-control" type="text" name="name" required="" placeholder="Nom du produit">
                   </div>
                   <div class="form-group">
                       <label>Description</label>
                       <input class="form-control" type="text" name="description" required="" placeholder="Description">
                   </div>
                   <div class="form-group">
                       <label>Image</label>
                       <input type="file" name="image" class="dropify" data-height="100" accept="image/png, image/jpeg" required="">
                   </div>

                   <div class="form-group d-flex flex-column align-items-center">
                       <label class="space">Disponibilité à la vente</label>
                       <input type="checkbox" data-toggle="switchery" name="disponibilitySale" data-color="#9e1b21" />
                       <label class="space">Prix de la vente</label>
                       <input type="text" data-toggle="touchspin" name="price_purchase" data-step="1" value="0" data-bts-postfix="€" class="form-control" data-color="#df3554" />
                   </div>
                   <div class="form-group d-flex flex-column align-items-center">
                       <label class="space">Disponibilité à la location</label>
                       <input type="checkbox" data-toggle="switchery" name="disponibilityRental" data-color="#9e1b21" />
                       <label class="space">Prix de la location</label>
                       <input type="text" data-toggle="touchspin" name="price_rental" data-step="1" value="0" data-bts-postfix="€" class="form-control" data-color="#df3554" />
                   </div>

                   <div class="form-group d-flex flex-column align-items-center">
                       <label class="space">Disponibilité à l'evenementiel</label>
                       <input type="checkbox" data-toggle="switchery" name="disponibilityEvent" data-color="#9e1b21" />
                   </div>
                   <div class="form-group">
                       <label class="space">Nombre de stockage disponible</label>
                       <input type="number" name="disponibilityStock" min="0" class="form-control">
                   </div>
                   </div>
                   <div class="d-flex justify-content-center align-items-center plusgros">
                       <button type="submit" class="btn btn-primary btn-block w-25">Ajouter</button>
                   </div>