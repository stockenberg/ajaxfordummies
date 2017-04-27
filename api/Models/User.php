<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 26.04.17
 * Time: 13:45
 */

namespace api\Models;


use api\Database\Database;

class User extends Database
{

    public function getUsers(){
        $sql = "SELECT * FROM users";
        return self::get($sql, []);
    }

    public function save($data)
    {
        $sql = "INSERT INTO users (user_name) VALUES (:user_name)";
        return self::SET($sql, [":user_name" => $data["username"]]);
    }

}