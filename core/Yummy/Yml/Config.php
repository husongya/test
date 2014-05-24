<?php
class Yummy_Yml_Config {
    protected  static $configs = array();
    protected  static $oneConfigs = array();
    /**
     * 加载YAML格式的配置文件
     *
     *
     * @param String $config YAML 配置文件
     *
     */
    function __construct(){
        $cache = self::getConfigCache('configs');
        if(!empty($cache)){
            self::$configs = $cache[0];
            self::$oneConfigs = $cache[1];
        }else{
        	self::load('index');
	        /*$r = self::load('yummy');
	        foreach ($r as $value){
	            self::load($value);
	        }*/
            self::setConfigCache('configs',array(self::$configs,self::$oneConfigs));
        }
    }
    
    /**
     * Fetch builtin cache use xcache
     *
     * @param string $key 
     * @return mixed
     */
    public static function getConfigCache($key){
        $result=null;
        if(function_exists('xcache_get')){
            $result = xcache_get(MODULE_NAME.'_m_'.$key);
        }
        return $result;
    }
    /**
     * Cache doggy internal vars
     *
     * @param string $key 
     * @param string $value 
     */
    public static function setConfigCache($key,$value){
        if(function_exists('xcache_set')){
            xcache_set(MODULE_NAME.'_m_'.$key,$value);
        }
    }
    
    
    public static function load($file){
		//$file = ucfirst($file);
        $configFile = PRODUCT_DIR.'/config/'.$file.'.yml';
        //print_r($configFile);
        if(!file_exists($configFile)) return ;
         
        $cate = strtolower(basename($configFile,'.yml'));
        $yml = new Yummy_Yml_Base();
        $setting = $yml->load($configFile);
		//print_r($setting);
        if(empty($setting))return;
        
        if(isset($setting['all'])){
            $env_setting = $setting['all'];
        }
        foreach ($env_setting as $key => $value) {
            self::$configs["$cate.$key"] = $value;
            self::$oneConfigs["$cate"][$key] = $value;
        }
        //print_r(self::$configs);
        return self::$configs;
    }
    /**
     * 获取参数值
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get($name, $default = null){
    	if(is_null($default)){
    		$result = self::$oneConfigs[$name];
    	}else{
    		$result = $default;
    	}
        return isset(self::$configs[$name])?self::$configs[$name]:$result;
    }
    /**
     * Set configuration paramter value
     *
     * @param string $name
     * @param mixed $value
     */
    public static function set($name,$value){
        self::$configs[$name]=$value;
    }
    /**
     * 检测是否有参数
     *
     * @param string $name
     * @return mixed
     */
    public static function has($name){
        return isset(self::$configs[$name]);
    }
    /**
     * Clear current configuration
     *
     */
    public static function clear(){
        self::$configs=array();
    }
    /**
     * Direct add config value array
     *
     * @param array $paramters
     */
    public static function add($paramters){
        self::$configs = array_merge(self::$configs,$paramters);
    }
    /**
     * 返回所有的配置参数数组
     *
     * @return array
     *
     */
    static public function all(){
        return self::$configs;
    }
}
?>