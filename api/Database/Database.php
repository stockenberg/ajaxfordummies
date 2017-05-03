<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 26.04.17
 * Time: 14:00
 */

namespace api\Database;


class Database
{

    public static $user = "marten";
    public static $password = "1234";
    public static $database = "ajax";

    public static function getInstance()
    {
        try {
            $dbh = new \PDO("mysql:host=localhost;dbname=" . self::$database . ";", self::$user, self::$password, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $dbh ?? "";
    }


    public static function get(string $sql = NULL, array $exec = NULL)
    {
        try {
            $db = self::getInstance();
            $stmt = $db->prepare($sql);
            $stmt->execute($exec);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Error $e) {
            echo $e->getMessage() . PHP_EOL;
        }

    }

    public static function getObj(string $sql = NULL, array $exec = NULL, $classname = NULL)
    {
        try {
            $db = self::getInstance();
            $stmt = $db->prepare($sql);
            $stmt->execute($exec);
            return $stmt->fetchObject($classname);
        } catch (\Error $e) {
            echo $e->getMessage() . PHP_EOL;
        }

    }

    public static function GETObjArr(string $sql, array $execArr = array(), string $classname)
    {
        try {
            $db = self::getInstance();

            $stmt = $db->prepare($sql);
            $stmt->execute($execArr);

            return $stmt->fetchAll(\PDO::FETCH_CLASS, $classname);
        } catch (\Error $e) {
            echo $e->getMessage() . PHP_EOL;
        }

    }

    public static function SET(string $sql, array $execArr = array())
    {
        try {
            $db = self::getInstance();

            $stmt = $db->prepare($sql);
            $stmt->execute($execArr);
            return true;
        } catch (\Error $e) {
            echo $e->getMessage() . PHP_EOL;
            return false;
        }

    }
}