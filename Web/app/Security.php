<?php 

namespace App;

use App\Mail;
use App\Controller;

abstract class Security
{

    private $sessionStart = false;


    /**
     * Check if the user is logged in
     * @return bool
     */
    public function isLogged(): bool
    {
        session_start();
        $this->sessionStart = true;
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    /**
     * Check if the user is admin
     * @param int $id_access
     * @return bool
     */
    public function isAdmin(int $id_access): bool
    {

        if($this->sessionStart === false){
            return false;
        }

        if ($id_access === ACCESS_ADMIN) {
            return true;
        }

        return false;
    }


}

?>