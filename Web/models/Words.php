<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Words extends Model
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
     * Get all swear words
     * @return array
     */
    public function getSwearWords(): array
    {
        $sql = "SELECT * FROM words";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all swear words
     * @return array
     */
    public function getSwearWordsWithoutId(): array
    {
        $sql = "SELECT word FROM words";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $words = [];
        
        foreach ($data as $key => $value) {
            $words[] = $value['word'];
        }

        return $words;
    }


    /** 
     * Add a swear word
     * @param string $word
     * @return bool
     */
    public function addSwearWord(string $word): bool
    {
        $sql = "INSERT INTO words (word) VALUES (:word)";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(":word", $word);

        return $stmt->execute();
    }

    /**
     * Delete a swear word
     * @param int $id
     * @return bool
     */

    public function deleteSwearWord(int $id): bool
    {
        $sql = "DELETE FROM words WHERE id_words = :id";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }


}