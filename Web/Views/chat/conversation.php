<div class="d-flex align-items-center border-bottom py-3">
    <div class="mr-3">
        <img src="assets/images/users/user.png" class="rounded-circle avatar-sm" alt="user">
    </div>
    <div class="w-100">
        <div class="d-flex justify-content-between">
            <h6 class="mb-1"><?= $conversationGuest[0]['name'] . " " . $conversationGuest[0]['surname'] ?></h6>
        </div>
    </div>
</div>

<div class="d-flex flex-column mt-5 overflow-auto" style="max-height: 50vh;" id="chatbox">

    <?php include_once('Views/Chat/Chatbox.php'); ?>

</div>

<div class="d-flex align-items-center border-top py-3 mt-auto ">
    <div class="w-100">
        <div class="d-flex justify-content-between">
            <input type="text" class="form-control" id="message" placeholder="Votre message">
            <button type="button" class="btn btn-primary" id="sendMessage">Envoyer</button>
        </div>
    </div>
</div>