<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Comment extends Model
{
/**
     * event constructor.
     */
    public function __construct()
    {
        $this->table = "comment";

        $this->getConnection();
    }

    /**
     * getAllCommentById
     * @return array
     */
    public function getAllCommentById(int $id_event): array
    {
        $query = "SELECT * FROM " . $this->table ." WHERE id_event = :id_event";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_event", $id_event);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * addComment
     */
    public function addComment(string $comment, int $stars, int $id_event, int $id_users): void
    {
        $query = "INSERT INTO " . $this->table . " (comment, stars, id_event, id_users) VALUES (:comment, :stars, :id_event, :id_users)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":comment", $comment);
        $stmt->bindParam(":stars", $stars);
        $stmt->bindParam(":id_event", $id_event);
        $stmt->bindParam(":id_users", $id_users);

        $stmt->execute();
    }


}