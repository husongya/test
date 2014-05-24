<?php
class Yummy_Config {
    /**
     * 获取配置文件的值 默认获取当前模块的yml文件配置
     *
     * @param string $key
     * @param string $default
     * @return string
     */
    public static function get($key,$default=null){
        $config = new Yummy_Yml_Config();
        if(is_null($default)){
        	$default = "index";
        }
        return $config->get($default.".".$key,null);
    }
}
?>