<?php

/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 20.04.17
 * Time: 17:11
 */
class Data
{
    public $data = [];

    public function __get($key)
    {
        return $this->data[$key] ?? NULL;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

}
