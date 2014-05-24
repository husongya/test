<?php
function smarty_function_format($params,&$smarty){
    $key = array_shift($params);
    $var_args = array_values($params);
    $rewrite = Yummy_Config::get("rewrite");
    $url_format = $rewrite[$key];
    array_unshift($var_args,$url_format);
    $url = call_user_func_array('sprintf',$var_args);
    return $url;
}
?>