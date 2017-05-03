<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 26.04.17
 * Time: 13:42
 */

namespace api;


use api\Controllers\AuthentificationController;
use api\Controllers\UserController;

class Ajax
{

    public $request;

    public function run()
    {
        session_name("ajaxapi");
        session_start();


        $this->request = array_merge($_GET, $_POST);

        switch ($this->request["case"] ?? "") {

            case "user":
                if (self::checkLoggedIn()) {
                    return (new UserController())->run();
                } else {
                    return ["success" => "false", "message" => "Nicht eingeloggt"];
                }
                break;

            case "authentification":
                return (new AuthentificationController())->run();
                break;

            case "checkLoggedIn":
                if (self::checkLoggedIn()) {
                    return ["success" => "true"];
                } else {
                    return ["success" => "false", "message" => "Nicht eingeloggt"];
                }
                break;

        }
    }

    public static function _e($param)
    {
        echo json_encode($param);
    }

    public static function checkLoggedIn()
    {

        if (isset($_SESSION["active_user"]) && count($_SESSION["active_user"]) > 0) {
            return true;
        }

        return false;
    }


}