<?php
abstract class Yummy_Dba_Adapter extends Yummy_Object {

    /**
     * Do real connection
     *
     * @return bool
     */
    abstract protected function doConnect();
    /**
     * Close real connection
     *
     */
    abstract protected function doClose();

    protected $_connected=false;

    /**
     * 构造函数
     *
     * 解析dsn到相应的url格式
     *
     * @param string $dsn
     *
     */
    public function __construct() {
    }
    public function __destruct(){
        //$this->close();
    }

    public function connect(){
        if(!$this->_connected){
            $this->_connected = $this->doConnect();
        }
        return $this->_connected;
    }

    public function close(){
        if($this->_connected){
            $this->doClose();
        }
    }

    /**
     * Just compatible with EPS2006
     *
     * @deprecated
     * @see genSeq
     */
    public function genId($name){
        return $this->genSeq($name);
    }
    /**
     * Just compatible with EPS2006
     * @deprecated
     * @see query
     */
    public function pageQuery($sql,$vars=array(),$page=-1,$size=-1){
        return $this->query($sql,$size,$page,$vars);
    }
}
?>