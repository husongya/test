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
function smarty_function_page($params, &$smarty){
    $totalPage = 1;
    $url = '';
    $page = 1;
    extract($params,EXTR_IF_EXISTS);
    $content = '';
    for ($i=1;$i<$totalPage+1;$i++){
    	if($page == $i){
    		$content.=" <a class=current href='{$url}&page={$i}'>{$i}</a> ";
    	}else{
            $content.=" <a href='{$url}&page={$i}'> {$i} </a> ";
    	}
    }
    return $content;
}
?>
