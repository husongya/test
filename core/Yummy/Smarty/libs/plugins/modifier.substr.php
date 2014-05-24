<?php
    /**
     * 截字符串
     *
     * @param string $content
     * @param int $len
     * @return string
     */
    function smarty_modifier_substr($content,$len=60){
             $str = mb_substr($content,0,$len,'utf-8');
             return (mb_strlen($content,'utf-8')>$len)?$str:$str;
    }

/* vim: set expandtab: */

?>
