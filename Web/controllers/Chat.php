<?php

namespace Controllers;

use App\Controller;

class Chat extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "chat/index";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        if ($this->isSubscription(FREE_SUBSCRIPTION) && !$this->isAdmin($this->getUserId())) {
            $this->setError("Oups !", "Vous n\'avez pas l\'abonnement nécessaire pour accéder à cette page", INFO_ALERT);
            $this->redirect('UserSubscription/information');
            exit();
        }
    }

    /**
     * Display page conversation of a user
     */
    public function index():void
    {
        $this->loadModel('Tchat');

        $user_id = $this->getUserId();

        $conversations = $this->_model->getConversation($user_id);

        $conversationGuest = array();

        foreach ($conversations as $key => $conversation) {
            $this->loadModel('user');
            $temp = $conversation['id_users1'];
            $conversations['user1'] = $this->_model->getUserName($conversation['id_users1']);
            $conversations['user1']['id'] = $temp;
            $conversations['user1']['guest'] = $conversations['user1']['id'] == $user_id ? false : true;
            $conversations['user1']['id_conversation'] = $conversation['id_conversation'];

            
            $temp = $conversation['id_users2'];
            $conversations['user2'] = $this->_model->getUserName($conversation['id_users2']);
            $conversations['user2']['id'] = $temp;
            $conversations['user2']['guest'] = $conversations['user2']['id'] == $user_id ? false : true;
            $conversations['user2']['id_conversation'] = $conversation['id_conversation'];

            $conversationGuest[] = $conversations['user1']['guest'] ? $conversations['user1'] : $conversations['user2'];
            
            $this->loadModel('Tchat');
            $conversationGuest[$key]['lastMessage'] = $this->_model->getLastMessage($conversation['id_conversation']);

            $conversationGuest[$key]['lastMessage'] = $this->checkMessage($conversationGuest[$key]['lastMessage']);

            $this->loadModel('user');
            if ($this->_model->getUserCensureChat($user_id) == CENSURE_CHAT) {
                $conversationGuest[$key]['lastMessage'] = $this->checkSwearWords($conversationGuest[$key]['lastMessage']);
            }
        }

        $page_name = array("Conversation" => "Chat");

        $this->setJsFile(array('chat.js'));

        $this->render($this->default_path, compact('conversationGuest','page_name'),DASHBOARD);
    }


    /**
     * Display a conversation via ajax
     * @return void
     *  */
    public function displayConversation():void
    {
        $id_conversation = (int) $_GET['params'][0];

        $this->loadModel('Tchat');

        $user_id = $this->getUserId();

        $messages = $this->_model->getMessages($id_conversation);

        $conversations = $this->_model->getConversation($user_id);

        $conversationGuest = array();

         foreach ($conversations as $key => $conversation) {
            $this->loadModel('user');

            $temp = $conversation['id_users1'];            
            $conversations['user1'] = $this->_model->getUserName($conversation['id_users1']);
            $conversations['user1']['id'] = $temp;
            $conversations['user1']['guest'] = $conversations['user1']['id'] == $user_id ? false : true;
            $conversations['user1']['id_conversation'] = $conversation['id_conversation'];


            $temp = $conversation['id_users2'];
            $conversations['user2'] = $this->_model->getUserName($conversation['id_users2']);
            $conversations['user2']['id'] = $temp;
            $conversations['user2']['guest'] = $conversations['user2']['id'] == $user_id ? false : true;
            $conversations['user2']['id_conversation'] = $conversation['id_conversation'];

            $conversationGuest[] = $conversations['user1']['guest'] ? $conversations['user1'] : $conversations['user2'];

            $this->loadModel('Tchat');
            $conversationGuest[$key]['lastMessage'] = $this->_model->getLastMessage($conversation['id_conversation']);

            $this->loadModel('user');
            if ($this->_model->getUserCensureChat($user_id) == CENSURE_CHAT) {
                $conversationGuest[$key]['lastMessage'] = $this->checkSwearWords($conversationGuest[$key]['lastMessage']);
            }
        }

        $this->loadModel('user');

        foreach ($messages as $key => $message) {
            $messages[$key]['message'] = $this->checkMessage($messages[$key]['message']);
        }

        if ($this->_model->getUserCensureChat($user_id) == CENSURE_CHAT) {
            foreach ($messages as $key => $message) {
                $messages[$key]['message'] = $this->checkSwearWords($messages[$key]['message']);
            }
        }


        foreach($conversationGuest as $key => $conversation){
            if($conversation['id_conversation'] == $id_conversation){
                $conversationGuest = $conversationGuest[$key];
            }
        }


        $this->render('chat/conversation', compact('user_id', 'conversationGuest', 'messages', 'conversations'),NO_LAYOUT);
    }

    /**
     * Refresh a conversation via ajax
     * @return void
     */
    public function refreshConversation():void
    {
        $id_conversation = (int) $_GET['params'][0];

        $this->loadModel('Tchat');

        $user_id = $this->getUserId();

        $messages = $this->_model->getMessages($id_conversation);

        $this->loadModel('user');

        foreach ($messages as $key => $message) {
            $messages[$key]['message'] = $this->checkMessage($messages[$key]['message']);
        }    

        if($this->_model->getUserCensureChat($user_id) == CENSURE_CHAT){
            foreach ($messages as $key => $message) {
                $messages[$key]['message'] = $this->checkSwearWords($messages[$key]['message']);
            }
        }

        $this->render('chat/chatbox', compact('user_id','messages'),NO_LAYOUT);
    }

    /**
     * Send a message via ajax
     * @return void
     */
    public function sendMessage():void
    {   
        $_POST = json_decode(file_get_contents('php://input'), true);

        $id_conversation = (int) htmlspecialchars($_POST['idConversation']);
        $message = htmlspecialchars($_POST['message']);
        $sender_id = $this->getUserId();

        $this->loadModel('Tchat');

        $info = $this->_model->getConversation($sender_id);

        $recever_id = $info[0]['id_users1'] == $sender_id ? $info[0]['id_users2'] : $info[0]['id_users1'];

        $this->_model->sendMessage($id_conversation, $message, $sender_id, $recever_id);
    }



}
?>