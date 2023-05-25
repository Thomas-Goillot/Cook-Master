<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

// DEFINIR LE NOM DE LA CLASSE = NOM DE LA TABLE DANS LA BDD = NOM DU FICHIER = NOM DU MODEL
class NomModel extends Model
{
    /**
     * User constructor.
     */
    // DEFINIR LE NOM DE LA TABLE DANS LA BDD
    // IL EST POSSIBLE D'UTILISER PLUSIEURS TABLES DANS UN MODEL MAIS IL EST NECESSAIRE DE NE PAS DEPASSER 3 TABLES DANS UN MODEL 
    // LE CONSTRUCTEUR DOIT ETRE LE MEME POUR TOUS LES MODELS 
    // LA LIGNE $this->getConnection(); DOIT ETRE LA DERNIERE LIGNE DU CONSTRUCTEUR
    public function __construct()
    {
        $this->table = "users";

        $this->getConnection();
    }

    /**
     * Get user info by id
     * @param int $id
     * @return array|bool
     */
    // METHODE = FONCTION = CORRESPONDS A UNE REQUEST SQL OU UNE ACTION DE RECUPERATION DE DONNEES
    // ICI ON RECUPERE LES INFORMATIONS D'UN UTILISATEUR EN FONCTION DE SON ID
    public function getUserInfo(int $id)
    {
        // DEFINIR LA REQUETE SQL
        $query = "SELECT id_users, email, name, surname, address, city, country, phone, zip_code, is_banned, sponsor_counter, id_access, creation_date,mail_verified FROM " . $this->table . " WHERE id_users = :id";

        // PREPARER LA REQUETE SQL AVEC PDO
        // LA VARIABLE $stmt EST UN OBJET PDO QUI CONTIENT LA REQUETE SQL PREPAREE
        // LA FONCTION PREPARE() PREND EN PARAMETRE LA REQUETE SQL
        $stmt = $this->_connexion->prepare($query);

        // DEFINIR LES PARAMETRES DE LA REQUETE SQL
        // LA FONCTION bindParam() PREND EN PARAMETRE LE NOM DU PARAMETRE DE LA REQUETE SQL ET LA VALEUR DU PARAMETRE
        $stmt->bindParam(":id", $id);

        // EXECUTER LA REQUETE SQL
        $stmt->execute();

        // RECUPERER LES RESULTATS DE LA REQUETE SQL
        // LA FONCTION fetch() RETOURNE UN TABLEAU ASSOCIATIF AVEC LES RESULTATS DE LA REQUETE SQL
        // LA FONCTION fetch() RETOURNE FALSE SI IL N'Y A PAS DE RESULTATS
        // PDO::FETCH_ASSOC PERMET DE RECUPERER UN TABLEAU ASSOCIATIF
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
