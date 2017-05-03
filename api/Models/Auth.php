<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 27.04.17
 * Time: 17:02
 */

namespace api\Models;


use api\Database\Database;

class Auth extends Database
{

    public function login(array $post)
    {
        $SQL = "SELECT * FROM admins WHERE admin_username = :username";
        $admins = self::get($SQL, [":username" => $post["username"]]);

       foreach ($admins ?? array() as $row => $admin){
           if(password_verify($post["password"], $admin["admin_password"])){
               $_SESSION["active_user"] = $admin;
               $_SESSION["active_user"][0]["admin_password"] = "";
               return true;
           }else{
               return false;
           }
       }
    }

}