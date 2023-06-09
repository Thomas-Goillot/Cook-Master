<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Tchat extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "conversation";

        $this->getConnection();
    }

    /**
     * Get all conversation of a user
     * @param int $user_id
     * @return array
     */
    public function getConversation(int $user_id): array
    {
        $sql = "SELECT * FROM ".$this->table." WHERE id_users1 = :user_id OR id_users2 = :user_id";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get last messages of a conversation
     * @param int $id
     * @return string
     */
    public function getLastMessage(int $id):string
    {
        $sql = "SELECT message FROM messages WHERE id_conversation = :id ORDER BY id_messages DESC LIMIT 1";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result === false){
            return "Pas de message";
        }

        return $result['message'];
    }   

    /**
     * Get all messages of a conversation
     * @param int $id
     * @return array
     */

    public function getMessages(int $id):array
    {
        $sql = "SELECT * FROM messages WHERE id_conversation = :id ORDER BY created_at ASC LIMIT 75";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Send a message
     * @param int $id_conversation
     * @param string $message
     * @param int $user_id
     * @return bool
     */
    public function sendMessage(int $id_conversation, string $message, int $sender_id, int $recever_id):bool
    {
        $sql = "INSERT INTO messages (id_conversation, message, sender_id, recever_id) VALUES (:id_conversation, :message, :sender_id, :recever_id)";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(":id_conversation", $id_conversation);
        $stmt->bindParam(":message", $message);
        $stmt->bindParam(":sender_id", $sender_id);
        $stmt->bindParam(":recever_id", $recever_id);

        return $stmt->execute();   
    }

    /**
     * Create a conversation
     * @param int $id_users1
     * @param int $id_users2
     * @return int
     */

    public function createConversation(int $id_users1, int $id_users2):int
    {
        $sql = "INSERT INTO ".$this->table." (id_users1, id_users2) VALUES (:id_users1, :id_users2)";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(":id_users1", $id_users1);
        $stmt->bindParam(":id_users2", $id_users2);

        $stmt->execute();

        return $this->_connexion->lastInsertId();
    }

    /**
     * Check if a conversation exist
     * @param int $id_users1
     * @param int $id_users2
     * @return bool
     */
    public function checkConversation(int $id_users1, int $id_users2):bool
    {
        $sql = "SELECT COUNT(id_conversation) FROM ".$this->table." WHERE id_users1 = :id_users1 AND id_users2 = :id_users2";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(":id_users1", $id_users1);
        $stmt->bindParam(":id_users2", $id_users2);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result['COUNT(id_conversation)'] == 1){
            return true;
        }else{
            return false;
        }
    }

}
