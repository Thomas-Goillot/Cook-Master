<div class="form-group">
    <label data-translation-key="Nom"></label>
    <input class="form-control" type="text" name="name" required="" placeholder="Nom de l'atelier" value="<?= isset($allWorkshop['name']) ? $allWorkshop['name'] : "" ?>">
</div>

<div class="form-group">
    <label data-translation-key="Description"></label>
    <textarea class="form-control" type="text" name="description" required="" placeholder="Description"><?= isset($allWorkshop['description']) ? $allWorkshop['description'] : "" ?></textarea>
</div>

<div class="form-group">
    <label data-translation-key="Image"></label>
    <input type="file" name="image" class="dropify" data-height="100" accept="image/png, image/jpeg">
</div>

<div class="form-group d-flex flex-column align-items-center">
    <label class="space" data-translation-key="Prix"></label>
    <input type="text" data-toggle="touchspin" name="price" data-step="1" value="0" data-bts-postfix="€" class="form-control" data-color="#df3554" id="price_default" value="<?= isset($allWorkshop['price']) ? $allWorkshop['price'] : "" ?>" />
</div>

<div class="form-group">
    <label data-translation-key="Date de la location"></label>
    <input type="text" class="form-control date" id="WorkshopDate" name="WorkshopDate" data-toggle="daterangepicker" data-time-picker="true" data-locale="{'format': 'DD/MM/YYYY hh:mm'}">
</div>

<div class="form-group d-flex flex-column align-items-center">
    <label class="space" data-translation-key="Nombre de place disponible"></label>
    <input type="number" data-toggle="touchspin" data-step="1" data-decimals="0" name="nb_place" data-bts-postfix=" " min="0" required="" class="form-control" value="<?= isset($allWorkshop['nb_place']) ? $allWorkshop['nb_place'] : "" ?>">
</div>