<?php
class Default_Model_Table_Stuff extends Yummy_ActiveRecord_Base{
  public $tableName = "stuff";
  protected $_attributes = array (
   'id' => array ('name' => 'id'),
   'rewriter_url' => array ('name' => 'rewriter_url'),
   'title' => array ('name' => 'title'),
   'user_id' => array ('name' => 'user_id'),
   'type' => array ('name' => 'type'),
   'category_id' => array ('name' => 'category_id'),
   'keywords' => array ('name' => 'keywords'),
   'description' => array ('name' => 'description'),
   'content' => array ('name' => 'content'),
   'image_url' => array ('name' => 'image_url'),
   'down_url' => array ('name' => 'down_url'),
   'state' => array ('name' => 'state'),
   'source' => array ('name' => 'source'),
   'recommend' => array ('name' => 'recommend'),
   'recommend_time' => array ('name' => 'recommend_time'),
   'view_count' => array ('name' => 'view_count'),
   'down_count' => array ('name' => 'down_count'),
   'created_on' => array ('name' => 'created_on'),
   'updated_on' => array ('name' => 'updated_on'),
   'published_on' => array ('name' => 'published_on')
);
  function setId($value){
	    $this->set('id',$value);
	    return $this;
	  }
  function getId(){
	    return $this->get('id');
	  }
  function setRewriterUrl($value){
	    $this->set('rewriter_url',$value);
	    return $this;
	  }
  function getRewriterUrl(){
	    return $this->get('rewriter_url');
	  }
  function setTitle($value){
	    $this->set('title',$value);
	    return $this;
	  }
  function getTitle(){
	    return $this->get('title');
	  }
  function setUserId($value){
	    $this->set('user_id',$value);
	    return $this;
	  }
  function getUserId(){
	    return $this->get('user_id');
	  }
  function setType($value){
	    $this->set('type',$value);
	    return $this;
	  }
  function getType(){
	    return $this->get('type');
	  }
  function setCategoryId($value){
	    $this->set('category_id',$value);
	    return $this;
	  }
  function getCategoryId(){
	    return $this->get('category_id');
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
  function setState($value){
	    $this->set('state',$value);
	    return $this;
	  }
  function getState(){
	    return $this->get('state');
	  }
  function setSource($value){
	    $this->set('source',$value);
	    return $this;
	  }
  function getSource(){
	    return $this->get('source');
	  }
  function setRecommend($value){
	    $this->set('recommend',$value);
	    return $this;
	  }
  function getRecommend(){
	    return $this->get('recommend');
	  }
  function setRecommendTime($value){
	    $this->set('recommend_time',$value);
	    return $this;
	  }
  function getRecommendTime(){
	    return $this->get('recommend_time');
	  }
  function setViewCount($value){
	    $this->set('view_count',$value);
	    return $this;
	  }
  function getViewCount(){
	    return $this->get('view_count');
	  }
  function setDownCount($value){
	    $this->set('down_count',$value);
	    return $this;
	  }
  function getDownCount(){
	    return $this->get('down_count');
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
  function setPublishedOn($value){
	    $this->set('published_on',$value);
	    return $this;
	  }
  function getPublishedOn(){
	    return $this->get('published_on');
	  }
}
/** vim:sw=4:expandtab:ts=4 **/
?>