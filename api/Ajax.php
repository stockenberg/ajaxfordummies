<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 26.04.17
 * Time: 13:42
 */

namespace api;


use api\Database\Database;
use api\Models\User;

class Ajax
{

    public $request;

    public function run()
    {
        $user = User::SET("SELECT * FROM users", []);
        $this->request = array_merge($_GET, $_POST);
        switch ($this->request["page"] ?? ""){

            case "user":

                break;

            case "task":

                break;

        }
    }

    public static function _e($param){
        echo json_encode($param);
    }

}