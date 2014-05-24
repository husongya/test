<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {page} function plugin
 *
 * Type:     function<br>
 * @author   husong
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_code($params, &$smarty){
    $string = null;
    extract($params,EXTR_IF_EXISTS);
	$a = iconv('gbk','utf-8',$string);
    return $a;
}
?>
