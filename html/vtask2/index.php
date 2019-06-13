<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../vtask2/MyLog.php';
require '../../vtask2/Controller.php';
mylog('start');

$request = (string)htmlspecialchars($_GET["request"]);
$c = new Controller($request);

echo $c->show($request);

?>

