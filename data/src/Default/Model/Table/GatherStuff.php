<?php
class Default_Model_Table_GatherStuff extends Yummy_ActiveRecord_Base{
  public $tableName = "gather_stuff";
  protected $_attributes = array (
   'id' => array ('name' => 'id'),
   'title' => array ('name' => 'title'),
   'gather_source_id' => array ('name' => 'gather_source_id'),
   'keywords' => array ('name' => 'keywords'),
   'description' => array ('name' => 'description'),
   'content' => array ('name' => 'content'),
   'image_url' => array ('name' => 'image_url'),
   'down_url' => array ('name' => 'down_url'),
   'note' => array ('name' => 'note'),
   'gather_source' => array ('name' => 'gather_source'),
   'created_on' => array ('name' => 'created_on')
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
  function setGatherSourceId($value){
	    $this->set('gather_source_id',$value);
	    return $this;
	  }
  function getGatherSourceId(){
	    return $this->get('gather_source_id');
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
  function setContent($value){
	    $this->set('content',$value);
	    return $this;
	  }
  function getContent(){
	    return $this->get('content');
	  }
  function setImageUrl($value){
	    $this->set('image_url',$value);
	    return $this;
	  }
  function getImageUrl(){
	    return $this->get('image_url');
	  }
  function setDownUrl($value){
	    $this->set('down_url',$value);
	    return $this;
	  }
  function getDownUrl(){
	    return $this->get('down_url');
	  }
  function setNote($value){
	    $this->set('note',$value);
	    return $this;
	  }
  function getNote(){
	    return $this->get('note');
	  }
  function setGatherSource($value){
	    $this->set('gather_source',$value);
	    return $this;
	  }
  function getGatherSource(){
	    return $this->get('gather_source');
	  }
  function setCreatedOn($value){
	    $this->set('created_on',$value);
	    return $this;
	  }
  function getCreatedOn(){
	    return $this->get('created_on');
	  }
}
/** vim:sw=4:expandtab:ts=4 **/
?>