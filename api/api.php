<?php

require_once "../vendor/autoload.php";

$ajax = new \api\Ajax();
echo json_encode($ajax->run());
