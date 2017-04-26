<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 19.04.17
 * Time: 16:07
 */
require_once "Data.php";

switch ($_GET["case"] ?? null) {

    case "message":
            $data = validateForm($_POST);
            echo json_encode($data);

        break;

    default:
        break;

}


function validateForm(array $data = null)
{
    $dataObj = new Data();

    $res["errors"] = [];
    $res["data"] = [];


    foreach ($data ?? [] as $name => $value) {

        if ($value == "") {
            $res["errors"][] = ["success" => false, "response" => "Fehler bitte ausfüllen: " . $name];
        } else {
            $dataObj->{$name} = $value ?? "";
        }


    }

    $res["data"] = $dataObj;
    return $res;

}


?>


