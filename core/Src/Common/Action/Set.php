<?php
/**
* 	http://www.***.com/app/206/common/set
*   author husong (beiley@163.com)
**/
class Common_Action_Set extends Yummy_Object{
    public $pre;
	public function execute(){
       //$this->creat('admin','uc_gateway_admins');
       $databases = Yummy_Config::get("databases");
       $this->pre = $databases["pre"];
       $database = $databases["database"];
       $this->putContext("table","Tables_in_{$database}");
       $table = $this->get("table");
       
       //print_r($table);
       if(!isset($table)){
	       $dba = new Yummy_Dba();
	       $tables = $dba->query("show tables");
	       //print_r($tables);
	       $create = $this->get("create");
	       if($create=="all"){
		       	foreach ($tables as $value){
		       		$this->creat(DEFAULT_MODULE,$value["Tables_in_{$database}"]);
		       	}
	       }else{
	           $this->putContext("tables",$tables);
	           return $this->smartyResult("set/set.html");
	       }

       }else{
       	    $this->creat(DEFAULT_MODULE,$table);
       }
		

    }
    
    public function creat($model,$table){
	    $y_table = $table;
	    $y_model = $model;
    	$model = ucfirst($model);
	    $table = ucfirst($table);
	    $replace_table = str_replace($this->pre,"",$y_table);
	    $uc_table = ucfirst(Yummy_Util_Inflector::methodlize($replace_table));
	  	$time = date("Y-m-d h:i:s",time());
	  	try{
		  	$dba = new Yummy_Dba();
		    $dba->query("describe {$y_table}");
	  	}catch (Yummy_Exception $e){
	  		throw new Yummy_Exception($e->getMessage());
	  	}
	  	
	    $data = "<?php\n";
	    $data .= "/**\n";
	    $data .= "* {$model}_Model_{$uc_table} created on: {$time} by husong\n";
	    $data .= "**/\n";
	    $data .= "class {$model}_Model_{$uc_table} extends {$model}_Model_Table_{$uc_table}{\n";
		$data .= "\n";
	    $data .= "    /**\n";
	    $data .= "    * default method\n";
	    $data .= "    **/\n";
		$data .= "    public function execute(){\n";
		$data .= "    \n";
		$data .= "    }\n";
		$data .= "\n";
	           
	    $data .= "}\n";
	    $data .= "/** vim:sw=4:expandtab:ts=4 **/\n";
	    $data .= "?>";
	
	    $shtml = new Yummy_Util_Html();
	    $a = $shtml->creat($data,1,$uc_table,'php',PRODUCT_DIR."/src/{$model}/Model",false);
	    if($a){
		    echo "creat sucess!\n</br>";
		    echo $shtml->path."\n</br>";
	    }else {
	    	echo "creat error!\n</br>";
	    	echo $shtml->path."\n</br>";
	    }
		$this->creatModel($y_model,$y_table);
    }
    public function creatModel($model,$table){
	    $model = ucfirst($model);
	    $y_table = $table;
	    $table = ucfirst($table);
        $replace_table = str_replace($this->pre,"",$y_table);
        $uc_table = ucfirst(Yummy_Util_Inflector::methodlize($replace_table));
	    
    	try{
		  	$dba = new Yummy_Dba();
		    $result = $dba->query("describe {$y_table}");
	  	}catch (Yummy_Exception $e){
	  		throw new Yummy_Exception($e->getMessage());
	  	}
	    $allFiled = array();
	    foreach ($result as $value){
	    	$allFiled[] = $value['Field'];
	    }
	    //print_r($allFiled);
	    //exit;
	    //$allFiled = array("ID","userId","Type");
	    $allFiled_num = count($allFiled);
	    $allFiled_child = "";
	    $allFiled_function = "";
	    
	    $data = "<?php\n";
	    $data .= "class {$model}_Model_Table_{$uc_table} extends Yummy_ActiveRecord_Base{\n";
	    $data .= "  public \$tableName = \"{$y_table}\";\n";
	    $data .= "  protected \$_attributes = array (\n";
	            //循环字段数组
	            foreach($allFiled as $key=>$value){
	               $a = "   '{$value}' => array ('name' => '{$value}')";
	               if($key == $allFiled_num-1){
	                    $allFiled_child .= $a."\n";
	               }else{
	                    $allFiled_child .= $a.",\n";
	               }
	            }
	    
	    $data .= $allFiled_child;
	    $data .= ");\n";
	            //循环字段函数
	            foreach($allFiled as $key=>$value){
	               $filedKey = ucfirst(Yummy_Util_Inflector::methodlize(str_replace($this->pre,"",$value)));
	               $allFiled_function .= "  function set{$filedKey}(\$value){
	    \$this->set('{$value}',\$value);
	    return \$this;
	  }\n";              
	    $allFiled_function .= "  function get{$filedKey}(){
	    return \$this->get('{$value}');
	  }\n";
	            }
	
	    $data .= $allFiled_function;
	    $data .= "}\n";
	    $data .= "/** vim:sw=4:expandtab:ts=4 **/\n";
	    $data .= "?>";
	
	    $shtml = new Yummy_Util_Html();
	    $a = $shtml->creat($data,1,$uc_table,'php',PRODUCT_DIR."/src/{$model}/Model/Table");
	    if($a){
		    echo "creat sucess!\n</br>";
		    echo $shtml->path."\n</br>";
	    }else {
	    	echo "creat error!\n</br>";
	    	echo $shtml->path."\n</br>";
	    }

    }
}
?>