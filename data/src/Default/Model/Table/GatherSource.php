<?php
class Default_Model_Table_GatherSource extends Yummy_ActiveRecord_Base{
  public $tableName = "gather_source";
  protected $_attributes = array (
   'id' => array ('name' => 'id'),
   'url' => array ('name' => 'url'),
   'state' => array ('name' => 'state'),
   'source_type' => array ('name' => 'source_type'),
   'err_count' => array ('name' => 'err_count'),
   'created_on' => array ('name' => 'created_on'),
   'updated_on' => array ('name' => 'updated_on')
);
  function setId($value){
	    $this->set('id',$value);
	    return $this;
	  }
  function getId(){
	    return $this->get('id');
	  }
  function setUrl($value){
	    $this->set('url',$value);
	    return $this;
	  }
  function getUrl(){
	    return $this->get('url');
	  }
  function setState($value){
	    $this->set('state',$value);
	    return $this;
	  }
  function getState(){
	    return $this->get('state');
	  }
  function setSourceType($value){
	    $this->set('source_type',$value);
	    return $this;
	  }
  function getSourceType(){
	    return $this->get('source_type');
	  }
  function setErrCount($value){
	    $this->set('err_count',$value);
	    return $this;
	  }
  function getErrCount(){
	    return $this->get('err_count');
	  }
  function setCreatedOn($value){
	    $this->set('created_on',$value);
	    return $this;
	  }
  function getCreatedOn(){
	    return $this->get('created_on');
	  }
  function setUpdatedOn($value){
	    $this->set('updated_on',$value);
	    return $this;
	  }
  function getUpdatedOn(){
	    return $this->get('updated_on');
	  }
}
/** vim:sw=4:expandtab:ts=4 **/
?>