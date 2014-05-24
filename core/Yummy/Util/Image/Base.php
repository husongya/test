<?php
class Yummy_Util_Image_Base extends Yummy_Object{
    public static function thumb($path,$type=1,$width=100,$height=100){
    	if(empty($path)){
    		return ;
    	}
    	$upload = Yummy_Config::get("upload");
    	$upload_dir = $upload["thumb_path"];
        $path_dir = dirname($path); //原图存储目录
        $file = basename($path);
        $ext = Yummy_Util_File::getFileExtension($file);
        $name = substr($file,0,-strlen(".".$ext));
        $thumb_path = $upload_dir.$path_dir."/".$name."_".$type."_".$width."_".$height.'.'.$ext;  //缩略图存储目录path
        if(!file_exists($thumb_path)){
	        $image_path = $upload_dir."/".$path;  //原图存储路径
	        Yummy_Util_File::mk($upload_dir.$path_dir);
	        $content = Yummy_Util_Image_MagickWand::makeThumb($image_path,$width,$height,'',$type,2);
	        Yummy_Util_File::writeFile($thumb_path,$content);
        }
        $thumb_path = str_replace($upload_dir."/","",$thumb_path);
        //self::debug($thumb_path,__CLASS__);
        return $thumb_path;
    }
}
?>