<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 26.04.17
 * Time: 14:00
 */

namespace api\Database;


trait Database
{

    public $user = "marten";
    public $password = "1234";
    public $database = "ajax";

    public function getInstance()
    {
        $dbh = new \PDO("mysql:host=localhost;dbname={$this->database};charset=UFT-8", $this->user, $this->password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        return $dbh;
    }

    public static function get(string $sql = NULL, array $exec = NULL, $classname = NULL)
    {
       $db = self::getInstance();
       $stmt = $db->prepare($sql);
       $stmt->execute($exec);
        return $stmt->fetchObject($classname);
    }

    public static function GETObjArr(string $sql, array $execArr = array(), string $classname)
    {
        $db = self::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->execute($execArr);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, $classname);

    }
}