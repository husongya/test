<?php
class Common_Util_Format {
    /**
     * 获取index.yml中的url配置
     *
     * @param yml中的KEY $key
     * @param array $value 要格式化的参数,按顺序放入
     * @return string url
     */
    public static function getUrl($key,$value=array()){
        $rewrite = Yummy_Config::get("rewrite");
        $url = $rewrite[$key];
        if(is_null($url)){
            return false;
        }
        if(empty($value)){
            return $url;
        }
        array_unshift($value,$url);
        return call_user_func_array('sprintf',$value);
    }
}
?>
