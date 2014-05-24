<?php
class Default_Model_Table_ViewLast extends Yummy_ActiveRecord_Base{
  public $tableName = "view_last";
  protected $_attributes = array (
   'stuff_id' => array ('name' => 'stuff_id'),
   'title' => array ('name' => 'title'),
   'updated_on' => array ('name' => 'updated_on')
);
  function setStuffId($value){
	    $this->set('stuff_id',$value);
	    return $this;
	  }
  function getStuffId(){
	    return $this->get('stuff_id');
	  }
  function setTitle($value){
	    $this->set('title',$value);
	    return $this;
	  }
  function getTitle(){
	    return $this->get('title');
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