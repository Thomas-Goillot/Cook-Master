<div class="card card-animate">
    <div class="card-body">
        <form action="../Events/addEvent" method="POST">

            <div class="card-title d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0 p-0">Créer un événement</h4>
                <select class="form-control form-control-sm w-50" id="EventTemplateId" name="EventTemplateId">
                    <option>Sélectionner un modèle</option>
                    <?php
                    foreach ($eventsTemplate as $eventTemplate) {
                        echo '<option value="' . $eventTemplate['id_event_template'] . '">' . $eventTemplate['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" maxlength="50" name="EventName" id="EventName" class="form-control" placeholder="Nom du template" />
            </div>

            <div class="form-group">
                <label>Textarea</label>
                <textarea id="EventDescription" name="EventDescription" class="form-control" maxlength="500" rows="4" placeholder="Ceci est une courte description de moins de 500 caractères"></textarea>
            </div>

            <div class="form-group">
                <label>Prix d'entrée</label>
                <input data-toggle="touchspin" name="EventEntryPrice" id="EventEntryPrice" type="text" data-step="1" value="0" data-bts-postfix="€">
            </div>

            <div class="form-group">
                <label>Nombre de place (0 = Pas d'inscription / -1 = Place illimité)</label>
                <input data-toggle="touchspin" name="EventPlace" id="EventPlace" type="text" data-step="1" data-decimals="0" data-min="-1" value="0">
            </div>

            <div class="form-group">
                <label>Date de la location</label>
                <input type="text" class="form-control date" id="EventDate" name="EventDate" data-toggle="daterangepicker" data-time-picker="true" data-locale="{'format': 'DD/MM/YYYY hh:mm'}">
            </div>



            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary btn-block w-25">Créer</button>
            </div>


        </form>

    </div>
</div>