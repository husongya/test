<?php
	define("DEFAULT_MODULE","default"); //默认模块module
	define("DEFAULT_ACTION","index"); //默认action
	define('DEFAULT_FUNCTION',"execute"); //默认function
    $app = new Yummy_Yummy(); //实例
	$app -> run(); //运行
	function __autoLoad($class_name){
	    $url = split("_", $class_name);
	    $temp = "";
	    for ($i=0; $i<count($url)-1;$i++){
	        $temp .= $url[$i]."/";
	    }
	    $ext = $url[count($url)-1];
	    if($url[0] == "Yummy"){
	        $path2 = $path = SYSTEM_DIR."/{$temp}{$ext}.php";
	    }else{
	        $path = PRODUCT_DIR."/src/{$temp}{$ext}.php";
	        $path2 = SYSTEM_DIR."/Src/{$temp}{$ext}.php";
	    }
	    if(!file_exists($path)){
	        Yummy_Object::debug("there is not this file : {$path},skip...","Yummy_Start");
	        if(!file_exists($path2)){
	            Yummy_Object::error("there is not this file : {$path2},end!!!","Yummy_Start");
	            exit();
	        }else{
	            require_once($path2); //加载框架
	        }
	    }else{
	        require_once($path); //加载框架
	    }
	}
?>