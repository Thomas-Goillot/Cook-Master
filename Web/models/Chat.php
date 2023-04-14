<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Chat extends Model
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



}
