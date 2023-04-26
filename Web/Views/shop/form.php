                   <div class="form-group">
                       <label>Nom</label>
                       <input class="form-control" type="text" name="name" required="" placeholder="Nom du produit">
                   </div>
                   <div class="form-group">
                       <label>Description</label>
                       <textarea class="form-control" type="text" id="floatingTextarea2"name="description" required="" placeholder="Description"></textarea>
                   </div>
                   <div class="form-group">
                       <label>Image</label>
                       <input type="file" name="image" class="dropify" data-height="100" accept="image/png, image/jpeg" required="">
                   </div>

                   <div class="form-group d-flex flex-column align-items-center">
                       <label class="space">Disponibilité à la vente</label>
                       <input type="checkbox" data-toggle="switchery" name="disponibilitySale" id="price_display" data-color="#9e1b21" />
                   <div id="price">
                       <label class="space">Prix de la vente</label>
                       <input type="text" data-toggle="touchspin" name="price_purchase" data-step="1" value="0" data-bts-postfix="€" class="form-control" data-color="#df3554" id="price_default"/>
                </div>
                   </div>
                   <div class="form-group d-flex flex-column align-items-center">
                       <label class="space">Disponibilité à la location</label>
                       <input type="checkbox" data-toggle="switchery" name="disponibilityRental" id="rent_display" data-color="#9e1b21" />
                       <div id="rent">
                       <label class="space">Prix de la location</label>
                       <input type="text" data-toggle="touchspin" name="price_rental" data-step="1" value="0" data-bts-postfix="€" class="form-control" data-color="#df3554" id="rent_default"/>
                       </div>
                   </div>

                   <div class="form-group d-flex flex-column align-items-center">
                       <label class="space">Disponibilité à l'evenementiel</label>
                       <input type="checkbox" data-toggle="switchery" name="disponibilityEvent" data-color="#9e1b21" />
                   </div>
                   <div class="form-group">
                       <label class="space">Nombre de stockage disponible</label>
                       <input type="number" name="disponibilityStock" min="0" required="" class="form-control">
                   </div>
                   </div>
                   <div class="d-flex justify-content-center align-items-center plusgros">
                       <button type="submit" class="btn btn-primary btn-block w-25">Ajouter</button>
                   </div>




<!-- <script type="text/javascript">


const checkbox = document.getElementById('price_display');
const priceDiv = document.getElementById('price');
const priceDefault = document.getElementById('price_default');

const checkbox_rent = document.getElementById('rent_display');
const rentDiv = document.getElementById('rent');
const rentDefault = document.getElementById('rent_default');

priceDiv.style.display = 'none';

rentDiv.style.display = 'none';


checkbox.addEventListener('click', function() {

  if (checkbox.checked) {
    priceDiv.style.display = 'block';
  } else {
    priceDiv.style.display = 'none';
    priceDefault.value = "0";
  }
});


checkbox_rent.addEventListener('click', function() {

  if (checkbox_rent.checked) {
    rentDiv.style.display = 'block';
  } else {
    rentDiv.style.display = 'none';
    rentDefault.value = "0";
    
  }
});

</script> -->