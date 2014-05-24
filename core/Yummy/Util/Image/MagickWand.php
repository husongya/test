<?php
/**
 * 图像缩放处理函数
 * 
 * @author   huhu
 */
class Yummy_Util_Image_MagickWand extends Yummy_Object {

    public static  $mStr="chinavisualc.om";   //水印文字

    public  static $mFont = "simsun.ttc";  //字体

    public  static $mFontSize="30";    //字体大小

    public static $mFontColor = "#000000" ;  //字体颜色

    public  static $mFontWidth = 100;  //字间距

    public static $mFontAlpha = 0.3;  //字体透明度

    public static $mFontAlign = MW_SouthEastGravity;   //字体对齐方式

    public static $mMarkImage = "01.jpg";

    public static $mImg ;

    /**
     * 创建magicwand对象
     *
     * @return unknown
     */
    public static function CreateMagick(){
        try{
            if(!is_object(self::$mImg)){
                self::$mImg =  NewMagickWand();
            }
        }catch (Exception $e){
            self::warn("create object........1".$e->getMessage(), __METHOD__);
        }
        return self::$mImg;
    }

    /**
     * 切图 缩略图函数
     *
     * @param string $pSrcFile 原始图片
     * @param string $pWidth   目标宽度
     * @param string $pHeight  目标高度
     * @param string $pThumpFile 目标文件
     * @param 切图类型 $pType  1:无切图缩图   2:  切图缩图   3:   固定宽度缩图   4：固定高度缩图  5：切图  
     * @return Magickwand object
     */
    static public function ReduceImage($pSrcFile,$pWidth,$pHeight, $pType=1){
        $img = self::CreateMagick();
        if(!MagickReadImage($img,$pSrcFile)){
            return false;
        }
        $oriHeight = MagickGetImageHeight($img);
        $oriWidth = MagickGetImageWidth($img);
        if($oriWidth< $pWidth && $oriHeight<$pHeight){
            return false;
        }
        try{
            if( $pType== 1){  //直接按照原图比例缩小
                $xratio = $pWidth/$oriWidth;
                $yratio = $pHeight/$oriHeight;
                if($xratio < $yratio) {
                    $pHeight = floor($oriHeight*$xratio);
                }
                else{
                    $pWidth = floor($oriWidth*$yratio);
                }
            }elseif ($pType == 3){ //按照宽度来缩图
                $Ratio = $pWidth/$oriWidth;
                $pHeight = floor($oriHeight*$Ratio);
            }
            elseif ($pType == 4){  //按照高度来缩图
                $Ratio = $pHeight/$oriHeight;
                $pWidth = floor($oriWidth*$Ratio);
            }
            elseif ($pType ==2 ){ //按照目标比例切图后再缩小
                if(($oriHeight/$pHeight) > ($oriWidth/$pWidth)){
                    $t = $oriWidth/$pWidth;
                }else{
                    $t = $oriHeight/$pHeight;
                }
                $_heght = $pHeight*$t;
                $_width = $pWidth*$t;
                $srX    = ceil($oriWidth/2-$_width/2); //copy开始的x坐标，单位是像素 (pixel)
                if($srX<0) $srX = 0;
                $srY    = ceil($oriHeight/2-$_heght/2); //copy开始的y坐标，单位是像素 (pixel)
                if($srY<0) $srY = 0;
                MagickCropImage($img,$_width, $_heght, $srX,$srY);
            }
            elseif( $pType == 5) { //直接切图
                $srX    = ceil($oriWidth/2-$pHeight/2); //copy开始的x坐标，单位是像素 (pixel)
                if($srX<0) $srX = 0;
                $srY    = ceil($oriHeight/2-$pWidth/2); //copy开始的y坐标，单位是像素 (pixel)
                if($srY<0) $srY = 0;

                MagickCropImage($img,$pWidth, $pHeight, $srX,$srY);
            }
            else{
                return false;
            }

            //去掉颜色配置等注释信息
            MagickRemoveImageProfiles($img);
            if($pType != 5){
                MagickResizeImage($img,$pWidth,$pHeight,MW_SincFilter ,1);
            }

            self::$mImg = $img;
            return self::$mImg;
        }catch (Exception $e){
            self::warn("reduce image failed".$e->getMessage(), __METHOD__);
        }
    }

    /**
     * 给图片添加水印效果
     *
     * @param unknown_type $pSrcFile
     * @param unknown_type $pType
     * @param unknown_type $pMarkImage
     * @param unknown_type $pStr
     * @param unknown_type $pOut
     * @return Magickwand object
     */
    public static function WriteMark($pSrcFile, $pMark=1){
        $img = self::CreateMagick();
        if(!MagickReadImage($img, $pSrcFile)){
            return false;
        }

        if($pMark == 1){ //添加图片水印效果
            $pMarkImage = self::$mMarkImage;
            $img_temp=  NewMagickWand();
            if(!MagickReadImage($img_temp,$pMarkImage)){
                return false;
            }

            $oriHeight = MagickGetImageHeight($img_temp);
            $oriWidth = MagickGetImageWidth($img_temp);

            $h = MagickGetImageHeight($img);
            $w = MagickGetImageWidth($img);

            $x = $w-$oriWidth;
            $y =  $h-$oriHeight;

            MagickCompositeImage($img, $img_temp, MW_AtopCompositeOp, $x, $y);
        }else{ //添加文字水印
            $ndw = NewDrawingWand();
            $fontColor = NewPixelWand();

            $textEn= iconv("gb2312", "utf-8", self::$mStr);        //如果你传入的是非UTF8中文，这里要转换
            DrawSetTextEncoding($ndw, "UTF-8");        //设定图像上文字的编码
            DrawSetFont($ndw, self::$mFont);
            DrawSetFontWeight($ndw, self::$mFontWidth);        //设定字宽
            DrawSetFillColor($ndw, self::$mFontColor);      //设定字体颜色
            DrawSetFontSize($ndw, self::$mFontSize);        //设定字体大小
            DrawSetGravity($ndw, self::$mFontAlign);        //设定对齐方式
            DrawSetFillAlpha($ndw, self::$mFontAlpha);      //设置文字透明度
            MagickAnnotateImage($img, $ndw, 0, 0, 0, $textEn);
            ClearPixelWand($fontColor);
            ClearDrawingWand($ndw);
            DestroyPixelWand($fontColor);
            DestroyDrawingWand($ndw);
        }
        return $img;
    }

    /**
     *输出图片
     *
     * @param unknown_type $img
     * @param unknown_type $pOut  1:直接输出图片  2:输出图片内容
     * @return unknown
     */
    public function ShowPic($pOut=1, $pThumpFile){
        try{
            if($pOut == 1){
                MagickSetImageFormat(self::$mImg,'image/png');
                $ok = MagickWriteImage(self::$mImg,$pThumpFile);
                DestroyMagickWand(self::$mImg);
                return $ok;
            }
            else{
                MagickSetImageFormat(self::$mImg,'image/png');
                $ok=MagickGetImageBlob(self::$mImg);
                DestroyMagickWand(self::$mImg);
                self::$mImg=null;
                return $ok;
            }
        }catch (Exception $e){
            self::warn("show picture failed".$e->getMessage(), __METHOD__);
        }
    }
    /**
     * 缩略图 并 判断是否添加  水印
     *
     * @param  string $pSrcFile   原文件
     * @param  int $pWidth     目标宽度
     * @param  int $pHeight    目标高度
     * @param  string $pThumpFile 缩略图文件
     * @param  int $pType      1:无切图缩图   2:切图缩图   3:   切图   
     * @param  int $pOut       1:生成缩略图   2:返回缩略图数据
     * @param  int $pMark      0:不加水印 1:图片水印  2:文字水印
     * @return blog or bool
     */
    static public function makeThumb($pSrcFile, $pWidth,$pHeight, $pThumpFile, $pType=1, $pOut=1, $pMark=0){
        self::ReduceImage($pSrcFile,$pWidth,$pHeight, $pType, $pOut);
        if($pMark != 0){
            self::WriteMark($pSrcFile, $pMark);
        }       
        return self::ShowPic($pOut, $pThumpFile);
    }
    
    /**
     * 给图片加水印
     *
     * @param string  原图片  
     * @param int     $pMark 1:图片水印 2:文字水印
     * @param unknown_type $pOut  1:直接输出图片  2:输出图片内容
     * @return blog or bool
     */
    public static  function makeMark($pSrcFile, $pMark=1, $pThumpFile='', $pOut=1){
        self::WriteMark($pSrcFile, $pMark);
        if(empty($pThumpFile)) $pThumpFile = $pSrcFile;
        return self::ShowPic($pOut, $pThumpFile);
    }
}
?>