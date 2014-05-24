<?php
class Common_Util_User extends Yummy_Object{
	public function set($key,$value=null){
        Yummy_Session_Base::getContext()->set($key,$value);
	    return $this;
	}
	public function get($key){
        $value = Yummy_Session_Base::getContext()->get($key);
	    return $value;
	}
}
?>