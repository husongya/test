<?php
$app = "app.php";
$request_uri = "/{$app}/default/index/view";
$_SERVER['REQUEST_URI'] = $request_uri;
require_once $app;
?>
