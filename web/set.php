<?php
$app = "app.php";
$request_uri = "/{$app}/common/set/execute";
if(isset($_GET["table"])){
	$request_uri .= "/table/{$_GET["table"]}";
}
$_SERVER['REQUEST_URI'] = $request_uri;
require_once $app;
?>
