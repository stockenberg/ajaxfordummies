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

    public function getUser(int $id = null){
        $sql = "SELECT * FROM users WHERE user_id = :id";
        return self::get($sql, [":id" => $id]);
    }

    public function update(array $post = null)
    {
        $sql = "UPDATE users SET user_name = :name WHERE user_id = :id";
        return self::SET($sql, [":name" => $post["username"], ":id" => $post["id"]]);
    }

    public function save($data)
    {
        $sql = "INSERT INTO users (user_name) VALUES (:user_name)";
        return self::SET($sql, [":user_name" => $data["username"]]);
    }

    public function delete(int $id = null)
    {
        $sql = "DELETE FROM users WHERE user_id = :id";
        return self::SET($sql, [":id" => $id]);
    }

}