<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../App.php");
$app = new App;

$skin = $_GET['skin'];

$app->changeskin($skin);

header('location:c_settings.php');
?>