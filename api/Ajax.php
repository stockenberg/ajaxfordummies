<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 26.04.17
 * Time: 13:42
 */

namespace api;


class Ajax
{

    public $request;

    public function run()
    {
        $this->request = array_merge($_GET, $_POST);
        switch ($this->request["page"]){

            case "user":

                break;

            case "task":

                break;

        }
    }

}