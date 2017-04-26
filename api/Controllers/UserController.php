<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 26.04.17
 * Time: 13:44
 */

namespace api\Controllers;


class UserController
{

    public $request;

    public function run()
    {
        $this->request = array_merge($_GET, $_POST);
        switch ($this->request["action"]){

            case "save":

                break;

            case "update":

                break;

            case "delete":

                break;

            case "read":

                break;
        }
    }

}