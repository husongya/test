<?php
class Default_Model_Table_User extends Yummy_ActiveRecord_Base{
  public $tableName = "user";
  protected $_attributes = array (
   'id' => array ('name' => 'id'),
   'account' => array ('name' => 'account'),
   'password' => array ('name' => 'password'),
   'nick' => array ('name' => 'nick'),
   'level' => array ('name' => 'level'),
   'state' => array ('name' => 'state'),
   'created_on' => array ('name' => 'created_on'),
   'last_login' => array ('name' => 'last_login')
);
  function setId($value){
	    $this->set('id',$value);
	    return $this;
	  }
  function getId(){
	    return $this->get('id');
	  }
  function setAccount($value){
	    $this->set('account',$value);
	    return $this;
	  }
  function getAccount(){
	    return $this->get('account');
	  }
  function setPassword($value){
	    $this->set('password',$value);
	    return $this;
	  }
  function getPassword(){
	    return $this->get('password');
	  }
  function setNick($value){
	    $this->set('nick',$value);
	    return $this;
	  }
  function getNick(){
	    return $this->get('nick');
	  }
  function setLevel($value){
	    $this->set('level',$value);
	    return $this;
	  }
  function getLevel(){
	    return $this->get('level');
	  }
  function setState($value){
	    $this->set('state',$value);
	    return $this;
	  }
  function getState(){
	    return $this->get('state');
	  }
  function setCreatedOn($value){
	    $this->set('created_on',$value);
	    return $this;
	  }
  function getCreatedOn(){
	    return $this->get('created_on');
	  }
  function setLastLogin($value){
	    $this->set('last_login',$value);
	    return $this;
	  }
  function getLastLogin(){
	    return $this->get('last_login');
	  }
}
/** vim:sw=4:expandtab:ts=4 **/
?>