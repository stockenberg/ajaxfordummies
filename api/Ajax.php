<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 26.04.17
 * Time: 13:42
 */

namespace api;


use api\Controllers\UserController;

class Ajax
{

    public $request;

    public function run()
    {

        $this->request = array_merge($_GET, $_POST);

        switch ($this->request["case"] ?? "") {

            case "user":
                return (new UserController())->run();
                break;

            case "task":

                break;

        }
    }

    public static function _e($param)
    {
        echo json_encode($param);
    }

}