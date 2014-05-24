<?php
class Yummy_Dba extends Yummy_Dba_Adapter{
    public $database_type;
    public $host;
    public $username;
    public $password;
    public $database;
    public $db;
	public $_data = array();
	public $self;

    protected function doConnect(){
    	$data = Yummy_Config::get("databases");
        $this->database_type = $data["type"];
        $this->host = $data["host"];
        $this->username = $data["username"];
        $this->password = $data["password"];
        $this->database = $data["database"];
        //浼�缁���瑰��
        $this->db = &NewADOConnection($this->database_type);
        $cok = @$this->db->Connect($this->host,$this->username,$this->password,$this->database);
        if (!$cok) {echo "connection database is failed!";exit;}
		/*$dsn = "mysqli://username:password@localhost/database?charSet=utf8";
		$conn = new NewADOConnection($dsn);*/
        $this->db->charSet = "UTF8";
		$this->_connected = true;
		$ok = $this->_connected;
        if ( $ok && ($this->database_type=='mysql' || $this->database_type=='mysqli') ){
            if(!empty($this->db->charSet)){
                $ok2 =  $this->db->Execute('SET NAMES '.$this->db->charSet);
                if(!$ok2){
                    throw new Yummy_Exception("Cannot set names to ".$this->db->charSet);
                }
            }
        }
		return $ok;
    }
	
    protected function doClose(){
        $this->db->close();
        $this->_connected = false;
    }
    public function execute($sql,$vars=array()){
        if(!$this->connect()){
            throw new Yummy_Exception("Database connect failed");
        }
        Yummy_Object::debug("SQL:[$sql]",__METHOD__);
        $rs= $this->db->Execute($sql,$vars);
        if($rs===false){
            throw new Yummy_Exception("Database Error:[".$this->db->ErrorMsg().'] Cause SQL:'.$sql);
        }
        return true;
    }
	
	public function query($sql,$size=-1,$page=1,$vars=array()){
		if(!$this->connect()){
            throw new Yummy_Exception("Database connect failed");
        }
		//$rs =  $this->db->PageExecute($sql,$size,$page,$vars);
        if($size>0){
            if($page>=1){
					$offset = ($page-1)*$size;
            }else{
                $offset =-1;
            }
        }else{
            $page=-1;
            $size=-1;
            $offset =-1;
        }
         if($size>0){
            $sql .= ' LIMIT '.$size;
            if($offset>0){
                $sql.=' OFFSET '.$offset;
            }
        }  
        //$rs = $this->db->SelectLimit($sql,$size,$offset,$vars);
        $rs = $this->db->Query($sql,$vars);
		//print_r($rs->GetRows());
        Yummy_Object::debug("SQL:[$sql]:vars:".print_r($vars,true),__METHOD__);
        if($rs===false) {
            throw new Yummy_Exception("Database Error:[".$this->db->ErrorMsg().'] Cause SQL:['.$sql.']');
        }
        return $rs->GetRows();
    }
    

    public function getTableList(){
        if(!$this->connect()) return array();
        return $this->db->MetaTables('TABLES');
    }

    /**
     * backwords compatibillity
     *
     * @deprecated
     */
    public function tables(){
        return $this->getTableList();
    }

    public function getFieldMetaList($table){
        if(!$this->connect()) return array();
        $fieldObjs = $this->db->MetaColumns($table);
        if(!$fieldObjs){
            throw new Yummy_Exception('table:'.$table.' no fields,error:'.$this->db->ErrorMsg());
        }
        $fields = array();
        foreach($fieldObjs as $f){
            $fields[$f->name]= array('name'=>$f->name,'type'=>self::convertFieldType($f->type), 'length'=>$f->max_length);
        }
        return $fields;
    }
    private static function convertFieldType($type){
        switch($type){
            case 'varchar':
            case 'char':
            case 'text':
                return 'S';
            case 'date':
                return 'D';
            case 'datetime':
                return 'T';
            case 'time':
            case 'int':
            case 'float':
            case 'long':
                return 'N';
            default:
                return 'S';
        }
    }
    /**
     * backwards compatibillity
     * @deprecated
     */
    public function fields($table){
        return $this->getFieldMetaList($table);
    }

    public function genSeq($name){
        $name = 'SEQ_'.strtoupper($name);
        if(!$this->connect()){
            throw new Yummy_Exception('Connection failed.Error:'.$this->db->ErrorMsg());
        }
        $v = $this->db->GenID($name,1);
        if($v===false){
            throw new Yummy_Exception('Error:'.$this->db->ErrorMsg());
        }
        return $v;
    }
    
    public function dropSeq($name){
        $name = 'SEQ_'.strtoupper($name);
        return $this->execute('DROP TABLE IF EXISTS '.$name);
    }
}
?>