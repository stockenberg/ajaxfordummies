<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 26.04.17
 * Time: 13:44
 */

namespace api\Controllers;


use api\Ajax;
use api\Models\User;

class UserController
{

    public $request;

    public function run()
    {
        $this->request = array_merge($_GET, $_POST);
        switch ($this->request["action"]){

            case "save":
                $status = [];
                if(!empty($_POST)){
                    if($_POST["username"] === ""){
                        $status["error"] = "Username ist leer";
                    }
                    if(empty($status)){
                        $user = new User();
                        if($user->save($_POST)){
                            return ["success" => "true", "message" => "Daten gespeichert"];
                        }
                        return ["success" => "false", "message" => "Fehler aufgetreten"];
                    }else{

                        return ["success" => "false", "message" => "Fehler aufgetreten", "errors" => $status];
                    }
                }
                break;

            case "update":

                break;

            case "delete":

                break;

            case "read":
                $user = new User();
                return $user->getUsers();
                break;
        }
    }

}