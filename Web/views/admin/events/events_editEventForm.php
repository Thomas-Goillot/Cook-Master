<div class="card card-animate">
    <div class="card-body">
        <form action="<?= $path_prefix ?>events/editEvent" method="POST">

            <input type="hidden" name="EventId" value="<?= $eventInfo['id_event'] ?>" />

            <div class="card-title d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0 p-0">Modification de <?= $eventInfo['name'] ?></h4>
            </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" maxlength="50" name="EventName" id="EventName" class="form-control" placeholder="Nom du template" value="<?= $eventInfo['name'] ?>" />
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea id="EventDescription" name="EventDescription" class="form-control" maxlength="500" rows="4" placeholder="Ceci est une courte description de moins de 500 caractères"><?= $eventInfo['description'] ?></textarea>
            </div>

            <div class="form-group">
                <label>Prix d'entrée</label>
                <input data-toggle="touchspin" name="EventEntryPrice" id="EventEntryPrice" type="text" data-step="1" data-bts-postfix="€" value="<?= $eventInfo['price'] ?>">
            </div>

            <div class="form-group">
                <label>Nombre de place</label>
                <input data-toggle="touchspin" name="EventPlace" id="EventPlace" type="text" data-step="1" data-decimals="0" data-min="-1" value="<?= $eventInfo['place'] ?>">
            </div>

            <div class="form-group">
                <label>Date de l'événement</label>
                <input type="text" class="form-control date" id="EventDate" name="EventDate" data-toggle="daterangepicker" data-time-picker="true" value="<?= $eventInfo['date_start'] . " - " . $eventInfo['date_end'] ?>">
            </div>



            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-secondary btn-bloc">Modifier</button>
        </form>
        <form action="<?= $path_prefix ?>events/deleteEvent" method="POST">
            <input type="hidden" name="EventId" value="<?= $eventInfo['id_event'] ?>" />

            <button type="submit" class="btn btn-primary btn-block mx-3">Supprimer</button>
        </form>
    </div>

</div>
</div>