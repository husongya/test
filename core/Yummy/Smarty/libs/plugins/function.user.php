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
function smarty_function_user($params, &$smarty){
    $user_id = null;
    extract($params,EXTR_IF_EXISTS);
    $user = new Admin_Model_User();
    $result = $user->findById($user_id);
    return $result['username']?$result['username']:'游客 ';
}
?>
