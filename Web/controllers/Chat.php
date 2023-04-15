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
    }

    /**
     * Display all conversation of a user
     */
    public function index():void
    {
        $this->loadModel('Chat');

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
            $conversation['user2']['id_conversation'] = $conversation['id_conversation'];

            $conversationGuest[] = $conversations['user1']['guest'] ? $conversations['user1'] : $conversations['user2'];
            
            $this->loadModel('chat');
            $conversationGuest[$key]['lastMessage'] = $this->_model->getLastMessage($conversation['id_conversation']);
        }

        $page_name = array("Conversation" => "chat");

        $this->render($this->default_path, compact('conversationGuest','page_name'),DASHBOARD);
    }


    /**
     * Display a conversation via ajax
     * @return void
     *  */
    public function displayConversation():void
    {
        $id_conversation = (int) $_GET['params'][0];

        $this->loadModel('Chat');

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
            $conversation['user2']['id_conversation'] = $conversation['id_conversation'];

            $conversationGuest[] = $conversations['user1']['guest'] ? $conversations['user1'] : $conversations['user2'];

            $this->loadModel('chat');
            $conversationGuest[$key]['lastMessage'] = $this->_model->getLastMessage($conversation['id_conversation']);
        }


        $this->render('chat/conversation', compact('user_id','conversationGuest','messages'),NO_LAYOUT);
    }

    /**
     * Refresh a conversation via ajax
     * @return void
     */
    public function refreshConversation():void
    {
        $id_conversation = (int) $_GET['params'][0];

        $this->loadModel('Chat');

        $user_id = $this->getUserId();

        $messages = $this->_model->getMessages($id_conversation);

        $this->render('chat/tchatbox', compact('user_id','messages'),NO_LAYOUT);
    }

    /**
     * Send a message via ajax
     * @return void
     */
    public function sendMessage():void
    {
        $id_conversation = (int) $_POST['id_conversation'];
        $message = $_POST['message'];
        $id_user = $this->getUserId();

        $this->loadModel('Chat');

        //$this->_model->sendMessage($id_conversation, $message, $id_user);

        $this->displayConversation();
    }



}
?>