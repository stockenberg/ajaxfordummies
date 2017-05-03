<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 27.04.17
 * Time: 16:51
 */

namespace api\Controllers;


use api\Models\Auth;

class AuthentificationController
{
    public $request = array();

    public function run()
    {
        $this->request = array_merge($_GET, $_POST);

        switch ($this->request["action"] ?? "") {
            case "login":
                $status = array();
                foreach ($_POST ?? array() as $k => $input) {
                    if ($input == "") {
                        $status["error"][$k] = "Hey du arschkrampe! " . $k . " ist falsch!";
                    }
                }
                if (empty($status)) {
                    $auth = new Auth();
                    if ($auth->login($_POST)) {
                        return ["success" => "true", "message" => "Erfolgreich eingeloggt.", "redirect" => "index.html"];
                    } else {
                        return ["success" => "false", "message" => "Benutzername oder Passwort falsch."];
                    }
                } else {
                    return ["success" => "false", "message" => "Validierungsfehler", "errors" => $status];
                }
                break;

            case "logout":
                // TODO : implement me
                break;
        }
    }

}