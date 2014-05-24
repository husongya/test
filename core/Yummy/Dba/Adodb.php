<?php
/**
 * ADODb Database Adapter
 *
 * A Bridge to ADODB
 *
 * @package ActiveRecord
 * @subpackage DBA
 */
class Yummy_Dba_Adodb extends Yummy_Dba_Adapter {
    /**
     * @var AdoConnection
     */
    protected $_adodb = null;


    
    protected function doConnect() {

        //remove adodb://
        $dsn = substr($this->dsn,8);

        $this->_adodb = &NewADOConnection($dsn);
        $this->_adodb->SetFetchMode(ADODB_FETCH_ASSOC);
        $this->_adodb->autoRollback = true;

        $ok = $this->_adodb->connect();

        if ( $ok && ($this->_adodb->databaseType=='mysql' || $this->_adodb->databaseType=='mysqli') ){
            if(!empty($this->_adodb->charSet)){
                $ok2 =  $this->_adodb->Execute('SET NAMES '.$this->_adodb->charSet);
                if(!$ok2){
                    throw new Yummy_Exception("Cannot set names to ".$this->_adodb->charSet);
                }
            }
        } 
        return $ok;
    }
    protected function doClose(){
        $this->_adodb->close();
        $this->_connected = false;
    }
    public function execute($sql,$vars=array()){
        if(!$this->connect()){
            throw new Yummy_Exception("Database connect failed");
        }
//        $this->_adodb->debug=99;
        self::debug("SQL:[$sql]",__METHOD__);
        $rs= $this->_adodb->Execute($sql,$vars);
        if($rs===false){
//            adodb_backtrace();
            throw new Yummy_Exception("Database Error:[".$this->_adodb->ErrorMsg().'] Cause SQL:'.$sql);
        }
        return true;
    }

    public function query($sql,$size=-1,$page=1,$vars=array()){
        if(!$this->connect()){
            throw new Yummy_Exception("Database connect failed");
        }
//        $rs =  $this->_adodb->PageExecute($sql,$size,$page,$vars);
        if($size>0){
            if($page>=1){
                $offset = ($page-1)*$size;
            }else{
                $offset =-1;
            }
        }else{
            $page=-1;
            $size=-1;
        }
        if($size>0){
            $sql .= ' LIMIT '.$size;
            if($offset>0){
                $sql.=' OFFSET '.$offset;
            }
        }
        //$rs = $this->_adodb->SelectLimit($sql,$size,$offset,$vars);
        $rs = $this->_adodb->Query($sql,$vars);
        self::debug("SQL:[$sql]",__METHOD__);
        if($rs===false) {
            throw new Yummy_Exception("Database Error:[".$this->_adodb->ErrorMsg().'] Cause SQL:['.$sql.']');
        }
        return $rs->GetRows();
    }

    public function getTableList(){
        if(!$this->connect()) return array();
        return $this->_adodb->MetaTables('TABLES');
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
        $fieldObjs = $this->_adodb->MetaColumns($table);
        if(!$fieldObjs){
            throw new Yummy_Exception('table:'.$table.' no fields,error:'.$this->_adodb->ErrorMsg());
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
            throw new Yummy_Exception('Connection failed.Error:'.$this->_adodb->ErrorMsg());
        }
        $v = $this->_adodb->GenID($name,1);
        if($v===false){
            throw new Yummy_Exception('Error:'.$this->_adodb->ErrorMsg());
        }
        return $v;
    }
    
    public function dropSeq($name){
        $name = 'SEQ_'.strtoupper($name);
        return $this->execute('DROP TABLE IF EXISTS '.$name);
    }
}
?>