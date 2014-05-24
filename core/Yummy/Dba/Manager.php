<?php
/**
 * Dba Adapter Manager
 *
 * This class use factory pattern
 *
 */
abstract class Yummy_Dba_Manager {
    protected static $_instances = array();
    private function __consturct(){
    }
	/**
	 * Database connection factory
	 *
	 * $dsn format is as follow:
	 * <code>
	 * 'adodb://mysql://user:password@localhost/database?driver=mysql&charset=utf8'
	 * 'jdba://jdba_server_uri'
	 * </code>
	 *
	 * @param	string	$dsn Database connection string
	 * @return	Yummy_Dba_Adodb
	 */
	public static function getConnection($dsn) {
		if (isset(self::$_instances[$dsn]))
			return self::$_instances[$dsn];
		$driver = false !== ($i = strpos($dsn, ':')) ? substr($dsn, 0, $i) : $dsn;
		$class = "Yummy_Dba_Adodb";
		if(!class_exists($class) ){
		    throw new Doggy_Dba_Exception('Unknow database adpater:'.$driver);
		}
		return self::$_instances[$dsn] = new $class($dsn);
	}
	/**
	 * Factory a default dba connection
	 * 
	 * @uses Yummy_Config
	 * @return Yummy_Dba_Adodb
	 */
	public static function getDefaultConnection(){
	    $dsn = Doggy_Config::get('database.default');
	    return self::getConnection($dsn);
	}
}
?>