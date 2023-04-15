<?php
include_once('Views/layout/dashboard/path.php');
?>



<div class="row">
    <div class="col-12">
        <div class="card card-animate">
            <div class="card-body">

                <div class="row h-100">
                    <div class="col-lg-4 col-md-4 col-sm-0">

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Rechercher" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>


                        <div data-simplebar style="min-height: 65vh;">

                            <?php
                            foreach ($conversationGuest as $conversation) {
                                echo "
                            <a href=\"#\" class=\"d-flex align-items-center border-bottom py-3\" id=\"buttonDisplay\" data-idconversation=\"" . $conversation['id_conversation'] . "\">
                                <div class=\"mr-3\">
                                    <img src=\"" . $path_prefix . "assets/images/users/user.png\" class=\"rounded-circle avatar-sm\" alt=\"user\">
                                </div>
                                <div class=\"w-100\">
                                    <div class=\"d-flex justify-content-between\">
                                        <h6 class=\"mb-1\">" . $conversation['name'] . " " . $conversation['surname'] . "</h6>
                                        <p class=\"text-muted font-size-11 mb-0\">En Ligne</p>
                                    </div>
                                    <p class=\"text-muted font-size-13 mb-0\">" . $conversation['lastMessage'] . "</p>
                                </div>
                            </a>";
                            }
                            ?>

                            <div class="d-flex justify-content-center align-items-center border-bottom py-3">
                                <button class="btn btn-primary"><i class="bx bx-plus"></i> Conversation</button>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-8 col-md-8 d-flex flex-column" id="ConversationChatBox">

                        <div class="d-flex align-items-center border-bottom py-3">
                            <div class="mr-3">
                                <img src="<?= $path_prefix ?>assets/images/users/user.png" class="rounded-circle avatar-sm" alt="user">
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">Commencer une nouvelle conversation</h6>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column justify-content-center align-items-center h-100 ">
                            <p class="text-muted">Vous n'êtes pas encore dans une conversation</p>
                            <button class="btn btn-primary"><i class="bx bx-plus"></i> Conversation</button>
                        </div>



                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .message {
        border-radius: 5px;
        padding: 10px;
        margin: 10px;
        width: fit-content;
        max-width: 50%;
        align-self: flex-start;
    }

    .user-1 {
        align-self: flex-end;
        background-color: var(--danger);
        color: white;
    }

    .user-2 {
        align-self: flex-start;
        background-color: #f1f1f1;
    }
</style>