<?php
$app = "app.php";
$request_uri = "/{$app}/default/index/index";
$id = $_GET['cid'];
$page = $_GET['page'];
if(isset($id)){
    $request_uri.="/cid/$id";
}
if(isset($page)){
    $request_uri.="/page/$page";
}
$_SERVER['REQUEST_URI'] = $request_uri;
require_once $app;
?>
