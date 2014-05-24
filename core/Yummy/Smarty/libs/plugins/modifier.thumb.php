<?php
    /**
     * smarty缩略图
     * 
     * @param string $path
     * @param int $type
     * @param int $width
     * @param int $height
     * @example {{$p.small_image|thumb:1:100:100}}
     * @return string
     */
    function smarty_modifier_thumb($path,$type=1,$width=100,$height=100){
        $thumb_path = Yummy_Util_Image_Base::thumb($path,$type,$width,$height);
        return $thumb_path;
    }

/* vim: set expandtab: */

?>
