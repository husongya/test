<?php
class Default_Model_Table_Category extends Yummy_ActiveRecord_Base{
  public $tableName = "category";
  protected $_attributes = array (
   'id' => array ('name' => 'id'),
   'title' => array ('name' => 'title'),
   'keywords' => array ('name' => 'keywords'),
   'description' => array ('name' => 'description'),
   'ordering' => array ('name' => 'ordering'),
   'state' => array ('name' => 'state')
);
  function setId($value){
	    $this->set('id',$value);
	    return $this;
	  }
  function getId(){
	    return $this->get('id');
	  }
  function setTitle($value){
	    $this->set('title',$value);
	    return $this;
	  }
  function getTitle(){
	    return $this->get('title');
	  }
  function setKeywords($value){
	    $this->set('keywords',$value);
	    return $this;
	  }
  function getKeywords(){
	    return $this->get('keywords');
	  }
  function setDescription($value){
	    $this->set('description',$value);
	    return $this;
	  }
  function getDescription(){
	    return $this->get('description');
	  }
  function setOrdering($value){
	    $this->set('ordering',$value);
	    return $this;
	  }
  function getOrdering(){
	    return $this->get('ordering');
	  }
  function setState($value){
	    $this->set('state',$value);
	    return $this;
	  }
  function getState(){
	    return $this->get('state');
	  }
}
/** vim:sw=4:expandtab:ts=4 **/
?>