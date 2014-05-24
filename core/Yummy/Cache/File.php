<?php
class Yummy_Cache_File {
    public $limit_time = 3600; //缓存过期时间
    public $cache_dir = "cache"; //缓存文件保存目录

	function MD5Hash($str){
		$hash = md5($str);
		//$hash = $hash[0] | ($hash[1] <<8 ) | ($hash[2] <<16) | ($hash[3] <<24) | ($hash[4] <<32) | ($hash[5] <<40) | ($hash[6] <<48) | ($hash[7] <<56);
		$hash = substr($hash,0,6);
		$hash_path = $this->cache_dir."/";
		for ($i=0;$i<strlen($hash);$i++){
			$hash_path.= substr($hash,$i,2)."/";
			$i++;
		}
		$this->makedir($hash_path);
		return $hash_path;
	}
    
    function makedir($path,$mode=0777){
        if(file_exists($path)) return true;
        $dirs = split('/',$path);
        $p = '';
        for($i=0;$i<count($dirs);$i++){
            $p.= $dirs[$i].'/';
            if(@is_dir($p))continue;
            @mkdir($p);
            @chmod($p,$mode);
        }
        return true;
    }
	
    public function getCache(){
    	$cache = new Yummy_Cache_File();
    	return $cache;
    }
    
    public function __construct(){
        $temp = Yummy_Config::get("templates");
        $cache_dir = $temp["file_cache"];
        if(empty($cache_dir)){
            throw new Yummy_Exception('cache_dir is not specified!');
        }
        $this->cache_dir = $cache_dir;
    }

    
    //写入缓存
    function __set($key , $val){
        $this->set($key ,$val);
    }
    //第三个参数为过期时间
    function set($key ,$val,$limit_time=null){
        $limit_time = $limit_time ? $limit_time : $this->limit_time;
        $hash_path = $this->MD5Hash($key);
        $file = $hash_path."/".$key.".php";
        $val = serialize($val);
        file_put_contents($file,$val) or self::error(__line__."文件写入失败");
        chmod($file,0777)  or self::error(__line__."设定文件权限失败");
        touch($file,time()+$limit_time) or self::error(__line__."更改文件时间失败");
    }

    //读取缓存
    function __get($key){
        return $this->get($key);
    }
    function get($key){
    	$hash_path = $this->MD5Hash($key);
        $file = $hash_path."/".$key.".php";
        if (@filemtime($file)>=time()){
            return unserialize(file_get_contents($file));
        }else{
            @unlink($file) ;
        }
    }

    //删除缓存文件
    function __unset($key){
        return $this->_unset($key);
    }
    //删除缓存文件
    function delete($key){
        return $this->_unset($key);
    }
    function _unset($key){
        $hash_path = $this->MD5Hash($key);
        if (@unlink($hash_path."/".$key.".php")){
            return true;
        }else{
            return false;
        }
    }

    //检查缓存是否存在，过期则认为不存在
    function __isset($key){
        return $this->_isset($key);
    }
    function _isset($key){
        $hash_path = $this->MD5Hash($key);
        $file = $hash_path."/".$key.".php";
        if (@filemtime($file)>=time()){
            return true;
        }else{
            @unlink($file) ;
            return false;
        }
    }
    
    //清除过期缓存文件
    function clear(){
/*        $files = scandir($this->cache_dir);
        foreach ($files as $val){
            if (filemtime($this->cache_dir."/".$val)cache_dir."/".$val);
            }
        }*/
    }

    //清除所有缓存文件
    function clear_all(){
        $this->deldir($this->cache_dir);
    }
	function deldir($dir) {
	  $dh = opendir($dir);
	  while ($file=readdir($dh)) {
	    if($file!="." && $file!="..") {
	      $fullpath=$dir."/".$file;
	      if(!is_dir($fullpath)) {
	          @unlink($fullpath);
	      } else {
	          $this->deldir($fullpath);
	      }
	    }
	  }
	  closedir($dh);
	}
    
}
/**vim:sw=4 et ts=4 **/
?>