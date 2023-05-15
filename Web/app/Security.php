<?php 

namespace App;

use App\Controller;
use App\Utils;

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

    /**
     * Check if the user is Rh
     * @param int $id_access
     * @return bool
     */
    public function isRh(int $id_access): bool
    {

        if ($this->sessionStart === false) {
            return false;
        }

        if ($id_access === ACCESS_RH) {
            return true;
        }

        return false;
    }

    /**
     * active security
     * @param string $url
     * @return array
     */
    public function activeSecurity(string $url = ""): array
    {
        if(isset($_SESSION['security'])){
            return $_SESSION['security'];
        }

        $_SESSION['security'] = [
            'token' => Utils::generateRandomString(250),
            'time' => base64_encode(time()),
            'ip' => $_SERVER['REMOTE_ADDR'],
        ];

        if ($url !== "") {
            $_SESSION['security']['url'] = $url . "/" . $_SESSION['security']['token'] . "/" . $_SESSION['security']['time'];
        }

        return $_SESSION['security'];
    }


    /**
     * Setup a security check for a page of success after payment with stripe
     * @return bool
     */
    public function checkSecurity(): bool
    {
        try{
            if (isset($_SESSION['security'])) {

                $params = $_GET['params'];

                if (count($params) !== 2) return false;


                if (!isset($params[0]) || !isset($params[1])) return false;

                $token = htmlspecialchars($params[0]);
                $time = htmlspecialchars($params[1]);

                if (!isset($_SESSION['security']['token']) || !isset($_SESSION['security']['time'])) return false;

                if ($token !== $_SESSION['security']['token'] || $time !== $_SESSION['security']['time']) return false;

                if (time() - base64_decode($time) > 300) return false;

                return true;
            }
        }
        finally{
            unset($_SESSION['security']);
        }
        return false;
    }

}

?>