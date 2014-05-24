<?php
/**
 * session的设置和获取
 * author husong (beiley@163.com)
 * exmple
 * Yummy_Session_Base::getContext()->set("aa",11);
   echo Yummy_Session_Base::getContext()->get("aa");
 */
class Yummy_Session_Base{
	public static $_datas = array();
	public static $_session_id = null;
	/**
     * @var Yummy_Session_Base
     */
    protected static $_instance;
	
	public function __construct(){
		@session_start();
		self::$_session_id = session_id();
	}
	public function __destruct(){

	}
	public function set($key,$value){
		$_SESSION[$key] = $value;
    }
	public function get($key){
		return $_SESSION[$key];
	}
	public function getSessionId(){
		return self::$_session_id;
	}
	public function clear($key){
		unset($_SESSION[$key]);
	}
    /**
     * 返回Yummy_Session_Base实例
     * 
     * @return Yummy_Session_Base
     */
    public static function getContext(){
        if(is_null(self::$_instance)){
            self::$_instance = new Yummy_Session_Base();
        }
        return self::$_instance;
    }
}
?>