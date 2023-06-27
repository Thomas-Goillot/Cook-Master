<div class="card card-animate">
    <div class="card-body">
        <h4 class="card-title" data-translation-key="Créer un Modèles d'évènements"></h4>

        <form action="../eventsTemplate/addEventTemplate" method="POST">

            <div class="form-group">
                <label data-translation-key="Name"></label>
                <input type="text" maxlength="50" name="EventTemplateName" id="EventTemplateName" class="form-control" placeholder="Nom du template" />
            </div>

            <div class="form-group">
                <label data-translation-key="Description"></label>
                <textarea id="EventTemplateDescription" name="EventTemplateDescription" class="form-control" maxlength="500" rows="3" placeholder="Ceci est une courte description de moins de 500 caractères"></textarea>
            </div>

            <div class="form-group">
                <label data-translation-key="Prix d'entrée"></label>
                <input data-toggle="touchspin" name="EventTemplateEntryPrice" id="EventTemplateEntryPrice" type="text" data-step="1" value="0" data-bts-postfix="€">
            </div>

            <div class="form-group">
                <label data-translation-key="Nombre de place (0 = Pas d'inscription / -1 = Place illimité)"></label>
                <input data-toggle="touchspin" name="EventTemplatePlace" id="EventTemplatePlace" type="text" data-step="1" data-decimals="0" data-min="-1" value="0">
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary btn-block w-25" data-translation-key="Créer"></button>
            </div>

        </form>

    </div>
</div>