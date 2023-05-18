<?php 

namespace App;

use App\Controller;
use App\Utils;
use App\Model;

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
    public function activeSecurity(string $url = "", array $params = []): array
    {
        if(isset($_SESSION['security'])){
            return $_SESSION['security'];
        }

        $_SESSION['security'] = [
            'token' => Utils::generateRandomString(250),
            'time' => base64_encode(time()),
            'ip' => $_SERVER['REMOTE_ADDR'],
            'params' => array_map(function ($param) {
                return Utils::crypt($param);
            }, $params)
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

                $_SESSION['securityParams'] = array_map(function ($param) {
                    return Utils::decrypt($param);
                }, $_SESSION['security']['params']);

                return true;
            }
        }
        finally{
            unset($_SESSION['security']);
        }
        return false;
    }

    public function getSecurityParams(): array
    {
        if (isset($_SESSION['securityParams'])) {
            return $_SESSION['securityParams'];
        }
        return [];
    }

    public function checkUserIp(int $id_user, $ip):bool
    {
        $controller = new Controller();
        $controller->loadModel('UserSecurity');

        $user = $controller->_model->getUserAllowedIp($id_user);

        if(count($user) === 0){
            return true; // == first connection
        }

        for($i = 0; $i < count($user); $i++){
            if($user[$i]['ip'] === $ip){
                return true;
            }
        }
        
        return false;
    }

    public function checkAllowIp(int $id_user, $ip):bool
    {
        $controller = new Controller();
        $controller->loadModel('UserSecurity');

        $user = $controller->_model->getUserAllowedIp($id_user);

        for($i = 0; $i < count($user); $i++){
            if($user[$i]['allowed'] === IP_ALLOWED){
                return true;
            }
        }
        
        return false;
    }

    /* 
    * Check if the user is connected for the first time
    */
    public function firstConnection(int $id_user):bool
    {
        $controller = new Controller();
        $controller->loadModel('UserSecurity');

        $user = $controller->_model->getUserIp($id_user);

        if(count($user) === 0){
            return true; // == first connection
        }
        
        return false;
    }

    



}

?>