<?php
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once "access_control.php";

require_once "Service/Container.php";
require_once "api/ApiActions.php";

$configuration = array(
    'db_dsn' => "mysql:host=localhost; dbname=php2steden",
    'db_user'=> 'root',
    'db_pass' => 'Xrkwq349'
);
$container = new Container($configuration);


