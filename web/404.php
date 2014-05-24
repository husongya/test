<?php
$app = "index.php";
$request_uri = "/{$app}/default/index/errorPage";
$_SERVER['REQUEST_URI'] = $request_uri;
require_once $app;
?>