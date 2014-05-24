<?php
$app = "app.php";
$default = "execute";
$action = $_GET["action"];
$id = $_GET["id"];
$keyword = $_GET["keyword"];
$type = $_GET["type"];
if(isset($action)){
    $default = $action;
}
$request_uri = "/{$app}/default/admin/{$default}";
if(isset($id)){
    $request_uri.="/id/".$id;
}
if(isset($keyword)){
    $request_uri.="/keyword/".$keyword."/type/".$type;
}
$_SERVER['REQUEST_URI'] = $request_uri;
require_once "../".$app;
?>
