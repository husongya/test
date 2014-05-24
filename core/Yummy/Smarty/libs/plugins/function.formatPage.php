<?php
function smarty_function_formatPage($params,&$smarty){
    $url_format = array_shift($params);
    $var_args = array_values($params);
    array_unshift($var_args,$url_format);
    $url = call_user_func_array('sprintf',$var_args);
    return $url;
}
?>